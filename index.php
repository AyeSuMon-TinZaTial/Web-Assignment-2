<!-- Aung Kaung Myat -->
 
<?php
// index.php - registration form (does NOT insert; process.php does)
include 'connect.php'; // must provide $conn (mysqli)

$id        = $_POST['ID']?? ''; 
$name       = $_POST['Name'] ?? '';
$mobile     = $_POST['Mobile'] ?? '';
$email      = $_POST['Email'] ?? '';
$gender     = $_POST['Gender'] ?? '';
$department = $_POST['Department'] ?? []; // array from checkboxes
$address    = $_POST['Address'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Registration Form</title>
    
</head>
<body>
    <h2>Student Registration Form</h2>

    <form action="process.php" method="post">
        <!-- Hidden ID (empty for new registrations) -->
        <input type="hidden" name="ID" value="<?= htmlspecialchars($id) ?>">

        Student Name:
            <input type="text" name="Name" value="<?= htmlspecialchars($name) ?>" required>
        <br><br>

        Mobile no.: +95-
            <input type="text" name="Mobile" value="<?= htmlspecialchars($mobile) ?>">
        <br><br>

        Email:
            <input type="email" name="Email" value="<?= htmlspecialchars($email) ?>">
        <br><br>

        Gender:
        <input type="radio" name="Gender" value="Male" <?= ($gender === 'Male') ? 'checked' : '' ?>> Male
        <input type="radio" name="Gender" value="Female" <?= ($gender === 'Female') ? 'checked' : '' ?>> Female
        <br><br>

        <label>Department:</label><br>
        <input type="checkbox" name="Department[]" value="English" <?= in_array('English', (array)$department) ? 'checked' : '' ?>> English
        <input type="checkbox" name="Department[]" value="Computer" <?= in_array('Computer', (array)$department) ? 'checked' : '' ?>> Computer
        <input type="checkbox" name="Department[]" value="Business" <?= in_array('Business', (array)$department) ? 'checked' : '' ?>> Business<br><br>

        <label>Address:</label><br>
            <textarea name="Address" rows="4" cols="50"><?= htmlspecialchars($address) ?></textarea>
        <br><br>

        <input type="submit" value="Register">
    </form>

    <p><a href="view.php">View All Registered Students</a></p>
</body>
</html>
