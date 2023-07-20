<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Students with Books</title>

    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<nav class="navbar navbar-light">
  <div class="container-fluid justify-content-end">
  <a class="navbar-brand font-monospace" href="libra.php"><button class="btn btn-outline-primary me-2" type="button">Back</button></a>
  </div>
</nav>  
 



<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">List of Student with Books</h2>
                        <a href="giveboo.php" class="btn btn-outline-primary pull-right"><i class="fa fa-plus"></i> Give New Book</a>
                    </div>
                    <?php
                    require_once "function.php";
                    
                    $sql = "SELECT * FROM studentWithBook";
                    $result = $link->query($sql);
                       if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-hover table-dark">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Student Id</th>";
                                        echo "<th>Student Name</th>";
                                        echo "<th>Book Title</th>";
                                        echo "<th>Level of Year</th>";
                                        echo "<th>Book Id</th>";
                                        echo "<th>Number of Books</th>";
                                        echo "<th>In / Time</th>";
                                        // echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>";
                                        echo "<td>" . $row['student_Id'] . "</td>";
                                        echo "<td>" . $row['student_name'] . "</td>";
                                        echo "<td>" . $row['book_title'] . "</td>";
                                        echo "<td>" . $row['level_year'] . "</td>";
                                        echo "<td>" . $row['book_id'] . "</td>";
                                        echo "<td>" . $row['number'] . "</td>";
                                        echo "<td>" . $row['getBook_at'] ."</td>";
                                        // echo "<td>"; 
                                        //         echo '<a href="delete.php?id='. $row['student_Id'] . $row['number'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        // echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                        } else{
                            echo '<div class="alert alert-danger"><em>No records found.</em></div>';
                             }
                    ?>
                </div>
            </div>        
        </div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>