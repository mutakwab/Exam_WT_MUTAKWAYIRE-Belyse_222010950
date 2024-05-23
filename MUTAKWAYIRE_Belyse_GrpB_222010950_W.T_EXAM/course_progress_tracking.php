<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> course progress tracking entity Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: yellow;
      background-color: green;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: orange;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: dimgray;
    }

    /* Active link */
    a:active {
      background-color: yellow;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
      background-color: yellow;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1250px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    header{
    background-color:pink;
    padding: 20px;
}

section{
    padding:28px;
    border-bottom: 1px solid #ddd;
}
footer{
    text-align: center;
    padding: 15px;
    background-color:pink;
}
  </style>
   <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  </head>

  <header>

<body bgcolor="orange">
  <form method="GET" class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/WDCP logo.jpg" width="90" height="70" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./courses.php">Courses</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./course_feedback.php">Feedback</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./course_materials.php">Materials</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./course_progress_tracking.php">Progress Tracking</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./course_ratings.php">Ratings</a></li>

     <li style="display: inline; margin-right: 10px;"><a href="./course_sections.php">Sections</a></li>

     <li style="display: inline; margin-right: 10px;"><a href="./enrollments.php">Enrollments</a></li>

     <li style="display: inline; margin-right: 10px;"><a href="./instructors.php">Instructors</a></li>

     <li style="display: inline; margin-right: 10px;"><a href="./user_certificates.php">UserCertificates</a></li>

     <li style="display: inline; margin-right: 10px;"><a href="./web_development_resources.php">Web Development Resources</a></li>
    
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
         <a href="login.html">Change Account</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
  <center>
  <center><h1><u>Course Progress Tracking Form</u></h1></center>
<form method="post" action="process_progress.php" onsubmit="return confirmInsert();">
    <label for="progressID">Progress ID:</label>
    <input type="number" id="progressID" name="progressID" required><br><br>

    <label for="courseID">Course ID:</label>
    <input type="number" id="courseID" name="courseID" required><br><br>

    <label for="sectionID">Section ID:</label>
    <input type="number" id="sectionID" name="sectionID" required><br><br>

    <label for="progress">Progress:</label>
    <input type="text" id="progress" name="progress" required><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO course_progress_tracking(ProgressID, CourseID, SectionID, Progress) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $progressID, $courseID, $sectionID, $progress);
    // Set parameters and execute
    $progressID = $_POST['progressID'];
    $courseID = $_POST['courseID'];
    $sectionID = $_POST['sectionID'];
    $progress = $_POST['progress'];
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>






<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Course Progress Tracking</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <center><h2>Course Progress Tracking</h2></center>
  <table border="5">
    <tr>
      <th>Progress ID</th>
      <th>Course ID</th>
      <th>Section ID</th>
      <th>Progress</th>
      <th>Last Accessed</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
      include('db_connection.php');

      // Prepare SQL query to retrieve all course progress
      $sql = "SELECT * FROM course_progress_tracking";
      $result = $connection->query($sql);

      // Check if there is any course progress
      if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
          $progressID = $row['ProgressID']; // Fetch the ProgressID
          echo "<tr>
            <td>" . $row['ProgressID'] . "</td>
            <td>" . $row['CourseID'] . "</td>
            <td>" . $row['SectionID'] . "</td>
            <td>" . $row['Progress'] . "</td>
            <td>" . $row['LastAccessed'] . "</td>
            <td><a style='padding:4px' href='delete_course_progress_tracking.php?progressID=$progressID'>Delete</a></td>
            <td><a style='padding:4px' href='update_course_progress_tracking.php?progressID=$progressID'>Update</a></td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
      }
      // Close the database connection
      $connection->close();
    ?>
  </table>
  </body>
</section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy for 2024, Designer by: MUTAKWAYIRE Belyse</h2></b>
  </center>
</footer>
  
</body>
</html>
