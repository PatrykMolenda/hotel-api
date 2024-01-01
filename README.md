# Welcome in project named Hotel API
In this project I created a simple REST API where u can manage rooms in your hotel

# Requirements
- PHP 8.2+
- Symfony 7.0
- MySQL Database

# Run Instructions
```
git clone https://github.com/FrancuzDEV/hotel-api
cd hotel-api
composer require
// Configure .env file
// Create in your db a new database named the same as in your .env file
php bin/console doctrine:schema:update
symfony server:start
```

# Road Map
- Virtual payment system working as pay-by-link