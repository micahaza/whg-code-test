<?php

namespace WhiteHatApi;


use Dotenv\Dotenv;
use Slim\Container;
use Slim\Views\PhpRenderer;
use Tuupola\Middleware\JwtAuthentication;
use WhiteHatApi\Controllers\LobbyController;
use Slim\App;
use WhiteHatApi\Controllers\GameController;
use WhiteHatApi\Dao\Game;

class AppBuilder
{
	private $app;

	private function __construct(App $app)
	{
		$this->app = $app;
	}

	public static function buildApp(){
		return (new self(new App()))->build();
	}

	private function build()
	{
		$this->loadEnv();
		$this->setupDbConnections();
		$this->setupControllers();
        $this->setupRoutes();

		return $this->app;
	}

	private function loadEnv()
	{
		if (getenv('APPLICATION_ENV') == 'development') {
            $dotenvFile = '.env.development';
		} else {
			$dotenvFile = '.env';
		}

		$dotenv = new Dotenv(__DIR__ . '/../', $dotenvFile);
		$dotenv->load();
	}

	private function setupDbConnections()
	{
		$dbFactory = new DBConnectionFactory();
		$this->app->getContainer()['DB_CASINO'] = $dbFactory->getCasino();
	}

	private function setupControllers()
	{
		$container = $this->app->getContainer();

		$container[Game::class] = function(Container $container) {
		    return new Game($container->get('DB_CASINO'));
		};
        $container[GameController::class] = function(Container $container) {
            return new GameController($container->get(Game::class));
        };

        $container[PhpRenderer::class] = function(Container $container) {
            return new PhpRenderer(__DIR__ .  '/Templates/');
        };

		$container[LobbyController::class] = function(Container $container) {
		    return new LobbyController($container->get(PhpRenderer::class));
		};

	}

    private function setupRoutes()
	{
		$this->app->get('/', LobbyController::class . ':getLobby');

		$this->app->get('/api/games', GameController::class . ':getGames');
	}
}