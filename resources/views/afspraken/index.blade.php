<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afspraken Beheer</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet">
</head>
<body>
    <h1>Afspraken Beheer</h1>
    <div id="calendar"></div>

    <h2>Nieuwe Afspraak</h2>
    <form id="afspraakForm">
        <label for="titel">Titel:</label>
        <input type="text" id="titel" name="titel" required><br>
        <label for="datum">Datum:</label>
        <input type="date" id="datum" name="datum" required><br>
        <label for="tijd">Tijd:</label>
        <input type="time" id="tijd" name="tijd" required><br>
        <button type="submit">Afspraak Toevoegen</button>
    </form>

    <script>
        // Initieer de kalender
        document.addEventListener('DOMContentLoaded', function() {
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridMonth',
                events: '/api/afspraken',  // Haal de afspraken op vanuit de API
                dateClick: function(info) {
                    alert('Datum geklikt: ' + info.dateStr);
                }
            });
            calendar.render();
        });

        // Verwerk formulier om een nieuwe afspraak toe te voegen
        document.getElementById('afspraakForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let titel = document.getElementById('titel').value;
            let datum = document.getElementById('datum').value;
            let tijd = document.getElementById('tijd').value;

            fetch('/api/afspraken', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ titel, datum, tijd })
            }).then(response => response.json())
              .then(data => {
                  alert('Afspraak toegevoegd!');
                  window.location.reload();  // Herlaad de pagina om de kalender bij te werken
              })
              .catch(error => console.error('Er is een fout opgetreden:', error));
        });
    </script>
</body>
</html>
