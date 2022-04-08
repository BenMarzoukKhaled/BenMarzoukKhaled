<?php

use LDAP\Result;

session_start();

$nom_du_serveur = "localhost";
$nom_de_la_base = "psr";
$nom_utilisateur = "root";
$passe = "";

$cam = mysqli_connect($nom_du_serveur, $nom_utilisateur, $passe, $nom_de_la_base);
if (isset($_POST)) {
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {

        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        $query = "SELECT pseudo,password FROM UTILISATEURS WHERE pseudo='$pseudo'  ";
        $result = mysqli_query($cam, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {

                if (password_verify($password, $row['password'])) {
                    $_SESSION['pseudo'] = $row['pseudo'];
                    header('Location: http://localhost/PSR/display.php');
                } else {
                    header('Location: http://localhost/PSR/login.php?reg_err=password');
                }
            }
        }
    }
}



?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <title>PSR</title>
</head>

<body>
    <div style="background-color: #FEF8EF;">

        <?php
        if (isset($_GET['reg_err'])) {
            $err = htmlspecialchars($_GET['reg_err']);

            switch ($err) {
                case 'password':
        ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Mot de passe incorrect !
                    </div>
                <?php
                    break;

                case 'pseudo':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Le Pseudo n'existe pas !
                    </div>
                    <?php
                    break;
                    ?>
        <?php

            }
        }
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <form method="POST" class="border shadow p-3 rounded" style="width: 450px;">
                <h1>Connexion</h1>
                <div class="mb-3">
                    <label for="username" class="form-label">Login</label>
                    <input type="text" class="form-control" required="required" name="pseudo">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" required="required" name="password">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Se connecter</button>
                <button class="btn btn-success" onclick="location.href='http://localhost/PSR/register.php'" type="button">
                    Créer un compte</button>
            </form>
        </div>
    </div>

    <style>
        * {
            margin: 0;
            padding: 0;
        }
    </style>
</body>


</html>