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

// Retrieve staff ID from URL parameter (e.g., staff_edit.php?id=123)
$staff_id = $_GET["id"];

// Retrieve existing staff data based on staff ID
$sql = "SELECT * FROM staff WHERE staff_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $staff_id);
$stmt->execute();
$result = $stmt->get_result();
$staff_data = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $position = $_POST["position"];
    // ... other staff attributes

    // Update staff record in the database
    $sql_update = "UPDATE staff SET name = ?, position = ? WHERE staff_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssi", $name, $position, $staff_id);
    if ($stmt_update->execute()) {
        echo "Staff record updated successfully.";
    } else {
        echo "Error updating staff record: " . $stmt_update->error;
    }
}

// Display the HTML form with populated data
?>

<!-- HTML form -->
<form method="post">
    <input type="hidden" name="staff_id" value="<?= $staff_id ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?= $staff_data['name'] ?>">
    <!-- Other input fields for position, contact details, etc. -->
    <button type="submit">Save Changes</button>
</form>

<?php
// Close the database connection
$conn->close();
?>