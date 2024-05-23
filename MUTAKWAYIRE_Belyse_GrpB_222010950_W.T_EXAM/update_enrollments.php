<?php
include('db_connection.php');

// Check if EnrollmentID is set
if(isset($_REQUEST['EnrollmentID'])) {
    $enrollmentID = $_REQUEST['EnrollmentID'];
   
    $stmt = $connection->prepare("SELECT * FROM enrollments WHERE EnrollmentID=?");
    $stmt->bind_param("i", $enrollmentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['UserID'];
        $courseID = $row['CourseID'];
        $enrollmentDate = $row['EnrollmentDate'];
    } else {
        echo "Enrollment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Enrollment</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update enrollment form -->
    <h2><u>Update Form of Enrollment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="userID">User ID:</label>
        <input type="number" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
        <br><br>

        <label for="courseID">Course ID:</label>
        <input type="number" name="courseID" value="<?php echo isset($courseID) ? $courseID : ''; ?>">
        <br><br>

        <label for="enrollmentDate">Enrollment Date:</label>
        <input type="date" name="enrollmentDate" value="<?php echo isset($enrollmentDate) ? $enrollmentDate : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $userID = $_POST['userID'];
    $courseID = $_POST['courseID'];
    $enrollmentDate = $_POST['enrollmentDate'];
    
    // Update the enrollment in the database
    $stmt = $connection->prepare("UPDATE enrollments SET UserID=?, CourseID=?, EnrollmentDate=? WHERE EnrollmentID=?");
    $stmt->bind_param("iisi", $userID, $courseID, $enrollmentDate, $enrollmentID);
    $stmt->execute();
  
    // Redirect to enrollments.php
    header('Location: enrollments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
