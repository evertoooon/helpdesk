# 💜 HelpDesk

Sistema web moderno para abertura, gerenciamento e acompanhamento de chamados técnicos desenvolvido com Laravel 💻✨

O projeto foi criado para a disciplina **ADS160 – Tópicos Especiais em Desenvolvimento de Software** e evoluído ao longo do semestre com foco em:

* arquitetura organizada;
* autenticação segura;
* experiência visual moderna;
* comunicação em tempo real;
* API REST;
* testes automatizados;
* boas práticas de desenvolvimento.

---

# 📸 Visão Geral

O **HelpDesk Neon** permite que usuários registrem problemas, solicitações e dúvidas técnicas, enquanto administradores e equipe de suporte acompanham os atendimentos através de um painel moderno e interativo 💜

---

# ✨ Funcionalidades

## 👤 Sistema de Autenticação

* Login seguro
* Registro de usuários
* Logout
* Recuperação de senha
* Redefinição de senha
* Perfil do usuário
* Exclusão de conta
* Controle de permissões por nível de acesso

---

## 🎫 Sistema de Chamados

* Abertura de chamados
* Visualização detalhada
* Controle de status
* Controle de prioridade
* Upload de imagens/prints
* Histórico completo de ações
* Acompanhamento em tempo real
* Paginação e filtros
* Controle de chamados por usuário

---

## 💬 Chat em Tempo Real

Cada chamado possui um sistema de conversa integrado entre usuário e suporte 💬

### Recursos do chat:

* atualização automática;
* mensagens em tempo real;
* indicador de mensagens não lidas;
* separação visual entre usuário e suporte;
* bloqueio automático em chamados encerrados;
* proteção contra XSS;
* renderização segura de mensagens.

---

## 👨‍💼 Área Administrativa

Administradores possuem acesso completo ao sistema:

* gerenciamento de categorias;
* atendimento de chamados;
* atualização de status;
* atribuição de responsáveis;
* dashboard administrativo;
* visualização global do sistema;
* exclusão de chamados;
* controle operacional completo.

---

# 📂 Categorias

O sistema já possui categorias padrão cadastradas:

* Hardware
* Software
* Rede
* Impressora
* Sistema
* E-mail
* Acesso
* Segurança
* Outros

---

# 🌐 API REST

O sistema possui API REST autenticada utilizando Laravel Sanctum 🔐

## Autenticação

```http
POST /api/login
```

Retorna um token de autenticação.

---

## Endpoints disponíveis

### 🎫 Chamados

```http
GET /api/tickets
GET /api/tickets/{id}
POST /api/tickets
PUT /api/tickets/{id}
DELETE /api/tickets/{id}
```

### 💬 Comentários

```http
POST /api/tickets/{id}/comments
```

---

# 🧪 Testes Automatizados

O projeto possui testes automatizados utilizando PHPUnit ✅

### Cobertura atual:

* testes de autenticação;
* testes de permissões;
* testes de API;
* testes de validação;
* testes de regras de negócio;
* testes de integração;
* testes do sistema de chamados.

### Executar testes

```bash
php artisan test
```

---

# 🚀 Tecnologias Utilizadas

## Backend

* PHP 8.1+
* Laravel 10
* MySQL
* Laravel Sanctum
* PHPUnit

---

## Frontend

* Tailwind CSS
* Vite
* Blade
* JavaScript

---

## Ferramentas

* Mailtrap
* Git
* GitHub
* Composer
* NPM

---

# ⚙️ Instalação do Projeto

## 1️⃣ Clonar repositório

```bash
git clone https://github.com/evertoooon/helpdesk
```

---

## 2️⃣ Acessar pasta

```bash
cd helpdesk
```

---

## 3️⃣ Instalar dependências

```bash
composer install
npm install
```

---

## 4️⃣ Configurar ambiente

Copie o arquivo `.env.example`:

```bash
cp .env.example .env
```

---

## 5️⃣ Gerar chave da aplicação

```bash
php artisan key:generate
```

---

## 6️⃣ Configurar banco de dados

Edite o `.env`:

```env
DB_DATABASE=helpdesk
DB_USERNAME=root
DB_PASSWORD=
```

---

## 7️⃣ Executar migrations

```bash
php artisan migrate
```

---

## 8️⃣ Popular banco com categorias iniciais

```bash
php artisan db:seed
```

---

## 9️⃣ Criar link simbólico do storage

```bash
php artisan storage:link
```

---

## 🔟 Iniciar servidor Laravel

```bash
php artisan serve
```

---

## 1️⃣1️⃣ Rodar Vite

```bash
npm run dev
```

---

# 🔐 Recuperação de Senha

O projeto utiliza **Mailtrap** para testes de envio de e-mails em ambiente de desenvolvimento 📧

## Configuração SMTP

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=SEU_USERNAME
MAIL_PASSWORD=SUA_SENHA
MAIL_ENCRYPTION=tls
```

---

# 👥 Tipos de Usuário

## 👤 Usuário comum

Pode:

* abrir chamados;
* comentar;
* acompanhar atendimentos;
* visualizar histórico;
* acompanhar respostas do suporte.

---

## 👨‍💼 Administrador

Pode:

* visualizar todos os chamados;
* atender chamados;
* alterar status e prioridade;
* gerenciar categorias;
* controlar responsáveis;
* acessar dashboard completo;
* excluir chamados.

---

# 🎨 Interface

O sistema utiliza uma identidade visual moderna baseada em:

* glassmorphism ✨
* blur effects 🌌
* gradientes 🎨
* componentes modernos com Tailwind CSS

---

# 📁 Estrutura Principal

```text
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

---

# 🔒 Segurança

O projeto possui:

* autenticação segura;
* proteção CSRF;
* controle de permissões;
* proteção contra XSS;
* validações backend;
* proteção de rotas administrativas;
* upload validado de imagens.

---

# 📌 Observações

* Projeto desenvolvido para fins acadêmicos 🎓
* Estrutura preparada para futuras expansões 🚀
* API pronta para integrações futuras 🔗
* Sistema preparado para crescimento 📈

---

# 💜 Autor

## Éverton Lima

Projeto acadêmico desenvolvido em ADS com Laravel 💻✨

Feito com dedicação, café ☕ e muitas linhas de código 💜
