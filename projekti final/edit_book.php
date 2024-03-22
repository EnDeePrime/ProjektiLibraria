<?php
$host = "localhost";
$db = "libraria";
$user = "root";
$pass = "";

// Establish a connection to the MySQL database
$connection = new mysqli($host, $user, $pass, $db);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


   

$Book_id ="";
 
$Title= "";
$Author= "";
$Category= "";
$ISBN= "";
$Publisher= "";
$Price="";
$Publication_date="";

$errorMessage ="";


$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
// GET method - show the data of the book
    if ( !isset($_GET["id"])) { header("location:/projekti final/Admin.php");
    exit;
    
    }


$Book_id = $_GET["id"];



$sql ="SELECT * FROM books WHERE id=$id";
$result = $connection->query($sql);
$books =$result->fetch_assoc();



if (!$books) {
    header("location:projekti final/Admin.php");
    exit;
}

$Title = $books["title"];
$Author = $books["author"];
$Category = $books["category"];
$ISBN = $books["isbn"];
$Publisher = $books["publisher"];
$Price = $books["price"];
$Publication_date = $books["publication_date"];
}
else{
//Post method - Update the book data
$id =$_POST["id"];
$Title = $_POST["title"];
$Author = $_POST["author"];
$Category = $_POST["category"];
$ISBN = $_POST["isbn"];
$Publisher = $_POST["publisher"];
$Price = $_POST["price"];
$Publication_date = $_POST["publication_date"];

do{
    if (empty($id) ||empty($Title) || empty($Author) || empty($Category) || empty($ISBN) || empty($Publisher)|| empty($Price) || empty($Publication_date) ){
        $errorMessage = "All the fields are requred";
        break;
    }

$sql = "UPDATE books " . 
        "SET title = '$Title', author = '$Author', category = '$Category', isbn = '$ISBN', publisher = '$Publisher', publication_date = '$Publication_date' " . 
        "WHERE id = $id";
        $result = $connection-> query($sql); 
  if (!$result)     {$errorMessage = "Invalid query: ". $connection->error; 
        break;
  }
$succesMessage = "Book Updated Correctly";

header("location:projekti final/Admin.php");

} while (true);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</head>
<body>
    <div class= "container my-5">
        <h2>Edit Book</h2>
       
       
       
        <?php 
       if ( !empty($errorMessage) ) {
    echo "
    <div class= 'alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> 
    </div>
    ";

       }
       
       ?>
        <form method= "post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="title" value="<?php echo $Title;?>">
                </div>
            </div>
            
            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Author</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="author" value="<?php echo $Author;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Category</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="category" value="<?php echo $Category;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">ISBN</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="isbn" value="<?php echo $ISBN;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Publisher</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="publisher" value="<?php echo $Publisher;?>">
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="price" value="<?php echo $Price;?>">
                </div>
            </div>
            <div class= "row mb-3">
                <label class="col-sm-3 col-form-label">Publication_Date</label>
                <div class="col-sm-6" >
                    <input type="text" class="form-control" name="publication_date" value="<?php echo $Publication_date;?>">
                </div>
            </div>





            <div class= "row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>

                <div class=" col-sm-3 d-grid">
                    <a  class="btn btn-outline-primary" href="/projektifinal/Admin.php#book-copies" role="button" >Cancel</a>
                </div>

            </div>
        </form>
    </div>
</body>
</html>