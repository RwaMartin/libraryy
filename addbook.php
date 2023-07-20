<?php
require_once("function.php");

// define variables and initialize to empty value
$bookId = $bookName = $bookAuthor = $bookEdition = $bookPublish = $bookDepart = $bookNumber ="";
$bookId_err = $bookName_err = $bookAuthor_err = $bookEdition_err = $bookPublish_err = $bookDepart_err = $bookNumber_err ="";

// processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate book id
    if(empty(trim($_POST["id"]))){
        $bookId_err = "Please Enter Book Id.";
    }elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["id"]))){
        $bookId_err = "Only letters allowed in the title field.";
    }else{
        $bookId = trim($_POST["id"]);
    }

    // validate book name
    if(empty(trim($_POST["title"]))){
        $bookName_err = "Please Enter Book Name>";
    }elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["title"]))){
        $bookName_err = "Only letters allowed in the title field.";
    } else{
        $bookName = trim($_POST["title"]);
    }

    // validate Autor name
    if(empty(trim($_POST["author"]))){
        $bookAuthor_err = "Please enter author's name.";
    }elseif(!preg_match('/^[a-zA-Z\s]+$/', trim($_POST["author"]))){
        $bookAuthor_err = "Only letters allowed in the title field.";
    } else{
        $bookAuthor = trim($_POST["author"]);
    }

    // validate book edition
    if(empty(trim($_POST["edition"]))){
        $bookEdition_err = "Please fill this place";
    }elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["edition"]))){
        $bookEdition_err = "Please Enter valid edition";
    }else{
        $bookEdition = trim($_POST["edition"]);
    }

    // validate book publishs
    if(empty(trim($_POST["published"]))){
        $bookPublish  = "Please fill This place";
    }elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["published"]))){
        $bookPublish_err = "Enter valid published";
    }else{
        $bookPublish = trim($_POST["published"]);
    }

    // validate department
    if(empty(trim($_POST["department"]))){
        $bookDepart_err = "Please fill this place.";
    }elseif(!preg_match('/^[a-zA-Z]/', trim($_POST["department"]))){
        $bookDepart_err = "Please fill validate department";
    }else{
        $bookDepart = trim($_POST["department"]);
    }

    // validate book number
    if(empty(trim($_POST["numbers"]))){
        $bookNumber_err = "Please fill this place.";
    }elseif(!preg_match('/^([0-9]+)$/', trim($_POST["numbers"]))){
        $bookNumber_err = "Enter numelic only.";
    }else{
        $bookNumber = trim($_POST["numbers"]);
    }

    // Checking input errors before inserting to the database

    if(empty($bookId_err) && empty($bookName_err) && empty($bookAuthor_err) && empty($bookEdition_err) && empty($bookPublish_err) && empty($bookDepart_err) && empty($bookNumber_err)){
        
        // do an insert statment
        //$sql = "INSERT INTO book (id, title, book_author, edition, published, department, numbers) VALUES (:id, :title, :author, :edition, :published, :department, :numbers)";
        
        $sql = "INSERT INTO `book`(`id`, `title`, `book_author`, `edition`, `published`, `department`, `numbers`) VALUES ('$bookId','$bookName','$bookAuthor','$bookEdition','$bookPublish','$bookDepart','$bookNumber')";
        
        if ($link->query($sql) === TRUE) {
            header("location: books.php");
            exit();
         }else{
            echo "OOPS... Something Wrong!!!";
         }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Add Books</title>
</head>
<body>

<nav class="navbar navbar-light d-flex">
  <div class="container-fluid justify-content-end">
  <a class="navbar-brand font-monospace" href="books.php"><button class="btn btn-outline-primary me-2" type="button">Back</button></a>
  </div> 
</nav> 
 




<div class="container bg-transparent justify-content-center ">
    <h3 class="text-center mt-5 pt-5 font-monospace">Register The Book</h3>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="container px-5 py-5">
        <div class="mb-3 row">
            <label for="inputId" class="col-sm-2 col-form-label font-monospace" style="color: white;">Book Id</label>
                <div class="col-sm-10">
                <input type="text" name="id" class="form-control <?php echo (!empty($bookId_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bookId; ?>" id="inputId" placeholder="Book Id">
                <span class="invalid-feedback"><?php echo $bookId_err;?></span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputTitle" class="col-sm-2 col-form-label font-monospace" style="color: white;">Book Title/Name</label>
                <div class="col-sm-10">
                <input type="text" name="title" class="form-control <?php echo (!empty($bookName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bookName; ?>" id="inputTitle" placeholder="Book Title">
                <span class="invalid-feedback"><?php echo $bookName_err;?></span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputAuthor" class="col-sm-2 col-form-label font-monospace" style="color: white;">Book Author</label>
                <div class="col-sm-10">
                <input type="text" name="author" class="form-control <?php echo (!empty($bookAuthor_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bookAuthor; ?>" id="inputAuthor" placeholder="Book Author">
                <span class="invalid-feedback"><?php echo $bookAuthor_err;?></span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputEdition" class="col-sm-2 col-form-label font-monospace" style="color: white;">Book Edition</label>
                <div class="col-sm-10">
                <input type="text" name="edition" class="form-control <?php echo (!empty($bookEdition_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bookEdition; ?>" id="inputEdition" placeholder="Book Edition">
                <span class="invalid-feedback"><?php echo $bookEdition_err;?></span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPublished" class="col-sm-2 col-form-label font-monospace" style="color: white;">Published</label>
                <div class="col-sm-10">
                <input type="text" name="published" class="form-control <?php echo (!empty($bookPublish_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bookPublish ;?>" id="inputPublished" placeholder="Published">
                <span class="invalid-feedback"><?php echo $bookPublish_err;?></span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputDepartment" class="col-sm-2 col-form-label font-monospace" style="color: white;">Department</label>
                <div class="col-sm-10">
                <input type="text" name="department" class="form-control <?php echo (!empty($bookDepart_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bookDepart; ?>" id="inputDepartment" placeholder="Department">
                <span class="invalid-feedback"><?php echo $bookDepart_err;?></span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputNumber" class="col-sm-2 col-form-label font-monospace" style="color: white;">Book's numbers</label>
                <div class="col-sm-10">
                <input type="text" name="numbers" class="form-control <?php echo (!empty($bookNumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bookNumber; ?>" id="inputDepartment" placeholder="How many Books">
                <span class="invalid-feedback"><?php echo $bookNumber_err;?></span>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-outline-primary mb-5 " value="Submit">Register</button>
        </div>
    </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>