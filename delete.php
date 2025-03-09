<?php
// delete.php
require 'db_interface.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $studentID = $_POST['studentID'];
    $courseCode = $_POST['courseCode'];

    if ($dbInterface->deleteCourse($studentID, $courseCode)) {
        echo json_encode(["message" => "Record deleted successfully"]);
    } else {
        echo json_encode(["error" => "No records deleted. Please check the Student ID and Course Code."]);
    }
}
?>
