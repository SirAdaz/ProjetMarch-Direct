# 🛍️ ProjetMarch-Direct

Backend du projet Marche Direct, réalisé avec Symfony et API Platform. Cette application met en relation des marchands et des clients pour permettre la commande de produits en ligne, avec retrait sur place.

## 🎯 Objectif

Développer une API REST sécurisée permettant :
- La gestion des utilisateurs (clients et marchands)
- La gestion des produits, commandes, et points de retrait
- La communication avec le frontend Angular

## 🚀 Technologies utilisées

- **Symfony**
- **API Platform**
- **PHP**
- **Doctrine ORM**
- **JWT Authentication**
- **MySQL (base de données)**

## 🖥️ Fonctionnalités

- Création et gestion des comptes utilisateurs (clients / marchands / admins)
- CRUD complet pour les produits, commandes, marchands, et lieux de retrait
- Authentification avec JWT
- Routes d’API documentées automatiquement avec Swagger (via API Platform)

## 🛠️ Installation

1. Clone ce dépôt :
   ```bash
   git clone https://github.com/SirAdaz/ProjetMarch-Direct.git
   ```
2. Installe les dépendances PHP :
   ```bash
   composer install
   ```
3. Configure la base de données dans `.env`
4. Crée la base de données :
   ```bash
   php bin/console doctrine:database:create
   ```
5. Applique les migrations :
   ```bash
   php bin/console doctrine:migrations:migrate
   ```
6. (Optionnel) Charge des données fictives :
   ```bash
   php bin/console doctrine:fixtures:load
   ```
7. Lance le serveur Symfony :
   ```bash
   symfony serve
   ```

## 🔗 Accès à l'API

Une fois le serveur lancé, accède à la documentation interactive :
```
http://localhost:8000/api
```

## 🔒 Sécurité

- Authentification via JWT
- Séparation des rôles (client, marchand, admin)
- Accès contrôlé aux ressources via les groupes de sérialisation et les voters

## Auteur

- ## Auteur

- **SirAdaz** – [GitHub](https://github.com/SirAdaz)
- **Veltako** – [GitHub](https://github.com/Veltako)
- **elyayus** – [GitHub](https://github.com/elyayus)
- **Astrid-OC** – [GitHub](https://github.com/Astrid-OC)
