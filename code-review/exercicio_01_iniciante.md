# Exercício 01 - Nível INICIANTE

## 📋 Contexto do Pull Request

**Autor**: dev-junior  
**Descrição**: Implementação de validação de formulário de cadastro de usuário  
**Objetivo**: Validar dados do usuário antes de salvar no banco de dados

---

## 📝 Descrição da Alteração

Adicionei uma nova classe para validar o formulário de cadastro. A função valida nome, email e senha conforme os requisitos de negócio.

**Requisitos:**
- Nome: obrigatório, mínimo 3 caracteres
- Email: obrigatório, deve ser um email válido
- Senha: obrigatório, mínimo 8 caracteres

---

## 📁 Arquivos Modificados

### Arquivo: `src/Validators/UserValidator.php`

```php
<?php

class UserValidator {
    
    public function validateUserRegistration($data) {
        $errors = [];
        
        // Validar nome
        if (empty($data['name'])) {
            $errors[] = "Nome é obrigatório";
        } else if (strlen($data['name']) < 3) {
            $errors[] = "Nome deve ter no mínimo 3 caracteres";
        }
        
        // Validar email
        if (empty($data['email'])) {
            $errors[] = "Email é obrigatório";
        } else if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email inválido";
        }
        
        // Validar senha
        if (empty($data['password'])) {
            $errors[] = "Senha é obrigatória";
        } else if (strlen($data['password']) < 8) {
            $errors[] = "Senha deve ter no mínimo 8 caracteres";
        }
        
        return $errors;
    }
    
    public function isValid($data) {
        $errors = $this->validateUserRegistration($data);
        return count($errors) == 0;
    }
}
?>
```

### Arquivo: `src/Controllers/UserController.php`

```php
<?php

require_once 'src/Validators/UserValidator.php';

class UserController {
    
    private $validator;
    
    public function __construct() {
        $this->validator = new UserValidator();
    }
    
    public function register() {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        
        if (!$this->validator->isValid($data)) {
            return $this->validator->validateUserRegistration($data);
        }
        
        // Salvar usuário no banco de dados
        // ...
        
        return ["success" => true];
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

