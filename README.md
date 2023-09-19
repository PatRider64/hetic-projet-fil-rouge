# Hetic Projet Fil Rouge
 
Pour lancer le projet :
```shell
docker-compose up -d
cd frontend
npm run start
```

Récupérer les dépendances Yarn dans le frontend :
```shell
cd frontend
npm i
```

Récupérer les dépendances Composer et charger les fixtures dans le backend :
```shell
docker ps -a
docker exec -ti [container_id] bash
cd html
composer i
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
symfony console d:f:l
```
