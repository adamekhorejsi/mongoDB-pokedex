<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pokémon List</title>
    <style>
        .normal { background-color: #A8A878; }
        .fighting { background-color: #C03028; }
        .flying { background-color: #A890F0; }
        .poison { background-color: #A040A0; }
        .ground { background-color: #E0C068; }
        .rock { background-color: #B8A038; }
        .bug { background-color: #A8B820; }
        .ghost { background-color: #705898; }
        .steel { background-color: #B8B8D0; }
        .fire { background-color: #F08030; }
        .water { background-color: #6890F0; }
        .grass { background-color: #78C850; }
        .electric { background-color: #F8D030; }
        .psychic { background-color: #F85888; }
        .ice { background-color: #98D8D8; }
        .dragon { background-color: #7038F8; }
        .dark { background-color: #705848; }
        .fairy { background-color: #EE99AC; }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        @include('layouts.navigation')
        <header class="mb-4 text-center">
            <h1 class="display-3 text-dark">Pokémon List</h1>
        </header>
        <main>
            <form action="/pokemon/list" method="get">
                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Search Pokémon..."
                            value="<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                    <div class="row g-2 align-items-center">
                        <div class="col-auto">
                            <label for="type" class="col-form-label">Filter by Type:</label>
                        </div>
                        <div class="col-auto">
                            <select name="type" id="type" class="form-select">
                                <option value="">All</option>
                                <option value="Grass" <?php echo $type == 'Grass' ? 'selected' : ''; ?>>Grass</option>
                                <option value="Fire" <?php echo $type == 'Fire' ? 'selected' : ''; ?>>Fire</option>
                                <option value="Water" <?php echo $type == 'Water' ? 'selected' : ''; ?>>Water</option>
                                <option value="Electric" <?php echo $type == 'Electric' ? 'selected' : ''; ?>>Electric</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row g-4">
                @foreach ($pokemons as $pokemon)
                <div class="col-md-3">
                    <div class="card h-100 {{ strtolower($pokemon['type'][0]) }}">
                        <a href="/pokemon/{{ $pokemon['id'] }}" class="text-decoration-none text-dark">
                            <img src="/thumbnails/{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}.png"
                                class="card-img-top"
                                alt="{{ $pokemon['name']['english'] }}"
                                style="object-fit: contain; height: 120px;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    <strong>{{ $pokemon['id'] }}</strong> <br>
                                    {{ $pokemon['name']['english'] }}
                                    ({{ $pokemon['name']['japanese'] }}) <br>
                                </h5>
                                <div class="mt-auto">
                                    <span>
                                        {{ implode(', ', $pokemon['type']) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>