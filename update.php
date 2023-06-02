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

<?= header_template("Edit Player Data") ?>
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
<?= footer_template() ?>