# 🐾 Amora

**Amora** é um sistema inteligente de lembretes recorrentes. Ele permite que usuários criem notificações personalizadas com frequências específicas, garantindo que compromissos e tarefas nunca sejam esquecidos através de notificações por e-mail processadas em segundo plano.

---

### 📋 Pré-requisitos
S
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
    # Setup inicial
    composer run setup
    ```

    ```bash
    # Rodar servdor
    composer run dev
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
