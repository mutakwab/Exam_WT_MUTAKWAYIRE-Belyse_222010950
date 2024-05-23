<?php
include('db_connection.php');

// Check if ResourceID is set
if(isset($_REQUEST['ResourceID'])) {
    $resourceID = $_REQUEST['ResourceID'];
   
    $stmt = $connection->prepare("SELECT * FROM web_development_resources WHERE ResourceID=?");
    $stmt->bind_param("i", $resourceID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['Title'];
        $description = $row['Description'];
        $link = $row['Link'];
    } else {
        echo "Resource not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Web Development Resource</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update web development resource form -->
    <h2><u>Update Form of Web Development Resource</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
        <br><br>

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
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
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    
    // Update the web development resource in the database
    $stmt = $connection->prepare("UPDATE web_development_resources SET Title=?, Description=?, Link=? WHERE ResourceID=?");
    $stmt->bind_param("sssi", $title, $description, $link, $resourceID);
    $stmt->execute();
  
    // Redirect to web_development_resources.php
    header('Location: web_development_resources.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
