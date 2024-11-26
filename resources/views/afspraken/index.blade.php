<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afsprakenbeheer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a class="text-2xl font-bold text-gray-800" href="{{ url('/') }}">Laravel</a>
                <div class="flex items-center space-x-4">
                    <a class="text-gray-600 hover:text-blue-600" href="{{ route('patient.index') }}">Patiënten</a>
                    <a class="text-gray-600 hover:text-blue-600" href="{{ route('AccountOverzicht.index') }}">Account Overzicht</a>
                    <a class="text-gray-600 hover:text-blue-600" href="{{ route('praktijkmanager.medewerkers') }}">Medewerkers</a>
                    <a class="text-gray-600 hover:text-blue-600" href="{{ route('Communicatie.index') }}">Communicatie</a>
                    <a class="text-gray-600 hover:text-blue-600" href="{{ route('factuur.index') }}">Factuur</a>
                    <a class="text-gray-600 hover:text-blue-600" href="{{ url('/beschikbaarheid') }}">Beschikbaarheid</a>
                    <a class="text-gray-600 hover:text-blue-600" href="{{ url('/afspraken') }}">Afspraken</a>
                    <a class="text-gray-600 hover:text-blue-600" href="{{ url('/dashboard') }}">Dashboard</a>
                    <a class="text-gray-600 hover:text-blue-600" href="{{ route('profile.edit') }}">Profile</a>
                    <a class="text-gray-600 hover:text-blue-600" href="{{ route('login') }}">Login</a>
                    <a class="text-gray-600 hover:text-blue-600" href="{{ route('register') }}">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8" x-data="app()">
        <h1 class="text-2xl font-bold mb-4">Afsprakenbeheer</h1>
        <div x-init="initDate()" x-cloak>
            <!-- Kalender -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <span x-text="MONTH_NAMES[month]" class="text-lg font-bold"></span>
                        <span x-text="year" class="text-lg text-gray-600"></span>
                    </div>
                    <div>
                        <button @click="prevMonth()" :disabled="month == 0" class="text-gray-500 hover:text-blue-600">Vorige</button>
                        <button @click="nextMonth()" :disabled="month == 11" class="text-gray-500 hover:text-blue-600 ml-4">Volgende</button>
                    </div>
                </div>

                <!-- Dagen en datums -->
                <div class="grid grid-cols-7 gap-4">
                    <template x-for="day in DAYS">
                        <div class="text-center font-bold text-gray-600" x-text="day"></div>
                    </template>
                    <template x-for="blankday in blankdays">
                        <div></div>
                    </template>
                    <template x-for="date in no_of_days">
                        <div class="p-2 border rounded hover:bg-gray-100 cursor-pointer" @click="showEventModal(date)">
                            <span x-text="date" class="block text-center"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>

       <!-- Modal aangepast om tijdslots te tonen -->
<div x-show="openEventModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full" @click.away="closeEventModal()">
        <h2 class="text-xl font-bold mb-4">Afspraak maken</h2>
        <p class="text-gray-600 mb-4" x-text="event_date"></p>

        <!-- Dropdown voor tijdslots -->
        <select class="w-full p-2 border rounded" x-model="selectedTime">
            <template x-for="time in timeSlots">
                <option x-text="time"></option>
            </template>
        </select>

        <div x-show="errorMessage" class="text-red-500 mt-4" x-text="errorMessage"></div>
        <button @click="saveAppointment()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Opslaan</button>
        <button @click="closeEventModal()" class="mt-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 w-full">Sluiten</button>
    </div>
</div>


<script>
    const MONTH_NAMES = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];
    const DAYS = ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'];

    function app() {
    return {
        month: new Date().getMonth(),
        year: new Date().getFullYear(),
        no_of_days: [],
        blankdays: [],
        openEventModal: false,
        event_date: '',
        errorMessage: '',
        timeSlots: [],
        selectedTime: '',
        existingAppointments: [], // Array om bestaande afspraken te simuleren

        initDate() {
            this.getNoOfDays();
        },

        prevMonth() {
            if (this.month > 0) {
                this.month--;
                this.getNoOfDays();
            }
        },

        nextMonth() {
            if (this.month < 11) {
                this.month++;
                this.getNoOfDays();
            }
        },

        getNoOfDays() {
            let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
            let dayOfWeek = new Date(this.year, this.month).getDay();
            this.blankdays = Array.from({ length: dayOfWeek }, (_, i) => i + 1);
            this.no_of_days = Array.from({ length: daysInMonth }, (_, i) => i + 1);
        },

        generateTimeSlots() {
            this.timeSlots = [];
            let startHour = 8; // Starttijd (08:00)
            let endHour = 17; // Eindtijd (17:00)
            for (let hour = startHour; hour < endHour; hour++) {
                this.timeSlots.push(`${hour}:00`);
                this.timeSlots.push(`${hour}:30`);
            }
        },

        showEventModal(date) {
            this.event_date = `${this.year}-${this.month + 1}-${date}`;
            this.generateTimeSlots();
            this.openEventModal = true;
        },

        closeEventModal() {
            this.openEventModal = false;
            this.errorMessage = '';
        },

        saveAppointment() {
            if (!this.selectedTime) {
                this.errorMessage = 'Selecteer een tijdstip.';
                return;
            }
            alert(`Afspraak gepland op ${this.event_date} om ${this.selectedTime}`);
            this.closeEventModal();
        }
    };
}

</script>
</body>
</html>
    