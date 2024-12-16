<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beschikbaarheid</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
    
    <div class="container mx-auto mt-8" x-data="calendarApp()">
        <h1 class="text-2xl font-bold mb-4">Beschikbaarheid</h1>
        
        <div x-init="initCalendar()" x-cloak>
            <div class="bg-white rounded-lg shadow">
                <!-- Month Navigation -->
                <div class="flex items-center justify-between py-2 px-6">
                    <div>
                        <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                        <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                    </div>
                    <div class="flex items-center">
                        <button 
                            class="p-1 rounded-lg hover:bg-gray-200"
                            :disabled="month === 0"
                            @click="changeMonth(-1)">
                            <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button 
                            class="p-1 rounded-lg hover:bg-gray-200"
                            :disabled="month === 11"
                            @click="changeMonth(1)">
                            <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Days of the Week -->
                <div class="grid grid-cols-7 text-center py-2">
                    <template x-for="(day, index) in DAYS" :key="index">
                        <div x-text="day" class="font-medium text-gray-700"></div>
                    </template>
                </div>

                <!-- Calendar Days -->
                <div class="grid grid-cols-7 border-t">
                    <template x-for="blank in blankdays">
                        <div class="h-32"></div>
                    </template>
                    <template x-for="(date, index) in no_of_days" :key="index">
                        <div class="h-32 border-r border-b relative">
                            <div class="absolute top-2 left-2" x-text="date"></div>
                        
                            <!-- Edit Button (show only if there's event data) -->
                            <button 
                                @click="showEditModal(date)" 
                                x-show="hasData(date)" 
                                class="absolute right-2 top-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-md">
                                Edit
                            </button>
                        
                            <!-- Main Yellow Button (show only if there's event data) -->
                            <button 
                                @click="showEventModal(date)" 
                                x-show="hasData(date)" 
                                class="absolute bottom-0 left-0 w-full h-8 flex items-center justify-center rounded-md"
                                :class="hasData(date) ? 'bg-yellow-500' : ''">

                                <!-- Event Time Info -->
                                <span x-text="hasData(date) ? (event = events.find(event => event.DatumVanaf === convertToISODate(new Date(year, month, date)))) ? event.TijdVanaf + ' - ' + event.TijdTotMet : '' : ''">
                                </span>
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div 
    x-show="openEventModal" 
    x-ref="eventModal"
    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
    @click.away="closeEventModal()">
    <div class="bg-white rounded-lg shadow-lg w-3/4 md:w-1/2 p-6 transform transition-all duration-300 ease-in-out">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Beschikbaarheid Details</h2>
            <button @click="closeEventModal()" class="text-gray-700 text-2xl hover:text-gray-500 transition">&times;</button>
        </div>
        <p class="text-gray-600 mb-4">Datum: <span x-text="event_date"></span></p>
        
        <template x-if="eventsForSelectedDate.length > 0">
            <table class="w-full border">
                <thead>
                    <tr>
                        <th class="border px-2 py-1 bg-gray-100">Medewerker Naam</th>
                        <th class="border px-2 py-1 bg-gray-100">Status</th>
                        <th class="border px-2 py-1 bg-gray-100">Tijd Vanaf</th>
                        <th class="border px-2 py-1 bg-gray-100">Tijd Tot Met</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="event in eventsForSelectedDate" :key="event.id">
                        <tr>
                            <td class="border px-2 py-1" x-text="event.MedewerkerNaam"></td>
                            <td class="border px-2 py-1" x-text="event.Status"></td>
                            <td class="border px-2 py-1" x-text="event.TijdVanaf"></td>
                            <td class="border px-2 py-1" x-text="event.TijdTotMet"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </template>
        

        <template x-if="eventsForSelectedDate.length === 0">
            <p class="text-red-600">Geen beschikbaarheid voor deze datum.</p>
        </template> 

        <button type="button" class="bg-white hover:bg-red-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="closeEventModal()">
            Sluiten
        </button> 
        
    </div>
</div>


    <div 
    x-show="openEditModal" 
    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
    @keydown.escape.window="closeEditModal()"
    aria-labelledby="editModalTitle"
    role="dialog"
    aria-modal="true"
    tabindex="0"
>
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 p-6 relative">
        <!-- Close Button -->
        <button 
            @click="closeEditModal()" 
            class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 transition"
            aria-label="Sluit modal"
        >
            &times;
        </button>
    
        <!-- Modal Header -->
        <h2 id="editModalTitle" class="text-2xl font-bold mb-4">Bewerk Beschikbaarheid</h2>
        <p class="text-gray-600 mb-4">Datum: <span x-text="event_date"></span></p>
      <!-- Time From -->
<div class="mb-4">
    <label for="TimeFrom" class="block text-gray-700">Tijd Vanaf:</label>
    <input 
        type="time" 
        id="TimeFrom" 
        x-model="editTimeFrom" 
        class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
        min="06:00"    
        max="17:00"   
        step="1800"    
        aria-describedby="timeFromError"
    >
    <p id="timeFromError" class="text-red-500 text-sm mt-1" x-show="!validateTimeFrom()">Voer een geldige begintijd in.</p>
</div>

<!-- Time To -->
<div class="mb-4">
    <label for="TimeTo" class="block text-gray-700">Tijd Tot Met:</label>
    <input 
        type="time" 
        id="TimeTo" 
        x-model="editTimeTo" 
        class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
        min="06:00"  
        max="17:00"   
        step="1800"   
        aria-describedby="timeToError"
    >
    <p id="timeToError" class="text-red-500 text-sm mt-1" x-show="!validateTimeTo()">Voer een geldige eindtijd in.</p>
</div>
    
        <!-- Status -->
        <div class="mb-4">
            <label for="Status" class="block text-gray-700">Status:</label>
            <select 
                id="Status" 
                x-model="editStatus" 
                class="w-full p-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                aria-describedby="statusError"
            >
                <option value="" disabled>Selecteer een status</option>
                <option value="Aanwezig">Aanwezig</option>
                <option value="Afwezig">Afwezig</option>
                <option value="Verlof">Verlof</option>
                <option value="Ziek">Ziek</option>
            </select>
            <p id="statusError" class="text-red-500 text-sm mt-1" x-show="!validateStatus()">Selecteer een geldige status.</p>
        </div>
    
        <!-- Modal Actions -->
        <div class="flex justify-end space-x-2">
            <button 
                @click="closeEditModal()" 
                class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600 transition focus:outline-none focus:ring focus:ring-gray-300"
            >
                Annuleren
            </button>
            <button 
                @click="saveTime()" 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-400 transition focus:outline-none focus:ring focus:ring-blue-300"
                :disabled="!validateForm()"
            >
                Opslaan
            </button>
        </div>
    </div>  
</div>


    


    <script>
        const MONTH_NAMES = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];
        const DAYS = ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'];
    
    function calendarApp() {
        return {
            month: 0,
            year: 0,
            no_of_days: [],
            blankdays: [],
            events: [],
            eventsForSelectedDate: [],
            event_date: '',
            openEventModal: false,
            noAvailabilityMessage: 'Er zijn momenteel geen beschikbaarheden mogelijk op deze datum',
            timeZone: 'Europe/Amsterdam',
            openEditModal: false,
            editTimeFrom: '',
            editTimeTo: '',
            editStatus: '',
            selectedEditDate: '',
            editMedewerkerId: '',

            validateTimeFrom() {
                return this.editTimeFrom.match(/^([01]?[0-9]|2[0-3]):([0-5][0-9])$/);
            },
            validateTimeTo() {
                return this.editTimeTo.match(/^([01]?[0-9]|2[0-3]):([0-5][0-9])$/);
            },
            validateStatus() {
                return ['Aanwezig', 'Afwezig', 'Verlof', 'Ziek'].includes(this.editStatus);
            },
            validateForm() {
                return this.validateTimeFrom() && this.validateTimeTo() && this.validateStatus();
            },

            showEditModal(date) {
                this.event_date = new Date(this.year, this.month, date).toDateString();
                this.selectedEditDate = this.convertToISODate(new Date(this.year, this.month, date));
                const event = this.events.find(e => e.DatumVanaf === this.selectedEditDate);
                if (event) {
                    this.editTimeFrom = event.TijdVanaf;
                    this.editTimeTo = event.TijdTotMet;
                    this.editStatus = event.Status;
                    this.editMedewerkerId = event.MedewerkerId;
                } else {
                    this.editTimeFrom = '';
                    this.editTimeTo = '';
                    this.editStatus = '';
                    this.editMedewerkerId = '';
                }

                this.openEditModal = true;
            },

            closeEditModal() {
                this.openEditModal = false;
            },

            showEventModal(date) {
                this.event_date = new Date(this.year, this.month, date).toDateString();
                const formattedDate = this.convertToISODate(new Date(this.year, this.month, date));
                
                this.eventsForSelectedDate = this.events.filter(event => {
                    const startDate = new Date(event.DatumVanaf);
                    const endDate = new Date(event.DatumTotMet);
                    const selectedDate = new Date(formattedDate);
                    return selectedDate >= startDate && selectedDate <= endDate;
                });

                if (!this.eventsForSelectedDate.length) {
                    this.noAvailabilityMessage = 'Er zijn momenteel geen beschikbaarheden mogelijk op deze datum';
                } else {
                    this.noAvailabilityMessage = '';
                }

                this.employeesForSelection = this.eventsForSelectedDate.map(event => ({
                    id: event.MedewerkerId,
                    name: event.MedewerkerNaam,
                }));

                this.openEventModal = true;
                this.$refs.eventModal.focus();
            },

            closeEventModal() {
                this.openEventModal = false;
            },

            saveTime() {
                if (!this.validateForm()) {
                    alert('Please ensure all fields are correctly filled.');
                    return;
                }

                const eventIndex = this.events.findIndex(e => e.DatumVanaf === this.selectedEditDate);

                const eventData = {
                    MedewerkerId: this.editMedewerkerId,
                    DatumVanaf: this.selectedEditDate,
                    DatumTotMet: this.selectedEditDate,
                    TijdVanaf: this.editTimeFrom,
                    TijdTotMet: this.editTimeTo,
                    Status: this.editStatus,
                    Opmerking: this.editRemark || ''
                };

                console.log('Events:', this.events);
                console.log('Selected Edit Date:', this.selectedEditDate);
                console.log('Event Data:', eventData);

                axios.post('/save-beschikbaarheid', eventData, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (response.data.success) {
                        if (eventIndex !== -1) {
                            this.events[eventIndex] = response.data.data;
                        } else {
                            this.events.push(response.data.data);
                        }
                        this.closeEditModal();
                        alert('Beschikbaarheid succesvol opgeslagen.');
                    } else {
                        alert('Er is een fout opgetreden bij het opslaan van de beschikbaarheid.');
                    }
                })
                .catch(error => {
                    if (error.response && error.response.data && error.response.data.message) {
                        console.error('Validation error:', error.response.data.message);
                        alert('Fout: ' + error.response.data.message);
                    } else {
                        console.error('Unknown error:', error);
                        alert('Er is een onbekende fout opgetreden.');
                    }
                });
            },

            initCalendar() {
                const today = new Date();
                this.month = today.getMonth();
                this.year = today.getFullYear();
                this.fetchEvents(this.month + 1, this.year);
                this.getNoOfDays();
            },

            fetchEvents(month, year) {
                fetch('/get-beschikbaarheden-by-month', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ month, year })
                })
                .then(res => res.json())
                .then(data => {
                    this.events = data.map(event => ({
                        ...event,
                        DatumVanaf: this.convertToISODate(new Date(event.DatumVanaf)),
                        DatumTotMet: this.convertToISODate(new Date(event.DatumTotMet)),
                    }));
                });
            },

            getNoOfDays() {
                const daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                const firstDay = new Date(this.year, this.month, 1).getDay();
                this.blankdays = Array.from({ length: firstDay });
                this.no_of_days = Array.from({ length: daysInMonth }, (_, i) => i + 1);
            },

            changeMonth(step) {
                this.month += step;
                if (this.month < 0) {
                    this.month = 11;
                    this.year -= 1;
                }
                if (this.month > 11) {
                    this.month = 0;
                    this.year += 1;
                }
                this.getNoOfDays();
                this.fetchEvents(this.month + 1, this.year);
            },

            hasData(date) {
                const formattedDate = this.convertToISODate(new Date(this.year, this.month, date));
                return this.events.some(event => event.DatumVanaf === formattedDate);
            },

            convertToISODate(date) {
                if (!(date instanceof Date) || isNaN(date)) {
                    console.error('Invalid date passed to convertToISODate:', date);
                    return null;
                }
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }
        };
    }
</script>
</body>
</html>