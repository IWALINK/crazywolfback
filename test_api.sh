#!/bin/bash

echo "🧪 Test des routes API Laravel 11"
echo "=================================="

BASE_URL="http://localhost:8000/api"

echo ""
echo "1. Test de la route hello"
curl -s -X GET "$BASE_URL/hello" | jq '.'

echo ""
echo "2. Test de la route status"
curl -s -X GET "$BASE_URL/status" | jq '.'

echo ""
echo "3. Test de la route users (GET)"
curl -s -X GET "$BASE_URL/users" | jq '.'

echo ""
echo "4. Test de la création d'un utilisateur (POST)"
curl -s -X POST "$BASE_URL/users" \
  -H "Content-Type: application/json" \
  -d '{"name": "Test User", "email": "test@example.com"}' | jq '.'

echo ""
echo "5. Test de la route products (GET)"
curl -s -X GET "$BASE_URL/products" | jq '.'

echo ""
echo "6. Test de la création d'un produit (POST)"
curl -s -X POST "$BASE_URL/products" \
  -H "Content-Type: application/json" \
  -d '{"name": "Test Product", "price": 199.99, "category": "Test", "in_stock": true}' | jq '.'

echo ""
echo "7. Test de la recherche de produits"
curl -s -X GET "$BASE_URL/products/search?category=Smartphones&min_price=500" | jq '.'

echo ""
echo "✅ Tests terminés !" 