<?php
// update.php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $studentID = $_POST['studentID'];
    $courseCode = $_POST['courseCode'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $test3 = $_POST['test3'];
    $finalExam = $_POST['finalExam'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE CourseTable SET Test1 = ?, Test2 = ?, Test3 = ?, FinalExam = ? WHERE StudentID = ? AND CourseCode = ?");
    $stmt->bind_param("dddis", $test1, $test2, $test3, $finalExam, $studentID, $courseCode);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p>Record updated successfully!</p>";
    } else {
        echo "<p>No records updated. Please check the Student ID and Course Code.</p>";
    }
}
?>
