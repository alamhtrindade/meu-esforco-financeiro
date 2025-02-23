#!/bin/sh

# Aguarda o MySQL estar disponível antes de executar os comandos
until mysqladmin ping -h "localhost" --silent; do
    echo "Aguardando o MySQL iniciar..."
    sleep 2
done

# Conecta ao MySQL e executa comandos SQL necessários
mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "
INSTALL PLUGIN mysqlx SONAME 'mysqlx.so';
SHOW PLUGINS;
"