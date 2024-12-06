<?php
    include "connection/connect.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento</title>
    <link rel="stylesheet" href="css/inserimento.css">
</head>
<body>
    <?php
        if($conn->connect_errno != 0) {
            echo "<h1>Errore di conessione</h1>";
            exit();
        }
        
        /* Inserimento dati */
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $user_email = $_POST["user_email"];
        $user_password = $_POST["user_password"];
        $user_birth = $_POST["user_birth"];
        $user_graduation = $_POST["user_graduation"];
        $user_region = $_POST["user_region"];
        $user_province = $_POST["user_province"];

        $query_check_email = "SELECT * FROM `users` WHERE `email` = '$user_email'";
        $result_check = mysqli_query($conn, $query_check_email);

        if (mysqli_num_rows($result_check) > 0) {
            echo "<div class='error-box'>
                        <h1>Errore: questa email è già registrata!</h1>
                        <a href='sign_up.html'>Torna alla pagina di Registrazione</a>
                      </div>";
        } 
        else {
            $query_insert = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`, `birth_date`, `graduration`, `region`, `province`) 
                            VALUES ('$firstname', '$lastname', '$user_email', '$user_password', '$user_birth', '$user_graduation', '$user_region', '$user_province')";
            
            $result_insert = mysqli_query($conn, $query_insert);

            if ($result_insert) {
                echo "<div class='success'>
                        <h1>Registrazione avvenuta con successo</h1>
                        <a href='index.php'>Torna a Login</a>
                      </div>";
            } else {
                echo "<div class='error-box'>
                        <h1>Errore nella registrazione. Riprova.</h1>
                        <a href='sign_up.html'>Torna alla pagina di Registrazione</a>
                      </div>";
            }
        }
    ?>
    
</body>
</html>