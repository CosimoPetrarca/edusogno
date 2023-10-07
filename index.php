<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src="./js/register.js"></script>

</head>

<body>
    <header>
        <div>
            <img src="https://ecp.yusercontent.com/mail?url=https%3A%2F%2Fci3.googleusercontent.com%2Fmail-sig%2FAIorK4zhugEBsblv-fjJhjk0pg0g3EUZC2ckNu6884TURiAOrFePWDHy3qJjvaF6ebhCGBvrtzc8wvU&amp;t=1696490945&amp;ymreqid=67560da6-2c16-b0e5-1c1f-a3000101be00&amp;sig=2Cg9Efcvkzywf8bP5pPB6A--~D">
        </div>
    </header>
    <main>
        <h2>Crea il tuo account</h2>
        <form action="./php/register.php" method="POST">

            <label for="nome"><strong>Nome</strong></label>
            <input type="text" name="nome" id="nome" placeholder="Mario" required>

            <label for="cognome"><strong>Cognome</strong></label>
            <input type="text" name="cognome" id="cognome" placeholder="Rossi" required>

            <label for="email"><strong>Email</strong></label>
            <input type="email" name="email" id="email" placeholder="name@example.com" required>

            <label for="password"><strong>Password</strong></label>
            <input type="password" name="password" id="password" placeholder="Scrivila qui" required>

            <input type="submit" value="REGISTRATI">

            <p>Hai già un account? <a href="login.html">Accedi</a></p>
        </form>

        <!-- modale di errore -->
        <div id="error-modal" class="modal">
            <div class="modal-content">
                <span class="close" id="close-error-modal">&times;</span>
                <p id="error-message"></p>
            </div>
        </div>

    </main>

</body>

</html>