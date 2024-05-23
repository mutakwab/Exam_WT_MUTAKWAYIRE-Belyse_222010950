<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>user certificates entity Page</title>
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
  <h1><u> User Certificate Form </u></h1>
<form method="post" onsubmit="return confirmInsert();">
   <!-- CertificateID UserID CourseID IssueDate -->
    <label for="certificateId">Certificate ID:</label>
    <input type="number" id="certificateId" name="certificateId"><br><br>

    <label for="userId">User ID:</label>
    <input type="number" id="userId" name="userId" required><br><br>

    <label for="courseId">Course ID:</label>
    <input type="number" id="courseId" name="courseId" required><br><br>

    <label for="issueDate">Issue Date:</label>
    <input type="date" id="issueDate" name="issueDate" required><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO user_certificates(CertificateID, UserID, CourseID, IssueDate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $certificateId, $userId, $courseId, $issueDate);
    // Set parameters and execute
    $certificateId = $_POST['certificateId'];
    $userId = $_POST['userId'];
    $courseId = $_POST['courseId'];
    $issueDate = $_POST['issueDate'];
   
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
    <title>User Certificates</title>
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
    <center><h2>Table of User Certificates</h2></center>
    <table border="5">
        <tr>
            <th>Certificate ID</th>
            <th>User ID</th>
            <th>Course ID</th>
            <th>Issue Date</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('db_connection.php');

        // Prepare SQL query to retrieve all user certificates
        $sql = "SELECT * FROM user_certificates";
        $result = $connection->query($sql);

        // Check if there are any user certificates
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $certificateId = $row['CertificateID']; // Fetch the CertificateID
                echo "<tr>
                    <td>" . $row['CertificateID'] . "</td>
                    <td>" . $row['UserID'] . "</td>
                    <td>" . $row['CourseID'] . "</td>
                    <td>" . $row['IssueDate'] . "</td>
                    <td><a style='padding:4px' href='delete_certificates.php?CertificateID=$certificateId'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_certificates.php?CertificateID=$certificateId'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
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
