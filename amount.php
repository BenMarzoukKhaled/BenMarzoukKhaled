<?php include("connexionDataBase.php"); ?>
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
                        <a href="display.php" class="nav-link active">Afficher les factures</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" style="color: white;" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Factures</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="amount.php" class="dropdown-item disabled">Montant des factures</a></li>
                            <li><a href="stats.php" class="dropdown-item">Pv en attente</a></li>
                            <li><a href="paiement.php" class="dropdown-item">Paiement en attente</a></li>
                        </ul>
                    </li>
                    <li class="nav-item active">
                        <a href="disconnect.php" class="nav-link active">Déconnexion</a>
                    </li>
                </ul>
            </div>
            <div>
                <form method="POST" class="d-flex">
                    <select name="psa" class="form-control" style="margin-right: 10px;">
                        <?php
                        $sql_psa = "SELECT DISTINCT(CODE_PSA) FROM TPS_FACTURATION ";
                        $result_psa = mysqli_query($cam, $sql_psa);
                        while ($row = mysqli_fetch_array($result_psa)) {
                            if (isset($_POST["psa"]) && $row["CODE_PSA"] == $_POST["psa"])
                                echo '<option selected  value="' . $row["CODE_PSA"] . '">' . $row["CODE_PSA"] . '</option>';
                            else
                                echo '<option   value="' . $row["CODE_PSA"] . '">' . $row["CODE_PSA"] . '</option>';
                        }
                        ?>
                    </select>
                    <select name="statut" class="form-control" style="margin-right: 10px;">
                        <?php
                        $statutList = array("Attente BDC", "Attente PV", "Navette transmise", "Terminé");
                        foreach ($statutList as $value) {
                            if (isset($_POST["statut"]) && $value == $_POST["statut"]) {
                                echo '<option selected>' . $value . '</option>';
                            } else {
                                echo '<option>' . $value . '</option>';
                            }
                        }

                        ?>
                        <input type="date" class="form-control" name="date_reception_fact" style="margin-right: 10px;" value="<?php echo isset($_POST['date_reception_fact']) ? $_POST['date_reception_fact'] : '' ?>">
                        <input type="submit" value="Appliquer" class="btn btn-light" name="submit" />
                </form>
            </div>
        </div>
    </nav>
    <div style="background-color: #FEF8EF;">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Code PSA</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Date réception de la facture</th>
                        <th scope="col">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM REPORT_FACTURATION";
                    $result = mysqli_query($cam, $sql);
                    if (isset($_POST['submit'])) {
                        $psa = $_POST['psa'];
                        $statut = $_POST['statut'];
                        $date_reception_fact = $_POST['date_reception_fact'];
                        $sql = "SELECT * FROM REPORT_FACTURATION WHERE CODE_PSA='$psa' AND STATUT ='$statut' AND DATE_RECP_FACT>'$date_reception_fact' ";
                        $result = mysqli_query($cam, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $code_psa = $row['CODE_PSA'];
                                $statut = $row['STATUT'];
                                $date_recp_fact = $row['DATE_RECP_FACT'];
                                $montant_fact = $row['MONTANT'];
                                echo '<tr>
                        <th scope="row">' . $code_psa . '</th>
                        <td  >' . $statut . '</td>
                        <td>' . $date_recp_fact . '</td>
                        <td>' . $montant_fact . '€' . '</td>
                    </tr> ';
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
    </style>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/multiselect-dropdown.js"></script>
</body>

</html>