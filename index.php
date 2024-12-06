<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <form action="profile.php" method="post">
            <h1>Accedi</h1>
            <input required type="email" name="email" placeholder="E-mail"/>
            <input required type="password" name="password" placeholder="Password"/>
            <input type="submit" name="Accedi">
        </form>
        <p>
            Non sei ancora registrato?
            <a href="sign_up.html">Registrati ora</a>
        </p>
        <p>
            <a href="user_list.php">Lista utenti registrati</a>
        </p>
    </div>
</body>
</html>