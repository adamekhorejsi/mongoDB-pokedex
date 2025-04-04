<?php

declare(strict_types=1);

namespace App\Helpers;

use MongoDB\Client;

class Router
{
    // Namespace, ve kterém se nachází všechny controllery
    protected string $controller_namespace = "App\\Controllers\\";
    // Instance MongoDB klienta pro předávání do controllerů
    protected Client $mongo_client;
    // Pole registrovaných rout s přiřazenými controllery a metodami
    protected array $routes = [];

    // Konstruktor pro inicializaci MongoDB klienta
    public function __construct(Client $mongo_client)
    {
        $this->mongo_client = $mongo_client;
    }

    /**
     * Přidá novou route do seznamu.
     *
     * @param string $path       Cesta, např. 'pokemon/{id}'
     * @param string $controller Název controlleru bez namespace
     * @param string $method     Název metody v controlleru
     */
    public function addRoute(string $path, string $controller, string $method): void
    {
        $this->routes[$path] = [
            'controller' => $controller,
            'method' => $method,
        ];
    }

    /**
     * Zpracuje příchozí požadavek na základě URI.
     *
     * @param string $request_uri URI z požadavku (např. '/pokemon/1?query=abc')
     * @return string             HTML výstup
     */
    public function handle(string $request_uri): string
    {
        // Rozdělení URI na část cesty a dotaz (query string)
        $uri_parts = explode('?', $request_uri, 2);
        $path = trim($uri_parts[0], '/'); // Odstraní začáteční a koncové lomítko
        $query_string = $uri_parts[1] ?? ''; // Dotazovací řetězec za otazníkem

        // Parsování query stringu do asociativního pole
        parse_str($query_string, $query_params);

        // Procházení registrovaných rout
        foreach ($this->routes as $route => $handler) {
            // Nahrazení dynamických parametrů (např. {id}) regulárním výrazem
            $pattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([^/]+)', $route);
            $pattern = "#^" . $pattern . "$#"; // Vytvoření regulárního výrazu

            // Kontrola, zda aktuální cesta odpovídá dané routě
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // První prvek obsahuje celý shodný řetězec, odstraníme jej

                // Sestavení plného názvu controlleru včetně namespace
                $controller_class = $this->controller_namespace . $handler['controller'];
                $method = $handler['method'];

                // Kontrola, zda controller existuje
                if (class_exists($controller_class)) {
                    // Vytvoření instance controlleru a předání MongoDB klienta
                    $controller = new $controller_class($this->mongo_client);
                    // Nastavení query parametrů v controlleru
                    $controller->setQueryParams($query_params);

                    // Kontrola, zda metoda existuje v daném controlleru
                    if (method_exists($controller, $method)) {
                        // Volání metody controlleru a předání dynamických parametrů
                        return $controller->$method(...$matches);
                    } else {
                        // Metoda neexistuje, vracíme chybu 404
                        http_response_code(404);
                        return $this->renderError("Method '{$method}' not found in {$controller_class}.");
                    }
                } else {
                    // Controller neexistuje, vracíme chybu 404
                    http_response_code(404);
                    return $this->renderError("Controller '{$controller_class}' not found.");
                }
            }
        }

        // Žádná route neodpovídá požadavku, vracíme chybu 404
        http_response_code(404);
        return $this->renderError("Route '{$path}' not found.");
    }

    /**
     * Vygeneruje HTML pro chybovou stránku.
     *
     * @param string $message Chybová zpráva
     * @return string         HTML výstup
     */
    protected function renderError(string $message): string
    {
        return "<h1>404 Not Found</h1><p>{$message}</p>";
    }
}
