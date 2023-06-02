<?php 
    require 'functions.php';

    if (isset($_POST["submit"])) {
        if (add($_POST) > 0) {
            echo "
                <script>
                    alert('Data added successfully!');
                    document.location.href = 'player.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data failed to add!');
                    document.location.href = 'player.php';
                </script>
            ";
        }
    }
?>

<?= header_template("Add Player Data") ?>
    <main>
        <div class="container">
            <!-- Heading Title -->
            <h1 class="heading-title">Add Player Data</h1>
            <!-- View data from database -->    
            <form action="" method="post" enctype="multipart/form-data" id="form-input">
                <div class="container text-center">
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="text" name="name" id="name" required minlength="7" placeholder="Player's name">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="number">Number</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="number" name="number" id="number" required max="99" min="1" placeholder="Player's number (between 1 and 99">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="position">Position</label>
                        </div>
                        <div class="col-5 input-form">
                            <select class="form-select" id="position" name="position" required>
                                <option selected disabled value="">Choose one</option>
                                <option value="Goalkeeper">Goalkeeper</option>
                                <option value="Defender">Defender</option>
                                <option value="Midfielder">Midfielder</option>
                                <option value="Striker">Striker</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="nationality">Nationality</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="text" name="nationality" id="nationality" required placeholder="Player's nationality">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="birthDate">Birth of Date</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="date" name="birthDate" id="birthDate" max="<?= time()?>">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="image" class="label-form">Image</label>
                        </div>
                        <div class="col-5 input-form">
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