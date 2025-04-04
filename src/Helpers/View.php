<?php

declare(strict_types=1);

namespace App\Helpers;

use Jenssegers\Blade\Blade;

class View
{
    protected Blade $blade;

    public function __construct()
    {
        $views_path = __DIR__ . '/../views'; // Path to views directory
        $cache_path = __DIR__ . '/../cache'; // Path to cache directory

        // Ensure paths are valid
        if (!is_dir($views_path)) {
            throw new \Exception("Views directory not found: {$views_path}");
        }

        if (!is_dir($cache_path)) {
            mkdir($cache_path, 0755, true);
        }

        // Initialize Blade
        $this->blade = new Blade($views_path, $cache_path, null);

        
    }

    public function render(string $view, array $data = []): string
    {
        
        $view = str_replace('/', '.', $view); // Convert slashes to dot notation
        return $this->blade->make($view, $data)->render();
    }
}
