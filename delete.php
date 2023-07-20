<!-- 


<?php
// Process delete operation after confirmation
if(isset($_POST["student_Id"]) && !empty($_POST["student_Id"]) && isset($_POST["number"]) && !empty($_POST["number"])){
    // Include config file
    require_once "function.php";
    
    // Prepare a delete statement
    //$sql = "DELETE FROM employees WHERE id = ?";
    $sql = "DELETE FROM `studentwithbook` WHERE `student_Id` = ':student_Id' ";
    $updat = "UPDATE `book` SET `numbers`= `numbers` + ':number' WHERE `id`=':student_Id'";
    
    if($stmt = mysqli_prepare($link, $sql, $updat)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id, $param_number);
        
        // Set parameters
        $param_id = trim($_POST["student_Id"]);
        $param_number = trim($_POST["number"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: give.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
// } else{
//     // Check existence of id parameter
//     if(empty(trim($_GET["student_Id"])) && empty(trim($_GET["number"]))){
//         // URL doesn't contain id parameter. Redirect to error page
//         header("location: error.php");
//         exit();
//     }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["student_Id"]); ?>">

                            <p>Are you sure you want to delete this student record!!!!!!?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html> -->
