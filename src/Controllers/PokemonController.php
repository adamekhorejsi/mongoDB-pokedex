<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Pokemon;
use App\Models\Move;

use function PHPSTORM_META\type;

class PokemonController extends AbstractController
{
    public function index(): string
    {
        $query_params = $this->getQueryParams();

        return $this->render('pokemon.index', ['query' => $query_params]);
    }

    /**
     * @return string
     */
    public function list(): string
    {
        $query_params = $this->getQueryParams();
        $pokemonModel = new Pokemon($this->mongo_client);

        $type = $_GET['type'] ?? null;
        $search = $_GET['search'] ?? null;

        // Filtrování podle typu
        if ($type) {
            $pokemons = $pokemonModel->filterByType($type);
        } else {
            $pokemons = $pokemonModel->all();
        }
        // Filtrování podle názvu
        if ($search) {
            $pokemons = array_filter($pokemons, function ($pokemon) use ($search) {
                return stripos($pokemon['name']['english'], $search) !== false;
            });
        }
        $data = [
            'title' => 'Pokémon List',
            'pokemons' => json_decode(json_encode($pokemons), true),
            'type' => $type,
            'search' => $search,
            'query' => $query_params,
        ];

        return $this->render('pokemon.list', $data);
    }


    public function details(string $id): string
    {
        $pokemon_model = new Pokemon($this->mongo_client);
        $move_model = new Move($this->mongo_client);

        // 1. Najdeme Pokémona podle ID
        $pokemon = $pokemon_model->findById((int)$id);
        if (!$pokemon) {
            http_response_code(404);
            return $this->render('error', ['message' => "Pokémon with ID {$id} not found."]);
        }

        // 2. Ověříme, zda Pokémon má typy
        $types = $pokemon['type'] ?? []; // Použij správný klíč

        if (!is_array($types)) {
            $types = [$types]; // Pokud je jen jeden typ jako string, převedeme na pole
        }

        // 3. Najdeme útoky podle typů
        $moves = $move_model->findByTypes($types);

        // 4. Předání do šablony
        return $this->render('pokemon.details', [
            'pokemon' => $pokemon,
            'moves' => $moves,
        ]);
    }

    public function edit($id)
    {
        $pokemon_model = new Pokemon($this->mongo_client);
        $move_model = new Move($this->mongo_client);
        
        // 1. Najdeme Pokémona podle ID
        $pokemon = $pokemon_model->findById((int)$id);
        if (!$pokemon) {
            http_response_code(404);
            return $this->render('error', ['message' => "Pokémon with ID {$id} not found."]);
        }

        // 2. Ověříme, zda Pokémon má typy
        $types = $pokemon['type'] ?? []; // Použij správný klíč

        if (!is_array($types)) {
            $types = [$types]; // Pokud je jen jeden typ jako string, převedeme na pole
        }

        // 3. Najdeme útoky podle typů
        $moves = $move_model->findByTypes($types);

        // 4. Předání do šablony

        return $this->render('pokemon.edit', [
            'pokemon' => $pokemon,
            'moves' => $moves,
            'types' => $types,
        ]);
    }

    // update pokemona
    public function update($id)
    {
        $pokemon_model = new Pokemon($this->mongo_client);
        $move_model = new Move($this->mongo_client);

        // 1. Najdeme Pokémona podle ID
        $pokemon = $pokemon_model->findById((int)$id);
        if (!$pokemon) {
            http_response_code(404);
            return $this->render('error', ['message' => "Pokémon with ID {$id} not found."]);
        }

        // 2. Ověříme, zda Pokémon má typy
        $types = $pokemon['type'] ?? []; // Použij správný klíč

        if (!is_array($types)) {
            $types = [$types]; // Pokud je jen jeden typ jako string, převedeme na pole
        }

        // 3. Najdeme útoky podle typů
        $moves = $move_model->findByTypes($types);

        // 4. Předání do šablony

        return $this->render('pokemon.update', [
            'pokemon' => $pokemon,
            'moves' => $moves,
        ]);
    }

    public function filter()
    {
        // Získání hodnot z query parametrů
        $type = $_GET['type'] ?? null;
        $alphabet = $_GET['alphabet'] ?? null;
        $move = $_GET['move'] ?? null;
        $query_params = $this->getQueryParams();
        $collection = $this->mongo_client->pokedex->pokedex;
        $filter = [];


        
    }
}
