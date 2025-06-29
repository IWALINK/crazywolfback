# Documentation API Laravel 11

## Base URL
```
http://localhost:8000/api
```

## Routes disponibles

### 1. Routes de base

#### GET /api/hello
Retourne un message de bienvenue avec la version de Laravel.

**Réponse :**
```json
{
    "message": "Hello from Laravel 11 API!",
    "version": "11.6.1"
}
```

#### GET /api/status
Retourne le statut de l'application.

**Réponse :**
```json
{
    "status": "success",
    "timestamp": "2025-06-27T21:32:42.156861Z",
    "environment": "local"
}
```

### 2. Routes Utilisateurs

#### GET /api/users
Récupère la liste de tous les utilisateurs.

**Réponse :**
```json
{
    "message": "Liste des utilisateurs",
    "data": [
        {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com"
        },
        {
            "id": 2,
            "name": "Jane Smith",
            "email": "jane@example.com"
        }
    ]
}
```

#### POST /api/users
Crée un nouvel utilisateur.

**Corps de la requête :**
```json
{
    "name": "Nouvel Utilisateur",
    "email": "nouveau@example.com"
}
```

**Réponse :**
```json
{
    "message": "Utilisateur créé avec succès",
    "data": {
        "name": "Nouvel Utilisateur",
        "email": "nouveau@example.com"
    }
}
```

#### GET /api/users/{id}
Récupère les détails d'un utilisateur spécifique.

**Réponse :**
```json
{
    "message": "Détails de l'utilisateur",
    "data": {
        "id": "1",
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2025-06-27T21:32:42.156861Z"
    }
}
```

#### PUT /api/users/{id}
Met à jour un utilisateur existant.

**Corps de la requête :**
```json
{
    "name": "John Doe Updated",
    "email": "john.updated@example.com"
}
```

#### DELETE /api/users/{id}
Supprime un utilisateur.

### 3. Routes Produits

#### GET /api/products
Récupère la liste de tous les produits.

**Réponse :**
```json
{
    "message": "Liste des produits",
    "data": [
        {
            "id": 1,
            "name": "iPhone 15",
            "price": 999.99,
            "category": "Smartphones",
            "in_stock": true
        },
        {
            "id": 2,
            "name": "MacBook Pro",
            "price": 1999.99,
            "category": "Laptops",
            "in_stock": true
        }
    ]
}
```

#### POST /api/products
Crée un nouveau produit.

**Corps de la requête :**
```json
{
    "name": "Nouveau Produit",
    "price": 299.99,
    "category": "Électronique",
    "in_stock": true
}
```

#### GET /api/products/{id}
Récupère les détails d'un produit spécifique.

#### PUT /api/products/{id}
Met à jour un produit existant.

#### DELETE /api/products/{id}
Supprime un produit.

#### GET /api/products/search
Recherche des produits avec des filtres.

**Paramètres de requête :**
- `category` : Catégorie du produit
- `min_price` : Prix minimum
- `max_price` : Prix maximum

**Exemple :**
```
GET /api/products/search?category=Smartphones&min_price=500&max_price=1000
```

## Codes de statut HTTP

- `200` : Succès
- `201` : Créé avec succès
- `400` : Requête invalide
- `404` : Ressource non trouvée
- `422` : Erreur de validation
- `500` : Erreur serveur

## Authentification

Pour les routes protégées, utilisez l'authentification Sanctum :

```
Authorization: Bearer {token}
```

## Exemples d'utilisation avec cURL

### Lister les utilisateurs
```bash
curl -X GET http://localhost:8000/api/users
```

### Créer un utilisateur
```bash
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{"name": "Nouvel Utilisateur", "email": "nouveau@example.com"}'
```

### Lister les produits
```bash
curl -X GET http://localhost:8000/api/products
```

### Rechercher des produits
```bash
curl -X GET "http://localhost:8000/api/products/search?category=Smartphones&min_price=500"
``` 