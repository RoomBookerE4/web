symfony server:start
php bin/console
php bin/console doctrine:mapping:import "App\Entity" annotation --path=src/Entity

\App\Domain\Auth\...