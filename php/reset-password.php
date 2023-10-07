<?php
session_start();

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connessione al database e inclusione del file di configurazione
    require_once('./config.php');

    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Verifica che le due password corrispondano
    if ($new_password === $confirm_password) {
        // Recupera l'indirizzo email dell'utente loggato
        $email_utente_loggato = $_SESSION['email'];

        // Hash della nuova password 
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Aggiorna la password nel database per l'utente loggato
        $sql_update_password = "UPDATE utenti SET password = '$hashed_password' WHERE email = '$email_utente_loggato'";

        if ($connessione->query($sql_update_password) === TRUE) {
            $success_message = "Password aggiornata con successo!";
        } else {
            $error_message = "Errore durante l'aggiornamento della password: " . $connessione->error;
        }
    } else {
        $error_message = "Attenzione le password non corrispondono!";
    }
    
    // Memorizza i messaggi di successo o errore nella sessione
    $_SESSION['success_message'] = $success_message;
    $_SESSION['error_message'] = $error_message;

    // Reindirizza l'utente a reset.php
    header("Location: /edusogno/reset.php");
    exit;
}

?>
