<?php
include("connexionDataBase.php");
$id = $_GET['updateID'];

$sql = "SELECT * FROM TPS_FACTURATION WHERE ID='$id'";
$result = mysqli_query($cam, $sql);
$row = mysqli_fetch_assoc($result);
$opp = $row['OPP_ID'];
$client = $row['CLIENT_ID'];
$psa = $row['CODE_PSA'];
$devis = $row['DEVIS'];
$prestataire = $row['PRESTATAIRE'];
$porteur = $row['PORTEUR'];
$domaine = $row['DOMAINE'];
$description = $row['DESCRIPTION'];
$date_debut_prestation = $row['DATE_DEB_PRES'];
$date_fin_prestation = $row['DATE_FIN_PRES'];
$montant_ht = $row['MONTANT_HT'];
$bdc = $row['BDC'];
$date_reception_bdc = $row['DATE_RECP_BDC'];
$facture = $row['FACTURE'];
$date_recp_fact = $row['DATE_RECP_FACT'];
$taux_fact = $row['TAUX_FACT'];
$montant_fact = $row['MONTANT_FACT'];
$commentaire = $row['COMMENTAIRE'];
$statut = $row['STATUT'];
$fy = $row['FY'];

if (isset($_POST['submit'])) {
    $opp_p = $opp;
    $client_p = $client;
    $psa_p = $psa;
    $devis_p = $_POST['devis_p'];
    $prestataire_p = $_POST['prestataire_p'];
    $porteur_p = $_POST['porteur_p'];
    $domaine_p = $_POST['domaine_p'];
    $description_p = $_POST['description_p'];
    $date_deb_pres_p = $_POST['date_debut_pres_p'];
    $date_fin_pres_p = $_POST['date_fin_pres_p'];
    $montant_ht_p = $_POST['montant_ht_p'];
    $bdc_p = $_POST['bdc_p'];
    $date_recp_bdc_p = $_POST['date_recp_bdc_p'];
    $facture_p = $_POST['facture_p'];
    $date_recp_fact_p = $_POST['date_recp_fact_p'];
    $taux_fact_p = $_POST['taux_fact_p'];
    $montant_fact_p = $_POST['montant_fact_p'];
    $commentaire_p = $_POST['commentaire_p'];
    $statut_p = $_POST['statut_p'];
    $fy_p = $_POST['fy_p'];
    $query = "UPDATE TPS_FACTURATION set OPP_ID='$opp_p',CLIENT_ID='$client_p',CODE_PSA='$psa_p',DEVIS='$devis_p',PRESTATAIRE='$prestataire_p',PORTEUR='$porteur_p',DOMAINE='$domaine_p',DESCRIPTION='$description_p',DATE_DEB_PRES='$date_deb_pres_p',DATE_FIN_PRES='$date_fin_pres_p',MONTANT_HT='$montant_ht_p',BDC='$bdc_p',DATE_RECP_BDC='$date_recp_bdc_p',FACTURE='$facture_p',DATE_RECP_FACT='$date_recp_fact_p',TAUX_FACT='$taux_fact_p',MONTANT_FACT='$montant_fact_p',COMMENTAIRE='$commentaire_p',STATUT='$statut_p',FY='$fy_p'
        WHERE ID='$id'";
    $run = mysqli_query($cam, $query);
    if ($run) {

        header('Location: http://localhost/PSR/display.php');
    } else {
        echo mysqli_error($cam);
    }
} else {
    echo "all fields required";
}



?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <title>PSR</title>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark" style="background-color: #C21745">
        <div class="container" style="padding-right: 0px;">
            <a href="#" class="navbar-brand mb-0 h1">
                CGI
            </a>
            <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="addFacture.php" class="nav-link active">Ajouter une facture</a>
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



    <div style="background-color: #FEF8EF;">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <form method="POST" class="border shadow p-3 rounded" style="width: 450px;">
                <h1 class="text-center p-5" style="color: black;">Facture</h1>
                <div class="mb-3">
                    <label for="username" class="form-label">Identifiant OPP</label>
                    <?php echo '<input required type="text" class="form-control" name="opp_p" maxlength="20" disabled value="' . $opp . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Identifiant Client</label>
                    <?php echo '<input required type="text" class="form-control" name="client_p" maxlength="20" disabled value="' . $client . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Code PSA</label>
                    <?php echo  '<input required type="text" class="form-control" name="psa_p" maxlength="20" disabled value="' . $psa . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Devis</label>
                    <?php echo '<input type="text" class="form-control" name="devis_p" maxlength="20" value="' . $devis . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Prestataire</label>
                    <?php echo '<input type="text" class="form-control" name="prestataire_p" maxlength="20" value="' . $prestataire . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Porteur</label>
                    <?php echo '<input type="text" class="form-control" name="porteur_p" maxlength="50" value="' . $porteur . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Domaine</label>
                    <?php echo '<input type="text" class="form-control" name="domaine_p" maxlength="50" value="' . $domaine . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Description</label>
                    <?php echo '<input type="text" class="form-control" name="description_p" maxlength="200" value="' . $description . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Date début prestation</label>
                    <input type="date" class="form-control" name="date_debut_pres_p" value=<?PHP echo $date_debut_prestation; ?>>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Date fin prestation</label>
                    <input type="date" class="form-control" name="date_fin_pres_p" value=<?PHP echo $date_fin_prestation; ?>>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Montant HT</label>
                    <input step="0.000001" type="number" class="form-control" name="montant_ht_p" value=<?PHP echo $montant_ht; ?>>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">BDC</label>
                    <?php echo '<input type="text" class="form-control" name="bdc_p" maxlength="20" value="' . $bdc . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Date de réception BDC</label>
                    <input type="date" class="form-control" name="date_recp_bdc_p" value=<?PHP echo $date_reception_bdc; ?>>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Facture</label>
                    <?php echo '<input type="text" class="form-control" name="facture_p" maxlength="20" value="' . $facture . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Date de réception facture</label>
                    <input type="date" class="form-control" name="date_recp_fact_p" value=<?PHP echo $date_recp_fact; ?>>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Taux de la facture</label>
                    <?php echo '<input type="text" class="form-control" name="taux_fact_p" maxlength="20" value="' . $taux_fact . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Montant de la facture</label>
                    <input step="0.000001" type="number" class="form-control" name="montant_fact_p" value=<?PHP echo $montant_fact; ?>>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Commentaire</label>
                    <?php echo '<input type="text" class="form-control" name="commentaire_p" maxlength="200" value="' . $commentaire . '">'; ?>
                </div>
                <div class="mb-3">
                    <label for="inputState">Statut</label>
                    <select name="statut_p" class="form-control">
                        <option selected><?PHP echo $statut; ?></option>
                        <?php $statutList = array('Devis en cours', 'Devis transmis', 'Attente BDC', 'Attente PV', 'PV Reçu', 'Attente BDC', 'Navette transmise', 'Retard Paiement', 'Terminé', 'Sans suite');
                        foreach ($statutList as $value) {
                            if ($value <> $statut) {
                        ?>
                                <?php echo '<option>' . $value . '</option>'; ?>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputState">FY</label>
                    <select name="fy_p" class="form-control">
                        <option selected><?PHP echo $fy; ?></option>
                        <?php $fyList = array('FY22', 'FY23', 'FY24');
                        foreach ($fyList as $value) {
                            if ($value <> $fy) {
                        ?>
                                <?php echo '<option >' . $value . '</option>'; ?>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
            </form>
        </div>
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
        }

        #containerp {
            padding-right: 0px;

        }
    </style>
    </div>
</body>


</html>