 listing des outils / services symfony
 # php bin/console debug:writing --all
 
 mise en service du serveur :
  - download lz zip
  - dezip
  - composer install
  - composer update
  - update .env / .en.local
  - php bin/console doctrine:database:create
  - php bin/console database:migrations:migrate
  - php bin/console d:f:l
  - symfony server:start

 
 
 # require faker
 - composer require orm-fixtures   
 - composer require fzaninotto/faker
 - composer require liorchamla/faker-prices    
 - composer require mbezhanov/faker-provider-collection 
 - composer require bluemmb/faker-picsum-photos-provider
 
 
 
