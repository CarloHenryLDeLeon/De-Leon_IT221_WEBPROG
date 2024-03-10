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
    <title>Registration Form</title>
    <link rel="icon" type="image/png" href="jqlogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style_ph.css">
</head>
<body>

<h1 id="register">REGISTER</h1>

<div class="container">
    <?php
    if(isset($_POST["Submit"])) {
        $LastName = $_POST["LastName"];
        $FirstName = $_POST["FirstName"];
        $email = $_POST["Email"];
        $password = $_POST["password"];
        $RepeatPassword = $_POST["repeat_password"];
        $province = $_POST["province"];
        $city_municipality = $_POST["city_municipality"];
        $barangay = $_POST["barangay"];
        $country = $_POST["country"];
        $phone = $_POST["phone"];
       
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $errors = array();
        if (empty($LastName) || empty($FirstName) || empty($email) || empty($password) || empty($RepeatPassword)) {
            array_push($errors, "All fields are required");
        }
 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, "Email is not valid");
        }
 
        if(strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }
 
        if($password != $RepeatPassword){
            array_push($errors, "Password does not match");
        }
 
        require_once "database.php";
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if($rowCount > 0){
            array_push($errors,"Email Already Exist!");
        }
 
        if (count($errors) > 0){
            foreach($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            require_once("database.php");
            $sql = "INSERT INTO user (LastName, FirstName, email, password, province, city_municipality, barangay, country, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $preparestmt = mysqli_stmt_prepare($stmt, $sql);
            if ($preparestmt) {
                mysqli_stmt_bind_param($stmt, "sssssssss", $LastName, $FirstName, $email, $passwordHash, $province, $city_municipality, $barangay, $country, $phone);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-sucess'> You are Registered Successfully! Login now! </div>";
        }   else {
                die("Something went wrong");
            }
        }
    }
    ?>
    <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="LastName" placeholder="Last Name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="FirstName" placeholder="First Name">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="Email" placeholder="Email">
        </div>
        
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Input Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
        </div>
        <!--provice and city-->
        <div class="form-row">
            <div class="col form-group">
                <label>Province</label>
                <select id="provinces" name="province" class="form-control" required>
                    <option value="" disabled selected>Select Province</option>
                </select>
            </div> <!-- form-group end.// -->
            <div class="col form-group">
                <label>City/Municipality</label>
                <select id="cities" name="city_municipality" class="form-control" required>
                    <option value="" disabled selected>Select City/Municipality</option>
                </select>
            </div> <!-- form-group end.// -->
            <div class="col form-group">
                <label>Barangay</label>
                <select id="barangay" name="barangay" class="form-control" required>
                    <option value="" disabled selected>Select Barangay</option>
                </select>
            </div> <!-- form-group end.// -->
        </div>
 
        <div class="form-group">
            <label>Country</label>
            <select id="countries" name="country" class="form-control" name="countries" required>
            </select>
        </div> <!-- form-group end.// -->
 
        <div class="form-group">
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required maxlength="20">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="Submit" value="Register">
        </div>
        <div><p>Already registered? <a href="login.php">Login Here</a></p></div>
    </div>
    </form>
    </article> <!-- card-body end .// -->
    </div> <!-- card.// -->
    </div> <!-- col.//-->
    </div> <!-- row.//-->
    </div>
<!--container end.//-->
    <br><br>
    </form>
    <div><p>Already registered? <a href="login.php">Login Here</a></p></div>
</div>
<script src="./build/js/intlTelInput.js"></script>
        <script src="country 1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="province_barangay_city 1.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var input = document.querySelector("#phone");
                var iti = window.intlTelInput(input, {
                    utilsScript: "./build/js/utils.js",
                    separateDialCode: true,        
                });
 
                // Event listener for handling changes in the input
                input.addEventListener("change", function() {
                    // Check if the input value already contains the dial code
                    if (!input.value.startsWith('+')) {
                        var selectedCountryData = iti.getSelectedCountryData();
                        var countryCode = selectedCountryData.dialCode;
 
                        // Remove leading zeros
                        input.value = input.value.replace(/^0+/, '');
 
                        // Add the dial code only if it's not already present
                        input.value = '+' + countryCode + input.value;
                    }
                });
            });
 
<script src="script.js"></script>
</body>
</html>