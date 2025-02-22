<?php
// add_course.php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addCourse'])) {
    $studentID = $_POST['studentID'];
    $courseCode = $_POST['courseCode'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $test3 = $_POST['test3'];
    $finalExam = $_POST['finalExam'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO CourseTable (StudentID, CourseCode, Test1, Test2, Test3, FinalExam) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isdddd", $studentID, $courseCode, $test1, $test2, $test3, $finalExam);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p>New course added successfully!</p>";
    } else {
        echo "<p>Failed to add new course. Please check the input data.</p>";
    }
}
?>
