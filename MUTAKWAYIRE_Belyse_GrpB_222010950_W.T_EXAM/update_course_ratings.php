<?php
include('db_connection.php');

// Check if RatingID is set
if(isset($_REQUEST['RatingID'])) {
    $ratingID = $_REQUEST['RatingID'];
   
    $stmt = $connection->prepare("SELECT * FROM course_ratings WHERE RatingID=?");
    $stmt->bind_param("i", $ratingID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $courseID = $row['CourseID'];
        $userID = $row['UserID'];
        $rating = $row['Rating'];
        $ratingDate = $row['RatingDate'];
    } else {
        echo "Rating not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course Ratings</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update ratings form -->
    <h2><u>Update Form of Course Ratings</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="courseID">Course ID:</label>
        <input type="number" name="courseID" value="<?php echo isset($courseID) ? $courseID : ''; ?>">
        <br><br>

        <label for="userID">User ID:</label>
        <input type="number" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
        <br><br>

        <label for="rating">Rating:</label>
        <input type="number" name="rating" value="<?php echo isset($rating) ? $rating : ''; ?>">
        <br><br>

        <label for="ratingDate">Rating Date:</label>
        <input type="date" name="ratingDate" value="<?php echo isset($ratingDate) ? $ratingDate : ''; ?>">
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
    $rating = $_POST['rating'];
    $ratingDate = $_POST['ratingDate'];
    
    // Update the rating in the database
    $stmt = $connection->prepare("UPDATE course_ratings SET CourseID=?, UserID=?, Rating=?, RatingDate=? WHERE RatingID=?");
    $stmt->bind_param("iiisi", $courseID, $userID, $rating, $ratingDate, $ratingID);
    $stmt->execute();
  
    // Redirect to course_ratings.php
    header('Location: course_ratings.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
