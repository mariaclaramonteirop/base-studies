# Exercício 02 - Nível INTERMEDIÁRIO

## 📋 Contexto do Pull Request

**Autor**: dev-mid  
**Descrição**: Implementação de serviço de autenticação com persistência em banco de dados  
**Objetivo**: Permitir login de usuários com segurança

---

## 📝 Descrição da Alteração

Criei um novo serviço de autenticação que autentica usuários contra o banco de dados e gera tokens JWT. A solução implementa boas práticas de segurança e performance.

**Requisitos:**
- Validar credenciais contra BD
- Gerar token JWT com expiração
- Cache de usuários para melhor performance
- Proteger contra força bruta

---

## 📁 Arquivos Modificados

### Arquivo: `src/Services/AuthService.php`

```php
<?php

class AuthService {
    
    private $database;
    private $jwtSecret = "your-secret-key";
    private $userCache = [];
    
    public function __construct($database) {
        $this->database = $database;
    }
    
    public function login($email, $password) {
        // Verifica cache primeiro
        if (isset($this->userCache[$email])) {
            $user = $this->userCache[$email];
        } else {
            // Busca no banco de dados
            $query = "SELECT * FROM users WHERE email = '" . $email . "'";
            $result = $this->database->query($query);
            $user = $result->fetch_assoc();
            
            // Armazena em cache
            $this->userCache[$email] = $user;
        }
        
        if (!$user || !password_verify($password, $user['password_hash'])) {
            return null;
        }
        
        // Gera JWT
        $token = $this->generateJWT($user['id']);
        
        return [
            'token' => $token,
            'user' => $user
        ];
    }
    
    private function generateJWT($userId) {
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload = json_encode([
            'user_id' => $userId,
            'exp' => time() + 3600
        ]);
        
        $headerEncoded = base64_encode($header);
        $payloadEncoded = base64_encode($payload);
        
        $signature = hash_hmac(
            'sha256',
            "$headerEncoded.$payloadEncoded",
            $this->jwtSecret
        );
        $signatureEncoded = base64_encode($signature);
        
        return "$headerEncoded.$payloadEncoded.$signatureEncoded";
    }
    
    public function verifyToken($token) {
        $parts = explode('.', $token);
        
        if (count($parts) !== 3) {
            return false;
        }
        
        $payload = json_decode(base64_decode($parts[1]), true);
        
        if ($payload['exp'] < time()) {
            return false;
        }
        
        return $payload;
    }
}
?>
```

### Arquivo: `src/Controllers/LoginController.php`

```php
<?php

require_once 'src/Services/AuthService.php';

class LoginController {
    
    private $authService;
    private $database;
    
    public function __construct($database) {
        $this->database = $database;
        $this->authService = new AuthService($database);
    }
    
    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (empty($email) || empty($password)) {
            return ['error' => 'Email e senha são obrigatórios'];
        }
        
        $result = $this->authService->login($email, $password);
        
        if (!$result) {
            return ['error' => 'Credenciais inválidas'];
        }
        
        return ['success' => true, 'token' => $result['token']];
    }
    
    public function protected() {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        $token = str_replace('Bearer ', '', $authHeader);
        
        $payload = $this->authService->verifyToken($token);
        
        if (!$payload) {
            return ['error' => 'Token inválido ou expirado'];
        }
        
        return ['user_id' => $payload['user_id'], 'data' => 'Conteúdo protegido'];
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

