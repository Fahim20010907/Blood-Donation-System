<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Verify admin credentials using USER table
    $sql = "SELECT U.User_id, U.Name, U.Password 
            FROM USER U 
            INNER JOIN ADMIN A ON U.User_id = A.Admin_id 
            WHERE U.Name = ? AND U.Password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['logged_in'] = true;
        $_SESSION['role'] = 'admin';
        $_SESSION['username'] = $name;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Login failed
        echo "<script>alert('Invalid credentials'); window.location.href='admin_login.php';</script>";
    }
}
?>
