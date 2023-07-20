<?php
// initialize the session

session_start();

// check if the user is already logged in, if yes then redidect him to libra page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location:../libra/index.php");
    exit;
}

//include function file
require_once "function.php";
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

//processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    //check if username is empty
    if(empty(trim($_POST["name"]))){
        $username_err = "Please enter your Name.";
    } else{
        $username = trim($_POST["name"]);
    }

    //check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter the Password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)){
        // prepare a select statement 
        $sql = "SELECT id, name, passw FROM admin WHERE name=?";


        if($stmt = mysqli_prepare($link, $sql)){
            // Bind valiables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"s", $param_username,);

            // set parameters
            $param_username = $username;
            
            // attempt to execute the prepared statment
            if(mysqli_stmt_execute($stmt)){

                // store result
                mysqli_stmt_store_result($stmt);

                // check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){

                    // bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)) {
                        if($password == $hashed_password){

                            // password is correct, so start a nw session
                            session_start();

                            // store data in session variables

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"]= $id;
                            $_SESSION["name"] = $username;

                            // redirect user to libra page
                            header("location: libra.php");
                        } else{
                            // Password is not valid, Error message
                            $login_err = "Invalid password.";
                        }
                    }

                } else{
                    // Username doesn't exist or there are multiple users
                    $login_err = "Invalid username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close conenection
    mysqli_close($link);
}


  






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>



    <div class="container">
        <h2 class="font-monospace mx-5 " style="color: white;"></h2>
        
    <div class="container bg-transparent justify-content-center ">
    <h3 class="text-center mt-5 pt-5 font-monospace">Library's Admin page</h3>
    <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="container px-5 py-5">
        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label font-monospace" style="color: white;">Name</label>
                <div class="col-sm-10">
                <input type="text" name="name" class="form-control bg-transparent <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" id="inputcName" placeholder="Name" >
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
        </div>
        <div class="form-group mb-3 row">
            <label class="col-sm-2 col-form-label font-monospace" style="color: white;">Password</label>
                <div class="col-sm-10">
                <input type="password" name="password" class="form-control bg-transparent <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="inputPassword" placeholder="Password">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
        </div>
        <div class="form-group col-12">
            <button type="submit" class="btn btn-outline-primary mb-5 " value="Login">Sign in</button>
        </div>
    </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>