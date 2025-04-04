<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pokemon['name']['english'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/sprites/{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}MS.png" type="image/x-icon">
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="/pokemon/edit/{{ $pokemon['id'] }}" class="btn btn-warning me-2">Editovat</a>

            <form action="/pokemon/delete/{{ $pokemon['id'] }}" method="POST" style="display:inline;">
                <button type="submit" class="btn btn-danger">Smazat</button>
            </form>

        </div>
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="card-title text-primary">{{ $pokemon['name']['english'] }}</h1>
                        <h4 class="card-subtitle mb-4 text-muted">Types: {{ implode(', ', $pokemon['type']) }}</h4>
                        
                        <h5 class="mt-4">Base Stats:</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>HP:</strong> {{ $pokemon['base']['HP'] }}</li>
                            <li class="list-group-item"><strong>Attack:</strong> {{ $pokemon['base']['Attack'] }}</li>
                            <li class="list-group-item"><strong>Defense:</strong> {{ $pokemon['base']['Defense'] }}</li>
                            <li class="list-group-item"><strong>Sp. Attack:</strong> {{ $pokemon['base']['Sp. Attack'] }}</li>
                            <li class="list-group-item"><strong>Sp. Defense:</strong> {{ $pokemon['base']['Sp. Defense'] }}</li>
                            <li class="list-group-item"><strong>Speed:</strong> {{ $pokemon['base']['Speed'] }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <img src="/images/{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}.png"
                            class="img-fluid"
                            alt="{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }} - {{ $pokemon['name']['english'] }}"
                            style="max-width: 300px; height: auto;">
                    </div>
                </div>
                <h3 class="mt-4">Moves:</h3>
                <ul class="list-group">
                    @foreach ($moves as $move)
                    <li class="list-group-item">{{ $move['ename'] }} ({{ $move['type'] }}) - Power: {{ $move['power'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mt-4 text-center">
            <a href="/pokemon/list" class="btn btn-secondary">Zpět</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
