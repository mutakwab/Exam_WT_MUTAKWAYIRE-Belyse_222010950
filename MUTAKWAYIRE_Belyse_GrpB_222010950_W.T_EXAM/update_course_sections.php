<?php
include('db_connection.php');

// Check if SectionID is set
if(isset($_REQUEST['SectionID'])) {
    $sectionID = $_REQUEST['SectionID'];
   
    $stmt = $connection->prepare("SELECT * FROM course_sections WHERE SectionID=?");
    $stmt->bind_param("i", $sectionID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $courseID = $row['CourseID'];
        $title = $row['Title'];
        $description = $row['Description'];
    } else {
        echo "Section not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course Sections</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update sections form -->
    <h2><u>Update Form of Course Sections</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="courseID">Course ID:</label>
        <input type="number" name="courseID" value="<?php echo isset($courseID) ? $courseID : ''; ?>">
        <br><br>

        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
        <br><br>

        <label for="description">Description:</label>
        <textarea name="description"><?php echo isset($description) ? $description : ''; ?></textarea>
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $courseID = $_POST['courseID'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Update the section in the database
    $stmt = $connection->prepare("UPDATE course_sections SET CourseID=?, Title=?, Description=? WHERE SectionID=?");
    $stmt->bind_param("issi", $courseID, $title, $description, $sectionID);
    $stmt->execute();
  
    // Redirect to course_sections.php
    header('Location: course_sections.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
