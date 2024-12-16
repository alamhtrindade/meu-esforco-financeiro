# 📌 Tarefeiro

Tarefeiro é um gerenciador de tarefas simples e intuitivo, projetado para ajudar você a organizar, priorizar e concluir atividades do dia a dia. Ideal para quem busca praticidade e foco na gestão de tarefas.

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
   127.0.0.1       api-tarefeiro.docker.dev
   ```

### Subindo a Aplicação
Na raiz do projeto, execute os comandos abaixo:

```bash
sh dev build
sh dev start-dev
```

Verifique se o serviço está ativo acessando o endpoint de status:

```
https://api-tarefeiro.docker.dev/status
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

## 🗂️ Estrutura de Pastas

O projeto segue o padrão **Domain-Driven Design (DDD)** para organizar responsabilidades e domínios.

```bash
app/Domain/
├── Shared/               # Componentes compartilhados entre domínios
│   ├── ValueObjects/     # Ex.: Email, CPF
│   ├── Exceptions/       # Exceções genéricas
│   └── Enums/            # Enumeradores (StatusEnum, PriorityEnum)
└── Task/                 # Contexto principal: Tarefas
    ├── Entities/         # Entidades do domínio (ex.: Task.php)
    ├── Contracts/        # Interfaces (ex.: Repositórios e Validações)
    ├── Repositories/     # Implementações de persistência
    ├── Services/         # Regras de negócio reutilizáveis
    └── Exceptions/       # Exceções específicas do contexto
```

---

## 📚 Endpoints da API

### Tarefa
Abaixo estão os endpoints para gerenciar tarefas:

#### 📖 Consultar Tarefa
- **Método:** `GET`
- **URL:** `https://api-tarefeiro.docker.dev/task/read/{idTask}`

#### ➕ Criar Tarefa
- **Método:** `POST`
- **URL:** `https://api-tarefeiro.docker.dev/task/create`

**Exemplo de Payload:**

```json
{
   "name": "Levar carro ao mecânico",
   "description": "Precisa consertar os freios",
   "category": 1,
   "priority": 1,
   "startDate": "2024/12/16",
   "endDate": "2024/12/16",
   "startTime": "07:00:00",
   "endTime": "07:30:00"
}
```

#### ✏️ Atualizar Tarefa
- **Método:** `PUT`
- **URL:** `https://api-tarefeiro.docker.dev/task/update`

**Exemplo de Payload:**

```json
{
   "name": "Levar carro ao mecânico",
   "description": "Precisa consertar os freios",
   "category": 1,
   "priority": 1,
   "startDate": "2024/12/16",
   "endDate": "2024/12/16",
   "startTime": "07:00:00",
   "endTime": "07:30:00"
}
```

#### 🗑️ Deletar Tarefa
- **Método:** `DELETE`
- **URL:** `https://api-tarefeiro.docker.dev/task/delete/{idTask}`

---

## 🛠️ Tecnologias Utilizadas

- **PHP** com arquitetura DDD
- **Docker** e **Docker Compose**
- **Carbon** para manipulação de datas
- **Symfony** para exceções e respostas HTTP

---