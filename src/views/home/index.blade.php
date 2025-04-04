<?php
session_start();
// Například na stránce pro výběr jazyka
if (isset($_GET['lang'])) {
    $_SESSION['language'] = $_GET['lang'];
    header('Location: ' . $_SERVER['REQUEST_URI']); // Přesměruje zpět, aby se jazyk načetl
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>{{ $title }}</title>
</head>

<body class="bg-light d-flex flex-column vh-100">
    <header class=" text-white py-3">
        @include('layouts.navigation')
    </header>

    <main class="flex-grow-1 d-flex align-items-center justify-content-center">


        <!-- obrazky 2 pokemonu -->
        <div class="container">
            <div class="column text-center">
                <!-- obrazek na střed -->
                <img src="/images/001.png" alt="" class="img-fluid">
            </div>

        </div>

        <div class="text-center">
            <h2 class="text-secondary">{{ $message }}</h2>
            <a href="/pokemon/list" class="btn btn-dark mt-4">Pokémon list</a>

        </div>

        <!-- obrazky 2 pokemonu -->
        <div class="container">
            <div class="column text-center">
                <!-- obrazek na střed -->
                <img src="/images/036.png" alt="" class="img-fluid">
            </div>

        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; {{ date('Y') }} Pokémon App. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>