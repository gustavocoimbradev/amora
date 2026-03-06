# 🐾 Amora

O **Amora** é um sistema inteligente de lembretes recorrentes ("Remember everything"). Ele permite que usuários criem notificações personalizadas com frequências específicas, garantindo que compromissos e tarefas nunca sejam esquecidos através de notificações por e-mail processadas em segundo plano.

---

## ✨ Funcionalidades

* **Autenticação Completa**: Sistema de login e registro de usuários com proteção de rotas.
* **Gestão de Lembretes**: CRUD completo para criar, visualizar, editar e excluir lembretes.
* **Frequência Customizada**: Opções de recorrência (ex: diário) para os disparos automáticos.
* **Processamento em Fila (Queues)**: O envio de e-mails é feito de forma assíncrona, garantindo que a aplicação continue rápida enquanto os lembretes são disparados.

---

## 🛠️ Stack Tecnológica

* **Backend**: Laravel 12.
* **Testes**: PEST Framework (PHP) - Cobertura total de autenticação e regras de negócio.
* **Frontend**: Blade / Vue.js com interface minimalista e responsiva.
* **Banco de Dados**: MySQL / SQLite.
* **Background Jobs**: Laravel Queues para processamento assíncrono.

---

## 🧪 Qualidade e Testes

O projeto utiliza o **PEST** para garantir que a lógica de permissões e criação de dados esteja sempre íntegra:

* **Security**: Usuários só podem interagir com seus próprios lembretes (403 Forbidden para acessos não autorizados).
* **Validation**: Validação rigorosa de e-mails e fluxos de cadastro.
* **Database Integrity**: Testes de persistência garantem que cada lembrete seja salvo com os parâmetros corretos.

Para rodar os testes:
php artisan test

---

## 🚀 Como Rodar Localmente

Para subir o ambiente de desenvolvimento, siga os passos abaixo:

1. Setup Inicial (Instalação e Migrações):
npm run build

2. Interface (Frontend):
npm run dev # Execute em um terminal

3. Servidor (Backend):
php artisan serve # Execute em outro terminal

4. Processamento de Filas (Obrigatório para os e-mails):
php artisan queue:work

---

## 📝 Licença

Este projeto é open-source.