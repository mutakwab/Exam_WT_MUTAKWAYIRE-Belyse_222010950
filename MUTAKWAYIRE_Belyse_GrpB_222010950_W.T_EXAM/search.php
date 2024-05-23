<?php
include('db_connection.php');

// Check if a search term was provided
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Define the SQL queries to search across multiple tables
    $queries = [
        "courses" => "SELECT CourseID FROM courses WHERE CourseID LIKE '%$searchTerm%'",
        "course_feedback" => "SELECT Feedback FROM course_feedback WHERE Feedback LIKE '%$searchTerm%'",
        "course_materials" => "SELECT Type FROM course_materials WHERE Type LIKE '%$searchTerm%'",
        "course_progress_tracking" => "SELECT ProgressID FROM course_progress_tracking WHERE ProgressID LIKE '%$searchTerm%'",
        "course_ratings" => "SELECT Rating FROM course_ratings WHERE Rating LIKE '%$searchTerm%'",
        "course_sections" => "SELECT Title FROM course_sections WHERE Title LIKE '%$searchTerm%'",
        "enrollments" => "SELECT EnrollmentID FROM enrollments WHERE EnrollmentID LIKE '%$searchTerm%'",
        "instructors" => "SELECT Name FROM instructors WHERE Name LIKE '%$searchTerm%'",
        "user_certificates" => "SELECT UserID FROM user_certificates WHERE UserID LIKE '%$searchTerm%'",
        "web_development_resources" => "SELECT Title FROM web_development_resources WHERE Title LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>";
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
