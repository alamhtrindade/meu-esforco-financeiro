# 📌 Tarefeiro

Tarefeiro é um gerenciador de tarefas simples e intuitivo, projetado para ajudar você a organizar, priorizar e concluir atividades do dia a dia. Ideal para quem busca praticidade e foco na gestão de tarefas.

## 🚀 Iniciando o Projeto

### Pré-requisitos
- **NPM** v9.8.0

### Configuração do Host
Antes de iniciar, configure o arquivo de hosts do seu sistema para registrar a URL do projeto.

1. Abra o terminal e edite o arquivo de hosts:

   ```bash
   sudo nano /etc/hosts
   ```

2. Adicione a URL base da API:

   ```
   127.0.0.1       app-tarefeiro.docker.dev
   ```

### Subindo a Aplicação
Na raiz do projeto, execute os comandos abaixo:

```bash
sh dev build
sh dev npm install
sh dev start-dev
```

Acesse o serviço pelo navegador:

```
https://app-tarefeiro.docker.dev/
```


## 🛠️ Tecnologias Utilizadas

- **VueJS** 
- **Docker** e **Docker Compose**
- **NPM**

---