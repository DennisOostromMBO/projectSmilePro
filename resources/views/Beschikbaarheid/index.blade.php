<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beschikbaarheid</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Gebruik Alpine.js versie 3 -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container mx-auto mt-8" x-data="app()">
        <h1 class="text-2xl font-bold mb-4">Beschikbaarheid</h1>
        <div x-init="[initDate(), getNoOfDays()]" x-cloak>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="flex items-center justify-between py-2 px-6">
                    <div>
                        <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                        <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                    </div>
                    <div class="border rounded-lg px-1" style="padding-top: 2px;">
                        <button 
                            type="button"
                            class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center" 
                            :class="{'cursor-not-allowed opacity-25': month == 0 }"
                            :disabled="month == 0 ? true : false"
                            @click="month--; getNoOfDays()">
                            <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>  
                        </button>
                        <div class="border-r inline-flex h-6"></div>        
                        <button 
                            type="button"
                            class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1" 
                            :class="{'cursor-not-allowed opacity-25': month == 11 }"
                            :disabled="month == 11 ? true : false"
                            @click="month++; getNoOfDays()">
                            <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>                                      
                        </button>
                    </div>
                </div>    

                <div class="-mx-1 -mb-1">
                    <div class="flex flex-wrap" style="margin-bottom: -40px;">
                        <template x-for="(day, index) in DAYS" :key="index">    
                            <div style="width: 14.26%" class="px-2 py-2">
                                <div
                                    x-text="day" 
                                    class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
                            </div>
                        </template>
                    </div>

                    <div class="flex flex-wrap border-t border-l">
                        <template x-for="blankday in blankdays">
                            <div 
                                style="width: 14.28%; height: 120px"
                                class="text-center border-r border-b px-4 pt-2"    
                            ></div>
                        </template>    
                        <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">    
                            <div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative">
                                <div
                                    @click="showEventModal(date)"
                                    x-text="date"
                                    class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                                    :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"    
                                ></div>
                                <div style="height: 80px;" class="overflow-y-auto mt-1">
                                    <template x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )">    
                                        <div
                                            class="px-2 py-1 rounded-lg mt-1 overflow-hidden border"
                                            :class="{
                                                'border-blue-200 text-blue-800 bg-blue-100': event.event_theme === 'blue',
                                                'border-red-200 text-red-800 bg-red-100': event.event_theme === 'red',
                                                'border-yellow-200 text-yellow-800 bg-yellow-100': event.event_theme === 'yellow',
                                                'border-green-200 text-green-800 bg-green-100': event.event_theme === 'green',
                                                'border-purple-200 text-purple-800 bg-purple-100': event.event_theme === 'purple'
                                            }"
                                        >
                                            <p x-text="event.event_title" class="text-sm truncate leading-tight"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div style="background-color: rgba(0, 0, 0, 0.8)" 
             class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" 
             x-show="openEventModal" 
             @click.away="closeEventModal()">
            <div class="p-4 max-w-xl mx-auto relative mt-24" @click.stop>
                <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
                    @click="closeEventModal()">
                    <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
                    </svg>
                </div>

                <div class="shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8">
                    <h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Beschikbaarheid Details</h2>
                 
                    <div class="mb-4">
                        <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Datum</label>
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_date" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Beschikbaarheden</label>
                        <ul class="list-disc pl-5">
                            <template x-for="event in eventsForSelectedDate" :key="event.medewerker_id">
                                <li class="text-gray-700 mb-1">
                                    <strong>Medewerker ID:</strong> <span x-text="event.medewerker_id"></span><br>
                                    <strong>Datum Vanaf:</strong> <span x-text="event.datum_vanaf"></span><br>
                                    <strong>Datum Tot Met:</strong> <span x-text="event.datum_tot_met"></span><br>
                                    <strong>Tijd Vanaf:</strong> <span x-text="event.tijd_vanaf"></span><br>
                                    <strong>Tijd Tot Met:</strong> <span x-text="event.tijd_tot_met"></span><br>
                                    <strong>Status:</strong> <span x-text="event.status"></span><br>
                                    <strong>Is Actief:</strong> <span x-text="event.is_actief"></span><br>
                                    <strong>Opmerking:</strong> <span x-text="event.opmerking"></span>
                                </li>
                            </template>
                        </ul>
                    </div>

                    <div class="mt-8 text-right">
                        <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="closeEventModal()">
                            Sluiten
                        </button>    
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal -->
    </div>

    <script>
        const MONTH_NAMES = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'October', 'November', 'December'];
        const DAYS = ['Zo', 'Ma', 'Di', 'Wo', 'DO', 'Fr', 'Za'];

        function app() {
            return {
                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                days: DAYS,
                events: [],
                eventsForSelectedDate: [],
                event_date: '',
                event_theme: 'blue',

                openEventModal: false,

                initDate() {
                    let today = new Date();
                    this.month = today.getMonth();
                    this.year = today.getFullYear();
                    this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                },

                isToday(date) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, date);

                    return today.toDateString() === d.toDateString() ? true : false;
                },

                showEventModal(date) {
                    // open the modal
                    this.openEventModal = true;
                    this.event_date = new Date(this.year, this.month, date).toDateString();
                    console.log("Selected date:", this.event_date); // Debugging
                    const formattedDate = new Date(this.year, this.month, date).toISOString().split('T')[0];
                    this.loadBeschikbaarheden(formattedDate);
                },

                closeEventModal() {
                    this.openEventModal = false;
                },

                addEvent() {
                    if (this.event_title == '') {
                        return;
                    }

                    this.events.push({
                        event_date: this.event_date,
                        event_title: this.event_title,
                        event_theme: this.event_theme
                    });

                    console.log(this.events);

                    // clear the form data
                    this.event_title = '';
                    this.event_date = '';
                    this.event_theme = 'blue';

                    //close the modal
                    this.closeEventModal();
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay();
                    let blankdaysArray = [];
                    for ( var i=1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }

                    let daysArray = [];
                    for ( var i=1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }
                    
                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                },

                loadBeschikbaarheden(date) {
                    this.eventsForSelectedDate = [];
                    console.log("Loading beschikbaarheden for date:", date); // Debugging
                    fetch('/get-beschikbaarheden ', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ date: date })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Received data:", data); // Debugging
                        this.eventsForSelectedDate = data.map(beschikbaarheid => ({
                            medewerker_id: beschikbaarheid.medewerker_id,
                            datum_vanaf: beschikbaarheid.datum_vanaf,
                            datum_tot_met: beschikbaarheid.datum_tot_met,
                            tijd_vanaf: beschikbaarheid.tijd_vanaf,
                            tijd_tot_met: beschikbaarheid.tijd_tot_met,
                            status: beschikbaarheid.status,
                            is_actief: beschikbaarheid.is_actief,
                            opmerking: beschikbaarheid.opmerking
                        }));
                        console.log("Processed eventsForSelectedDate:", this.eventsForSelectedDate); // Debugging
                    })
                    .catch(error => {
                        console.error("Error loading beschikbaarheden:", error); // Debugging
                    });
                }
            }
        }
    </script>
</body>
</html>