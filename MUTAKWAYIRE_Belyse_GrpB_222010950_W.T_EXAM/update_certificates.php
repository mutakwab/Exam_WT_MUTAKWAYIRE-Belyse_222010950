<?php
include('db_connection.php');

// Check if CertificateID is set
if(isset($_REQUEST['CertificateID'])) {
    $certificateID = $_REQUEST['CertificateID'];
   
    $stmt = $connection->prepare("SELECT * FROM user_certificates WHERE CertificateID=?");
    $stmt->bind_param("i", $certificateID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['UserID'];
        $courseID = $row['CourseID'];
        $issueDate = $row['IssueDate'];
    } else {
        echo "Certificate not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Certificate</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update certificate form -->
    <h2><u>Update Form of Certificate</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="userID">User ID:</label>
        <input type="number" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
        <br><br>

        <label for="courseID">Course ID:</label>
        <input type="number" name="courseID" value="<?php echo isset($courseID) ? $courseID : ''; ?>">
        <br><br>

        <label for="issueDate">Issue Date:</label>
        <input type="date" name="issueDate" value="<?php echo isset($issueDate) ? $issueDate : ''; ?>">
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
    $issueDate = $_POST['issueDate'];
    
    // Update the certificate in the database
    $stmt = $connection->prepare("UPDATE user_certificates SET UserID=?, CourseID=?, IssueDate=? WHERE CertificateID=?");
    $stmt->bind_param("iiii", $userID, $courseID, $issueDate, $certificateID);
    $stmt->execute();
  
    // Redirect to user_certificates.php
    header('Location: user_certificates.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
