# 🐾 Amora

O **Amora** é um sistema inteligente de lembretes recorrentes ("Remember everything"). Ele permite que usuários criem notificações personalizadas com frequências específicas, garantindo que compromissos e tarefas nunca sejam esquecidos através de notificações por e-mail processadas em segundo plano.

---

### 📋 Pré-requisitos

- **PHP 8.2+**
- **Composer**
- **Node.js & NPM**

### 🛠️ Passo a passo

1. **Clone o repositório:**

    ```bash
    git clone https://github.com/gustavocoimbradev/amora.git
    cd amora
    ```

2. **Como rodar localmente:**

    ```bash
    # Setup inicial (Instalação, Banco SQLite, Migrations e Seeds)
    npm run build
    ```

    ```bash
    # Frontend em tempo real
    npm run dev
    ```

    ```bash
    # Servidor Backend
    php artisan serve
    ```

    ```bash
    # Processamento de Filas (Obrigatório para envio de e-mails)
    php artisan queue:work
    ```

3. **Acesse o sistema:**
   Após a conclusão do script, o sistema estará disponível em:
    ```bash
    http://localhost:8000
    ```

---

## 🧪 Qualidade e Testes

O projeto utiliza o **PEST Framework** para garantir a integridade das regras de negócio e segurança:

* **Security**: Validação de que usuários só acessam seus próprios lembretes.
* **Auth**: Testes completos de login e registro.
* **CRUD**: Garantia de persistência correta no banco de dados.

Para rodar a suíte de testes:
```bash
php artisan test