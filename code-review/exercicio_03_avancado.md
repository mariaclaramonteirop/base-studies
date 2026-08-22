# Exercício 03 - Nível AVANÇADO

## 📋 Contexto do Pull Request

**Autor**: dev-senior  
**Descrição**: Implementação de API REST para gerenciamento de pedidos com validações complexas  
**Objetivo**: Criar endpoint seguro e eficiente para CRUD de pedidos

---

## 📝 Descrição da Alteração

Implementei uma API REST completa para gerenciamento de pedidos. A solução inclui:
- Validação de regras de negócio complexas
- Otimização de queries com relacionamentos
- Tratamento robusto de erros
- Segurança contra ataques comuns
- Logging de operações críticas

**Requisitos:**
- Criar, ler, atualizar e deletar pedidos
- Validar estoque antes de criar pedido
- Impedir duplicação de pedidos
- Rastrear mudanças de status
- Apenas usuários autorizados podem atualizar

---

## 📁 Arquivos Modificados

### Arquivo: `src/Models/Order.php`

```php
<?php

class Order {
    private $id;
    private $userId;
    private $items = [];
    private $status = 'pending';
    private $createdAt;
    private $database;
    
    public function __construct($database) {
        $this->database = $database;
        $this->createdAt = date('Y-m-d H:i:s');
    }
    
    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    
    public function setUserId($userId) { $this->userId = $userId; }
    public function getUserId() { return $this->userId; }
    
    public function addItem($productId, $quantity, $price) {
        $this->items[] = [
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $price
        ];
    }
    
    public function getItems() { return $this->items; }
    
    public function setStatus($status) { 
        if (in_array($status, ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'])) {
            $this->status = $status;
        }
    }
    public function getStatus() { return $this->status; }
    
    public function getTotalAmount() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
?>
```

### Arquivo: `src/Services/OrderService.php`

```php
<?php

class OrderService {
    
    private $database;
    private $logger;
    private $cache;
    
    public function __construct($database, $logger, $cache) {
        $this->database = $database;
        $this->logger = $logger;
        $this->cache = $cache;
    }
    
    public function createOrder($userId, $items) {
        try {
            // Valida itens
            if (empty($items)) {
                throw new Exception("Pedido deve conter pelo menos um item");
            }
            
            // Verifica duplicação (últimos 5 minutos)
            $recentOrders = $this->database->query(
                "SELECT COUNT(*) as count FROM orders 
                 WHERE user_id = ? AND created_at > DATE_SUB(NOW(), INTERVAL 5 MINUTE)",
                [$userId]
            );
            
            if ($recentOrders[0]['count'] > 10) {
                throw new Exception("Muitas tentativas. Tente novamente mais tarde.");
            }
            
            // Validação de estoque
            $this->database->beginTransaction();
            
            foreach ($items as $item) {
                $stock = $this->database->query(
                    "SELECT quantity FROM products WHERE id = ? FOR UPDATE",
                    [$item['product_id']]
                );
                
                if (!$stock || $stock[0]['quantity'] < $item['quantity']) {
                    throw new Exception("Estoque insuficiente para produto ID: " . $item['product_id']);
                }
            }
            
            // Cria pedido
            $order = new Order($this->database);
            $order->setUserId($userId);
            
            foreach ($items as $item) {
                $product = $this->database->query(
                    "SELECT * FROM products WHERE id = ?",
                    [$item['product_id']]
                );
                
                $order->addItem(
                    $item['product_id'],
                    $item['quantity'],
                    $product[0]['price']
                );
            }
            
            // Insere no BD
            $orderId = $this->database->insert(
                "INSERT INTO orders (user_id, total_amount, status, created_at) 
                 VALUES (?, ?, ?, ?)",
                [$userId, $order->getTotalAmount(), 'pending', date('Y-m-d H:i:s')]
            );
            
            // Insere itens
            foreach ($items as $item) {
                $this->database->insert(
                    "INSERT INTO order_items (order_id, product_id, quantity, price) 
                     VALUES (?, ?, ?, ?)",
                    [$orderId, $item['product_id'], $item['quantity'], $item['price']]
                );
                
                // Atualiza estoque
                $this->database->update(
                    "UPDATE products SET quantity = quantity - ? WHERE id = ?",
                    [$item['quantity'], $item['product_id']]
                );
            }
            
            $this->database->commit();
            
            // Limpa cache
            $this->cache->delete("user_orders_" . $userId);
            
            $this->logger->info("Order created", ['order_id' => $orderId, 'user_id' => $userId]);
            
            return ['success' => true, 'order_id' => $orderId];
            
        } catch (Exception $e) {
            $this->database->rollback();
            $this->logger->error("Order creation failed", ['user_id' => $userId, 'error' => $e->getMessage()]);
            throw $e;
        }
    }
    
    public function getOrder($orderId, $userId) {
        $cacheKey = "order_" . $orderId;
        
        if ($this->cache->get($cacheKey)) {
            $order = json_decode($this->cache->get($cacheKey), true);
        } else {
            $order = $this->database->query(
                "SELECT o.*, oi.product_id, oi.quantity, oi.price 
                 FROM orders o 
                 LEFT JOIN order_items oi ON o.id = oi.order_id 
                 WHERE o.id = ? AND o.user_id = ?",
                [$orderId, $userId]
            );
            
            $this->cache->set($cacheKey, json_encode($order), 3600);
        }
        
        return $order;
    }
    
    public function updateOrderStatus($orderId, $newStatus, $userId) {
        // Autorização simplista - apenas o dono pode atualizar
        $order = $this->database->query(
            "SELECT user_id FROM orders WHERE id = ?",
            [$orderId]
        );
        
        if ($order[0]['user_id'] != $userId) {
            throw new Exception("Acesso negado");
        }
        
        $this->database->update(
            "UPDATE orders SET status = ?, updated_at = ? WHERE id = ?",
            [$newStatus, date('Y-m-d H:i:s'), $orderId]
        );
        
        $this->cache->delete("order_" . $orderId);
        $this->logger->info("Order status updated", ['order_id' => $orderId, 'status' => $newStatus]);
        
        return true;
    }
    
    public function deleteOrder($orderId, $userId) {
        $order = $this->database->query(
            "SELECT status, user_id FROM orders WHERE id = ?",
            [$orderId]
        );
        
        if ($order[0]['user_id'] != $userId) {
            throw new Exception("Acesso negado");
        }
        
        if ($order[0]['status'] !== 'pending') {
            throw new Exception("Apenas pedidos pendentes podem ser cancelados");
        }
        
        $this->database->delete("DELETE FROM order_items WHERE order_id = ?", [$orderId]);
        $this->database->delete("DELETE FROM orders WHERE id = ?", [$orderId]);
        
        $this->cache->delete("order_" . $orderId);
        
        return true;
    }
}
?>
```

