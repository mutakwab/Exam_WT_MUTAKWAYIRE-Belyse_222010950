<?php
include('db_connection.php');

// Check if enrollment id is set
if(isset($_REQUEST['enrollment_id'])) {
    $enrollment_id = $_REQUEST['enrollment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM enrollments WHERE EnrollmentID=?");
    $stmt->bind_param("i", $enrollment_id);
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
        <input type="hidden" name="enrollment_id" value="<?php echo $enrollment_id; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='enrollments.php'>OK</a>";
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
    echo "Enrollment ID is not set.";
}

$connection->close();
?>
