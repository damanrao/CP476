<?php
// update.php
require 'db_interface.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $studentID = $_POST['studentID'];
    $courseCode = $_POST['courseCode'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $test3 = $_POST['test3'];
    $finalExam = $_POST['finalExam'];

    if ($dbInterface->updateCourse($studentID, $courseCode, $test1, $test2, $test3, $finalExam)) {
        echo json_encode(["message" => "Record updated successfully"]);
    } else {
        echo json_encode(["error" => "No records updated. Please check the Student ID and Course Code."]);
    }
}
?>

