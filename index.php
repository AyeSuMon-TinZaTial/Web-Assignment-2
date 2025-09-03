<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Form</title>
</head>
<body>
    <h2>Student Registration Form</h2>
    <form action="process.php" method="post">

        <input type="hidden" name="form" value="unsubmitted">
        Student name:
        <input type="text" name="name" placeholder="Name" >
        <br><br>

        Mobile no.: +95-
        <input type="text" name="mobile"  >
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" >
        <br><br>

        <label>Gender: </label>
        <input type="radio" name="gender" value="Male" > Male
        <input type="radio" name="gender" value="Female" > Female
        <br><br>

      <label>Department:</label><br>
        <input type="checkbox" name="department[]" value="English"> English
        <input type="checkbox" name="department[]" value="Computer"> Computer
        <input type="checkbox" name="department[]" value="Business"> Business<br><br>

        Address: <br><textarea name="address" rows="4" cols="50" ></textarea><br><br> 

        <input type="submit" value="Register">
    </form>
</body>
</html>
