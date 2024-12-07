<?php
include "connection/connect.php";
session_start();

// Авторизация
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"], $_POST["password"])) {
    $email = $_POST["email"];
    $psw = $_POST["password"];

    $query = "SELECT email, password, firstname FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $psw);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["user_email"] = $row["email"];
        $_SESSION["user_name"] = $row["firstname"];
    } else {
        echo "<h1>Errore</h1>";
        echo "<p class='error'>Errore nelle credenziali. Riprova per favore.</p>";
        echo "<a href='index.php'>Torna a login</a>";
        exit;
    }
}

if (!isset($_SESSION["user_email"])) {
    header("Location: index.php");
    exit;
}

$user_email = $_SESSION["user_email"];
$user_name = $_SESSION["user_name"];

// Отправка сообщений
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["send_message"])) {
    $receiver = $_POST["receiver"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    if (!empty($receiver) && !empty($subject) && !empty($message)) {
        $query = "INSERT INTO emails (sender, receiver, subject, message, timestamp) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $user_email, $receiver, $subject, $message);

        if ($stmt->execute()) {
            $send_success = "Messaggio inviato con successo a <strong>" . htmlspecialchars($receiver) . "</strong>!";
        } else {
            $send_error = "Errore durante l'invio del messaggio. Riprova.";
        }
    } else {
        $send_error = "Tutti i campi sono obbligatori.";
    }
}

// Пометка сообщения как прочитанного
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["mark_read"], $_POST["email_id"])) {
    $email_id = $_POST["email_id"];
    $query = "UPDATE emails SET is_read = 1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $email_id);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvenuto</title>
    <link rel="stylesheet" href="css/profile_style.css">
</head>
<body>
    <div class="logout-container">
        <a href="logout.php" class="logout-button">Esci</a>
    </div>
    <div class="container">
        <h1>Benvenuto!</h1>
        <p class="message">Benvenuto, <span class="highlight"><?= htmlspecialchars($user_name) ?></span>! Accesso eseguito con successo.</p>
        <h2>Invia un messaggio</h2>
        <form method="POST">
            <label for="receiver">A:</label>
            <input type="email" name="receiver" id="receiver" required><br>
            <label for="subject">Oggetto:</label>
            <input type="text" name="subject" id="subject" required><br>
            <label for="message">Messaggio:</label>
            <textarea name="message" id="message" required></textarea><br>

            <?php if (isset($send_success)) : ?>
                <p class="success"><?= $send_success ?></p>
            <?php endif; ?>

            <?php if (isset($send_error)) : ?>
                <p class="error"><?= $send_error ?></p>
            <?php endif; ?>

            <button type="submit" name="send_message">Invia</button>
        </form>

        <h2>Posta in arrivo</h2>
        <ul>
            <?php
            $query = "SELECT * FROM emails WHERE receiver = ? ORDER BY timestamp DESC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                while ($email = $result->fetch_assoc()) {
                    $is_read = $email["is_read"] == 0 ? "font-weight: bold;" : "";
                    echo "<li style='$is_read'><strong>Da:</strong> " . htmlspecialchars($email["sender"]) . "<br>";
                    echo "<strong>Oggetto:</strong> " . htmlspecialchars($email["subject"]) . "<br>";
                    echo "<strong>Messaggio:</strong> " . htmlspecialchars($email["message"]) . "<br>";
                    echo "<small>" . $email["timestamp"] . "</small>";
                    
                    if ($email["is_read"] == 0) {
                        echo "<form method='POST' style='display:inline;'>";
                        echo "<input type='hidden' name='email_id' value='" . $email["id"] . "'>";
                        echo "<button type='submit' class='mark-read-button' name='mark_read'>Segna come letto</button>";
                        echo "</form>";
                    }

                    echo "</li>";
                }
            } else {
                echo "<li>Nessuna posta trovata.</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
