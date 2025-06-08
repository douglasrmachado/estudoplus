# Estudo+ - Organizador de Estudos Inteligente

## 📋 Sobre o Projeto

Estudo+ é uma aplicação web desenvolvida para ajudar estudantes a organizarem seus estudos, tarefas e autoavaliações. O sistema permite o controle de matérias, sessões de estudo, tarefas pendentes e acompanhamento de desempenho semanal.

## 🚀 Tecnologias Utilizadas

- Laravel 10.x
- MySQL 8.0+
- TailwindCSS
- PHP 8.1+
- Node.js 18+
- npm 9+

## 📦 Pré-requisitos

Antes de começar, certifique-se de ter instalado em sua máquina:

- PHP >= 8.1
  - Extensões PHP necessárias:
    - BCMath PHP Extension
    - Ctype PHP Extension
    - Fileinfo PHP Extension
    - JSON PHP Extension
    - Mbstring PHP Extension
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension
- Composer (última versão estável)
- MySQL >= 8.0
- Node.js >= 18.0
- npm >= 9.0
- Git

## 🛠️ Instalação

1. Clone o repositório
```bash
git clone [url-do-repositorio]
cd [nome-do-diretorio]
```

2. Instale as dependências do PHP
```bash
composer install
```

3. Instale as dependências do Node.js
```bash
npm install
```

4. Copie o arquivo de ambiente
```bash
cp .env.example .env
```

5. Configure o arquivo .env com suas credenciais de banco de dados
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=estudoplus
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

6. Gere a chave da aplicação
```bash
php artisan key:generate
```

7. Crie o banco de dados
```bash
mysql -u root -p
CREATE DATABASE estudoplus;
exit;
```

8. Execute as migrações e seeders
```bash
php artisan migrate --seed
```

9. Compile os assets
```bash
npm run build
```

## 🏃‍♂️ Executando o Projeto

Para rodar o projeto em ambiente de desenvolvimento, você precisará executar dois servidores simultaneamente:

1. Em um terminal, inicie o servidor Laravel:
```bash
php artisan serve
```

2. Em outro terminal, inicie o servidor Vite para compilação dos assets:
```bash
npm run dev
```

3. Acesse a aplicação em `http://localhost:8000`

**Importante**: Ambos os servidores (Laravel e Vite) precisam estar rodando simultaneamente para que a aplicação funcione corretamente.

## 🔧 Solução de Problemas Comuns

1. Se a tela aparecer sem estilos ou JavaScript:
   - Verifique se o servidor Vite está rodando (`npm run dev`)
   - Limpe o cache do navegador (Ctrl + F5)
   - Tente recompilar os assets: `npm run build`

2. Se encontrar erros após pull/merge:
   - Atualize as dependências: `composer install && npm install`
   - Atualize o banco de dados: `php artisan migrate`
   - Limpe os caches: `php artisan cache:clear && php artisan view:clear && php artisan config:clear`

## 📝 Funcionalidades

- Sistema de autenticação completo
- Gerenciamento de matérias
- Controle de sessões de estudo
- Sistema de tarefas com prazos
- Autoavaliação semanal
- Dashboard com métricas de desempenho

## 🤝 Contribuindo

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Faça commit das suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Faça push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
