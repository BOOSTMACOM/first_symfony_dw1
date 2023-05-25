# Setup
## Paramétrer son environnement
Ajouter un fichier .env.local avec vos informations de connexion à la base de données
```env
APP_ENV=dev
DATABASE_URL={votrechainedeconnexion}
```
## Installer les dépendances
```
composer install
```
```
yarn install
```

## Création de la base de donnée
```
php bin/console doctrine:database:create
```

## Execution des migrations
```
php bin/console doctrine:migrations:migrate
```

## Chargement des données de démo
```
php bin/console doctrine:fixtures:load
```

## Compilation des assets
```
yarn encore dev
```

## Lancement du projet
```
symfony serve
```
