<?php
require 'functions.php';
require_once 'config.php';

if (isset($_POST['register'])) {

    // Filter the input data
    $name = $_POST["name"];
    $username = $_POST["username"];
    // Encrypt the password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    // Prepare the query
    $sql = "INSERT INTO users (name, username, email, password) 
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters to the query
    mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $password);

    // Execute the query to save to the database
    $saved = mysqli_stmt_execute($stmt);

    // If the save query is successful, the user is registered
    // Redirect to the login page
    if ($saved) {
        header("Location: login.php");
        exit;
    } 
    // If the save query is not successful, the user is not registered
    // Redirect to the register page
    else {
        echo "
        <script>
                alert('Failed to register!');
                document.location.href = 'register.php';
        </script>
        ";
    }
}
?>


<?= header_template_auth("Register Account") ?>
    <main>
        <div class="container">
            <!-- Heading Title -->
            <h1 class="heading-title">Register Account</h1>
            <!-- View data from database -->
            <p class="p-title">Already has an account?  <a href="login.php">  Login here</a></p>
            <form action="" method="post" enctype="multipart/form-data" id="form-input">
                <div class="container text-center">
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="text" name="name" id="name" required minlength="7" placeholder="Full name">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="username">Username</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="text" name="username" id="username" required placeholder="Username">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="email" name="email" id="email" required placeholder="Email address">
                        </div>
                    </div>
                    <div class="row justify-content-center row-form">
                        <div class="col-2 label-form">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="password" name="password" id="password" required minlength="5" placeholder="Password">
                        </div>
                    </div>
                    <div id="btn-input-position">
                        <button type="submit" name="register" id="btn-input">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
<?= footer_template_auth() ?>