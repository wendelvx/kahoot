# Kahoot - Plataforma de Quiz Interativa

Kahoot é uma plataforma moderna de quiz interativa construída com Vue.js 3 no frontend e Laravel 12 no backend. Oferece uma experiência engajante para criação, compartilhamento e realização de quizzes.

## 🚀 Características

- ✅ Autenticação segura com Laravel Sanctum
- ✅ API RESTful moderna e escalável
- ✅ Interface responsiva e intuitiva com Vue.js 3
- ✅ Sistema de cache com Redis
- ✅ Queue de jobs com Redis
- ✅ Banco de dados MySQL
- ✅ Docker & Docker Compose para containerização
- ✅ Testes unitários e de integração
- ✅ CORS configurado
- ✅ Validação de dados robusta

## 📋 Pré-requisitos

### Opção 1: Desenvolvimento Local
- **PHP** 8.2+
- **Node.js** 20.19.0+ ou 22.12.0+
- **MySQL** 8.0+
- **Redis** 7+
- **Composer**
- **npm ou yarn**

### Opção 2: Docker (Recomendado)
- **Docker** 20.10+
- **Docker Compose** 2.0+

## 🐳 Instalação com Docker

### 1. Clone o repositório
```bash
git clone https://github.com/wendelvx/kahoot.git
cd kahoot
```

### 2. Configure as variáveis de ambiente
```bash
cp .env.docker .env
```

### 3. Inicie os containers
```bash
docker-compose up -d
```

### 4. Execute as migrações
```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

### 5. Acesse a aplicação
- **Frontend**: http://localhost:3000
- **Backend API**: http://localhost:8000
- **Documentação API**: http://localhost:8000/api/docs (se disponível)

## 💻 Instalação Local

### Backend (Laravel)

```bash
cd backend-api

# Instalar dependências
composer install

# Copiar arquivo de configuração
cp .env.example .env

# Gerar chave de aplicação
php artisan key:generate

# Executar migrações
php artisan migrate

# Seeders (opcional)
php artisan db:seed

# Iniciar servidor
php artisan serve
```

O backend estará disponível em `http://localhost:8000`

### Frontend (Vue.js)

```bash
cd front-end

# Instalar dependências
npm install

# Modo desenvolvimento
npm run dev

# Build para produção
npm run build

# Preview do build
npm run preview

# Testes
npm run test:unit
```

O frontend estará disponível em `http://localhost:5173` (desenvolvimento) ou `http://localhost:3000` (produção)

## 🏗️ Arquitetura do Projeto

### Backend - Laravel
```
backend-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controladores
│   │   ├── Middleware/      # Middleware customizado
│   │   └── Requests/        # Form requests
│   ├── Models/              # Modelos Eloquent
│   │   ├── User.php
│   │   ├── Quiz.php
│   │   ├── Question.php
│   │   ├── Option.php
│   │   └── QuizAnswer.php
│   ├── Policies/            # Autorização
│   └── Providers/           # Service providers
├── config/                  # Configurações
├── database/
│   ├── migrations/          # Migrações
│   ├── seeders/             # Seeders
│   └── factories/           # Factories para testes
├── routes/
│   ├── api.php              # Rotas API
│   ├── auth.php             # Rotas de autenticação
│   └── web.php              # Rotas web
├── storage/                 # Cache e sessions
└── tests/                   # Testes
```

### Frontend - Vue.js
```
front-end/
├── src/
│   ├── components/          # Componentes reutilizáveis
│   │   ├── BaseButton.vue
│   │   └── BaseInput.vue
│   ├── layouts/             # Layouts
│   │   ├── AppLayout.vue
│   │   └── AuthLayout.vue
│   ├── views/               # Páginas
│   │   ├── HomeView.vue
│   │   ├── LoginView.vue
│   │   ├── RegisterView.vue
│   │   ├── DashboardView.vue
│   │   └── QuizView.vue
│   ├── router/              # Configuração de rotas
│   ├── services/            # Serviços (API HTTP)
│   ├── stores/              # Pinia stores (estado)
│   │   ├── auth.js
│   │   └── counter.js
│   ├── assets/              # Assets estáticos
│   ├── App.vue              # Componente raiz
│   └── main.js              # Entrada da aplicação
├── __tests__/               # Testes
├── public/                  # Arquivos públicos
└── index.html               # HTML template
```

## 🐘 Modelos de Dados

### User
```php
- id
- name
- email
- password
- email_verified_at
- created_at
- updated_at
```

### Quiz
```php
- id
- user_id (criador do quiz)
- title
- description
- is_public
- created_at
- updated_at
```

### Question
```php
- id
- quiz_id
- text
- order
- created_at
- updated_at
```

### Option
```php
- id
- question_id
- text
- is_correct
- created_at
- updated_at
```

### QuizAnswer
```php
- id
- user_id
- quiz_id
- question_id
- selected_option_id
- is_correct
- created_at
- updated_at
```

## 🔐 Autenticação

A aplicação usa **Laravel Sanctum** para autenticação de API. 

### Endpoints de Autenticação
- `POST /api/auth/register` - Registrar novo usuário
- `POST /api/auth/login` - Fazer login
- `POST /api/auth/logout` - Fazer logout (requer token)
- `GET /api/auth/user` - Obter dados do usuário autenticado (requer token)

