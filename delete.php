<?php
// delete.php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $studentID = $_POST['studentID'];
    $courseCode = $_POST['courseCode'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM CourseTable WHERE StudentID = ? AND CourseCode = ?");
    $stmt->bind_param("is", $studentID, $courseCode);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p>Record deleted successfully!</p>";
    } else {
        echo "<p>No records deleted. Please check the Student ID and Course Code.</p>";
    }
}
?>
