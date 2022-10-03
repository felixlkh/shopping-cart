### -Setup Guide-

1. Install docker

2. Download the source code from git lab

3. Go to the project dir and run the commands below in docker

```
docker-compose build
```

```
docker-compose up -d
```

4. Setup the project dependencies

```
docker-compose run composer install
```

5. To run the Test cases:

```
docker-compose run phpunit
```
