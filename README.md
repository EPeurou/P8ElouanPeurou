## Instruction d'installation du projet

### Versions

PHP: 7.3.7
Symfony: 5.4

### Récupérer le code

Pour récupérer le code rendez-vous à l'adresse suivante: https://github.com/EPeurou/P8ElouanPeurou
Une fois arrivé sur la page GitHub du projet cliqué sur le bouton 'code' puis cliqué sur 'download ZIP'

### Installation sur un serveur local

Pour installer le projet sur un serveur local il faut d'abord extraire les données du dossier .zip puis placer le dossier contenant le code dans le dossier qui contient les autres applications fonctionnant sur le serveur.

Une fois le projet installé sur le serveur il vous suffira d'ouvrir votre navigateur web et saisir l'url pointant sur le dossier de votre projet et ajouter /public. Exemple: 127.0.0.1/NomDuDossier/public

### Dépendances

Pour installer les bundles nécéssaire au bon fonctionement du site, éxecuté la commande suivante au niveau du projet dans votre terminale.

    composer install

### Modification du code nécessaire

Quelques modifications sont requises pour le bon fonctionnement de l'application.

Dans le fichier '.env' situé à la racine du projet vous devrez modifier l'hôte, le nom d'utilisateur et son mot de passe, le nom  de votre base de données, comme ceci:

    DATABASE_URL="mysql://utilisateurBase:motDePasseBase@127.0.0.1:3306/nomBase"

Le projet est maintenant fonctionnel.

### Import de la base de données

Pour récupérer la base de données vous pouvez importer le fichier 'p8bdd.sql' (à la racine du projet), dans votre système de base de données afin de récupérer les données de démo du projet.

Si vous préféré chargé les données dans votre propre base de données, entré ces commandes dans l'ordre dans votre terminale au niveau du projet:

    php bin/console doctrine:migrations:migrate

    php bin/console doctrine:fixtures:load

Si vous souhaitez également chargé les données dans la base de test, tapé les commandes suivantes dans l'ordre:

    php bin/console --env=test doctrine:database:create

    php bin/console --env=test doctrine:schema:create

    php bin/console doctrine:fixtures:load --env=test

### Tests PHPUNIT

Pour lancer les tests PHPUNIT entré la ligne suivante en ligne de commande.

    php bin/phpunit

Si vous souhaitez tester une deuxième fois, veillé à bien rechargé les données de la base de test pour pouvoir tester à nouveau.

La page affichant le taux de couverture est accessible depuis un navigateur, exemple: 127.0.0.1/NomDuDossier/public/test-coverage/index.html

### Identifiants de connexion

Voici des identifiants qui vous permettront de tester le site.

#### Compte administrateur:
##### nom d'utilisateur: Admin
##### mot de passe: test

#### Compte utilisateur:
##### nom d'utilisateur: User
##### mot de passe: test
