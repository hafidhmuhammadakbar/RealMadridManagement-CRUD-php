<?php
require 'functions.php';
require_once 'config.php';

if (isset($_POST['login'])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username=? OR email=?";
    $stmt = mysqli_prepare($conn, $sql);

    // bind parameter to query
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    // if user exist
    if ($user) {
        // verify password
        if (password_verify($password, $user["password"])) {
            // create session
            session_start();
            $_SESSION["user"] = $user;
            // login success, redirect to home.php
            header("Location: home.php");
            exit;
        }
    }
    // if user not exist
    echo "
        <script>
                alert('Username or password is wrong!');
                document.location.href = 'login.php';
        </script>
    ";
}
?>


<?= header_template_auth("Login Account") ?>
    <main>
        <div class="container">
            <!-- Heading Title -->
            <h1 class="heading-title">Login Account</h1>
            <!-- View data from database -->
            <p class="p-title">Don't have an account yet?  <a href="register.php">  Create an account here</a></p>
            <form action="" method="post" enctype="multipart/form-data" id="form-input">
                <div class="container text-center">
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
                            <label for="password">Password</label>
                        </div>
                        <div class="col-5 input-form">
                            <input type="password" name="password" id="password" required minlength="5" placeholder="Password">
                        </div>
                    </div>
                    <div id="btn-input-position">
                        <button type="submit" name="login" id="btn-input">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

<?= footer_template_auth() ?>