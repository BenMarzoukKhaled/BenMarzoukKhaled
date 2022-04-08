<?php include("connexionDataBase.php");
$sql = "SELECT COUNT(*) AS NOMBRE,CLIENT_ID AS CLIENT  FROM TPS_FACTURATION WHERE STATUT ='Attente PV' GROUP BY CLIENT_ID ";
$result = mysqli_query($cam, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $client[] = array($row['CLIENT']);
        $nombre[] = array($row['NOMBRE']);
    }
}
?>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Chart bar </title>
    <style type="text/css">
        .chartBox {
            width: 700px;
        }
    </style>
</head>

<body style="background-color: #FEF8EF;">
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
                            <li><a href="stats.php" class="dropdown-item disabled">Pv en attente</a></li>
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

    <div class="chartBox" style="margin-top: 150px; display: block; box-sizing: border-box; height: 400px; width: 700px;margin-left: 400px;">
        <h1> Nombre de PV en attente par client</h1>
        <canvas id="myChart" width="700" height="400"></canvas>
    </div>

    <script type=" text/javascript" src="js/chart.js"></script>
    <script>
        //setup block 
        const client = <?php echo json_encode($client); ?>;
        const nombre = <?php echo json_encode($nombre); ?>;
        const data = {
            labels: client,
            datasets: [{
                label: 'Nombre de PV en attente',
                data: nombre,
                backgroundColor: [
                    'red',
                    'orange',
                    'salmon',
                    'bleu',
                    'yellow',
                    'purple'
                ]
            }]
        };
        //config block
        const config = {
            type: "bar",
            data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        };
        //render block 
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/multiselect-dropdown.js"></script>
    </div>
</body>

</html>