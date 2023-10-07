<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reimposta Password</title>
    <link rel="stylesheet" href="./css/reset-password.css">
</head>

<body>
    <header>
        <div>
            <img src="https://ecp.yusercontent.com/mail?url=https%3A%2F%2Fci3.googleusercontent.com%2Fmail-sig%2FAIorK4zhugEBsblv-fjJhjk0pg0g3EUZC2ckNu6884TURiAOrFePWDHy3qJjvaF6ebhCGBvrtzc8wvU&amp;t=1696490945&amp;ymreqid=67560da6-2c16-b0e5-1c1f-a3000101be00&amp;sig=2Cg9Efcvkzywf8bP5pPB6A--~D">
        </div>
        <div class="btn">
            <button><a href="private-area.php">Come Back</a></button>
        </div>

    </header>
    <main>
        <h2>Reimposta Password</h2>
        <form action="./php/reset-password.php" method="post">
            <label for="new-password">Nuova Password:</label>
            <input type="password" id="new-password" name="new_password" required>

            <label for="confirm-password">Conferma Password:</label>
            <input type="password" id="confirm-password" name="confirm_password" required>

            <input type="submit" value="Reimposta Password">
        </form>

        <div class="message">
            <?php
            session_start();
            if (!empty($_SESSION['success_message'])) {
                echo '<p class="success">' . $_SESSION['success_message'] . '</p>';
                unset($_SESSION['success_message']); // Rimuove il messaggio di successo dalla sessione
            }
            if (!empty($_SESSION['error_message'])) {
                echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']); // Rimuove il messaggio di errore dalla sessione
            }
            session_write_close(); // Chiude la sessione dopo aver utilizzato i messaggi
            ?>
        </div>

    </main>

</body>

</html>