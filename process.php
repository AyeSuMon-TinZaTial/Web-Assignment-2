

<?php
session_start();
include 'connect.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id      = $_POST['ID']?? '';
    $name    = $_POST['Name'] ?? '';
    $mobile  = $_POST['Mobile'] ?? '';
    $email   = $_POST['Email'] ?? '';
    $gender  = $_POST['Gender'] ?? '';
    $department = $_POST['Department'] ?? [];
    $dept_json  = json_encode($department);
    $address = $_POST['Address'] ?? '';

    if (!empty($id)) {
        // --- UPDATE existing record ---
        $sql = "UPDATE registered_students 
                   SET Name = ?, Mobile = ?, Email = ?, Gender = ?, Department = ?, Address = ?
                 WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $name, $mobile, $email, $gender, $dept_json, $address, $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Record updated successfully";
        } else {
            $_SESSION['message'] = "Error updating record: " . $stmt->error;
        } 
        header("Location: process.php");
        exit;

    } else {
        // --- INSERT new record ---
        $sql = "INSERT INTO registered_students (Name, Mobile, Email, Gender, Department, Address) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $name, $mobile, $email, $gender, $dept_json, $address);

        if ($stmt->execute()) {
            $_SESSION['message'] = "New record created successfully";
        } else {
            $_SESSION['message'] = "Error inserting record: " . $stmt->error;
        }
        header("Location: process.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Processing Request</title>
</head>
<body>
    <?php if (!empty($message)): ?>
        <h2><?= htmlspecialchars($message) ?></h2>
    

    <a href="home.php">Back to Registration</a><br>
    <a href="view.php">View All Registrations</a>

    <?php elseif (empty($message)): ?>
        <h2>New Record created successfully</h2>
    
     <a href="home.php">Back to Registration</a><br>
    <a href="view.php">View All Registrations</a>

    <?php endif; ?>
</body>
</html>

