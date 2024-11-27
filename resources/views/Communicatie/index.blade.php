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
        <p id="no-emails-message" style="display: none; text-align: center; color: gray;">
            Er zijn geen berichten beschikbaar in de inbox.
        </p>
        <div id="emails"></div>
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
            position: relative;
        }

        .email h2 {
            margin: 0;
            font-size: 18px;
        }

        .email p {
            margin: 10px 0 0;
            color: #666;
            display: none;
        }

        .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 16px;
            color: red;
            cursor: pointer;
            display: none;
        }

        .email.open p,
        .email.open .close-btn {
            display: block;
        }
    </style>

    <script>
        // Fetch e-mails via API
        fetch('/emails')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('emails');
                const noEmailsMessage = document.getElementById('no-emails-message');

                if (data.length === 0) {
                    // Laat de melding zien als er geen berichten zijn
                    noEmailsMessage.style.display = 'block';
                } else {
                    // Verwerk en toon de e-mails als ze bestaan
                    data.forEach(email => {
                        // Maak de e-maildiv
                        const emailDiv = document.createElement('div');
                        emailDiv.className = 'email';
                        emailDiv.innerHTML = `
                            <h2>${email.subject}</h2>
                            <span class="close-btn" onclick="closeEmail(event, this)">✖</span>
                            <p>${email.body}</p>
                        `;

                        // Voeg klik-functionaliteit toe om de e-mail te openen/sluiten
                        emailDiv.addEventListener('click', function () {
                            this.classList.toggle('open');
                        });

                        // Voeg de e-maildiv toe aan de container
                        container.appendChild(emailDiv);
                    });
                }
            })
            .catch(error => {
                console.error('Fout bij het ophalen van e-mails:', error);
            });

        // Sluit een e-mail
        function closeEmail(event, closeBtn) {
            event.stopPropagation(); // Zorgt dat de klik niet de e-mail opent/sluit
            const emailDiv = closeBtn.parentNode;
            emailDiv.classList.remove('open');
        }
    </script>
</body>
</html>
