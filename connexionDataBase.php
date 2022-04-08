<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location:login.php');
}
$nom_du_serveur = "localhost";
$nom_de_la_base = "psr";
$nom_utilisateur = "root";
$passe = "";

$cam = mysqli_connect($nom_du_serveur, $nom_utilisateur, $passe, $nom_de_la_base);
