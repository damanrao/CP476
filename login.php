<?php
// login.php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $studentID = $_POST['studentID'];
    $studentName = $_POST['studentName'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM NameTable WHERE StudentID = ? AND StudentName = ?");
    $stmt->bind_param("is", $studentID, $studentName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set session variables for logged-in user
        $_SESSION['studentID'] = $studentID;
        $_SESSION['studentName'] = $studentName;
        echo "<p>Login successful! Welcome, $studentName.</p>";
    } else {
        echo "<p>Invalid credentials! Please try again.</p>";
    }
}
?>
