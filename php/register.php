<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $connessione->real_escape_string($_POST['nome']);
    $cognome = $connessione->real_escape_string($_POST['cognome']);
    $email = $connessione->real_escape_string($_POST['email']);
    $password = $connessione->real_escape_string($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO utenti (nome, cognome, email, password) VALUES ('$nome', '$cognome', '$email', '$hashed_password')";

    if ($connessione->query($sql) === true) {
        // Restituisce una risposta JSON di successo
        echo json_encode(["success" => true]);
    } else {
        // Restituisce una risposta JSON di errore
        echo json_encode(["success" => false, "message" => "Errore durante la registrazione: " . $connessione->error]);
    }
} else {
    // Restituisce una risposta JSON di errore se la richiesta non è POST
    echo json_encode(["success" => false, "message" => "Richiesta non valida"]);
}

$connessione->close();
?>
