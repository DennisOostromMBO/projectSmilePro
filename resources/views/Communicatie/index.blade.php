<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailbox</title>
</head>
<body>
    <div class="mailbox">
        <h1>Mailbox</h1>
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
}

    </style>
    <script>
        // Fetch e-mails via API
        fetch('/emails')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('emails');
                data.forEach(email => {
                    const emailDiv = document.createElement('div');
                    emailDiv.className = 'email';
                    emailDiv.innerHTML = `<h2>${email.subject}</h2>`;
                    container.appendChild(emailDiv);
                });
            });
    </script>
</body>
</html>
