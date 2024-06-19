# objective-bank
### Requisitos
- Docker e Docker Compose

### Rodando o projeto
Copiar `.env.example` e renomear para `.env`:
```sh
cp .env.example .env
```

Navegue ate a pasta `/docker` e rode o comando para subir os containers:
```sh
docker compose up -d
```

Com os containes rodando, criar banco de dados:
```sh
docker exec -i objective-bank-db mysql -uroot -proot  <<< "create database objective_bank;"
```

Rode as migrations:
```sh
composer migrations:migrate
```

Tudo pronto! Use o Postman ou Insomnia para testar as rotas.

> **Obs:** Existe uma collection pronta do Insomnia na raiz do projeto.

### Rotas
Base: `http://localhost:8000`
- POST /conta
- GET /conta/{numero}
- POST /transacao