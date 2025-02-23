FROM mysql:8.0

# Atualiza e instala extensões necessárias
RUN apt-get update && apt-get install -y \
    mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Define variáveis de ambiente
ENV MYSQL_DATABASE='mysql'
ENV MYSQL_USER='mysqluser'
ENV MYSQL_PASSWORD='mysqlpassword'
ENV MYSQL_ROOT_PASSWORD='rootpassword'

# Copia scripts de inicialização
COPY init-scripts/ /docker-entrypoint-initdb.d/

# Define permissões dos scripts
RUN chmod -R 755 /docker-entrypoint-initdb.d/
