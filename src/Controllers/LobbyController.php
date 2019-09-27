<?php

namespace WhiteHatApi\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\PhpRenderer;
use WhiteHatApi\Dao\Country;

class LobbyController
{

    /**
     * @var PhpRenderer
     */
    private $view;

    public function __construct(PhpRenderer $view, Country $countryDao)
    {
        $this->view = $view;
        $this->countryDao = $countryDao;
    }

    public function getLobby(Request $request, Response $response, array $args)
    {
        $countries = $this->countryDao->getCountries();
        $brands = $this->getBrands();
        $categories = $this->getCategories();

        return $this->view->render($response, 'index.phtml', [
            'countries' => $countries,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    private function getBrands()
    {

        $brands = file_get_contents(__DIR__ . '/../brands.txt');
        $brands = explode("\n", $brands);
        $brands = array_map(function($item){
            $line = str_replace("'", '', $item);
            return explode(', ', $line);
        }, $brands);
        array_shift($brands);
        return $brands;
    }

    private function getCategories()
    {

        $categories = file_get_contents(__DIR__ . '/../categories.txt');
        $categories = explode("\n", $categories);
        $categories = array_map(function($item){
            $line = str_replace("'", '', $item);
            return explode(', ', $line);
        }, $categories);
        return $categories;
    }


}