<?php
require 'config.php'; 

$message = '';

if (isset($_POST['submit'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $message = "Cet email est déjà utilisé.";
    } else {
        $sql = "INSERT INTO users (lastname, firstname, email, password) 
                VALUES (:lastname, :firstname, :email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $message = "Inscription réussie ! Connectez-vous.";
        } else {
            $message = "Une erreur est survenue. Veuillez réessayer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Parc de la Barben</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style-register.css">
</head>
<body>
    <header>
        <img class="logo" src="images_i/logoparc.png" alt="Logo du Parc">
        <nav class="nav">
            <a href="index.php">Accueil</a>
            <a href="billetterie.php">Billetterie</a>
            <a href="animaux.php">Animaux</a>
            <a href="services.php">Services</a>
        </nav>
    </header>
    
    <div class="wrapper">
        <div class="form-box register">
            <h2>Inscription</h2>

            <?php if (!empty($message)) { ?>
                <div class="message <?php echo (strpos($message, 'réussie') !== false) ? 'success' : 'error'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form action="register.php" method="POST">
                <div class="input box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="lastname" required>
                    <label>Nom</label>
                </div>
                <div class="input box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="firstname" required>
                    <label>Prénom</label>
                </div>
                <div class="input box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Mot de passe</label>
                </div>
                <button type="submit" name="submit" class="btnlog">S'inscrire</button>
                <div class="login-register">
                    <p>Vous avez déjà un compte ? <a href="index.php" class="register-link">Connectez-vous</a></p>
                </div>
            </form>
        </div>
    </div>

    <footer>
    <div class="footer-content">
        <div class="footer-logo">
            <img src="images_i/logoparc.png" alt="Logo">
        </div>
        <div class="footer-contact">
            <h3>Contact</h3>
            <ul>
                <li><a href="#">Nous contacter</a></li>
                <li><a href="#">Mentions légales</a></li>
                <li><a href="#">Conditions d’utilisation</a></li>
                <li><a href="gps.html">Plan du site</a></li>
            </ul>
        </div>
        <div class="footer-search">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Rechercher un animal">
                <button type="submit"><ion-icon name="search"></ion-icon></button>
            </form>
        </div>
    </div>
</footer>

</body>
</html>
