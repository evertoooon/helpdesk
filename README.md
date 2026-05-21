# 🎧 HelpDesk

Sistema web para abertura, acompanhamento e gerenciamento de chamados técnicos desenvolvido em Laravel.

O projeto permite que usuários registrem problemas ou solicitações, enquanto administradores e equipe de suporte podem acompanhar atendimentos, atualizar status, definir prioridades e interagir em tempo real através de um sistema de conversa integrado.

Projeto desenvolvido para a disciplina **ADS160 – Tópicos Especiais em Desenvolvimento de Software**, com evolução planejada para utilização em **Teste de Software**.

---

## 📌 Inspirações

O sistema foi inspirado em plataformas como:

- Zendesk
- GLPI
- Jira Service Management
- Freshdesk

---

# 🚀 Tecnologias utilizadas

### Back-end
- PHP 8.1+
- Laravel

### Front-end
- Blade
- Tailwind CSS
- Vite

### Banco de dados
- MySQL
- phpMyAdmin

### Autenticação
- Laravel Breeze

### Ambiente
- XAMPP
- Composer
- Node.js
- NPM

### Controle de versão
- Git
- GitHub

---

# 📂 Arquitetura utilizada

Estratégia de branches:

```bash
main
develop
```

- `main` → versão estável
- `develop` → desenvolvimento

---

# ✨ Funcionalidades implementadas

### Sistema geral

✅ Sistema Admin/User  
✅ Login personalizado  
✅ Registro personalizado  
✅ Perfil personalizado  
✅ Dashboards separadas  
✅ Controle de permissões  
✅ Usuário visualiza apenas seus chamados  
✅ Histórico automático  
✅ Responsável pelo chamado (`assigned_to`)  
✅ Categorias protegidas  
✅ Exclusão protegida

---

### Chamados

✅ Abertura de chamados  
✅ Categorias  
✅ Prioridade  
✅ Status  
✅ Responsável técnico  
✅ Histórico de alterações  
✅ Chamados resolvidos/cancelados

---

### Sistema de anexos

✅ Upload de imagem  
✅ Preview antes do envio  
✅ Visualização da imagem  
✅ Exibição no painel admin  
✅ Exclusão automática do arquivo

---

### Atendimento

✅ Tela "Atender Chamado"  
✅ Botão Atender substituindo Editar  
✅ Alteração de prioridade  
✅ Alteração de status  
✅ Atribuição de responsável

---

### Chat integrado

✅ Conversa entre usuário e equipe  
✅ Mensagens estilo chat  
✅ Ordenação cronológica  
✅ Contador de mensagens novas  
✅ Sistema `is_read`  
✅ Som de notificação  
✅ Atualização automática sem F5  
✅ Bloqueio ao resolver/cancelar chamado  
✅ Backend protegido

---

# 🧠 Estrutura do banco

Estrutura base:

```text
users
categories
tickets
ticket_comments
ticket_histories
```

Relacionamentos:

Usuário → abre chamados

Chamado → possui categoria

Chamado → possui comentários

Chamado → possui histórico

Chamado → possui prioridade

Chamado → possui status

Chamado → possui responsável

---

# ⚙️ Instalação

Clone o projeto:

```bash
git clone URL_DO_REPOSITORIO
```

Entre na pasta:

```bash
cd helpdesk-facil
```

Instale dependências:

```bash
composer install

npm install
```

Configure:

```bash
cp .env.example .env
```

Gere a chave:

```bash
php artisan key:generate
```

Configure o banco `.env`

Execute:

```bash
php artisan migrate

php artisan storage:link
```

Inicie:

```bash
php artisan serve

npm run dev
```

---

# 🧪 Pensando em Teste de Software

O projeto foi estruturado para facilitar:

- testes unitários
- testes funcionais
- testes de integração
- validações automatizadas

Laravel já possui suporte nativo:

```bash
php artisan test
```

---

# 📷 Imagens do projeto

Em breve:

- Login
- Dashboard
- Tela de chamados
- Atendimento
- Chat em tempo real

---

# 🔮 Melhorias futuras

- Relatórios
- Dashboard com gráficos
- API REST
- Notificações em tempo real
- Login com múltiplos perfis
- Exportação PDF
- E-mail automático
- WebSockets

---

# 👨‍💻 Autor

Éverton Lima

Projeto acadêmico desenvolvido em ADS.