<?php
// calculate_grade.php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculateGrade'])) {
    $studentID = $_POST['studentID'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT NameTable.StudentName, CourseTable.CourseCode, CourseTable.Test1, CourseTable.Test2, CourseTable.Test3, CourseTable.FinalExam 
                            FROM CourseTable 
                            INNER JOIN NameTable ON CourseTable.StudentID = NameTable.StudentID 
                            WHERE CourseTable.StudentID = ? 
                            ORDER BY CourseTable.StudentID ASC");
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Final Grades</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Student ID</th><th>Student Name</th><th>Course Code</th><th>Final Grade</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $finalGrade = ($row["Test1"] * 0.2) + ($row["Test2"] * 0.2) + ($row["Test3"] * 0.2) + ($row["FinalExam"] * 0.4);
            echo "<tr>";
            echo "<td>" . $studentID . "</td>"; // Student ID from the input
            echo "<td>" . $row["StudentName"] . "</td>";
            echo "<td>" . $row["CourseCode"] . "</td>";
            echo "<td>" . number_format($finalGrade, 1) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found for Student ID: $studentID.</p>";
    }
}
?>
