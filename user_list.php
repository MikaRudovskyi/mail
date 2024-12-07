<?php
    include "connection/connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista utenti</title>
    <link rel="stylesheet" href="css/userList.css">
</head>
<body>
    <h1>Lista utenti registrati</h1>
    <a href="index.php">Torna a Login</a>
    <?php
        $query_ricevi = "SELECT `firstname`, `lastname`, `email`, `birth_date` FROM `users`";
        $result = mysqli_query($conn, $query_ricevi);
        
        if($result) {
            if($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>Nome</th>";
                echo "<th>Cognome</th>";
                echo "<th>Email</th>";
                echo "</tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";

                    echo "<td>".$row["firstname"]."</td>";
                    echo "<td>".$row["lastname"]."</td>";
                    echo "<td>".$row["email"]."</td>";

                    echo "</tr>";
                }

                echo "</table>";
            }
            else {
                echo "Non ho nulla da mostrare. Nessun utente si è registrato.";
            }
        }
        else {
            echo "<h1>Opss. Errore nella query. Riprova</h1>";
        }
    ?>
</body>
</html>
