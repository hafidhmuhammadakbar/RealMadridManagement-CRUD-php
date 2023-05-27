<?php 
require 'functions.php';
$player = query('SELECT * FROM `player`');

// tombol search ditekan
if (isset($_POST["search"])) {
    $player = search($_POST["keyword"]);
}
else {
    $player = query('SELECT * FROM `player`');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Madrid Management Player</title>

    <!-- Css -->
    <link rel="stylesheet" href="mystyle.css">
    <!-- Shortcut icon -->
    <link rel="shortcut icon" href="img/rm-logo.png"/>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
</head>
<body>
    <header>
        <!-- navbar -->
        <nav class="navbar navbar-expand-md fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="img/rm-logo.png" alt="Logo" width="24" height="30" class="d-inline-block align-text-top">
                    Real Madrid
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mb-2 mb-md-0 ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="player.php">Player</a>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <!-- Heading Title -->
            <h1 class="heading-title">Real Madrid Player Data</h1>
            <!-- search box -->
            <form id="form-search" action="" method="post">
                <input id="search-box" type="text" name="keyword" autofocus placeholder="Masukkan keyword" autocomplete="off">
                <button id="btn-search" type="submit" name="search">Search</button>
            </form>
            <!-- Button add data -->
            <div class="add-data">
                <a href="add.php">
                    <button id="btn-add" type="submit" name="add">Add Data</button>
                </a>
            </div>
            <!-- View data from database -->
            <table id="table-view">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Position</th>
                    <th>Nationality</th>
                    <th>Birth Date</th>
                    <th>Age (years)</th>
                    <th>Image</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <tr>
                    <?php $i=1 ?>
                    <?php foreach ($player as $row) : ?>
                    <td><?= $i; ?></td>
                    <td><?= $row["name"]; ?></td>
                    <td><?= $row["number"]; ?></td>
                    <td><?= $row["position"]; ?></td>
                    <td><?= $row["nationality"]; ?></td>
                    <td><?= $row["birthDate"]; ?></td>
                    <td><?= $row["age"]; ?></td>
                    <td>
                        <img src="file/<?= $row["image"];?>" alt="none" width="150px" height="200px">
                    </td>
                    <td>
                        <div>
                            <a href="update.php?id=<?= $row["id"];?>">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div>
                            <a href="remove.php?id=<?= $row["id"];?>"
                                onclick="return confirm('Are you sure want to delete this data?');">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
                </tr>
            </table>
        </div>
    </main>

    <footer class="text-center">
        <a href="https://github.com/hafidhmuhammadakbar" target="_blank">
            &copy; 2023, Real Madrid Management Player. <br>
            Hafidh Muhammad Akbar
        </a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>