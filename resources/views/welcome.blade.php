<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Navbar</title>
    <!-- Voeg hier Bootstrap CSS toe voor styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Laravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.index') }}">Patiënten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('AccountOverzicht.index') }}">Account Overzicht</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('praktijkmanager.medewerkers') }}">Medewerkers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Communicatie.index') }}">Communicatie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-5" href="{{ url('/beschikbaarheid') }}">Beschikbaarheid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a> <!-- Extra margin -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Voeg hier optioneel andere content toe -->
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
