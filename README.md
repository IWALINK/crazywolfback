<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Laravel 11.6.1 avec Docker

Ce projet utilise Laravel 11.6.1 avec Docker pour un environnement de développement simple et portable.

## Prérequis

- Docker
- Docker Compose

## Installation

1. Cloner le projet ou créer un nouveau dossier
2. Lancer les conteneurs Docker :

```bash
docker-compose up -d
```

3. Installer Laravel 11.6.1 dans le conteneur :

```bash
docker-compose exec app composer create-project laravel/laravel:^11.6.1 .
```

4. Configurer les permissions :

```bash
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

5. Copier le fichier d'environnement :

```bash
docker-compose exec app cp .env.example .env
```

6. Générer la clé d'application :

```bash
docker-compose exec app php artisan key:generate
```

7. Configurer la base de données dans le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=your_mysql_user
DB_PASSWORD=your_mysql_password
```

8. Lancer les migrations :

```bash
docker-compose exec app php artisan migrate
```

## API Routes

L'application inclut une API REST complète avec les routes suivantes :

### Routes de base
- `GET /api/hello` - Message de bienvenue
- `GET /api/status` - Statut de l'application

### Routes Utilisateurs
- `GET /api/users` - Liste des utilisateurs
- `POST /api/users` - Créer un utilisateur
- `GET /api/users/{id}` - Détails d'un utilisateur
- `PUT /api/users/{id}` - Mettre à jour un utilisateur
- `DELETE /api/users/{id}` - Supprimer un utilisateur

### Routes Produits
- `GET /api/products` - Liste des produits
- `POST /api/products` - Créer un produit
- `GET /api/products/{id}` - Détails d'un produit
- `PUT /api/products/{id}` - Mettre à jour un produit
- `DELETE /api/products/{id}` - Supprimer un produit
- `GET /api/products/search` - Rechercher des produits

## Test de l'API

Pour tester toutes les routes API :

```bash
./test_api.sh
```

Ou tester manuellement :

```bash
# Test de base
curl -X GET http://localhost:8000/api/hello

# Créer un utilisateur
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{"name": "John Doe", "email": "john@example.com"}'

# Lister les produits
curl -X GET http://localhost:8000/api/products

# Rechercher des produits
curl -X GET "http://localhost:8000/api/products/search?category=Smartphones&min_price=500"
```

## Documentation API

Consultez le fichier `API_DOCUMENTATION.md` pour une documentation complète de l'API.

## Structure du projet

```
crazyback/
├── app/
│   └── Http/
│       ├── Controllers/
│       │   └── Api/
│       │       ├── UserController.php
│       │       └── ProductController.php
│       └── Middleware/
│           └── ForceJsonResponse.php
├── routes/
│   └── api.php
├── docker/
│   ├── nginx/
│   │   └── conf.d/
│   │       └── app.conf
│   └── php/
│       └── local.ini
├── Dockerfile
├── docker-compose.yml
├── API_DOCUMENTATION.md
├── test_api.sh
└── README.md
```

## Services Docker

- **app** : Application Laravel (PHP 8.2 + FPM)
- **webserver** : Serveur web Nginx
- **db** : Base de données MySQL 8.0

## Accès

- **Application web** : http://localhost:8000
- **API** : http://localhost:8000/api
- **Base de données** : localhost:3306

## Commandes utiles

```bash
# Redémarrer les conteneurs
docker-compose restart

# Voir les logs
docker-compose logs -f

# Accéder au conteneur Laravel
docker-compose exec app bash

# Installer des dépendances
docker-compose exec app composer install

# Lancer les migrations
docker-compose exec app php artisan migrate

# Vider le cache
docker-compose exec app php artisan cache:clear
```

## Fonctionnalités

- ✅ Laravel 11.6.1
- ✅ API REST complète
- ✅ Contrôleurs API avec validation
- ✅ Middleware pour réponses JSON
- ✅ Documentation API complète
- ✅ Scripts de test
- ✅ Configuration Docker optimisée
- ✅ Base de données MySQL
- ✅ Serveur web Nginx
