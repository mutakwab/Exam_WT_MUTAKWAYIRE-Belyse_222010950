<?php
include('db_connection.php');

// Check if CertificateID is set
if(isset($_REQUEST['CertificateID'])) {
    $certificate_id = $_REQUEST['CertificateID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM user_certificates WHERE CertificateID=?");
    $stmt->bind_param("i", $certificate_id);
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
            <input type="hidden" name="certificate_id" value="<?php echo $certificate_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='user_certificates.php'>OK</a>";
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
    echo "CertificateID is not set.";
}

$connection->close();
?>
