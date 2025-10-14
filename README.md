# EBOKOLI - Plateforme Sociale

Plateforme de réseau social avec fonctionnalités de wallet, épargne et emprunts.

## Fonctionnalités principales

### Réseau Social
- Profils utilisateurs
- Publications, commentaires et réactions
- Messagerie instantanée
- Événements et groupes
- Pages et blogs
- Marketplace
- Live streaming

### Wallet & Finance
- **Portefeuille numérique** : Gestion du solde utilisateur
- **Épargne** : Création et gestion d'épargnes avec calcul d'intérêts
- **Emprunts** : Demande, approbation et remboursement d'emprunts
- **Transactions** : Historique complet des transactions
- **Administration** : Gestion complète des wallets, épargnes et emprunts

## Technologies

- **Backend** : PHP 8.4+
- **Base de données** : MySQL/MariaDB
- **Frontend** : HTML5, CSS3, JavaScript
- **Dépendances** : Composer, NPM

## Installation locale

### Prérequis
- PHP 8.4 ou supérieur
- MySQL/MariaDB
- Composer
- NPM

### Configuration

1. **Cloner le dépôt**
```bash
git clone <url-du-repo>
cd public_html
```

2. **Installer les dépendances**
```bash
composer install
npm install
```

3. **Configuration de la base de données**
- Créer une base de données MySQL
- Copier `includes/config-example.php` vers `includes/config.local.php`
- Éditer `includes/config.local.php` avec vos paramètres de connexion

4. **Importer la structure de la base de données**
- Importer le fichier SQL principal
- Importer `wallet_savings_loans.sql` pour les fonctionnalités épargne/emprunts

5. **Démarrer le serveur local**
```bash
php -S localhost:8080 router.php
```

Ou utiliser le fichier batch fourni :
```bash
start_server.bat
```

## Structure du projet

```
├── includes/               # Fichiers PHP core
│   ├── ajax/              # Endpoints AJAX
│   ├── class-user.php     # Classe principale User
│   ├── class-user-savings-loans.php  # Extension épargne/emprunts
│   └── config.php         # Configuration
├── content/               # Contenu utilisateur et thèmes
├── modules/               # Modules additionnels
├── vendor/                # Dépendances Composer
├── admin.php              # Panel d'administration
├── wallet.php             # Interface wallet
└── router.php             # Routeur principal
```

## Routes Wallet

- `/wallet` - Vue générale du wallet
- `/wallet/savings` - Gestion des épargnes
- `/wallet/loans` - Gestion des emprunts

## Administrateurs

Pour lister les administrateurs du système :
```bash
php list_admins.php
```

## Sécurité

- Fichiers sensibles exclus via `.gitignore`
- Configuration locale non versionnée
- Logs et fichiers temporaires ignorés

## Développé par

Équipe EBOKOLI

## Licence

Propriétaire - Tous droits réservés
