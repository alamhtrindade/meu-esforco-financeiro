# 📌 MEU ESFORÇO FINANCEIRO

Meu esforço financeiro é um simulador de esforço financeiro simples e intuitivo, projeto para calcular a taxa de esforço financeiro familiar, baseado nas rendas e despesas.
Ideal para quem busca saber quanto de sua renda mensal está comprometida.

## 🚀 Iniciando o Projeto

### Pré-requisitos
- **Docker** v24.0.7
- **Docker Compose** v1.29.2

### Configuração do Host
Antes de iniciar, configure o arquivo de hosts do seu sistema para registrar a URL do projeto.

1. Abra o terminal e edite o arquivo de hosts:

   ```bash
   sudo nano /etc/hosts
   ```

2. Adicione a URL base da API:

   ```
   127.0.0.1       api-meu-esforco-financeiro.docker.dev
   ```

### Arquivo .env
Copie para o arquivo .env as configurações do .env.example e
adicione as configurações de banco:


***CONEXAO BANCO***

DB_CONNECTION=mysql

DB_HOST=meu-esforco-financeiro_mysql

DB_PORT=3306

DB_DATABASE=meu_esforco

DB_USERNAME=mysqluser

DB_PASSWORD=mysqlpassword

---

### Subindo a Aplicação
Na raiz do backend, execute os comandos abaixo:

```bash
sh dev build
sh dev start-dev
```

Verifique se o serviço está ativo acessando o endpoint de status através do postman/insomia:

```
https://api-meu-esforco-financeiro.docker.dev/status
```

**Resposta esperada:**

```json
{
  "status": "ok"
}
```

---

### Criando a Base de Dados

**Execute a criação das tabelas:**

```bash
sh dev artisan migrate
```


Verifique a criação da estrutura:

```bash
sh dev artisan migrate:status
```

---

### Testes unitários

Para executar os testes unitários:
```bash
sh dev artisan test
```

---

## 📚 Endpoints da API

### Person
Abaixo estão os endpoints para gerenciar Pessoas:

#### ➕ Cadastrar Pessoa
- **Método:** `POST`
- **URL:** `https://api-meu-esforco-financeiro.docker.dev/person/create`

**Exemplo de Payload:**
```json
{
   "nif": "257880828",
   "name": "Benício Nathan Leonardo Castro"
}
```

#### 📖 Listar Pessoas

Listar todas as pessoas, e todas as transações
- **Método:** `GET`
- **URL:** `https://api-meu-esforco-financeiro.docker.dev/person/read`
  
Listar uma pessao e transações de um determinado mês
- **Método:** `GET`
- **URL:** `https://api-meu-esforco-financeiro.docker.dev/person/read/{idPessoa}/{mes}`


### Income
Abaixo estão os endpoints para gerenciar entradas:

#### ➕ Cadastrar Entradas
- **Método:** `POST`
- **URL:** `https://api-meu-esforco-financeiro.docker.dev/income/create`

**Exemplo de Payload:**
```json
{
   "id_person": "1",
   "value": 128.98,
   "date_income": "2025-02-11"
}
```

#### ➕ Cadastrar Despesas
- **Método:** `POST`
- **URL:** `https://api-meu-esforco-financeiro.docker.dev/expense/create`

**Exemplo de Payload:**
```json
{
   "id_person": "1",
   "value": 128.98,
   "date_expense": "2025-02-11"
}
```



---

## 🛠️ Tecnologias Utilizadas

- **PHP** com arquitetura DDD
- **Docker** e **Docker Compose**
- **MySql** para persistência dos dados

---
