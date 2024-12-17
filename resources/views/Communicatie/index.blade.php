<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailbox</title>
</head> 
<body>
    <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
    <div class="mailbox">
        <h1>Mailbox</h1>

        <!-- Nieuwe mail knop -->
        <button id="new-mail-btn" class="new-mail-btn">Nieuwe Mail</button>
        
        <!-- Wijzig mail knop -->
        <button id="edit-mail-btn" class="edit-mail-btn">Wijzig Mail</button>

        <p id="no-emails-message" style="display: none; text-align: center; color: gray;">
            Er zijn geen berichten beschikbaar in de inbox.
        </p>
        <div id="emails"></div>
    </div>

    <!-- Modal voor e-mail weergeven -->
    <div id="email-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">✖</span>
            <h2 id="modal-subject"></h2>
            <p id="modal-body"></p>
            <p id="modal-date" style="color: gray; font-size: 14px;"></p>
        </div>
    </div>

    <!-- Modal voor nieuwe e-mail -->
    <div id="new-mail-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" onclick="closeNewMailModal()">✖</span>
            <h2>Nieuwe Mail</h2>
            <form id="new-mail-form" method="POST" action="{{ route('emails.store') }}">
                @csrf
                <label for="to">Naar:</label><br>
                <input type="email" id="to" name="to" required style="width: 100%; margin-bottom: 10px;"><br>
                
                <label for="subject">Onderwerp:</label><br>
                <input type="text" id="subject" name="subject" required style="width: 100%; margin-bottom: 10px;"><br>
                
                <label for="body">Bericht:</label><br>
                <textarea id="body" name="body" rows="5" required style="width: 100%; margin-bottom: 10px;"></textarea><br>
                
                <button type="button" id="send-mail-btn" class="send-mail-btn">Verzend</button>
            </form>
        </div>
    </div>

    <!-- Popup voor wijzigen van e-mail -->
    <div id="edit-mail-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" onclick="closeEditMailModal()">✖</span>
            <h2>Selecteer E-mail om te Wijzigen</h2>
            <div id="email-list"></div>
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: white;
        }

        .mailbox {
            width: 50%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email {
            border: 2px solid black;
            margin: 10px 0;
            padding: 10px;
            cursor: pointer;
        }

        .email h2 {
            margin: 0;
            font-size: 18px;
        }

        .email .email-date {
            font-size: 14px;
            color: gray;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            position: relative;
            max-height: 80%;
            overflow-y: auto;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: red;
            cursor: pointer;
        }

        .new-mail-btn, .edit-mail-btn {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .new-mail-btn:hover, .edit-mail-btn:hover {
            background-color: darkgreen;
        }

        .send-mail-btn {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .send-mail-btn:hover {
            background-color: darkgreen;
        }

        .email-list-btn {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .email-list-btn:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        const container = document.getElementById('emails');
        const noEmailsMessage = document.getElementById('no-emails-message');
        const emailListContainer = document.getElementById('email-list');
        let selectedEmail = null;

        // Functie voor ophalen van inkomende e-mails
        function fetchEmails() {
            fetch('/emails') // API-endpoint voor inkomende e-mails
                .then(response => response.json())
                .then(data => {
                    container.innerHTML = '';
                    emailListContainer.innerHTML = ''; // Clear the email list when new data is fetched

                    if (data.length === 0) {
                        noEmailsMessage.style.display = 'block';
                    } else {
                        noEmailsMessage.style.display = 'none';
                        data.forEach(email => {
                            // Voeg de e-mail toe aan de inbox
                            const emailDiv = document.createElement('div');
                            emailDiv.className = 'email';
                            emailDiv.innerHTML = `
                                <h2>${email.subject}</h2>
                                <p class="email-date">Ontvangen op: ${new Date(email.created_at).toLocaleString()}</p>
                            `;
                            emailDiv.addEventListener('click', function () {
                                openModal(email);
                            });
                            container.appendChild(emailDiv);

                            // Voeg de e-mail toe aan de lijst in de wijzig-popup
                            const emailListItem = document.createElement('div');
                            emailListItem.className = 'email-list-item';
                            emailListItem.innerHTML = `
                                <span>${email.subject}</span>
                                <button class="email-list-btn" onclick="editEmail(${email.id})">Wijzig</button>
                            `;
                            emailListContainer.appendChild(emailListItem);
                        });
                    }
                })
                .catch(error => {
                    console.error('Fout bij het ophalen van e-mails:', error);
                });
        }

        // Open de wijzig popup voor geselecteerde e-mail
        function openModal(email) {
            const modal = document.getElementById('email-modal');
            const modalSubject = document.getElementById('modal-subject');
            const modalBody = document.getElementById('modal-body');
            const modalDate = document.getElementById('modal-date');

            modalSubject.textContent = email.subject;
            modalBody.textContent = email.body;
            modalDate.textContent = `Ontvangen op: ${new Date(email.created_at).toLocaleString()}`;
            modal.style.display = 'flex';
        }

        // Sluit modal
        function closeModal() {
            document.getElementById('email-modal').style.display = 'none';
        }

        // Open nieuwe mail modal
        document.getElementById('new-mail-btn').addEventListener('click', () => {
            document.getElementById('new-mail-modal').style.display = 'flex';
        });

        // Sluit nieuwe mail modal
        function closeNewMailModal() {
            document.getElementById('new-mail-modal').style.display = 'none';
        }

        // Open wijzig mail popup
        document.getElementById('edit-mail-btn').addEventListener('click', () => {
            document.getElementById('edit-mail-modal').style.display = 'flex';
        });

        // Sluit wijzig mail modal
        function closeEditMailModal() {
            document.getElementById('edit-mail-modal').style.display = 'none';
        }

        // Selecteer de e-mail om te bewerken
        function editEmail(emailId) {
            fetch(`/emails/${emailId}`)
                .then(response => response.json())
                .then(data => {
                    selectedEmail = data;  // Markeer geselecteerde e-mail
                    document.getElementById('subject').value = selectedEmail.subject;
                    document.getElementById('body').value = selectedEmail.body;
                    document.getElementById('edit-mail-modal').style.display = 'none'; // Sluit de lijst popup
                    document.getElementById('new-mail-modal').style.display = 'flex';  // Open de nieuwe mail modal met de gegevens
                })
                .catch(error => {
                    console.error('Fout bij het ophalen van e-mail:', error);
                });
        }

        // Verzenden van de nieuwe e-mail
        document.getElementById('send-mail-btn').addEventListener('click', function (event) {
            event.preventDefault();  // Voorkom dat het formulier direct verzonden wordt

            const form = document.getElementById('new-mail-form');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("E-mail succesvol verzonden!");
                    closeNewMailModal();  // Sluit het modal venster
                    fetchEmails();  // Haal de e-mails opnieuw op
                } else {
                    alert("Er is een fout opgetreden bij het verzenden.");
                }
            })
            .catch(error => {
                console.error('Fout bij het verzenden van e-mail:', error);
            });
        });

        // Laad inkomende e-mails bij het laden van de pagina
        window.onload = fetchEmails;
    </script>
</body>
</html>
