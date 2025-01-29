<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password']; 
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $blood_group = $_POST['blood_group'];
    $medical_history = $_POST['medical_history'];

    // Store user in USER table
    $sql_user = "INSERT INTO USER (Name, Password) VALUES (?, ?)";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("ss", $name, $password);
    
    if ($stmt_user->execute()) {
        $user_id = $stmt_user->insert_id;

        // Store user details in MEMBER table
        $sql_member = "INSERT INTO MEMBER (member_id, gender, age, blood_group, medical_history) VALUES (?, ?, ?, ?, ?)";
        $stmt_member = $conn->prepare($sql_member);
        $stmt_member->bind_param("isiss", $user_id, $gender, $age, $blood_group, $medical_history);
        
        if ($stmt_member->execute()) {

            // ✅ Automatically Add the New User to the Donor Table
            $sql_donor = "INSERT INTO donor (D_ID) VALUES (?)";
            $stmt_donor = $conn->prepare($sql_donor);
            $stmt_donor->bind_param("i", $user_id);
            $stmt_donor->execute();
			// ✅ Automatically Add the New User to the Patient Table
			$sql_patient = "INSERT INTO patient (P_ID) VALUES (?)";
			$stmt_patient = $conn->prepare($sql_patient);
			$stmt_patient->bind_param("i", $user_id);
			$stmt_patient->execute();
            
            // ✅ Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            echo "Error in member registration: " . $stmt_member->error;
        }
    } else {
        echo "Error in user registration: " . $stmt_user->error;
    }
}
?>
