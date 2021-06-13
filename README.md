# Email Microservice (Dev in progress)


# Installation using docker
1- Clone the project using git command
    git clone https://github.com/abhidev54/emailservice.git
2- Update mysql database credentials in .env file
3- go to emailservice directory and run docker command
   docker-compose --env-file .env up --build
4-  For database migration
    docker-compose exec app php artisan migrate
5- Start queue processor in new terminal
    docker-compose exec app php artisan queue:work

# Installation without using docker
1- Clone the project using git command
    git clone https://github.com/abhidev54/emailservice.git
2- go to emailservice directory and run below commands
   composer install
3- Update mysql database credentials in .env file
4- Run database migration command
   php artisan migrate
5- Start the server
   php -S lumen:8000 -t public
6- Start queue processor in new terminal
   php artisan queue:work


Screenshots :

![image](https://user-images.githubusercontent.com/32800622/117795805-23193a00-b26c-11eb-8ebd-0355f1809070.png)

![image](https://user-images.githubusercontent.com/32800622/117795946-417f3580-b26c-11eb-9cd9-fae2218d1eb1.png)


