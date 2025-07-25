# Brief Test PHP

![Tests Laravel](https://github.com/Mathieu-Hbrn/brief_test_php/actions/workflows/laravel-tests.yml/badge.svg)

Un projet Laravel servant d’exemple pour la mise en place de tests automatisés avec PHPUnit et GitHub Actions.

---

## Aperçu

Ce projet met en place :

- Une application Laravel basique
- Un CRUD sur les produits
- Des tests automatisés avec PHPUnit
- Une intégration continue via GitHub Actions

---

## Prérequis

- **PHP 8.2+**
- **Composer**
- **MySQL / SQLite** (selon ta configuration)
- **Node.js & npm** (si front inclus)
- **Git**

---

## Installation

Clone le projet :

```bash
git clone https://github.com/Mathieu-Hbrn/brief_test_php.git
cd brief_test_php
```

Installe les dépendances PHP :

```bash
composer install
```

Installe les dépendances front (si nécessaires) :

```bash
npm install && npm run dev
```

---

## Configuration

Copie le fichier `.env.example` en `.env` :

```bash
cp .env.example .env
```

Génère la clé d’application :

```bash
php artisan key:generate
```

Lance les migrations et les seeders :

```bash
php artisan migrate --seed
```

---

## Tests

Exécute les tests avec :

```bash
php artisan test
```

Pour un test spécifique :

```bash
php artisan test --filter=ProductTest
```

---

## CI/CD avec GitHub Actions

Un workflow GitHub Actions est configuré dans :

```
.github/workflows/laravel-tests.yml
```

Il exécute automatiquement :
- Installation des dépendances
- Migrations
- Lancement des tests PHPUnit

Badge de statut :  
![Tests Laravel](https://github.com/Mathieu-Hbrn/brief_test_php/actions/workflows/laravel-tests.yml/badge.svg)

---

## Structure du projet

- `app/Models/Product.php` → Modèle Eloquent du produit
- `app/Http/Controllers/ProductController.php` → Contrôleur CRUD
- `tests/Feature/ProductTest.php` → Tests fonctionnels
- `.github/workflows/laravel-tests.yml` → Pipeline CI

---

## Auteur

**Mathieu Hbrn**  
Projet de démonstration Laravel & PHPUnit
