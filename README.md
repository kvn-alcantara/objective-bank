# objective-bank
### Requisitos
- Docker e Docker Compose
- Composer

### Rodando o projeto
Copiar `.env.example` e renomear para `.env`:
```sh
cp .env.example .env
```

Instalar dependências:
```sh
composer install
```

Navegue ate a pasta `/docker` e suba os containers:
```sh
docker compose up -d
```

Executar migrations:
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
