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
    <style>
        .selected {
            background-color: #38a169; /* Groene achtergrond voor geselecteerde tijd */
            border-color: #2f855a; /* Donkergroene rand */
        }
    </style>
</head>
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
                    <!-- Tijdkeuze knoppen -->
                    <div id="tijdButtons" class="grid grid-cols-4 gap-2">
                        <!-- Dynamisch gegenereerde knoppen komen hier -->
                    </div>
                </div>
                <div class="mb-4">
                    <label for="berichten" class="block text-sm font-medium">Berichten</label>
                    <textarea id="berichten" name="berichten" class="w-full border-gray-300 rounded mt-1 p-2"></textarea>
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
    var tijdButtons = document.getElementById('tijdButtons');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'nl',
        selectable: true,
        validRange: {
            start: '2024-12-01',
            end: '2025-10-31'
        },
        businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5],
            startTime: '08:00',
            endTime: '17:00'
        },
        weekends: false,
        dateClick: function(info) {
            datumInput.value = info.dateStr;
            generateTijdButtons(info.dateStr);
            modal.classList.remove('hidden');
        },
        events: '{{ route('afspraken.index') }}'
    });

    calendar.render();

    function generateTijdButtons(date) {
        // Verwijder bestaande knoppen voordat we nieuwe genereren
        tijdButtons.innerHTML = '';

        // Starttijd: 08:00, eindtijd: 17:00, elk half uur
        var startTime = 8 * 60; // 8:00 in minuten
        var endTime = 17 * 60;  // 17:00 in minuten

        for (var time = startTime; time < endTime; time += 30) {
            var hours = Math.floor(time / 60);
            var minutes = time % 60;
            var timeString = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);

            var button = document.createElement('button');
            button.type = 'button';
            button.textContent = timeString;
            button.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-2', 'rounded');
            
            // Check beschikbaarheid van tijd
            if (!isTimeSlotAvailable(date, timeString)) {
                button.classList.remove('bg-blue-500'); // Verwijder blauwe achtergrond
                button.classList.add('bg-gray-500', 'text-gray-300'); // Voeg grijze achtergrond toe
                button.disabled = true; // Maak de knop niet klikbaar
            } else {
                // Voeg event listener toe voor het klikken op de knop
                button.onclick = function() {
                    // Verwijder de 'selected' klasse van alle knoppen
                    var allButtons = tijdButtons.querySelectorAll('button');
                    allButtons.forEach(function(b) {
                        b.classList.remove('selected');
                    });

                    // Voeg de 'selected' klasse toe aan de geklikte knop
                    this.classList.add('selected');
                    
                    // Zet de tijd in het formulier
                    document.getElementById('tijd').value = this.textContent;
                };
            }
            tijdButtons.appendChild(button);
        }
    }

    function isTimeSlotAvailable(date, timeString) {
        // Controleer of het tijdslot beschikbaar is (hier je eigen logica voor beschikbaarheid)
        // Retourneer true of false
        var availableSlots = []; // Voeg beschikbare tijden hier toe als array [ "08:00", "08:30", ... ]
        return availableSlots.includes(timeString);
    }

    closeModalBtn.addEventListener('click', function () {
        modal.classList.add('hidden');
    });

    afspraakForm.addEventListener('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(afspraakForm);

        axios.post('{{ route('afspraken.store') }}', {
            datum: formData.get('datum'),
            tijd: formData.get('tijd'),
            notities: formData.get('berichten'),
        })
        .then(function (response) {
            alert(response.data.message || 'De afspraak is succesvol aangemaakt.');
            modal.classList.add('hidden');
            calendar.refetchEvents();
        })
        .catch(function (error) {
            alert('Er is een fout opgetreden. Controleer je invoer.');
        });
    });
});

    </script>
</body>
</html>
