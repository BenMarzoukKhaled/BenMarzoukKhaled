<?php include("connexionDataBase.php");
if (isset($_POST['submit'])) {

    $opp = $_POST['opp'];
    $client = $_POST['client'];
    $psa = $_POST['psa'];
    $devis = $_POST['devis'];
    $prestataire = $_POST['prestataire'];
    $porteur = $_POST['porteur'];
    $domaine = $_POST['domaine'];
    $description = $_POST['description'];
    $date_debut_prestation = $_POST['date_debut_prestation'];
    $date_fin_prestation = $_POST['date_fin_prestation'];
    $montant_ht = $_POST['montant_ht'];
    $bdc = $_POST['bdc'];
    $date_reception_bdc = $_POST['date_reception_bdc'];
    $facture = $_POST['facture'];
    $date_reception_facture = $_POST['date_reception_facture'];
    $taux_facture = $_POST['taux_facture'];
    $montant_facture = $_POST['montant_facture'];
    $commentaire = $_POST['commentaire'];
    $statut = 'Devis en cours';
    $fy = $_POST['fy'];
    $query = "INSERT INTO TPS_FACTURATION(OPP_ID,CLIENT_ID,CODE_PSA,DEVIS,PRESTATAIRE,PORTEUR,DOMAINE,DESCRIPTION,DATE_DEB_PRES,DATE_FIN_PRES,MONTANT_HT,BDC,DATE_RECP_BDC,FACTURE,DATE_RECP_FACT,TAUX_FACT,MONTANT_FACT,COMMENTAIRE,STATUT,FY)  VALUES('$opp','$client','$psa','$devis','$prestataire','$porteur','$domaine','$description','$date_debut_prestation','$date_fin_prestation','$montant_ht','$bdc','$date_reception_bdc','$facture','$date_reception_facture','$taux_facture','$montant_facture','$commentaire','$statut','$fy')";
    $run = mysqli_query($cam, $query);
    if ($run) {
        header('Location: http://localhost/PSR/display.php');
    } else {
        header('Location: http://localhost/PSR/addFacture.php?reg_err=duplicatedKey');
    }
}



?>

<html>

<head>
    <title>PSR</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark" style="background-color: #C21745">

        <div class="container">
            <a href="#" class="navbar-brand mb-0 h1">
                CGI
            </a>
            <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="addFacture.php" class="nav-link disabled" style="color: black;">Ajouter une facture</a>
                    </li>
                    <li class="nav-item active">
                        <a href="display.php" class="nav-link active">Afficher les factures</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" style="color: white;" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Factures</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="amount.php" class="dropdown-item">Montant des factures</a></li>
                            <li><a href="stats.php" class="dropdown-item">Pv en attente</a></li>
                            <li><a href="paiement.php" class="dropdown-item">Paiement en attente</a></li>
                        </ul>
                    </li>
                    <li class="nav-item active">
                        <a href="disconnect.php" class="nav-link active">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="background-image">

        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <form method="POST" action="" class="border shadow p-3 rounded" style="width: 450px;">
                <h1 class="text-center p-5" style="color: black;">Facture</h1>
                <?php
                if (isset($_GET['reg_err'])) {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch ($err) {
                        case 'duplicatedKey':
                ?>
                            <div class="alert alert-danger">
                                <strong> Erreur</strong> table TSP_FACTURATION !
                            </div>
                            <?php
                            break;
                            ?>
                <?php
                    }
                }
                ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Identifiant OPP</label>
                    <input type="text" class="form-control" name="opp" minlength="1" maxlength="20" required="required" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Identifiant Client</label>
                    <input required="required" type="text" class="form-control" name="client" minlength="1" maxlength="20">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Code PSA</label>
                    <input required="required" type="text" class="form-control" name="psa" minlength="1" maxlength="20">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Devis</label>
                    <input type="text" class="form-control" name="devis" maxlength="20">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Prestataire</label>
                    <input type="text" class="form-control" name="prestataire" maxlength="20">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Porteur</label>
                    <input type="text" class="form-control" name="porteur" maxlength="50">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Domaine</label>
                    <input type="text" class="form-control" name="domaine" maxlength="50">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" maxlength="200">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Date début prestation</label>
                    <input type="date" class="form-control" name="date_debut_prestation">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Date fin prestation</label>
                    <input type="date" class="form-control" name="date_fin_prestation">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Montant HT</label>
                    <input step="0.000001" type="number" class="form-control" name="montant_ht">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">BDC</label>
                    <input type="text" class="form-control" name="bdc" maxlength="20">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Date de réception BDC</label>
                    <input type="date" class="form-control" name="date_reception_bdc">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Facture</label>
                    <input type="text" class="form-control" name="facture" maxlength="20">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Date de réception facture</label>
                    <input type="date" class="form-control" name="date_reception_facture">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Taux de la facture</label>
                    <input type="text" class="form-control" name="taux_facture" maxlength="20">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Montant de la facture</label>
                    <input step="0.000001" type="number" class="form-control" name="montant_facture">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Commentaire</label>
                    <input type="text" class="form-control" name="commentaire" maxlength="200">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Statut</label>
                    <input disabled type="text" class="form-control" name="statut" value="Devis en cours" maxlength="20">
                </div>
                <div class="mb-3">
                    <label for="inputState" class="form-label">FY</label>
                    <select name="fy" class="form-control">
                        <option selected>FY22</option>
                        <option>FY23</option>
                        <option>FY24</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
            </form>
        </div>
    </div>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        :required {
            border: 2px dotted red;
        }

        .background-image {
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #FEF8EF;
        }
    </style>

</body>


</html>