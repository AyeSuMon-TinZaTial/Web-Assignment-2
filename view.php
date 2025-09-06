<!-- Abraham -->
 
<?php
session_start();
include 'connect.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$student = [];

// --- Handle Update ---
if (isset($_POST['update'])) {
    $id        = (int)$_POST['ID'];
    $name      = trim($_POST['Name'] ?? '');
    $mobile    = trim($_POST['Mobile'] ?? '');
    $email     = trim($_POST['Email'] ?? '');
    $gender    = $_POST['Gender'] ?? '';
    $department= $_POST['Department'] ?? [];
    $dept_json = json_encode($department);
    $address   = trim($_POST['Address'] ?? '');

    $update_sql = "UPDATE registered_students 
                   SET Name=?, Mobile=?, Email=?, Gender=?, Department=?, Address=?
                   WHERE ID=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssi", $name, $mobile, $email, $gender, $dept_json, $address, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Record updated successfully";
        header("Location: process.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

// --- If ID is given, fetch single student for editing ---
if (!empty($id)) {
    $sql = "SELECT * FROM registered_students WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Student not found.");
    }
    $student = $result->fetch_assoc();
    $departments = json_decode($student['Department'], true) ?? [];
} else {
    // --- Fetch all students ---
    $sql = "SELECT ID, Name, Mobile, Email, Gender, Department, Address 
            FROM registered_students ORDER BY ID DESC";
    $result = $conn->query($sql);

    $students = [];
    if ($result && $result->num_rows > 0) {
        $students = $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Records</title>
  <!-- CSS CDN Link in Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- JS CDN Link in Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <style>
        h2 { margin-left:15px; margin-top: 8px;}
      form { display:block; margin-left:15px; }

       </style>

</head>
 
<body>

<?php if (!empty($id)): ?>
    <!-- Edit form -->
    <h2>Edit Student Record</h2><br>
    <form action="view.php" method="post" >
        <input type="hidden" name="ID" value="<?= $student['ID'] ?>">

        
            <label> Student Name:</label>
            <input type="text" name="Name" 
                   value="<?= htmlspecialchars($student['Name']) ?>" required>
                   <br><br>
       

        <label>Mobile no: +95-</label>
            <input type="text" name="Mobile"
                   value="<?= htmlspecialchars($student['Mobile']) ?>" required>
            <br><br>
       

        <label>Email:</label>
            <input type="email" name="Email"
                   value="<?= htmlspecialchars($student['Email']) ?>" required>
            <br><br>
       


            <label>Gender:</label>
            <input type="radio" name="Gender" value="Male" <?= $student['Gender']=="Male"?"checked":"" ?>> Male
            <input type="radio" name="Gender" value="Female" <?= $student['Gender']=="Female"?"checked":"" ?>> Female
            <br><br>
       

        
            <label>Department</label><br>
            <input type="checkbox" name="Department[]" value="English" <?= in_array("English",$departments)?"checked":"" ?>> English
            <input type="checkbox" name="Department[]" value="Computer" <?= in_array("Computer",$departments)?"checked":"" ?>> Computer
            <input type="checkbox" name="Department[]" value="Business" <?= in_array("Business",$departments)?"checked":"" ?>> Business
            <br><br>
       

            <label>Address</label><br>
            <textarea name="Address" rows="4" cols="50"><?= htmlspecialchars($student['Address']) ?></textarea>
            <br><br>
       
        <button type="submit" name="update" >Update Record</button>
        <br><br>
        <a href="view.php" >Cancel and Go Back to List</a>
    </form>

<?php else: ?>
    <!-- Student list -->
    <h2>Registered Students</h2><br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($students)): ?>
            <?php foreach ($students as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['ID']) ?></td>
                    <td><?= htmlspecialchars($row['Name']) ?></td>
                    <td><?= htmlspecialchars($row['Mobile']) ?></td>
                    <td><?= htmlspecialchars($row['Email']) ?></td>
                    <td><?= htmlspecialchars($row['Gender']) ?></td>
                    <td><?= htmlspecialchars($row['Department']) ?></td>
                    <td><?= htmlspecialchars($row['Address']) ?></td>
                    <td>
                        <a href="view.php?id=<?= $row['ID'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8">No students registered.</td></tr>
        <?php endif; ?>
    </table>

    <a href="home.php" >Back to Registration</a>
<?php endif; ?>

</body>
</html>