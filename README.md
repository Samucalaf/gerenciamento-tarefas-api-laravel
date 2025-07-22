# Backend - API de Gerenciamento de Tarefas

## 📋 Descrição
API REST desenvolvida em Laravel 12 para gerenciamento de tarefas e categorias com autenticação via Sanctum.

## 🚀 Tecnologias
- **Laravel 12** - Framework PHP
- **Laravel Sanctum** - Autenticação API
- **MySQL 8.0** - Banco de dados
- **Docker** - Containerização
- **Nginx** - Servidor web

## 🛠️ Instalação

### Pré-requisitos
- Docker
- Docker Compose

### Executando o projeto
```bash
# Clone o repositório
git clone https://gitlab.com/ezwebagencia/backend.git

# Entre na pasta do backend
cd backend

# Execute com Docker
docker-compose up -d

# Instale as dependências (se necessário)
docker-compose exec app composer install

# Configure o ambiente
cp .env.example .env
docker-compose exec app php artisan key:generate

# Execute as migrations
docker-compose exec app php artisan migrate

# Execute os seeders (opcional)
docker-compose exec app php artisan db:seed
```

## 📁 Estrutura do Projeto
```
app/
├── Http/Controllers/    # Controladores da API
├── Models/             # Modelos Eloquent
├── Providers/          # Service Providers
└── Services/           # Serviços de negócio

config/
├── auth.php           # Configuração de autenticação
├── database.php       # Configuração do banco
└── sanctum.php        # Configuração do Sanctum

database/
├── migrations/        # Migrações do banco
└── seeders/          # Seeders para dados iniciais

routes/
└── api.php           # Rotas da API

storage/
└── logs/             # Logs da aplicação
```

## 🎯 Funcionalidades
- 🔐 Autenticação de usuários com Sanctum
- 📝 Gerenciamento de categorias
- ✅ Gerenciamento de tarefas
- 🔍 Filtros e busca
- 📊 Estatísticas e relatórios

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

## 🗄️ Banco de Dados

### Configuração MySQL
- **Host**: `db` (container)
- **Porta**: `3306`
- **Database**: `laravel_tasks`
- **Usuário**: `laravel_user`
- **Senha**: `password`

### Migrations Principais
- `users` - Tabela de usuários
- `personal_access_tokens` - Tokens do Sanctum
- `categories` - Categorias de tarefas
- `tasks` - Tarefas dos usuários

## 🐳 Docker

### Containers
- **app**: Laravel + PHP 8.2
- **db**: MySQL 8.0
- **nginx**: Servidor web

### Portas
- **API**: http://localhost:8000
- **MySQL**: 3306 (interno)

## 📝 Padrões de Commit
- `feat:` - Nova funcionalidade
- `fix:` - Correção de bug
- `docs:` - Documentação
- `style:` - Formatação de código
- `refactor:` - Refatoração
- `chore:` - Tarefas de manutenção

## 🌿 Branches
- `main` - Produção
- `develop` - Desenvolvimento
- `feature/` - Novas funcionalidades
- `fix/` - Correções
- `hotfix/` - Correções urgentes

## 🔧 Comandos Úteis

### Laravel
```bash
# Acessar o container
docker-compose exec app bash

# Executar migrations
docker-compose exec app php artisan migrate

# Limpar cache
docker-compose exec app php artisan cache:clear

# Ver rotas
docker-compose exec app php artisan route:list

# Criar controller
docker-compose exec app php artisan make:controller Api/AuthController

# Criar model
docker-compose exec app php artisan make:model Category -m
```

### Docker
```bash
# Ver logs
docker-compose logs app

# Reiniciar containers
docker-compose restart

# Parar containers
docker-compose down

# Rebuild
docker-compose up -d --build
```

## 📊 Status do Projeto
- ✅ Laravel 12 instalado
- ✅ Sanctum configurado
- ✅ MySQL conectado
- ✅ Docker funcionando
- ✅ Estrutura base criada
- 🔄 Pronto para desenvolvimento das funcionalidades

## 🎯 Próximos Passos
1. Implementar autenticação com Sanctum
2. Criar CRUD de categorias
3. Criar CRUD de tarefas
4. Implementar relacionamentos
5. Adicionar validações
6. Implementar filtros e busca

## 📞 Contato
Desenvolvido como desafio técnico - Novembro 2024
