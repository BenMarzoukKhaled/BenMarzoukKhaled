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
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
                        <a href="#" class="nav-link disabled" style="color: black;">Afficher les factures</a>
                    </li>
                    <li class="nav-item active">
                        <a href="amount.php" class="nav-link active">Montant des factures</a>
                    </li>
                    <li class="nav-item active">
                        <a href="disconnect.php" class="nav-link active">Déconnexion</a>
                    </li>
                </ul>
            </div>
            <div>
                <form method="POST" class="d-flex">
                    <select name='psa[]' multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="3" onchange="console.log(this.selectedOptions)">
                        <?php
                        $sql_psa = "SELECT DISTINCT(CODE_PSA) FROM TPS_FACTURATION ";
                        $result_psa = mysqli_query($cam, $sql_psa);
                        while ($row = mysqli_fetch_array($result_psa)) {
                            if (isset($_POST["psa"]) && in_array($row["CODE_PSA"], $_POST["psa"]))
                                echo '<option selected  value="' . $row["CODE_PSA"] . '">' . $row["CODE_PSA"] . '</option>';
                            else
                                echo '<option   value="' . $row["CODE_PSA"] . '">' . $row["CODE_PSA"] . '</option>';
                        }

                        ?>
                    </select>
                    <input type="text" name="rechercher" class="form-control me-2" placeholder="Recherche dynamique" value=<?php echo isset($_POST['rechercher']) ? htmlspecialchars($_POST['rechercher'], ENT_QUOTES) : ''; ?>>
                    <button type="submit" class="btn btn-light">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>


    <div style="background-color: #FEF8EF;">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">STATUT</th>
                        <th scope="col">Devis</th>
                        <th scope="col">Prestataire</th>
                        <th scope="col">Domaine</th>
                        <th scope="col">Montant HT</th>
                        <th scope="col">BDC</th>
                        <th scope="col">Facture</th>
                        <th scope="col">Taux</th>
                        <th scope="col">Montant facture</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //$sql = "SELECT * FROM TPS_FACTURATION ORDER BY BDC DESC ,CODE_PSA DESC ";
                    //$result = mysqli_query($cam, $sql);
                    if (isset($_POST['psa']) && isset($_POST['rechercher']) && !empty($_POST['rechercher'])) {
                        $recherche = '%' . htmlspecialchars($_POST['rechercher']) . '%';
                        $sql = "SELECT * FROM TPS_FACTURATION WHERE STATUT LIKE '$recherche' OR DEVIS LIKE '$recherche' OR PRESTATAIRE LIKE '$recherche' OR DOMAINE LIKE '$recherche' OR BDC LIKE '$recherche' OR FACTURE LIKE '$recherche' OR TAUX_FACT LIKE '$recherche'   ";
                        $result = mysqli_query($cam, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                foreach ($_POST['psa'] as $psa) {
                                    if ($psa == $row['CODE_PSA']) {
                                        $statut = $row['STATUT'];
                                        $devis = $row['DEVIS'];
                                        $prestataire = $row['PRESTATAIRE'];
                                        $domaine = $row['DOMAINE'];
                                        $montant_ht = $row['MONTANT_HT'];
                                        $bdc = $row['BDC'];
                                        $facture = $row['FACTURE'];
                                        $taux_fact = $row['TAUX_FACT'];
                                        $montant_fact = $row['MONTANT_FACT'];
                                        $code_psa = $row['CODE_PSA'];
                                        $id = $row['ID'];
                                        echo '<tr>
                        <th scope="row" id="test">' . $statut . '</th>
                        <td  >' . $devis . '</td>
                        <td>' . $prestataire . '</td>
                        <td>' . $domaine . '</td>
                        <td>' . $montant_ht . '€' . '</td>
                        <td>' . $bdc . '</td>
                        <td>' . $facture . '</td>
                        <td>' . $taux_fact . '</td>
                        <td>' . $montant_fact . '€' .  '</td>
                        <td>
                        <button class="btn btn-default" style="background-color:#79F272;"><a href="update.php?updateID=' . $id . '" class="text-light">Modifier</a></button>
                        </td>
                    </tr> ';
                                    }
                                }
                            }
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        input {
            outline: none;
            border: none;
        }

        select {
            width: 50em;
        }

        .btn-default {
            background-color: #79F272;
        }

        .table {
            margin-top: 100px;
            margin-bottom: 448px;
        }

        td,
        th {
            text-align: center;
            vertical-align: middle;
        }

        th {
            color: #8B8499;
        }

        .multiselect-dropdown {
            width: 356px;
            right: 8px;

        }
    </style>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/multiselect-dropdown.js"></script>
</body>
<script>

</script>


</html>