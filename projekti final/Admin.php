


<html>
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 1200px;
        }

        .nav-tabs {
            margin-bottom: 20px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
   
  </body>
</head>
<body>
    <!-- HTML code -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Library Management System</a>
        </div>
    </nav>
    <div class="container mt-4">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="books-tab" data-bs-toggle="tab" href="#books">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="books-tab" data-bs-toggle="tab" href="#book-copies">Book Copies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="borrowers-tab" data-bs-toggle="tab" href="#borrowers">Borrowers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="categories-tab" data-bs-toggle="tab" href="#categories">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shelves-tab" data-bs-toggle="tab" href="#shelves">Shelves</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="staff-tab" data-bs-toggle="tab" href="#staff">Staff</a>
            </li>
        </ul>
        
                    
    <div class="tab-content mt-4">
        <div class="tab-pane fade show active" id="books">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Books</h5>
                    <a class="btn btn-primary" href="create_book.php" type="button">Add Book</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Book ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>ISBN</th>
                                <th>Publisher</th>
                                <th>Publication Date</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $host = "localhost";
                            $db = "libraria";
                            $user = "root";
                            $pass = "";

                            // Establish a connection to the MySQL database
                            $conn = new mysqli($host, $user, $pass, $db);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch books from the database
                            $sql = "SELECT * FROM books";
                            $result = $conn->query($sql);

                            // Check if there are any books
                          
                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while($books = $result->fetch_assoc()) {
                                        echo "
                                        <tr>
                                      <td> $books[id]</td>
                                      <td> $books[title]</td>
                                       <td> $books[author] </td>
                                         <td> $books[category]</td>
                                       <td> $books[isbn]</td>
                                         <td> $books[publisher]</td>
                                       <td> $books[publication_date]</td>
                                        <td> $books[price]</td>
                                         <td>
                                       
                                       <a class='btn btn-primary btn-sm' href='/ProjektiFinal/edit_book.php?id=$books[id]' > Edit </a>
                                       <a class='btn btn-danger btn-sm' href='/ProjektiFinal/delete_book.php?id=$books[id]' > Delete </a>
                                        </td>
                                       </tr>
                                       ";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No books found</td></tr>";
                                }
                                
                                // Close the database connection
                                $conn->close();
                          
             
                            ?>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Similar structure for other tabs -->
        <!-- ... -->
<div class="tab-pane fade" id="borrowers">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Borrowers</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBorrowerModal">Add Borrower</button>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>First Name</th>
                        <th>Phone</th>
                        <th>Action</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $conn = new mysqli($host, $user, $pass, $db);

                     // Check connection
                     if ($conn->connect_error) {
                         die("Connection failed: " . $conn->connect_error);
                     }
                    // Assuming $conn is your database connection
                    $sql = "SELECT * FROM borrowers";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($borrower = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $borrower['borrower_id'] . "</td>";
                            echo "<td>" . $borrower['bfirst_name'] . "</td>";
                            echo "<td>" . $borrower['blast_name'] . "</td>";
                            echo "<td>" . $borrower['baddress'] . "</td>";
                            echo "<td>" . $borrower['bphone'] . "</td>";
                            echo "<td>" . $borrower['bemail'] . "</td>";
                           
                            echo "<td>";
                            echo "<a href='edit_borrower.php?id=" . $borrower['id'] . "' class='btn btn-sm btn-primary'>Edit</a> ";
                            echo "<a href='delete_borrower.php?id=" . $borrower['id'] . "' class='btn btn-sm btn-danger'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No borrowers found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="book-copies">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Book Copies</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kCopyModal">Add Book Copy</button>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Copy ID</th>
                        <th>Book ID</th>
                        <th>Shelf ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch book copies from the database
                    $sql = "SELECT * FROM book_copies"; 
                    $result = $conn->query($sql);

                    // Check if there are any book copies
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        
                        while($copy = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $copy['Copy_id'] . "</td>";
                            echo "<td>" . $copy['book_id'] . "</td>";
                            echo "<td>" . $copy['shelf_id'] . "</td>";
                            echo "<td>";
                            echo "<a href='edit_copy.php?id=" . $copy['Copy_id'] . "' class='btn btn-sm btn-primary'>Edit</a>";
                            echo "<a href='delete_copy.php?id=" . $copy['Copy_id'] . "' class='btn btn-sm btn-danger'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No book copies found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="tab-pane fade" id="categories">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Categories</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Assuming $conn is your database connection
                    $sql = "SELECT * FROM categories";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($category = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $category['id'] . "</td>";
                            echo "<td>" . $category['name'] . "</td>";
                            echo "<td>";
                            echo "<a href='edit_category.php?id=" . $category['id'] . "' class='btn btn-sm btn-primary'>Edit</a> ";
                            echo "<a href='delete_category.php?id=" . $category['id'] . "' class='btn btn-sm btn-danger'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No categories found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="tab-pane fade" id="shelves">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Shelves</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addShelfModal">Add Shelf</button>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Assuming $conn is your database connection
                    $sql = "SELECT * FROM shelves";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($shelves = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $shelves['id'] . "</td>";
                            echo "<td>" . $shelves['name'] . "</td>";
                            echo "<td>";
                        
                            echo "<a href='edit_shelves.php?id=" . $shelves['id'] . "' class='btn btn-sm btn-primary'>Edit</a> ";
                            echo "<a href='delete_shelves.php?id=" . $shelves['id'] . "' class='btn btn-sm btn-danger'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No shelves found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="tab-pane fade" id="staff">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Steaff</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">Add Staff</button>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                    
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>hire_date</th>
                        <th>salary</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Assuming $conn is your database connection
                    $sql = "SELECT * FROM staff";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($staff = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $staff['Staff_id'] . "</td>";
                            echo "<td>" . $staff['first_name'] . "</td>";
                            echo "<td>" . $staff['last_name'] . "</td>";
                            echo "<td>" . $staff['address'] . "</td>";
                            echo "<td>" . $staff['phone'] . "</td>";
                            echo "<td>" . $staff['email'] . "</td>";
                            echo "<td>" . $staff['hire_date'] . "</td>";
                            echo "<td>" . $staff['salary'] . "</td>";
                           
                            echo "<td>" ;
                            echo "<a href='edit_staff.php?id=" . $staff['Staff_id'] . "' class='btn btn-sm btn-primary'>Edit</a> ";
                            echo "<a href='delete_staff.php?id=" . $staff['Staff_id'] . "' class='btn btn-sm btn-danger'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No staff found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- ... -->
    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>