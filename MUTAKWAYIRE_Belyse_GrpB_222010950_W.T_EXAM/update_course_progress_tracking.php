<?php
include('db_connection.php');

// Check if ProgressID is set
if(isset($_REQUEST['ProgressID'])) {
    $progressID = $_REQUEST['ProgressID'];
   
    $stmt = $connection->prepare("SELECT * FROM course_progress_tracking WHERE ProgressID=?");
    $stmt->bind_param("i", $progressID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $courseID = $row['CourseID'];
        $sectionID = $row['SectionID'];
        $progress = $row['Progress'];
        $lastAccessed = $row['LastAccessed'];
    } else {
        echo "Progress tracking not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course Progress Tracking</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update progress tracking form -->
    <h2><u>Update Form of Course Progress Tracking</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="courseID">Course ID:</label>
        <input type="number" name="courseID" value="<?php echo isset($courseID) ? $courseID : ''; ?>">
        <br><br>

        <label for="sectionID">Section ID:</label>
        <input type="number" name="sectionID" value="<?php echo isset($sectionID) ? $sectionID : ''; ?>">
        <br><br>

        <label for="progress">Progress:</label>
        <input type="number" name="progress" value="<?php echo isset($progress) ? $progress : ''; ?>">
        <br><br>

        <label for="lastAccessed">Last Accessed:</label>
        <input type="datetime-local" name="lastAccessed" value="<?php echo isset($lastAccessed) ? $lastAccessed : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $courseID = $_POST['courseID'];
    $sectionID = $_POST['sectionID'];
    $progress = $_POST['progress'];
    $lastAccessed = $_POST['lastAccessed'];
    
    // Update the progress tracking in the database
    $stmt = $connection->prepare("UPDATE course_progress_tracking SET CourseID=?, SectionID=?, Progress=?, LastAccessed=? WHERE ProgressID=?");
    $stmt->bind_param("iiisi", $courseID, $sectionID, $progress, $lastAccessed, $progressID);
    $stmt->execute();
  
    // Redirect to progress_tracking.php
    header('Location: course_progress_tracking.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
