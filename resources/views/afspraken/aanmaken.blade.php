<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afspraken Kalender</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>

<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Afspraken Kalender</h1>
        <div id="calendar"></div>
    </div>

    <!-- Modal -->
    <div id="afspraakModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-1/3 p-6 rounded shadow-lg">
            <h2 class="text-xl font-bold mb-4">Nieuwe Afspraak</h2>
            <form id="afspraakForm">
                <div class="mb-4">
                    <label for="datum" class="block text-sm font-medium">Datum</label>
                    <input type="text" id="datum" name="datum" class="w-full border-gray-300 rounded mt-1 p-2" readonly>
                </div>
                <div class="mb-4">
                    <label for="tijd" class="block text-sm font-medium">Tijd</label>
                    <input type="time" id="tijd" name="tijd" class="w-full border-gray-300 rounded mt-1 p-2" required>
                </div>
                <div class="mb-4">
                    <label for="notities" class="block text-sm font-medium">Notities</label>
                    <textarea id="notities" name="notities" class="w-full border-gray-300 rounded mt-1 p-2"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuleren</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Opslaan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var modal = document.getElementById('afspraakModal');
            var closeModalBtn = document.getElementById('closeModal');
            var afspraakForm = document.getElementById('afspraakForm');
            var datumInput = document.getElementById('datum');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'nl',
                selectable: true,
                validRange: {
                    start: '2024-12-01', // Startdatum, je kunt dit aanpassen naar de huidige maand
                    end: '2024-12-31'  // Einddatum
                },
                businessHours: {
                    // Werkuren: 08:00 - 17:00 van maandag tot vrijdag
                    daysOfWeek: [1, 2, 3, 4, 5], // Maandag t/m vrijdag
                    startTime: '08:00',
                    endTime: '17:00'
                },
                weekends: false,  // Zorgt ervoor dat weekenddagen niet geselecteerd kunnen worden
                dateClick: function(info) {
                    // Vul de datum in en open het modal
                    datumInput.value = info.dateStr;
                    modal.classList.remove('hidden');
                },
                events: '{{ route('afspraken.index') }}'  // Zorg ervoor dat je deze route hebt gedefinieerd
            });

            calendar.render();

            // Modal sluiten
            closeModalBtn.addEventListener('click', function () {
                modal.classList.add('hidden');
            });

            // Formulier verzenden
            afspraakForm.addEventListener('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(afspraakForm);

                axios.post('{{ route('afspraken.store') }}', {
                    datum: formData.get('datum'),
                    tijd: formData.get('tijd'),
                    notities: formData.get('notities'),
                })
                .then(function (response) {
                    alert(response.data.message);
                    modal.classList.add('hidden'); // Sluit de modal
                    calendar.refetchEvents(); // Vernieuw de kalender
                })
                .catch(function (error) {
                    alert('Er is een fout opgetreden. Controleer je invoer.');
                });
            });
        });
    </script>
</body>
</html>
