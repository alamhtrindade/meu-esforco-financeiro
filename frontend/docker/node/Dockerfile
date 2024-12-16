FROM node:12

ENV TZ=America/Sao_Paulo

WORKDIR /var/www/html

COPY package.json package.json
COPY package-lock.json package-lock.json 

RUN npm install

COPY . .

EXPOSE 8080

CMD [ "sh", "-c", "npm install && npm run serve" ]