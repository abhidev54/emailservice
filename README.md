# Email Microservice


# Installation using docker
1- Clone the project using git command
    git clone https://github.com/abhidev54/emailservice.git
2- Update mysql database credentials in .env file
3- go to emailservice directory and run docker command
   docker-compose --env-file .env up --build
4-  For database migration
    docker-compose exec emailservice_lumen_1 php artisan migrate
5- Start queue processor in new terminal
    docker-compose exec emailservice_lumen_1 php artisan queue:work

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

# Postman collection (incase you want to check via postman however i have created VUEJS application, repo : https://github.com/abhidev54/emailservice-portal)
https://www.getpostman.com/collections/d88e937e9039434543e3

# VUE JS application (For this follow repo and build it , https://github.com/abhidev54/emailservice-portal)
http://localhost:8080/

Screenshots :

![image](https://user-images.githubusercontent.com/32800622/117795805-23193a00-b26c-11eb-8ebd-0355f1809070.png)

![image](https://user-images.githubusercontent.com/32800622/117795946-417f3580-b26c-11eb-9cd9-fae2218d1eb1.png)


