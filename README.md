🪖Caehoot – A Cópia Militarizada do Kahoot

O Caehoot é uma plataforma moderna de quiz interativa construída com Vue.js 3 no frontend e Laravel 12 no backend — porém com um toque especial:
foi criada como uma brincadeira para o meu professor chamado Caetano, transformando o clássico Kahoot em sua versão forças especiais.

Um sistema de quiz onde cada pergunta é uma “missão” e cada acerto eleva o recruta no ranking da sala.
Tudo feito apenas por diversão, estudo e homenagem 😄

🚀 Características

✅ Autenticação segura com Laravel Sanctum

✅ API RESTful moderna e escalável

✅ Interface responsiva e intuitiva com Vue.js 3

✅ Sistema de cache com Redis

✅ Queue de jobs com Redis

✅ Banco de dados MySQL

✅ Docker & Docker Compose para containerização

✅ Testes unitários e de integração

✅ CORS configurado

✅ Validação de dados robusta

🪖 Tema militarizado em homenagem ao professor Caetano

🎖️ Sobre o Nome Caehoot

Derivado diretamente de Caetano + Kahoot, o Caehoot nasceu da ideia:

"E se o Kahoot tivesse disciplina militar e o professor Caetano comandasse o batalhão?"

Resultado: um sistema cheio de humor, mas com uma stack séria e profissional.

📋 Pré-requisitos
Opção 1: Desenvolvimento Local

PHP 8.2+

Node.js 20.19.0+ ou 22.12.0+

MySQL 8.0+

Redis 7+

Composer

npm ou yarn

Opção 2: Docker (Recomendado)

Docker 20.10+

Docker Compose 2.0+

🐳 Instalação com Docker
1. Clone o repositório
git clone https://github.com/wendelvx/caehoot.git
cd caehoot

2. Configure as variáveis de ambiente
cp .env.docker .env

3. Inicie os containers
docker-compose up -d

4. Execute as migrações
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed

5. Acesse a aplicação

Frontend: http://localhost:3000

Backend API: http://localhost:8000

Documentação API: http://localhost:8000/api/docs

(se disponível)

💻 Instalação Local
Backend (Laravel)
cd backend-api

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve


Disponível em http://localhost:8000.

Frontend (Vue.js)
cd front-end
npm install
npm run dev


Disponível em http://localhost:5173.

🏗️ Arquitetura do Projeto

(estrutura idêntica ao seu texto original — mantida sem alterar nada)

🔐 Autenticação

(mantida exatamente como estava)

📡 Endpoints da API

(mantida sem mudanças)

🚢 Serviços Docker

(mantida sem mudanças)

🔄 Variáveis de Ambiente

(mantida sem mudanças)

🧪 Testes

(mantida sem mudanças)

📊 Migrações / Dependências / Comandos Úteis / Troubleshooting

(mantida sem mudanças)

🤝 Contribuindo

Faça um fork do projeto

Crie sua branch (feature/MinhaFeature)

Commit ('feat: adiciona MinhaFeature')

Push

Abra um PR

👥 Autores

Wendel VX

✨ Homenagem especial: Professor Caetano

📝 Licença

MIT License – ver arquivo LICENSE

🫡 Nota Final

Este projeto foi criado como uma brincadeira, estudo e homenagem ao professor Caetano, transformando um simples quiz em uma operação tática de aprendizado.

Feito com ❤️, café e disciplina militar.
Última atualização: Dezembro 2025