### Headers Necessários
```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

## 📡 Endpoints da API

### Quizzes
- `GET /api/quizzes` - Listar todos os quizzes
- `GET /api/quizzes/{id}` - Obter detalhes de um quiz
- `POST /api/quizzes` - Criar novo quiz (autenticado)
- `PUT /api/quizzes/{id}` - Atualizar quiz (autenticado)
- `DELETE /api/quizzes/{id}` - Deletar quiz (autenticado)

### Questões
- `GET /api/quizzes/{quiz_id}/questions` - Listar questões
- `POST /api/questions` - Criar questão (autenticado)
- `PUT /api/questions/{id}` - Atualizar questão (autenticado)
- `DELETE /api/questions/{id}` - Deletar questão (autenticado)

### Respostas
- `POST /api/quiz-answers` - Submeter resposta (autenticado)
- `GET /api/quizzes/{id}/results` - Obter resultados (autenticado)

## 🚢 Serviços Docker

### database (MySQL 8.0)
- Porta: 3306
- Usuário: `kahoot`
- Senha: `secret`
- Banco: `kahoot`

### app (PHP-FPM + Nginx)
- Portas: 8000 (HTTP), 9000 (PHP-FPM)
- Executa migrações, queue workers e nginx

### redis (Redis 7)
- Porta: 6379
- Cache, sessões e queue

### frontend (Node.js 22)
- Porta: 3000
- Aplicação Vue.js compilada

## 🔄 Variáveis de Ambiente

### Backend (.env)
```env
APP_NAME=Kahoot
APP_ENV=production
APP_DEBUG=false
APP_URL=http://localhost:8000
FRONTEND_URL=http://localhost:3000

DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=kahoot
DB_USERNAME=kahoot
DB_PASSWORD=secret

CACHE_STORE=redis
REDIS_HOST=redis
REDIS_PORT=6379
REDIS_PASSWORD=null

QUEUE_CONNECTION=redis

VITE_API_URL=http://localhost:8000
```

## 🧪 Testes

### Backend (PHPUnit)
```bash
cd backend-api

# Executar todos os testes
php artisan test

# Executar teste específico
php artisan test tests/Feature/Auth/

# Com cobertura
php artisan test --coverage
```

### Frontend (Vitest)
```bash
cd front-end

# Executar testes
npm run test:unit

# Watch mode
npm run test:unit -- --watch
```

## 📊 Migrações

### Criar nova migração
```bash
php artisan make:migration create_table_name
```

### Executar migrações
```bash
php artisan migrate
```

### Reverter migrações
```bash
php artisan migrate:rollback
```

### Reverter todas e executar novamente
```bash
php artisan migrate:refresh
```

## 📦 Gerenciamento de Dependências

### Backend
```bash
# Adicionar pacote
composer require vendor/package

# Remover pacote
composer remove vendor/package

# Atualizar dependências
composer update
```

### Frontend
```bash
# Adicionar pacote
npm install package-name

# Remover pacote
npm uninstall package-name

# Atualizar dependências
npm update
```

## 🛠️ Comandos Úteis

### Docker
```bash
# Iniciar containers
docker-compose up -d

# Parar containers
docker-compose down

# Ver logs
docker-compose logs -f app

# Executar comando no container
docker-compose exec app php artisan tinker

# Rebuild images
docker-compose up -d --build
```

### Laravel Artisan
```bash
# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Gerar dados de teste
php artisan tinker

# Fila
php artisan queue:work
php artisan queue:failed
```

## 🔍 Troubleshooting

### Problema: Erro de conexão com banco de dados
**Solução**: Verifique se o MySQL está rodando e as credenciais estão corretas
```bash
docker-compose exec database mysql -uroot -psecret -e "SHOW DATABASES;"
```

### Problema: Frontend não consegue acessar API
**Solução**: Verifique as configurações de CORS em `config/cors.php`
```php
'allowed_origins' => ['http://localhost:3000'],
```

### Problema: Redis connection failed
**Solução**: Reinicie o container Redis
```bash
docker-compose restart redis
```

### Problema: Permissão negada em storage
**Solução**: Ajuste as permissões
```bash
docker-compose exec app chown -R www-data:www-data /app/storage
docker-compose exec app chmod -R 755 /app/storage
```

## 📚 Documentação Adicional

- [Laravel Documentation](https://laravel.com/docs)
- [Vue.js 3 Documentation](https://vuejs.org/)
- [Laravel Sanctum](https://laravel.com/docs/sanctum)
- [Pinia State Management](https://pinia.vuejs.org/)
- [Docker Documentation](https://docs.docker.com/)

## 🤝 Contribuindo

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'Adiciona MinhaFeature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está licenciado sob a MIT License - veja o arquivo [LICENSE](LICENSE) para detalhes.

## 👥 Autores

- [Wendel VX](https://github.com/wendelvx)

## 📞 Suporte

Para reportar bugs ou sugerir features, abra uma [issue](https://github.com/wendelvx/kahoot/issues) no GitHub.

---

**Última atualização**: Dezembro 2025

Feito com ❤️ para educação e aprendizado interativo.
