<?php 
// connect to database
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "realmadrid";

$conn = mysqli_connect($server, $user, $password, $nama_database);

// function header_template
function header_template($title) {
    echo <<<EOT
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$title</title>

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
    EOT;
}

// template footer
function footer_template(){
    echo <<<EOT
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
    EOT;
}

// function query
function query($query) {
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

// function search
function search($keyword) {
    $query = "SELECT * FROM `player` WHERE
                `name` LIKE '%$keyword%' OR
                `number` LIKE '%$keyword%' OR
                `position` LIKE '%$keyword%' OR
                `nationality` LIKE '%$keyword%' OR
                `age` LIKE '%$keyword%' OR
                `birthDate` LIKE '%$keyword%'
            ";
    return query($query);
}

// function add
function add($data){
    global $conn;

    $name = htmlspecialchars($data["name"]);
    $number = htmlspecialchars($data["number"]);
    $position = htmlspecialchars($data["position"]);
    $nationality = htmlspecialchars($data["nationality"]);
    $birthDate = htmlspecialchars($data["birthDate"]);
    
    // Convert input date to a timestamp
    $inputTimestamp = strtotime($birthDate);

    // Get the current timestamp
    $currentTimestamp = time();
    if ($inputTimestamp > $currentTimestamp) {
        echo "<script>
            alert('Tanggal lahir tidak valid!');
        </script>";
        return false;
    }
    
    // upload image
    $image = upload();
    if (!$image) {
        echo "<script>
            alert('Upload gambar gagal!');
        </script>";
        return false;
    }

    $query = "INSERT INTO `player` (`name`, `position`, `number`, `birthDate`, `age`, `nationality`, `image`) VALUES ('$name', '$position', '$number', '$birthDate', YEAR(CURRENT_DATE) - YEAR('$birthDate'), '$nationality', '$image')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// function upload
function upload(){
    $filename = $_FILES['image']['name'];
    $filesize = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    // check is there any file uploaded
    if ($error === 4) {
        echo "<script>
            alert('Pilih gambar terlebih dahulu!');
        </script>";
        return false;
    }

    // check is the file uploaded is an image
    $imageExtensionValid = ['jpg', 'jpeg', 'png'];

    // explode('.', $filename) => ['namafile', 'jpg']
    $imageExtension = explode('.', $filename);

    // get the last element of the array
    $imageExtension = strtolower(end($imageExtension));

    // check if the extension is valid
    if (!in_array($imageExtension, $imageExtensionValid)) {
        echo "<script>
            alert('File yang diupload bukan gambar!');
        </script>";
        return false;
    }

    // check if the size is valid
    if ($filesize > 1000000) {
        echo "<script>
            alert('Ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    // generate new filename
    $newFilename = uniqid();
    $newFilename .= '.';
    $newFilename .= $imageExtension;

    // move the uploaded file to the destination folder
    move_uploaded_file($tmpName, 'file/' . $newFilename);
    return $newFilename;
}

// function remove data
function remove($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM `player` WHERE `id` = $id");
    return mysqli_affected_rows($conn);
}

// update data
function update($data){
    global $conn;

    $id = $data["id"];
    $oldImage = $data["oldImage"];
    $name = htmlspecialchars($data["name"]);
    $number = htmlspecialchars($data["number"]);
    $position = htmlspecialchars($data["position"]);
    $nationality = htmlspecialchars($data["nationality"]);
    $birthDate = htmlspecialchars($data["birthDate"]);

    // Convert input date to a timestamp
    $inputTimestamp = strtotime($birthDate);
    
    // Get the current timestamp
    $currentTimestamp = time();
    if ($inputTimestamp > $currentTimestamp) {
        echo "<script>
            alert('Tanggal lahir tidak valid!');
        </script>";
        return false;
    }

    // upload image but user can choose not to upload
    if ($_FILES['image']['error'] === 4) {
        $image = $_POST['oldImage'];
    } else {
        $image = upload();
        if (!$image) {
            echo "<script>
                alert('Upload gambar gagal!');
            </script>";
            return false;
        }
    }

    $query = "UPDATE `player` SET
                `name` = '$name',
                `position` = '$position',
                `number` = '$number',
                `birthDate` = '$birthDate',
                `age` = YEAR(CURRENT_DATE) - YEAR('$birthDate'),
                `nationality` = '$nationality',
                `image` = '$image'
            WHERE `id` = $id
            ";
            
    mysqli_query($conn, $query);   
    return mysqli_affected_rows($conn);
}
?>