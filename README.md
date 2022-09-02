## Instruction d'installation du projet

### Versions

PHP: 7.3.7
Symfony: 5.4

### Récupérer le code

Pour récupérer le code, rendez-vous à l'adresse suivante: https://github.com/EPeurou/P8ElouanPeurou
Une fois arrivé sur la page GitHub du projet, cliquez sur le bouton 'code' puis cliquez sur 'download ZIP'

### Installation sur un serveur local

Pour installer le projet sur un serveur local, il faut d'abord extraire les données du dossier .zip puis placer le dossier contenant le code dans le dossier qui contient les autres applications fonctionnant sur le serveur.

Une fois le projet installé sur le serveur, il vous suffira d'ouvrir votre navigateur web et saisir l'url pointant sur le dossier de votre projet et ajouter /public. Exemple: 127.0.0.1/NomDuDossier/public

### Dépendances

Pour installer les bundles nécéssaires au bon fonctionement du site, éxecutez la commande suivante au niveau du projet dans votre terminal.

    composer install

### Modification du code nécessaire

Quelques modifications sont requises pour le bon fonctionnement de l'application.

Dans le fichier '.env' situé à la racine du projet, vous devrez modifier l'hôte, le nom d'utilisateur, son mot de passe et le nom  de votre base de données, comme ceci:

    DATABASE_URL="mysql://utilisateurBase:motDePasseBase@127.0.0.1:3306/nomBase"


### Chargement des données

Pour charger les données dans votre base de données, entrez ces commandes dans l'ordre dans votre terminal au niveau du projet:

    php bin/console doctrine:migrations:migrate

    php bin/console doctrine:fixtures:load

Si vous souhaitez également charger les données dans la base de test, tapez les commandes suivantes dans l'ordre:

    php bin/console --env=test doctrine:database:create

    php bin/console --env=test doctrine:schema:create

    php bin/console doctrine:fixtures:load --env=test


### Consigne d'utilisation

Une commande a été créée pour rattacher les tâches sans utilisateur à l'utilisateur anonyme:

    php bin/console app:settasktoanon

### Tests PHPUNIT

Pour lancer les tests PHPUNIT entrez la ligne suivante en ligne de commande.

    php bin/phpunit

Si vous souhaitez tester une deuxième fois, veillez à bien recharger les données de la base de test pour pouvoir tester à nouveau.

La page affichant le taux de couverture est accessible depuis un navigateur, exemple: 127.0.0.1/NomDuDossier/public/test-coverage/index.html

### Identifiants de connexion

Voici des identifiants qui vous permettront de tester le site.

#### Compte administrateur:
##### nom d'utilisateur: Admin
##### mot de passe: test

#### Compte utilisateur:
##### nom d'utilisateur: User
##### mot de passe: test
