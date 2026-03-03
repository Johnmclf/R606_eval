## Démarrage
1. Cloner le projet.

   ```bash
    git clone https://github.com/Johnmclf/R606_eval.git
   ```

2. Se mettre sur develop
   ```bash
   git checkout develop
   ```

3. Lancer les conteneurs :

   ```bash
   docker-compose up -d --build
   ```

4. Créer le .env
A partir du .env_exemple créer le .env
Regarder le docker-compose pour vous aidez, mais dans l'idéal, il faudrai que le docker-compose prennent en paramètre les variable dans votre .env

## Accès
- Application : http://localhost:8080
- PhpMyAdmin : http://localhost:8081

## Tester (Non fonctionnelle)
Installer PHPUnit dans Docker
   ```bash
    docker exec -it apache_php bash
    composer require --dev phpunit/phpunit:^10.5
   ```

   ```bash
    docker exec -it apache_php bash
   ```

   ```bash
    vendor/bin/phpunit
   ```

##
CI : En cour d'inplémentation 

## Linter
Non implémenté