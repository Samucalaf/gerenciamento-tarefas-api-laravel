# API de Gerenciamento de Tarefas

## 📋 Descrição
API REST desenvolvida em Laravel para gerenciamento de tarefas e categorias com autenticação via Sanctum.

## 🚀 Tecnologias
- **Laravel 11** - Framework PHP
- **Laravel Sanctum** - Autenticação API
- **MySQL** - Banco de dados
- **Docker** - Containerização

## 🛠️ Instalação

### Pré-requisitos
- Docker
- Docker Compose

### Executando o projeto
```bash
# Clone o repositório
git clone [URL_DO_REPOSITORIO]

# Entre na pasta do backend
cd backend

# Execute com Docker
docker-compose up -d

# Instale as dependências
docker-compose exec app composer install

# Configure o ambiente
cp .env.example .env
docker-compose exec app php artisan key:generate

# Execute as migrations
docker-compose exec app php artisan migrate

# Execute os seeders (opcional)
docker-compose exec app php artisan db:seed
```

## 📚 Endpoints da API

### Autenticação
- `POST /api/auth/register` - Registro de usuário
- `POST /api/auth/login` - Login
- `POST /api/auth/logout` - Logout

### Categorias
- `GET /api/categories` - Listar categorias
- `POST /api/categories` - Criar categoria
- `PUT /api/categories/{id}` - Atualizar categoria
- `DELETE /api/categories/{id}` - Deletar categoria

### Tarefas
- `GET /api/tasks` - Listar tarefas
- `POST /api/tasks` - Criar tarefa
- `PUT /api/tasks/{id}` - Atualizar tarefa
- `DELETE /api/tasks/{id}` - Deletar tarefa

## 🧪 Testes
```bash
docker-compose exec app php artisan test
```

## 📝 Padrões de Commit
- `feat:` - Nova funcionalidade
- `fix:` - Correção de bug
- `docs:` - Documentação
- `style:` - Formatação de código
- `refactor:` - Refatoração
- `test:` - Testes

## 🌿 Branches
- `main` - Produção
- `develop` - Desenvolvimento
- `feature/` - Novas funcionalidades
- `fix/` - Correções
- `hotfix/` - Correções urgentes 