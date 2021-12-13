# Expense Management System with Symfony [BE]

In this project we have created a RESTful API backend for expense management application, based on PHP 8 symfony framework. 

This application allows you to manage expenses with all API that you might need to build a front end application.
<br>

Now let's jump into the project testing :D

## Prerequisite
- Docker and docker-compose installed in minimal version 1.24. You can check version with docker-compose -v If you're missing this requirement please refer docker-installation.md file.


## Insallation

1. Clone this repository by running the following command in the desired directory:
```bash
git clone https://github.com/mhmdmousawi/ems-symfony.git
```

2. Change directory to access the root folder of the project:
```bash
cd ems-symfony
```

3. Run the docker container to start the project:
```bash
docker-compose up -d --build database && docker-compose up -d --build app && docker-compose up -d --build web
```

later you can only use ``docker-compose up -d`` inside your root directory

Once you can access the web application throw the port defined in `docker-compose.yml` file port `:8990`
and the database throw port `:8991`

4. Access the container:
```bash
docker exec -it  ems-symfony-server bash
```

5. Run the migrations inside the container, and then clear the cache:
```bash
php bin/console doctrine:migrations:execute --up 'DoctrineMigrations\Version20211211142232'
php bin/console doctrine:migrations:execute --up 'DoctrineMigrations\Version20211211151003'
php bin/console doctrine:migrations:execute --up 'DoctrineMigrations\Version20211211151010'
php bin/console doctrine:migrations:execute --up 'DoctrineMigrations\Version20211211160334'
```
## Configuration

- Configuration is already done. But in case you want to change anything please feel free to update the .env file before running the containers.

## Testing
Now that you have set your project up, it's time for fun testing. <br>
Since this is a Back End application, so you will have to download Postman (https://www.postman.com/downloads/)

Now to help you check all the API endpoints, I have prepared a Postman Collection that you can download as well:
https://drive.google.com/drive/folders/1Vnksa2_blbvARvoXKTopnYExG6LvQo-3?usp=sharing

Happy Testing! :)
