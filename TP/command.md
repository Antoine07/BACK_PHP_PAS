
# maker 
- composer require symfony/maker-bundle
# db
- composer require symfony/orm-pack
- php bin/console doctrine:migrations:migrate
- composer require orm-fixtures --dev
- php bin/console doctrine:fixtures:load
- php bin/console doctrine:database:create
# form & twig
- composer require symfony/form
- composer require twig
# Package de tests pour SF
- composer require --dev symfony/test-pack
- php bin/phpunit

# command bash UNIX LINUX
```bash
# savoir où on est dans le terminal
pwd

# liste des dossiers et fichiers
ls -al 
```