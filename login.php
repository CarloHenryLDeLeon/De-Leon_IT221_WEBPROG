<?php
    session_start();
    if(!isset($_SESSION["user"])){
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" type="image/x-icon" href="icon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style_ph.css">

</head>
<body>

    <h1 id="login">LOGIN</h1>

    <div class="container">
        <?php
            if(isset ($_POST["login"])){
                $email = $_POST["email"];
                $password = $_POST["password"];
                    require_once "database.php";
                    $sql = "SELECT * FROM user WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if ($user) {
                        if(password_verify($password, $user["password"])) {
                            $_SESSION["user"] = "yes";
                            $_SESSION["user_id"] = $user["ID"];
                            $_SESSION["user_name"] = $user["FirstName"];
                            header("Location: index.php");
                            die();
                        } else {
                            echo "<div class= 'alert alert-danger'> Password does not match </div>";
                        }
                    } else {
                        echo "<div class= 'alert alert-danger'> Email does not match </div>";
                    }
            }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class= "form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class= "form-control" required>
            </div>

            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div style="margin-top: 30px;"><p>Not registered yet? <a href="registration.php">Register Here</a></p></div>
    </div>

</body>
</html>