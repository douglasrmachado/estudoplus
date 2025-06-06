# Estudo+ - Organizador de Estudos Inteligente

## 📋 Sobre o Projeto

Estudo+ é uma aplicação web desenvolvida para ajudar estudantes a organizarem seus estudos, tarefas e autoavaliações. O sistema permite o controle de matérias, sessões de estudo, tarefas pendentes e acompanhamento de desempenho semanal.

## 🚀 Tecnologias Utilizadas

- Laravel 10.x
- MySQL
- TailwindCSS/Bootstrap
- PHP 8.4

## 📦 Pré-requisitos

- PHP >= 8.4
- Composer
- MySQL >= 8.0
- Node.js & NPM

## 🛠️ Instalação

1. Clone o repositório
```bash
git clone [url-do-repositorio]
```

2. Instale as dependências do PHP
```bash
composer install
```

3. Copie o arquivo de ambiente
```bash
cp .env.example .env
```

4. Configure o arquivo .env com suas credenciais de banco de dados
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=estudoplus
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

5. Gere a chave da aplicação
```bash
php artisan key:generate
```

6. Execute as migrações
```bash
php artisan migrate
```

## 🏃‍♂️ Executando o Projeto

1. Inicie o servidor de desenvolvimento
```bash
php artisan serve
```

2. Acesse a aplicação em `http://localhost:8000`

## 📝 Funcionalidades

- Sistema de autenticação completo
- Gerenciamento de matérias
- Controle de sessões de estudo
- Sistema de tarefas com prazos
- Autoavaliação semanal
- Dashboard com métricas de desempenho

## 🤝 Contribuindo

[Instruções sobre como contribuir com o projeto]

## 📄 Licença

Este projeto está sob a licença [sua licença aqui].
