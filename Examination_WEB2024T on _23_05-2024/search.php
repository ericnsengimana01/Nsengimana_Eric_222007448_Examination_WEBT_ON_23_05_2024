<?php
// Include the database connection file
require_once "databaseconnection1.php";
if (isset($_GET['query'])) {
    $searchTerm = $connection->real_escape_string($_GET['query']);
    $output = "";

    $queries = [
        'attendees' => "SELECT fname, lname,email, phone, user_id, organisation, job_title,registration_date FROM attendees WHERE attendee_id LIKE '%$searchTerm%'",
        'instructors' => "SELECT fname, lname, email, bio, expertise, username, password,phone FROM instructors WHERE id LIKE '%$searchTerm%'",
        'workshops' => "SELECT workshop_name, description, instructor_id, location, registration_deadline,caurse_id FROM workshops WHERE workshop_id LIKE '%$searchTerm%'",
        'conflict_resolution_resources' => "SELECT resource_name, type, ratings, aploaded_by_instructor_id, uploaded_date, language FROM conflict_resolution_resources WHERE resource_id LIKE '%$searchTerm%'",
        'caurse' => "SELECT caurse_name, description, duration, category, instructor_id, workshop_id FROM caurse WHERE caurse_id LIKE '%$searchTerm%'",
        'lesson' => "SELECT title, caurse_id, duration, user_id FROM lesson WHERE lesson_id LIKE '%$searchTerm%'",
        'assessment' => "SELECT score, completion_status, user_id FROM assessment WHERE assessment_id LIKE '%$searchTerm%'",
        'progress' => "SELECT user_id, score, lesson_id, completion_date, completion_status FROM progress WHERE progress_id LIKE '%$searchTerm%'",
        'certificate' => "SELECT user_id, issued_date, instructor_id, is_verified, completion_caurse FROM certificate WHERE cert_id LIKE '%$searchTerm%'",
         'users' => "SELECT fname, lname,email, password, district, sector, village,role FROM users WHERE user_id LIKE '%$searchTerm%'",
    ];

    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        $output .= "<h3>Table of $table:</h3>";
        
        if ($result) {
            if ($result->num_rows > 0) {
                $output .= "<ul>";
                while ($row = $result->fetch_assoc()) {
                    $output .= "<li>";
                    foreach ($row as $key => $value) {
                        $output .= "$key: $value, ";
                    }
                    $output .= "</li>";
                }
                $output .= "</ul>";
            } else {
                $output .= "<p>No results found in $table matching the search term: '$searchTerm'</p>";
            }
        } else {
            $output .= "<p>Error executing query: " . $connection->error . "</p>";
        }
    }

    echo $output;

    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>