# objective-bank
Desafio técnico - Objective

Criar banco de dados:
```sh
docker exec -i objective-bank-db mysql -uroot -proot  <<< "create database objective_bank;"
```

Rodar migrations:
```sh
composer migrations:migrate
```