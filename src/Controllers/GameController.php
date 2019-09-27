<?php

namespace WhiteHatApi\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use WhiteHatApi\Dao\Game;

class GameController
{
    /**
     * @var Game
     */
    private $gameDao;

    public function __construct(Game $gameDao)
    {
        $this->gameDao = $gameDao;
    }

    public function getGames(Request $request, Response $response, array $args)
    {
        $games = $this->gameDao->getGames(
            $request->getParam('brand', null),
            $request->getParam('country', null),
            $request->getParam('category', null)
        );

        return $response->withJson(
            [
                'data' => $games
            ]
        );
    }

}