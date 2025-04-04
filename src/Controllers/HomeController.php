<?php

declare(strict_types=1);

namespace App\Controllers;



class HomeController extends AbstractController
{
    public function index(): string
    {
        $query_params = $this->getQueryParams();
        $data = [
            'title' => 'Vítejte v Pokedexu',
            'message'   => 'Nejkomplexnější Pokedex na světě'
        ];

        

        return $this->render('home.index', $data);
    }
}
