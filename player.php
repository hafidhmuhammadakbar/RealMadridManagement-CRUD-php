<?php
require_once 'auth.php';
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

<?= header_template("Player Data") ?>
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
<?= footer_template() ?>