<?php
include('db_connection.php');

// Check if progress id is set
if(isset($_REQUEST['progress_id'])) {
    $progress_id = $_REQUEST['progress_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM course_progress_tracking WHERE ProgressID=?");
    $stmt->bind_param("i", $progress_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="progress_id" value="<?php echo $progress_id; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='course_progress_tracking.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php
    $stmt->close();
} else {
    echo "Progress ID is not set.";
}

$connection->close();
?>
