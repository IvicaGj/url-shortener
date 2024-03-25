## Prerequisites:

Windows: 
- Windows Subsystem for Linux 2 (WSL2) installed
- Docker Desktop installed

## After cloning the repo, start the app:

Linux: 
- open project directory and run:
```
composer install \
    ./vendor/bin/sail up
```

Windows:
- start Docker Desktop
- open Windows Terminal in the project directory
- run the `wsl` command to instantiate a new terminal session for WSL2
- run the following:
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs \
    ./vendor/bin/sail up
```

After you do the above just run:

Linux: 
```
php artisan migrate
```

Windows:
- in a wsl instance run:
```
./vendor/bin/sail artisan migrate
```

## Accesing the application:

- navigate to http://localhost in the browser
