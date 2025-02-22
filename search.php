<?php
// search.php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $studentID = $_POST['studentID'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM CourseTable WHERE StudentID = ?");
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Search Results</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Student ID</th><th>Course Code</th><th>Test 1</th><th>Test 2</th><th>Test 3</th><th>Final Exam</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["StudentID"] . "</td>";
            echo "<td>" . $row["CourseCode"] . "</td>";
            echo "<td>" . $row["Test1"] . "</td>";
            echo "<td>" . $row["Test2"] . "</td>";
            echo "<td>" . $row["Test3"] . "</td>";
            echo "<td>" . $row["FinalExam"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found for Student ID: $studentID.</p>";
    }
}
?>
