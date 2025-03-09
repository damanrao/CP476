<?php
// db_interface.php
require 'db.php';

class DatabaseInterface {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addCourse($studentID, $courseCode, $test1, $test2, $test3, $finalExam) {
        $stmt = $this->conn->prepare("INSERT INTO CourseTable (StudentID, CourseCode, Test1, Test2, Test3, FinalExam) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isdddd", $studentID, $courseCode, $test1, $test2, $test3, $finalExam);
        return $stmt->execute();
    }

    public function updateCourse($studentID, $courseCode, $test1, $test2, $test3, $finalExam) {
        $stmt = $this->conn->prepare("UPDATE CourseTable SET Test1=?, Test2=?, Test3=?, FinalExam=? WHERE StudentID=? AND CourseCode=?");
        $stmt->bind_param("ddddis", $test1, $test2, $test3, $finalExam, $studentID, $courseCode);
        return $stmt->execute();
    }

    public function deleteCourse($studentID, $courseCode) {
        $stmt = $this->conn->prepare("DELETE FROM CourseTable WHERE StudentID=? AND CourseCode=?");
        $stmt->bind_param("is", $studentID, $courseCode);
        return $stmt->execute();
    }

    public function getCourses($studentID) {
        $stmt = $this->conn->prepare("SELECT * FROM CourseTable WHERE StudentID=?");
        $stmt->bind_param("i", $studentID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

$dbInterface = new DatabaseInterface($conn);
