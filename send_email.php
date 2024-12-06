<?php
    include "connection/connect.php";
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["user_email"])) {
        $sender = $_SESSION["user_email"];
        $receiver = $_POST["receiver"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        $query = "INSERT INTO `emails` (`sender`, `receiver`, `subject`, `message`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $sender, $receiver, $subject, $message);

        if ($stmt->execute()) {
            echo "Messaggio inviato con successo.";
        } else {
            echo "Errore durante l'invio del messaggio.";
        }
        header("Location: profile.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
?>
