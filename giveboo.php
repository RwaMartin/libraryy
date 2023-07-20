<?php
require_once "function.php";

// Define vartiablrs and initialize with empty values
$studentId = $studentName = $bookName = $bookId = $level = $bookNumber = "";
$studentId_err = $studentName_err = $bookName_err = $bookId_err = $level_err= $bookNumber_err = "";

//Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Validate Student Id
if(empty(trim($_POST["studentId"]))){
    $studentId_err = "Please enter the student id..!";
}else{
    $studentId = trim($_POST["studentId"]);
}

  // validate Student name
if(empty(trim($_POST["name"]))){
    $studentName_err = "Please give the name.";
}elseif(!preg_match('/^[a-zA-Z\s]+$/', trim($_POST["name"]))){
    $studentName_err = "Only letters and white space allowed in names.";
}else{
    $studentName = trim($_POST["name"]);
}


  // validate Student level
if(empty(trim($_POST["level"]))){
    $level_err = "Please fill this place.";
}elseif(!preg_match('/^([0-9]+)$/', trim($_POST["level"]))){
    $level_err = "Please Years in number.";
}else{
    $level = trim($_POST["level"]);
}

  // validate Book title
if(empty(trim($_POST["title"]))){
    $bookName = "Please select Bokk name.";
}else{
    $bookName = trim($_POST["title"]);
}

  //validate Book Id
if(empty(trim($_POST["bookId"]))){
    $bookId_err = "Please select Book Id.";
}else{
    $bookId = trim($_POST["bookId"]);
}

if(empty(trim($_POST["number"]))){
    $bookNumber_err = "Please fill this place.";
}elseif(!preg_match('/^([0-9]+)$/', trim($_POST["number"]))){
    $bookNumber_err = 'Only numbers are allowed.';
}else{
    $bookNumber = trim($_POST["number"]);
}
                                                                                                    
  //Check input errors before inserting in database
  if(empty($studentId_err) && empty($studentName_err) && empty($level_err)  && empty($bookName_err) && empty($bookId_err) && empty($bookNumber_err)){
    // do an insert statment
    $sql = "INSERT INTO `studentwithbook`(`student_Id`, `student_name`, `level_year`, `book_title`, `book_id`, `number`) VALUES ('$studentId','$studentName','$level','$bookName','$bookId','$bookNumber')";
    $updat = "UPDATE `book` SET `numbers`= `numbers` - '$bookNumber' WHERE `id`='$bookId'";

        if ($link->query($sql) === TRUE) {
            $link->query($updat);
            header("location: give.php");
            exit();
        }else{
        echo "OOPS... Something Wrong try again!!!";
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
    <title>Lend Book</title>

</head>
<body>
<nav class="navbar navbar-light d-flex">
  <div class="container-fluid justify-content-end">
  <a class="navbar-brand font-monospace" href="give.php"><button class="btn btn-outline-primary me-2" type="button">Back</button></a>
  </div> 
  </nav> 








<div class="container bg-transparent justify-content-center ">
    <h3 class="text-center mt-5 pt-5 font-monospace">Lend the Book to the student</h3>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="container px-5 py-5">

        <!-- Student Id -->
        <div class="mb-3 row">
            <label for="inputStuId" class="col-sm-2 col-form-label font-monospace" style="color: white;">Student Id</label>
                <div class="col-sm-10">
                <input type="text" name="studentId" class="form-control <?php echo (!empty($studentId_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $studentId; ?>" id="inputStuId" placeholder="Student Id">
                <span class="invalid-feedback"><?php echo $studentId_err;?></span>
            </div>
        </div>


        <!-- Student Name -->
        <div class="mb-3 row">
            <label for="inputName" class="col-sm-2 col-form-label font-monospace" style="color: white;">Student Name</label>
                <div class="col-sm-10">
                <input type="text" name="name" class="form-control <?php echo (!empty($studentName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $studentName;?>" id="inputName" placeholder="Student Name">
                <span class="invalid-feedback"><?php echo $studentName_err;?></span>
            </div>
        </div>

        <!-- Level of year -->
        <div class="mb-3 row">
            <label for="inputLevel" class="col-sm-2 col-form-label font-monospace" style="color: white;">Level year</label>
                <div class="col-sm-10">
                <input type="text" name="level" class="form-control <?php echo (!empty($level_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $level;?>" id="inputLevel" placeholder="Level of Year">
                <span class="invalid-feedback"><?php echo $level_err;?></span>
            </div>
        </div>

         <!-- Book Name -->
        <div class="mb-3 row">
            <label for="inputcTitle" class="col-sm-2 col-form-label font-monospace" style="color: white;">Book Title</label>
            <div class="col-sm-10">
                <select name="title" id="" class="form-select">
                 
         <?php
    $data="SELECT * FROM `book`";
    $result = $link->query($data);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
   ?>
               <option class="form-control"  value="<?php echo $row['id']?>"><?php echo $row['title']?></option>
   <?php }}?>
                </select>
                
            </div>
        </div>


        <!-- Book Id -->
        <div class="mb-3 row">
            <label for="inputBookId" class="col-sm-2 col-form-label font-monospace" style="color: white;">Book Id</label>
            <div class="col-sm-10">
                <select name="bookId"  class="form-select">
                 
         <?php
    $data="SELECT * FROM `book`";
    $result = $link->query($data);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
   ?>
               <option class="form-control" name="bookId" value="<?php echo $row['id']?>"><?php echo $row['id']?></option>
   <?php }}?>
                </select>
                
            </div>
        </div>



        <div class="mb-3 row">
            <label for="inputNumber" class="col-sm-2 col-form-label font-monospace" style="color: white;">Number of Books</label>
                <div class="col-sm-10">
                <input type="text" name="number" class="form-control <?php echo(!empty($bookNumber_err)) ? 'is-Invalid' : ''; ?>" value="<?php echo $bookNumber; ?>" id="inputNumber" placeholder="Number of Books">
                <span class="invalid-feedback"><?php echo $bookNumber_err;?></span>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-outline-primary mb-5 " value="submit">Give</button>
        </div>
    </form>
    </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>