### Arquivo: `src/Controllers/OrderController.php`

```php
<?php

class OrderController {
    
    private $orderService;
    private $auth;
    
    public function __construct($orderService, $auth) {
        $this->orderService = $orderService;
        $this->auth = $auth;
    }
    
    public function create() {
        $user = $this->auth->getCurrentUser();
        
        if (!$user) {
            http_response_code(401);
            return ['error' => 'Unauthorized'];
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        try {
            $result = $this->orderService->createOrder($user['id'], $data['items']);
            http_response_code(201);
            return $result;
        } catch (Exception $e) {
            http_response_code(400);
            return ['error' => $e->getMessage()];
        }
    }
    
    public function get($orderId) {
        $user = $this->auth->getCurrentUser();
        
        if (!$user) {
            http_response_code(401);
            return ['error' => 'Unauthorized'];
        }
        
        $order = $this->orderService->getOrder($orderId, $user['id']);
        
        if (!$order) {
            http_response_code(404);
            return ['error' => 'Order not found'];
        }
        
        return ['data' => $order];
    }
    
    public function update($orderId) {
        $user = $this->auth->getCurrentUser();
        
        if (!$user) {
            http_response_code(401);
            return ['error' => 'Unauthorized'];
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        try {
            $this->orderService->updateOrderStatus($orderId, $data['status'], $user['id']);
            return ['success' => true];
        } catch (Exception $e) {
            http_response_code(400);
            return ['error' => $e->getMessage()];
        }
    }
    
    public function delete($orderId) {
        $user = $this->auth->getCurrentUser();
        
        if (!$user) {
            http_response_code(401);
            return ['error' => 'Unauthorized'];
        }
        
        try {
            $this->orderService->deleteOrder($orderId, $user['id']);
            return ['success' => true];
        } catch (Exception $e) {
            http_response_code(400);
            return ['error' => $e->getMessage()];
        }
    }
}
?>
```

---

## 🔍 Sua Revisão

Adicione seus comentários abaixo no formato:

```
**Arquivo:** `caminho/arquivo.php`
**Linha:** XX

> Seu comentário
```

Quando terminar, diga **"finalizei a revisão"**

