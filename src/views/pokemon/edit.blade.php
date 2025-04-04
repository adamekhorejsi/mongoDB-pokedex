<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h1 class="card-title text-center">{{ isset($pokemon) ? 'Edit Pokémon' : 'Add New Pokémon' }}</h1>
                <form action="{{ isset($pokemon) ? '/pokemon/update/' . $pokemon['id'] : '/pokemon/save' }}" method="POST">
                    @if(isset($pokemon))
                 
                    
                    <div class="mb-3">
                        <label for="id" class="form-label">Pokémon ID</label>
                        <input type="number" class="form-control" id="id" name="id" value="{{ $pokemon['id'] ?? '' }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">English Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $pokemon['name']['english'] ?? '' }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="japanese_name" class="form-label">Japanese Name</label>
                        <input type="text" class="form-control" id="japanese_name" name="japanese_name" value="{{ $pokemon['name']['japanese'] ?? '' }}">
                    </div>
                    
                    
                    <div class="mb-3">
                        <h5>Base Stats</h5>
                        @foreach (['HP', 'Attack', 'Defense', 'Sp. Attack', 'Sp. Defense', 'Speed'] as $stat)
                        <label class="form-label">{{ $stat }}</label>
                        <input type="number" class="form-control" name="base[{{ $stat }}]" value="{{ $pokemon['base'][$stat] ?? '' }}" required>
                        @endforeach
                    </div>
                    
                    <div class="mb-3">
                        <h5>Moves</h5>
                        <textarea class="form-control" name="moves" rows="3">{{ isset($pokemon) ? implode(", ", array_column($pokemon['moves'], 'ename')) : '' }}</textarea>
                        <small class="text-muted">Enter move names separated by commas.</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">{{  'Update' }}</button>
                    <a href="/pokemon/delete/{{ $pokemon['id'] }}" class="btn btn-danger">Delete</a>
                    @endif
                </form>
            </div>
        </div>
        
        <div class="mt-4 text-center">
            <a href="/pokemon/list" class="btn btn-secondary">Back</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
