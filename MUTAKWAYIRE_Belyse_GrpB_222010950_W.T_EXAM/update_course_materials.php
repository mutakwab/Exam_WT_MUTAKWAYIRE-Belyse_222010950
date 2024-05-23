<?php
include('db_connection.php');

// Check if MaterialID is set
if(isset($_REQUEST['MaterialID'])) {
    $materialID = $_REQUEST['MaterialID'];
   
    $stmt = $connection->prepare("SELECT * FROM course_materials WHERE MaterialID=?");
    $stmt->bind_param("i", $materialID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sectionID = $row['SectionID'];
        $type = $row['Type'];
        $link = $row['Link'];
    } else {
        echo "Material not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course Materials</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update materials form -->
    <h2><u>Update Form of Course Materials</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="sectionID">Section ID:</label>
        <input type="number" name="sectionID" value="<?php echo isset($sectionID) ? $sectionID : ''; ?>">
        <br><br>

        <label for="type">Type:</label>
        <input type="text" name="type" value="<?php echo isset($type) ? $type : ''; ?>">
        <br><br>

        <label for="link">Link:</label>
        <input type="text" name="link" value="<?php echo isset($link) ? $link : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $sectionID = $_POST['sectionID'];
    $type = $_POST['type'];
    $link = $_POST['link'];
    
    // Update the material in the database
    $stmt = $connection->prepare("UPDATE course_materials SET SectionID=?, Type=?, Link=? WHERE MaterialID=?");
    $stmt->bind_param("issi", $sectionID, $type, $link, $materialID);
    $stmt->execute();
  
    // Redirect to materials.php
    header('Location: course_materials.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
