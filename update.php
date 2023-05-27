<?php 
    require 'functions.php';
    
    // get id di URL
    $id = $_GET["id"];

    // query data barang berdasarkan ID
    $player = query("SELECT * FROM `player` WHERE id=$id")[0];

    //tombol submit ditekan atau belum
    if(isset($_POST["submit"])){
        // cek data ada yang diubah atau tidak
        if (update($_POST) > 0) {
            echo "<script>
                alert('Change data success!');
                document.location.href = 'player.php';
            </script>";
        }
        else {
            echo "<script>
                alert('Change data failed!');
                document.location.href = 'player.php';
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data Player</title>

    <!-- Css -->
    <link rel="stylesheet" href="mystyle.css">
    <!-- Shortcut icon -->
    <link rel="shortcut icon" href="img/rm-logo.png" />
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
            <h1 class="heading-title">Edit Player Data</h1>
            <!-- View data from database -->    
            <form action="" method="post" enctype="multipart/form-data" id="form-input">
                <input type="hidden" name="id" value="<?= $player["id"]?>">
                <input type="hidden" name="oldImage" value="<?= $player["image"]?>">
                <div class="container text-center">
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="text" name="name" id="name" required minlength="7" value="<?= $player["name"];?>">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="number">Number</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="number" name="number" id="number" required max="99" min="1" value="<?= $player["number"];?>">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="position">Position</label>
                        </div>
                        <div class="col-5 input-form">
                            <select class="form-select" id="position" name="position" required>
                                <option selected disabled value="">Choose one</option>
                                <option value="Goalkeeper" <?php if ($player["position"] === "Goalkeeper") echo "selected"; ?>>Goalkeeper</option>
                                <option value="Defender" <?php if ($player["position"] === "Defender") echo "selected"; ?>>Defender</option>
                                <option value="Midfielder" <?php if ($player["position"] === "Midfielder") echo "selected"; ?>>Midfielder</option>
                                <option value="Striker" <?php if ($player["position"] === "Striker") echo "selected"; ?>>Striker</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="nationality">Nationality</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="text" name="nationality" id="nationality" required value="<?= $player["nationality"];?>">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="birthDate">Birth of Date</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="date" name="birthDate" id="birthDate" max="<?= time()?>" value="<?= $player["birthDate"];?>">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="image" class="label-form">Image</label>
                        </div>
                        <div class="col-5 input-form">
                            <img src="file/<?= $player["image"];?>" alt="none" width="150px" height="200px" class="mb-4"><br>
                            <input class="form-control form-control-lg" id="image" name="image" type="file">
                        </div>
                    </div>
                    <div id="btn-input-position">
                        <button type="submit" name="submit" id="btn-input">Submit</button>
                    </div>
                </div>
            </form>
            
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