# 📌 Tarefeiro App

As instruções para levantar a API e o APP estão nos arquivos README.MD de cada pasta.


### Pré-requisitos
- **NPM** v9.8.0
- **Docker** v24.0.7
- **Docker Compose** v1.29.2

### Configuração
Os contêineres podem usar portas que já estejam sendo utilizadas. Para que a aplicação funcione corretamente, é 
recomendado levantar apenas essa aplicação. Caso alguma porta esteja sendo utilizada, pare o serviço se possível.
Caso não seja possível, ajuste o docker-compose e o dockerfile do serviço.

### Subindo a Aplicação
- Primeiro faça o build do backend, conforme instruções do README.md.
- Na sequência, faça o build do frontend.
- Suba o contêiner do backend após o build do frontend.
- Suba o contêiner do frontend.
