<?php

namespace WhiteHatApi\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\PhpRenderer;
use WhiteHatApi\Dao\Country;
use WhiteHatApi\Dao\Brand;
use WhiteHatApi\Dao\Category;

class LobbyController
{

    /**
     * @var PhpRenderer
     */
    private $view;

    public function __construct(
        PhpRenderer $view,
        Country $countryDao,
        Brand $brandDao,
        Category $categoryDao
    )
    {
        $this->view = $view;
        $this->countryDao = $countryDao;
        $this->brandDao = $brandDao;
        $this->categoryDao = $categoryDao;
    }

    public function getLobby(Request $request, Response $response, array $args)
    {
        
        $countries = $this->countryDao->getCountries();
        $brands = $this->brandDao->getBrands();
        $categories = $this->categoryDao->getCategories();

        return $this->view->render($response, 'index.phtml', [
            'countries' => $countries,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }
}