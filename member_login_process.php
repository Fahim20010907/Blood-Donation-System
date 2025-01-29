<?php
session_start();
include 'connect.php';

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Query to check credentials using prepared statements for security
    $stmt = $conn->prepare("SELECT * FROM user WHERE name = ? AND password = ?");
    $stmt->bind_param("ss", $name, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // ✅ Fix: Correct session variable casing to match the database
        $_SESSION['name'] = $user['name'];  // Changed to lowercase
        $_SESSION['user_id'] = $user['User_id'];  // Kept as it is, assuming your DB uses User_id

        // ✅ Debugging check (Remove after verifying)
        echo "Session P_ID set: " . $_SESSION['user_id'];

        // Redirect to the member dashboard after login
        header("Location: member_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid login credentials. Please try again.'); window.location.href = 'login.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
