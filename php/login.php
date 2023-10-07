<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $connessione->real_escape_string($_POST['email']);
    $password = $connessione->real_escape_string($_POST['password']);

    $sql_select = "SELECT * FROM utenti WHERE email = '$email'";

    if ($result = $connessione->query($sql_select)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (password_verify($password, $row['password'])) {
                session_start();

                $_SESSION['loggato'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['cognome'] = $row['cognome'];
                $_SESSION['email'] = $row['email'];

                // Restituisce una risposta JSON di successo
                echo json_encode(["success" => true]);
                exit; 
            } else {
                // Restituisce una risposta JSON di errore
                echo json_encode(["success" => false, "message" => "La password non risulta corretta"]);
                exit; 
            }
        } else {
            // Restituisce una risposta JSON di errore
            echo json_encode(["success" => false, "message" => "Non ci sono account con questa mail"]);
            exit; 
        }
    } else {
        // Restituisce una risposta JSON di errore
        echo json_encode(["success" => false, "message" => "Errore in fase di login"]);
        exit; 
    }

    $connessione->close();
}

?>
