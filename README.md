**Sistema de Gestão - Extensão UFJF**

---

**Descrição:**
Sistema administrativo desenvolvido em **Laravel 11** com template **AdminLTE 3**, para gestão de usuários e projetos do departamento de Extensão.

## 📋 Pré-requisitos

* PHP 8.2 ou superior
* Composer (precisa instalar se não tiver)
* Node.js & NPM (precisa instalar se não tiver)
* MariaDB 10.4+

## 🔧 Instalação Passo a Passo

### 1️⃣ Clonar o repositório

```
git clone https://github.com/benector/ihc-trabalho.git
cd extensao-ufjf
```

### 2️⃣ Instalar dependências

```
# Composer para dependências PHP
composer install

# Node/NPM para assets e AdminLTE
npm install
```

### 3️⃣ Gerar chave da aplicação e compilar assets

```
php artisan key:generate
npm run dev
```

### 4️⃣ Configuração do Banco de Dados (MariaDB)

No terminal do MariaDB:

```
CREATE DATABASE extensao_ufjf CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'extensao'@'localhost' IDENTIFIED BY 'senha123';
GRANT ALL PRIVILEGES ON extensao_ufjf.* TO 'extensao'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 5️⃣ Executar migrações

```
php artisan migrate
```

### 6️⃣ Criar usuário e instâncias no banco

```
php artisan db:seed 
```

**Credenciais padrão:**

* E-mail: [admin@ufjf.br]
* Senha: 12345678

### 7️⃣ Execução Local

```
php artisan serve
```

Acesse no navegador: [http://localhost:8000](http://localhost:8000)

---

