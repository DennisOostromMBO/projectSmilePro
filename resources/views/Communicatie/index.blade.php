<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mailbox</title>
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
            position: relative;
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

        .new-mail-btn {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .new-mail-btn:hover {
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

        .edit-mail-btn {
            background: none;
            color: inherit;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            text-decoration: underline;
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .delete-mail-btn {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            text-decoration: underline;
            position: absolute;
            right: 10px;
            bottom: 10px;
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

        /* Error Popup Styles */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }

        .popup-btn {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
        }

        .popup-btn:hover {
            background-color: darkred;
        }

        /* Modaal voor nieuwe e-mail */
        .new-email-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .new-email-content {
            background: white;
            padding: 20px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            position: relative;
        }

        .new-close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: red;
            cursor: pointer;
        }

        .send-email-btn {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
    <div class="mailbox">
        <h1>Mailbox</h1>

        <button id="new-mail-btn" class="new-mail-btn">Nieuwe Mail</button>

        <p id="no-emails-message" style="display: none; text-align: center; color: gray;">
            Er zijn geen berichten beschikbaar in de inbox.
        </p>
        <div id="emails"></div>
    </div>

    <!-- Modaal voor nieuwe e-mail -->
    <div id="new-email-modal" class="new-email-modal">
        <div class="new-email-content">
            <span class="new-close-btn" onclick="closeNewEmailModal()">✖</span>
            <h2>Nieuwe E-mail</h2>
            <form id="new-email-form">
                <label for="to">Naar:</label><br>
                <input type="email" id="to" name="to" required style="width: 100%; margin-bottom: 10px;"><br>
                
                <label for="subject">Onderwerp:</label><br>
                <input type="text" id="subject" name="subject" required style="width: 100%; margin-bottom: 10px;"><br>
                
                <label for="body">Bericht:</label><br>
                <textarea id="body" name="body" rows="5" required style="width: 100%; margin-bottom: 10px;"></textarea><br>
                
                <button type="button" id="send-email-btn" class="send-email-btn">Verzend</button>
            </form>
        </div>
    </div>

    <!-- Confirm Delete Popup -->
    <div id="confirm-delete-popup" class="popup-overlay">
        <div class="popup-content">
            <h3>Weet je zeker dat je deze e-mail wilt verwijderen?</h3>
            <button id="confirm-delete-btn" class="popup-btn">Ja, Verwijderen</button>
            <button id="cancel-delete-btn" class="popup-btn">Annuleren</button>
        </div>
    </div>

    <!-- Modaal voor het wijzigen van een e-mail -->
    <div id="edit-email-modal" class="new-email-modal">
        <div class="new-email-content">
            <span class="new-close-btn" onclick="closeEditEmailModal()">✖</span>
            <h2>Wijzig E-mail</h2>
            <form id="edit-email-form">
                <label for="edit-to">Naar:</label><br>
                <input type="email" id="edit-to" name="to" required style="width: 100%; margin-bottom: 10px;"><br>
                
                <label for="edit-subject">Onderwerp:</label><br>
                <input type="text" id="edit-subject" name="subject" required style="width: 100%; margin-bottom: 10px;"><br>
                
                <label for="edit-body">Bericht:</label><br>
                <textarea id="edit-body" name="body" rows="5" required style="width: 100%; margin-bottom: 10px;"></textarea><br>
                
                <button type="button" id="save-edit-email-btn" class="send-email-btn">Opslaan</button>
            </form>
        </div>
    </div>

    <script>
    const container = document.getElementById('emails');
    const noEmailsMessage = document.getElementById('no-emails-message');
    const confirmDeletePopup = document.getElementById('confirm-delete-popup');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
    const newEmailModal = document.getElementById('new-email-modal');
    const editEmailModal = document.getElementById('edit-email-modal');
    let selectedEmailId = null; // ID van de geselecteerde e-mail

    // Functie om de e-mails op te halen
    function fetchEmails() {
        fetch('/emails')
            .then(response => response.json())
            .then(data => {
                container.innerHTML = '';
                if (data.length === 0) {
                    noEmailsMessage.style.display = 'block';
                } else {
                    noEmailsMessage.style.display = 'none';
                    data.forEach(email => {
                        const emailDiv = document.createElement('div');
                        emailDiv.className = 'email';
                        emailDiv.innerHTML = `
                            <h2>${email.subject}</h2>
                            <p class="email-date">Ontvangen op: ${new Date(email.created_at).toLocaleString()}</p>
                            <button class="edit-mail-btn" onclick="editEmail(${email.id})">Wijzig Mail</button>
                            <button class="delete-mail-btn" onclick="confirmDeleteEmail(event, ${email.id})">Verwijder</button>
                        `;
                        container.appendChild(emailDiv);
                    });
                }
            })
            .catch(error => {
                showErrorPopup('Fout bij het ophalen van e-mails. Probeer het opnieuw.');
                console.error('Fout bij het ophalen van e-mails:', error);
            });
    }

    // Functie om een e-mail te bewerken
    function editEmail(emailId) {
        fetch(`/emails/${emailId}`)
            .then(response => response.json())
            .then(email => {
                document.getElementById('edit-to').value = email.to;
                document.getElementById('edit-subject').value = email.subject;
                document.getElementById('edit-body').value = email.body;
                selectedEmailId = emailId; // Stel het geselecteerde email ID in
                editEmailModal.style.display = 'flex';
            })
            .catch(error => {
                showErrorPopup('Fout bij het ophalen van e-mailgegevens om te bewerken.');
                console.error('Fout bij het ophalen van e-mailgegevens:', error);
            });
    }

    // Functie om het bewerkingsmodaal te sluiten
    function closeEditEmailModal() {
        editEmailModal.style.display = 'none';
    }

    // Functie om de e-mailwijzigingen op te slaan
    document.getElementById('save-edit-email-btn').addEventListener('click', function () {
        const to = document.getElementById('edit-to').value;
        const subject = document.getElementById('edit-subject').value;
        const body = document.getElementById('edit-body').value;

        if (!to || !subject || !body) {
            showErrorPopup('Vul alle velden in.');
            return;
        }

        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        formData.append('to', to);
        formData.append('subject', subject);
        formData.append('body', body);

        fetch(`/emails/${selectedEmailId}`, {
            method: 'PUT',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            fetchEmails(); // Vernieuw de lijst van e-mails
            closeEditEmailModal(); // Sluit het modaal
        })
        .catch(error => {
            showErrorPopup('Fout bij het opslaan van de gewijzigde e-mail.');
            console.error('Fout bij het opslaan van de gewijzigde e-mail:', error);
        });
    });

    // Functie om de foutmelding-popup te tonen
    function showErrorPopup(message) {
        const errorPopup = document.getElementById('error-popup');
        const errorMessage = document.getElementById('error-message');
        errorMessage.textContent = message;
        errorPopup.style.display = 'flex';
    }

    // Functie om de foutmelding-popup te sluiten
    function closeErrorPopup() {
        document.getElementById('error-popup').style.display = 'none';
    }

    // Functie om de bevestigingspopup voor verwijderen te tonen
    function confirmDeleteEmail(event, emailId) {
        event.stopPropagation(); // Voorkom dat de e-mail wordt geopend
        selectedEmailId = emailId; // Sla het geselecteerde email ID op
        confirmDeletePopup.style.display = 'flex'; // Toon de bevestigingspopup
    }

    // Functie voor het verwijderen van de geselecteerde e-mail
    function deleteEmail() {
        if (!selectedEmailId) return;
        
        fetch(`/emails/${selectedEmailId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            fetchEmails(); // Vernieuw de lijst van e-mails
            confirmDeletePopup.style.display = 'none'; // Sluit de bevestigingspopup
        })
        .catch(error => {
            showErrorPopup('Fout bij het verwijderen van de e-mail.');
            console.error('Fout bij het verwijderen van de e-mail:', error);
        });
    }

    confirmDeleteBtn.addEventListener('click', deleteEmail);
    cancelDeleteBtn.addEventListener('click', function () {
        confirmDeletePopup.style.display = 'none';
    });

    // Functie om het modaal voor nieuwe e-mail te openen
    document.getElementById('new-mail-btn').addEventListener('click', function () {
        newEmailModal.style.display = 'flex';
    });

    // Functie om het modaal voor nieuwe e-mail te sluiten
    function closeNewEmailModal() {
        newEmailModal.style.display = 'none';
    }

    // Functie om een nieuwe e-mail te verzenden
    document.getElementById('send-email-btn').addEventListener('click', function () {
        const to = document.getElementById('to').value;
        const subject = document.getElementById('subject').value;
        const body = document.getElementById('body').value;

        // Controleer of de velden niet leeg zijn
        if (!to || !subject || !body) {
            showErrorPopup('Vul alle velden in.');
            return;
        }

        const formData = new FormData();
        formData.append('to', to);
        formData.append('subject', subject);
        formData.append('body', body);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        fetch('/emails', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            fetchEmails(); // Vernieuw de lijst van e-mails
            closeNewEmailModal(); // Sluit het modaal
        })
        .catch(error => {
            showErrorPopup('Fout bij het verzenden van de e-mail.');
            console.error('Fout bij het verzenden van de e-mail:', error);
        });
    });

    // Initialiseren van de e-mail lijst
    fetchEmails();
    </script>
</body>
</html>
