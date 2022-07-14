Pour demarrer le projet

créer une base de donnée vide ex "db_resto"
modifier le fichier env: login de votre base de donnée et le mot de passe de la base de donnée

    DB_DATABASE=db_resto
    DB_USERNAME=root
    DB_PASSWORD=root

lancer les commandes suivantes

php artisan migrate
php artisan db:seed

npm install
npm run dev
php artisan serve
