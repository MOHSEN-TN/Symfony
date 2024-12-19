# Tekupgym-symfony
Une application Symfony qui permet aux propriétaires de salles de sport de gérer leur activité et de faciliter leurs tâches quotidiennes comme apporter des modifications à leur planning hebdomadaire et l'afficher pour leurs clients, ajouter des activités avec des informations réelles pour les clients (heure, coach assigné...) avec le possibilité de participer à un ou plusieurs de leur choix...


# Environnement 

- PHP >=7.2.5
- Composer
- Mysql
- Symfony
- Twig Engine Template
- webpack

# Installation 
- composer install 
- php bin/console doctrine:database:create
- php bin/console doctrine:schema:update --force
- php bin/console doctrine:migrations:migrate
- php bin/console cache:clear --env=prod
- npm install --global yarn
- yarn install
- npm install
- yarn add --dev @symfony/webpack-encore
- yarn add webpack-notifier --dev
- composer require --dev phpunit/phpunit:^9.5 symfony/test-pack
- yarn encore dev

# Run Tests
- php bin/phpunit --testdox-html=tests/report/testdox.html
- php vendor/bin/phpunit --coverage-html coverage
# Tous les tests E2E
- php bin/phpunit --testsuite e2e
* Admin
* Client
# Fonctionnalités
# Admin
- Stats (Dashboard)
- Gestion d'utilisateurs
- Gestion des abonnements
- Gestion des produits
- Gestion des Categories
- Gestion des Activités
- Gestion Des participation
- Gestion des Commandes
- Gestion des Coachs

# Client

- Consulter le planning
- Commander un produit ou une catégorie
- Consulter l'historique des commandes
- Consulter les activités
- Participer à une activité


# TO DO
- Reservation
- Notifications 
- Email
- Confirmation de compte