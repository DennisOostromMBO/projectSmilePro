<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmilePro - Home</title>
    <!-- Voeg hier Bootstrap CSS toe voor styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">SmilePro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.index') }}">Patiënten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('accountoverzicht.index') }}">Account Overzicht</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('praktijkmanager.medewerkers') }}">Medewerkers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Communicatie.index') }}">Communicatie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('factuur.index') }}">Factuur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/beschikbaarheid') }}">Beschikbaarheid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-5" href="{{ url('/afspraken') }}">Afspraken</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/aboutus') }}">About us</a>
                    </li>
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Welkom bij SmilePro</h1>
            <p class="lead">Het platform voor moderne tandheelkunde en efficiënte patiëntenzorg.</p>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card p-4">
                        <div class="card-body">
                            <h5 class="card-title">Patiëntenbeheer</h5>
                            <p class="card-text">Beheer eenvoudig patiëntgegevens en hun afspraken.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <div class="card-body">
                            <h5 class="card-title">Teamoverzicht</h5>
                            <p class="card-text">Bekijk en beheer je medewerkers op één centrale plek.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <div class="card-body">
                            <h5 class="card-title">Geautomatiseerde communicatie</h5>
                            <p class="card-text">Houd patiënten en medewerkers op de hoogte met automatische e-mails en meldingen.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light text-center py-4">
        <div class="container">
            <p class="mb-0">© 2024 SmilePro. Alle rechten voorbehouden.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
