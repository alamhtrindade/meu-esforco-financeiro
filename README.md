# 📌 Tarefeiro App

Um aplicativo para gestão de tarefas, com instruções detalhadas para configuração e execução da API 
e do Frontend disponíveis nos respectivos arquivos `README.md`.

---

### **Pré-requisitos**
Para garantir a execução correta da aplicação, certifique-se de atender aos seguintes requisitos de ambiente:

- **Sistema Operacional:** Linux Mint ou qualquer distribuição baseada em Ubuntu.
- **Node Package Manager (NPM):** v9.8.0
- **Docker:** v24.0.7
- **Docker Compose:** v1.29.2

---

### **Configuração Inicial**
Antes de subir a aplicação, leve em consideração as seguintes orientações:

#### **Portas de Rede**
- Os contêineres podem utilizar portas já ocupadas por outros serviços no sistema.  
- Para evitar conflitos, recomenda-se encerrar serviços em execução que estejam ocupando as portas necessárias.  
- Caso isso não seja viável, modifique as configurações de portas nos arquivos `docker-compose.yml` e `Dockerfile` correspondentes.

#### **Ambiente Isolado**
- Para garantir o funcionamento adequado, é recomendável que apenas esta aplicação esteja em execução no ambiente.

---

### **Passo a Passo para Subir a Aplicação**

#### **Backend**
- Execute o processo de build do backend conforme descrito no `README.md` da pasta correspondente.

#### **Frontend**
- Após finalizar o build do backend, realize o build do frontend seguindo as instruções do `README.md` na pasta apropriada.

---

### **Execução**
- Suba o contêiner do backend antes de iniciar o contêiner do frontend.  
- Após o backend estar ativo, inicialize o contêiner do frontend.

---

### **Notas Adicionais**
- Caso precise ajustar configurações de porta ou outras propriedades específicas, edite diretamente os arquivos `docker-compose.yml` e `Dockerfile` de cada serviço.  
- Consulte os arquivos `README.md` de cada componente para detalhes adicionais sobre o build e a execução.

---

### ** POSSÍVEL ERRO DE CERTIFICADO**
- Caso receba um aviso de certificado inválido no navegador ao acessar a aplicação:
Na pasta backend execute:

```bash
sudo apt install libnss3-tools
curl -JLO https://dl.filippo.io/mkcert/latest?for=linux/amd64
chmod +x mkcert-v*-linux-amd64
sudo mv mkcert-v*-linux-amd64 /usr/local/bin/mkcert
mkcert -install
```
Faça o build novamente.
Suba os contêineres novamente

---

Se precisar de suporte adicional, não hesite em entrar em contato.
