<?php
include('db_connection.php');

// Check if FeedbackID is set
if(isset($_REQUEST['FeedbackID'])) {
    $feedbackID = $_REQUEST['FeedbackID'];
   
    $stmt = $connection->prepare("SELECT * FROM course_feedback WHERE FeedbackID=?");
    $stmt->bind_param("i", $feedbackID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $courseID = $row['CourseID'];
        $userID = $row['UserID'];
        $feedback = $row['Feedback'];
        $feedbackDate = $row['FeedbackDate'];
    } else {
        echo "Feedback not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Feedback</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update feedback form -->
    <h2><u>Update Form of Feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="courseID">Course ID:</label>
        <input type="number" name="courseID" value="<?php echo isset($courseID) ? $courseID : ''; ?>">
        <br><br>

        <label for="userID">User ID:</label>
        <input type="number" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
        <br><br>

        <label for="feedback">Feedback:</label>
        <textarea name="feedback"><?php echo isset($feedback) ? $feedback : ''; ?></textarea>
        <br><br>
 
        <label for="feedbackDate">Feedback Date:</label>
        <input type="date" name="feedbackDate" value="<?php echo isset($feedbackDate) ? $feedbackDate : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $courseID = $_POST['courseID'];
    $userID = $_POST['userID'];
    $feedback = $_POST['feedback'];
    $feedbackDate = $_POST['feedbackDate'];
    
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE course_feedback SET CourseID=?, UserID=?, Feedback=?, FeedbackDate=? WHERE FeedbackID=?");
    $stmt->bind_param("iissi", $courseID, $userID, $feedback, $feedbackDate, $feedbackID);
    $stmt->execute();
  
    // Redirect to course_feedback.php
    header('Location: course_feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
