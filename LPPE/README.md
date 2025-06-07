# Planning Entraînement - Lyon Palme

Application web de gestion des plannings d’entraînements pour le club **Lyon Palme**.

## Description

Cette application permet aux entraîneurs du club de :
- Consulter leur planning d’entraînements (en tant que coach)
- Déclarer leurs indisponibilités pour certaines séances
- Proposer des échanges de séances avec d’autres entraîneurs

Le responsable du planning peut :
- Créer, modifier ou supprimer des séances et des entraînements
- Valider ou refuser les échanges de séances proposés entre entraîneurs
- Gérer les indisponibilités

## Technologies utilisées

- **Framework** : Laravel (PHP)
- **Base de données** : MariaDB
- **Serveur web** : Apache 2
- **Frontend** : Blade, Tailwind CSS
- **Autres** : Composer, NPM

## Prérequis

- PHP >= 8.1
- Composer
- Node.js & NPM
- MariaDB (ou MySQL)
- Apache 2

## Installation

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/ton-utilisateur/ton-repo.git
   cd ton-repo
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances front-end**
   ```bash
   npm install
   npm run build
   ```

4. **Configurer l’environnement**
   - Copier le fichier `.env.example` en `.env`
   - Modifier les variables de connexion à la base de données :
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=planning_lyonpalme
     DB_USERNAME=ton_user
     DB_PASSWORD=ton_mot_de_passe
     ```

5. **Générer la clé d’application**
   ```bash
   php artisan key:generate
   ```

6. **Lancer les migrations et les seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```
   Ou configurer Apache pour pointer vers le dossier `public/`.

## Utilisation

- Rendez-vous sur [http://localhost:8000](http://localhost:8000) ou l’URL de votre serveur.
- Connectez-vous avec un compte existant ou créez-en un (selon la configuration).

### Exemples de comptes

- **Admin / Responsable planning**
  - Email : admin@lyonpalme.fr
  - Mot de passe : admin123

- **Entraîneur**
  - Email : coach@lyonpalme.fr
  - Mot de passe : coach123

> *(Modifiez ces exemples selon vos besoins)*

## Fonctionnalités principales

- Gestion des séances et des entraînements
- Consultation du planning personnel
- Déclaration d’indisponibilité
- Propositions et validation d’échanges de séances
- Gestion des rôles (admin, entraîneur)
- Sécurité : gestion des mots de passe, traçabilité des accès

## Captures d’écran

*(À insérer)*

## Auteur

Club Lyon Palme

---

N’hésite pas à compléter ou modifier selon tes besoins !