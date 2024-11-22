<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailbox</title>
    <link rel="stylesheet" href="{{ asset('resources\css\Communicatie.css') }}">
    <link rel="stylesheet" href="resources\css\Communicatie.css">
</head>

<body>
    <div class="mailbox">
        <h1>Mailbox</h1>
        <div id="emails"></div>
    </div>
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
