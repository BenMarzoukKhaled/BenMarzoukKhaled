<?php
if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_retype'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_retype = $_POST['password_retype'];

    $nom_du_serveur = "localhost";
    $nom_de_la_base = "psr";
    $nom_utilisateur = "root";
    $passe = "";

    $cam = mysqli_connect($nom_du_serveur, $nom_utilisateur, $passe, $nom_de_la_base);
    $sql = "SELECT pseudo,email,password FROM utilisateurs WHERE pseudo= '$pseudo' ";
    $result = mysqli_query($cam, $sql);
    if (mysqli_fetch_row($result) == 0) {
        if (strlen($pseudo) <= 100) {
            if (strlen($email) <= 100) {

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if ($password == $password_retype) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $ip = $_SERVER['REMOTE_ADDR'];

                        $query = "INSERT INTO utilisateurs(pseudo,email,password,ip)  VALUES('$pseudo','$email','$password','$ip')";
                        $run = mysqli_query($cam, $query);
                        header('Location: http://localhost/PSR/register.php?reg_err=success');
                    } else {
                        header('Location: http://localhost/PSR/register.php?reg_err=password');
                    }
                } else {
                    header('Location: http://localhost/PSR/register.php?reg_err=email');
                }
            } else {
                header('Location: http://localhost/PSR/register.php?reg_err=email_length');
            }
        } else {
            header('Location: http://localhost/PSR/register.php?reg_err=pseudo_length');
        }
    } else {
        header('Location: http://localhost/PSR/register.php?reg_err=already');
    }
}


?>
<html lang="en">

<head>
    <title>PSR</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <script type="text/javascript" src="bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="background-image">
        <?php
        if (isset($_GET['reg_err'])) {
            $err = htmlspecialchars($_GET['reg_err']);

            switch ($err) {
                case 'success':
        ?>
                    <div class="alert alert-success">
                        <strong>Succès</strong> inscription réussie !
                    </div>
                <?php
                    break;

                case 'password':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> mot de passe différent
                    </div>
                <?php
                    break;

                case 'email':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> email non valide
                    </div>
                <?php
                    break;

                case 'email_length':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> email trop long
                    </div>
                <?php
                    break;

                case 'pseudo_length':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> pseudo trop long
                    </div>
                <?php
                case 'already':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> compte déjà existant
                    </div>
        <?php

            }
        }
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <form method="POST" class="border shadow p-3 rounded" style="width: 450px;">
                <h1>Inscription</h1>
                <div class="mb-3">
                    <label for="username" class="form-label">Pseudo</label>
                    <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="required" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-success btn-block">Inscription</button>
                <button class="btn btn-primary"><a href="login.php" class="text-light">Se connecter</a></button>
            </form>
        </div>
    </div>
    </form>
    </div>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .background-image {
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            background-color: #FEF8EF;
        }
    </style>
</body>

</html>