<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}


// Include config file
//require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

   // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Bind result variables
        // $stmt->bind_result($id, $username, $hashed_password);
        //if($stmt->fetch()){
        $id = 1;
        $username = 'sumonst21';
        $hashfile = 'hash.txt';
        if (file_exists($hashfile)) {
            $hashfile = fopen($hashfile, "r") or die("Unable to open file!");
            $hashed_password = fgets($hashfile);
            //echo $hashed_password;

            if (password_verify($password, $hashed_password)) {
                // Password is correct, so start a new session
                session_start();

                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;

               // Redirect user to welcome page
                header("location: index.php");
                fclose($hashfile); // close hashfile
            } else {
                // Display an error message if password is not valid
                $password_err = "The password you entered was not valid.";
            }
        }
        //}
    } else {
        // Display an error message if username doesn't exist
        $username_err = "No account found with that username.";
    }
}// else {
       // echo "Oops! Something went wrong. Please try again later.";
   // }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
            margin: auto;
        }
    </style>

    <title>Login - File Transfer Script by Sumonst21</title>
</head>

<body class="text-center">
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-signin">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.1/assets/brand/bootstrap-solid.svg" alt="" width="72"
                height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <?php echo (!empty($username_err)) ? 'has-error' : '';?>
            <label for="username" class="sr-only">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Email address" value="<?php echo $username; ?>" required autofocus>
            <span class="help-block">
                    <?php echo $username_err; ?></span>

            <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <span class="help-block">
                    <?php echo $password_err; ?></span>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>

            <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>

            <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>

            <!-- <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>-->
        </form>
    </div>
</body>

</html>
