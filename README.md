# sample probelm solutions
## Installations
Clone the project into the `web server` or `docker` 
```sh
git clone git@github.com:tarikul05/thrivecart-task.git
cd thrivecart-task
composer install
```
For docker just run `docker-compose build` and `docker-compose up`. 

## Project run
- in `src` folder the files are located
- for output run browse `index.php` file 
- for command line just run `php index.php`, in index.php test case sample input/output

## UnitTesting
For running unit testing run in command line 
```
./vendor/bin/phpunit --testdox tests
```

## Php debuging with PHPStan
we can debug code with PHPStan and get the report 
```
 vendor/bin/phpstan analyse src 
```
There is `level` of debug can be set. By default iit is `0` and it's up to 10
I validate it 4 level
```
vendor/bin/phpstan analyse src tests --level 4 
```

