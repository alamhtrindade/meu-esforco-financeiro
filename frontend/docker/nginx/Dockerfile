FROM node:12 as frontend

WORKDIR /var/www/html

COPY ./package*.json ./

COPY ./ ./

RUN npm install --no-progress --silent && npm run build

FROM nginx:1.23.1-alpine as app

ENV TZ=America/Sao_Paulo \
    APP_HOME=/usr/share/nginx/html

WORKDIR $APP_HOME

COPY --chown=nginx:nginx --from=frontend /var/www/html/dist $APP_HOME
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

USER nginx

EXPOSE 8080

CMD ["nginx", "-g", "daemon off;"]