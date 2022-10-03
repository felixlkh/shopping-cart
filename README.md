-Setup Guide-

Install docker

Download the source code from git lab

Go to the project dir and run the commands below in docker

docker-compose build

docker-compose up -d

Setup the project dependencies
docker-compose run composer install

To run the Test cases:

docker-compose run phpunit
