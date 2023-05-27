<?php 
// connect to database
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "realmadrid";

$conn = mysqli_connect($server, $user, $password, $nama_database);

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