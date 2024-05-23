<?php
include('db_connection.php');

// Check if CourseID is set
if(isset($_REQUEST['CourseID'])) {
    $courseID = $_REQUEST['CourseID'];
   
    $stmt = $connection->prepare("SELECT * FROM courses WHERE CourseID=?");
    $stmt->bind_param("i", $courseID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $courseID = $row['CourseID'];
        $title = $row['Title'];
        $description = $row['Description'];
        $instructorID = $row['InstructorID'];
    } else {
        echo "Course not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Course form -->
    <h2><u>Update Form of Course</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
        <br><br>

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
        <br><br>

        <label for="instructorID">Instructor ID:</label>
        <input type="number" name="instructorID" value="<?php echo isset($instructorID) ? $instructorID : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $instructorID = $_POST['instructorID'];
    
    // Update the course in the database
    $stmt = $connection->prepare("UPDATE courses SET Title=?, Description=?, InstructorID=? WHERE CourseID=?");
    $stmt->bind_param("ssii", $title, $description, $instructorID, $courseID);
    $stmt->execute();
  
    // Redirect to course.php
    header('Location: courses.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
