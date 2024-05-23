<?php
include('db_connection.php');

// Check if InstructorID is set
if(isset($_REQUEST['InstructorID'])) {
    $instructorID = $_REQUEST['InstructorID'];
   
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE InstructorID=?");
    $stmt->bind_param("i", $instructorID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];
        $email = $row['Email'];
        $bio = $row['Bio'];
    } else {
        echo "Instructor not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Instructor</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update instructors form -->
    <h2><u>Update Form of Instructor</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>

        <label for="bio">Bio:</label>
        <textarea name="bio"><?php echo isset($bio) ? $bio : ''; ?></textarea>
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    
    // Update the instructor in the database
    $stmt = $connection->prepare("UPDATE instructors SET Name=?, Email=?, Bio=? WHERE InstructorID=?");
    $stmt->bind_param("sssi", $name, $email, $bio, $instructorID);
    $stmt->execute();
  
    // Redirect to instructors.php
    header('Location: instructors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
