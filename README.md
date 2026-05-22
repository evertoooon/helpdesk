# 🎧 HelpDesk

Sistema web para abertura, acompanhamento e gerenciamento de chamados técnicos desenvolvido em Laravel.

O projeto permite que usuários registrem problemas ou solicitações, enquanto administradores e equipe de suporte podem acompanhar atendimentos, atualizar status, definir prioridades e interagir em tempo real através de um sistema de conversa integrado.

Projeto desenvolvido para a disciplina **ADS160 – Tópicos Especiais em Desenvolvimento de Software**, com evolução planejada para utilização em **Teste de Software**.

# 📸 Visão Geral

O HelpDesk Fácil permite:

- abertura de chamados;
- comunicação entre usuários e técnicos;
- gerenciamento de categorias;
- controle de status e prioridades;
- autenticação segura;
- recuperação de senha;
- upload de imagens/anexos;
- API REST autenticada;
- histórico completo de ações.

---

# 🚀 Tecnologias Utilizadas

- PHP 8.1+
- Laravel 10
- MySQL
- Tailwind CSS
- Laravel Breeze
- Laravel Sanctum
- Vite
- Mailtrap

---

# 🔐 Funcionalidades

## 👤 Autenticação

- Login
- Registro de usuários
- Logout
- Recuperação de senha
- Redefinição de senha
- Perfil do usuário
- Exclusão de conta

---

## 🎫 Chamados

- Criar chamados
- Editar chamados
- Excluir chamados
- Visualizar chamados
- Controle de prioridade
- Controle de status
- Atribuição de responsável
- Histórico de ações
- Sistema de comentários/chat
- Upload de imagens e prints

---

## 👨‍💼 Administração

Usuários administradores possuem acesso a:

- gerenciamento de categorias;
- visualização global de chamados;
- atendimento de chamados;
- controle de responsáveis;
- acesso completo ao sistema.

---

## 💬 Sistema de Comentários

Cada chamado possui um sistema de conversa integrado:

- comentários em tempo real;
- mensagens entre usuário e técnico;
- indicador de mensagens não lidas;
- bloqueio automático em chamados encerrados.

---

## 📂 Categorias

O sistema possui gerenciamento completo de categorias:

- Hardware
- Software
- Rede
- Impressora
- Sistema
- E-mail
- Acesso
- Segurança
- Outros

---

# 📧 Recuperação de Senha

O projeto utiliza o **Mailtrap** para testes de envio de e-mails em ambiente de desenvolvimento.

Ao solicitar recuperação de senha:

1. o sistema envia o e-mail para o Mailtrap;
2. o link de redefinição fica disponível na caixa de areia (sandbox);
3. o usuário acessa o link diretamente pelo painel do Mailtrap.

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

# 🌐 API REST

O sistema possui API autenticada com Laravel Sanctum.

## Autenticação

```http
POST /api/login
```

Retorna token de autenticação.

---

## Endpoints disponíveis

### Listar chamados

```http
GET /api/tickets
```

### Visualizar chamado

```http
GET /api/tickets/{id}
```

### Criar chamado

```http
POST /api/tickets
```

### Atualizar chamado

```http
PUT /api/tickets/{id}
```

### Excluir chamado

```http
DELETE /api/tickets/{id}
```

### Comentar chamado

```http
POST /api/tickets/{id}/comments
```

---

# 🧪 Testes Automatizados

O projeto possui testes automatizados utilizando PHPUnit.

Atualmente:

- 33 testes automatizados;
- 79 assertions;
- testes de autenticação;
- testes de permissões;
- testes de API;
- testes de validação;
- testes de regras de negócio.

Para executar:

```bash
php artisan test
```

---

# ⚙️ Instalação do Projeto

## 1. Clonar repositório

```bash
git clone URL_DO_REPOSITORIO
```

---

## 2. Instalar dependências

```bash
composer install
npm install
```

---

## 3. Configurar ambiente

Copie o `.env.example`:

```bash
cp .env.example .env
```

---

## 4. Gerar chave da aplicação

```bash
php artisan key:generate
```

---

## 5. Configurar banco de dados

Edite o `.env`:

```env
DB_DATABASE=helpdesk
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6. Executar migrations

```bash
php artisan migrate
```

---

## 7. Popular categorias iniciais

```bash
php artisan db:seed --class=CategorySeeder
```

---

## 8. Iniciar servidor

```bash
php artisan serve
```

---

## 9. Rodar Vite

```bash
npm run dev
```

---

# 👥 Tipos de Usuário

## Usuário comum

Pode:

- abrir chamados;
- comentar;
- acompanhar atendimentos;
- editar seus próprios chamados.

---

## Administrador

Pode:

- acessar todos os chamados;
- atender chamados;
- gerenciar categorias;
- visualizar dashboards completos;
- controlar o sistema.

---

# 📁 Estrutura Principal

```text
app/
resources/views/
routes/
database/
tests/
public/
storage/
```

---

# 🎨 Interface

O sistema utiliza:

- visual neon;
- glassmorphism;
- efeitos blur;
- gradientes;
- componentes modernos com Tailwind CSS.

---

# 📌 Observações

- O projeto foi desenvolvido para fins acadêmicos.
- O Mailtrap é utilizado apenas em ambiente de desenvolvimento.
- O sistema já possui base preparada para futuras expansões.

---

# 👨‍💻 Autor

Éverton Lima

Projeto acadêmico desenvolvido em ADS.