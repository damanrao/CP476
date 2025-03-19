<?php
// check_session.php
session_start();

if (isset($_SESSION['studentID']) && isset($_SESSION['studentName'])) {
    echo $_SESSION['studentName'];
} else {
    echo "not_logged_in";
}
?>
