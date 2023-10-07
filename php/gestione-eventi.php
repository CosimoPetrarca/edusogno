<?php
session_start();
if (!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true) {
    header("Location: login.html");
    exit;
}

require_once('./config.php');

$email_utente_loggato = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "create") {
        $nome_evento = $_POST["nome_evento"];
        $data_evento = $_POST["data_evento"];

        // inserimento nel database
        $sql_create_evento = "INSERT INTO eventi (attendees, nome_evento, data_evento) VALUES ('$email_utente_loggato', '$nome_evento', '$data_evento')";
        if ($connessione->query($sql_create_evento) === TRUE) {
            header("Location: /edusogno/private-area.php");
            exit;
        } else {
            echo "Errore durante la creazione dell'evento: " . $connessione->error;
        }
    } elseif ($_POST["action"] == "update") {
        // dati dalla richiesta POST
        $evento_id = $_POST["evento_id"];
        $nome_evento = $_POST["nome_evento"];
        $data_evento = $_POST["data_evento"];

        // Aggiorna il record nel database
        $sql_update_evento = "UPDATE eventi SET nome_evento = '$nome_evento', data_evento = '$data_evento' WHERE id = '$evento_id'";

        if ($connessione->query($sql_update_evento) === TRUE) {
            header("Location: /edusogno/private-area.php");
            exit;
        } else {
            echo "Errore durante l'aggiornamento dell'evento: " . $connessione->error;
        }
    } elseif ($_POST["action"] == "delete") {
        // ID dell'evento da cancellare
        $evento_id = $_POST["evento_id"];

        // cancellazione dal database
        $sql_delete_evento = "DELETE FROM eventi WHERE id = '$evento_id' AND attendees LIKE '%$email_utente_loggato%'";

        if ($connessione->query($sql_delete_evento) === TRUE) {
            header("Location: /edusogno/private-area.php");
            exit;
        } else {
            echo "Errore durante la cancellazione dell'evento: " . $connessione->error;
        }
    }
}
?>
