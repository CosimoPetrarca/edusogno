<?php
session_start();
if (!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true) {
    header("Location: login.html");
    exit;
}

require_once('./php/config.php');

$email_utente_loggato = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    while ($row = $result->fetch_assoc()) {
        $evento_id = $row["id"];
        $nome_evento = $row["nome_evento"];
        $data_evento = $row["data_evento"];
    }
}

$sql_select_eventi = "SELECT * FROM eventi WHERE attendees LIKE '%$email_utente_loggato%'";

$result_eventi = $connessione->query($sql_select_eventi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Privata</title>
    <link rel="stylesheet" href="./css/private-area.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <header>
        <div>
            <img src="https://ecp.yusercontent.com/mail?url=https%3A%2F%2Fci3.googleusercontent.com%2Fmail-sig%2FAIorK4zhugEBsblv-fjJhjk0pg0g3EUZC2ckNu6884TURiAOrFePWDHy3qJjvaF6ebhCGBvrtzc8wvU&amp;t=1696490945&amp;ymreqid=67560da6-2c16-b0e5-1c1f-a3000101be00&amp;sig=2Cg9Efcvkzywf8bP5pPB6A--~D">
        </div>
        <a href="login.html">Logout</a>
    </header>
    <main>
        <div class="content">
            <?php
            echo "<h2>Ciao " . strtoupper($_SESSION["nome"]) . " " . strtoupper($_SESSION["cognome"]) . " ecco i tuoi eventi</h2>";
            ?>
            <br>
            <div class="card">
                <?php
                if ($result_eventi->num_rows > 0) {
                    foreach ($result_eventi as $row_evento) {
                        echo '<div class="event-card">';
                        echo '<h3>' . htmlspecialchars($row_evento['nome_evento']) . '</h3>';
                        echo '<p>' . htmlspecialchars($row_evento['data_evento']) . '</p>'; // join event
                        echo '<form action="" method="post">';
                        echo '<input type="hidden" name="event_id" value="' . $row_evento['id'] . '">';
                        echo '<input class="event-create" type="submit" value="     JOIN    ">';
                        echo '</form>';

                        echo '<div>';
                        // Pulsante per mostrare/nascondere il modulo di modifica
                        echo '<button class="edit-button">MODIFICA</button>';

                        // Modulo di modifica inizialmente nascosto
                        echo '<div class="event-edit-form" style="display:none;">';
                        echo '<form action="./php/gestione-eventi.php" method="post">';
                        echo '<input type="hidden" name="action" value="update">';
                        echo '<input type="hidden" name="evento_id" value="' . $row_evento['id'] . '">';
                        echo '<input type="text" name="nome_evento" placeholder="Nome dell\'evento" required value="' . htmlspecialchars($row_evento['nome_evento']) . '">';
                        echo '<input type="datetime-local" name="data_evento" required value="' . htmlspecialchars($row_evento['data_evento']) . '">';
                        echo '<input type="submit" value="SALVA MODIFICHE">';
                        echo '</form>';
                        echo '</div>';

                        // Form per eliminare l'evento
                        echo "<div>
                        <form action='./php/gestione-eventi.php' method='post'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='evento_id' value='{$row_evento['id']}'>
                        <input type='submit' value='  DELETE  ' class='event-delete'>
                        </form>
                        </div>";
                        echo '</div>';
                        echo '</div>';

                    }
                } else {
                    echo "Al momento non risultano eventi.";
                }
                ?>
            </div>

            <!-- Modulo per la creazione di un nuovo evento -->
            <div class="create-event">
                <form action="php/gestione-eventi.php" method="post">
                    <input type="hidden" name="action" value="create">
                    <input type="text" name="nome_evento" placeholder="Nome dell'evento" required>
                    <input type="datetime-local" name="data_evento" required>
                    <input type="submit" value="CREA EVENTO">
                </form>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $(".edit-button").click(function() {
                var editForm = $(this).siblings(".event-edit-form");
                if (editForm.is(":visible")) {
                    editForm.hide();
                } else {
                    editForm.show();
                }
            });
        });
    </script>
</body>

</html>
