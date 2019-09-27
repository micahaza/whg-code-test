<?php

namespace WhiteHatApi\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\PhpRenderer;

class LobbyController
{

    /**
     * @var PhpRenderer
     */
    private $view;

    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    public function getLobby(Request $request, Response $response, array $args)
    {
        $countries = $this->getCountries();
        $brands = $this->getBrands();
        $categories = $this->getCategories();

        return $this->view->render($response, 'index.phtml', [
            'countries' => $countries,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    private function getCountries()
    {
        $countries = file_get_contents(__DIR__ . '/../countries.txt');
        $countries = explode("\n", $countries);
        $countries = array_map(function($item){
            return str_replace("'", '', $item);
        }, $countries);
        return $countries;
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