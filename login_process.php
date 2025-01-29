<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Displaying input for debugging
    echo "Username: $username <br>";
    echo "Password: $password <br>";

    // Prepare a query for both admins and members
    $stmt = $conn->prepare("
        SELECT * FROM user 
        WHERE BINARY Name = ? AND BINARY Password = ?
    ");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any result was returned
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['name'] = $user['Name'];
        $_SESSION['user_id'] = $user['User_id'];

        echo "Login successful! Redirecting...<br>";
		
        if ($user['User_id'] == 101 || $user['User_id'] == 102) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            header("Location: member_dashboard.php");
            exit();
        }
    } else {
        echo "<script>alert('Invalid login credentials! Please try again.'); window.location.href='login.php';</script>";
        exit();
    }
}
?>
