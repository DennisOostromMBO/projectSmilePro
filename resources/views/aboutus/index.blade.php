<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - SmilePro</title>
    <!-- Voeg Bootstrap CSS toe -->
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
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('aboutus.index') }}">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Over SmilePro</h1>
            <p class="lead">Uw partner in tandheelkundige zorg en praktijkbeheer.</p>
        </div>
    </header>

    <!-- Over ons sectie -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Wie zijn wij?</h2>
            <p class="text-center">Bij SmilePro geloven we in het moderniseren van tandheelkundige zorgpraktijken. Ons platform is ontworpen om patiënten, tandartsen en praktijkmanagers te ondersteunen met efficiënte tools voor beheer, communicatie en planning.</p>
        </div>
    </section>

    <!-- Onze Missie en Waarden -->
    <section class="py-5 bg-light">
        <div class="container">
            <h3 class="text-center mb-4">Onze Missie</h3>
            <p>Onze missie is eenvoudig: tandheelkundige zorg makkelijker en toegankelijker maken voor iedereen. We streven ernaar om praktijken te ondersteunen met technologie die zorgt voor efficiëntie en transparantie.</p>

            <h3 class="mt-5">Onze Waarden</h3>
            <ul class="list-unstyled mt-3">
                <li><strong>Innovatie:</strong> We omarmen technologie om tandheelkunde te transformeren.</li>
                <li><strong>Klantgerichtheid:</strong> Uw succes is ons succes.</li>
                <li><strong>Betrouwbaarheid:</strong> Uw gegevens en processen zijn veilig bij ons.</li>
            </ul>
        </div>
    </section>

    <!-- Team sectie -->
    <section class="py-5">
        <div class="container">
            <h3 class="text-center mb-4">Ontmoet Ons Team</h3>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
                    <h5>Dr. Smile Pro</h5>
                    <p>Oprichter & CEO</p>
                </div>
                <div class="col-md-4 mb-4">
                    <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
                    <h5>Jane Doe</h5>
                    <p>Product Manager</p>
                </div>
                <div class="col-md-4 mb-4">
                    <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
                    <h5>John Smith</h5>
                    <p>Lead Developer</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h3>Klaar om uw praktijk te transformeren?</h3>
            <p>Neem vandaag nog contact met ons op en ontdek hoe SmilePro u kan helpen!</p>
            <a href="{{ url('/contact') }}" class="btn btn-light btn-lg">Contacteer ons</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light text-center py-4">
        <p>© 2024 SmilePro. Alle rechten voorbehouden.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
