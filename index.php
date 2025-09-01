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
        <input type="text" name="fname" placeholder="First Name" >
        -
        <input type="text" name="lname" placeholder="Last Name" >
        <br><br>
        Father's name:
        <input type="text" name="father" >
        <br><br>
        Date of birth:
        <input type="number" name="day" min="1" max="31" placeholder="Day" >
        -
        <input type="number" name="month" min="1" max="12" placeholder="Month" >
        -
        <input type="number" name="year" min="1900" max="2025" placeholder="Year" >
        (DD-MM-YYYY)
        <br><br>
        Mobile no.: +95-
        <input type="text" name="mobile"  >
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" ><br><br>

        <label>Password:</label>
        <input type="password" name="password" ><br><br>

        <label>Gender: </label>
        <input type="radio" name="gender" value="Male" > Male
        <input type="radio" name="gender" value="Female" > Female
        <br><br>

      <label>Department:</label><br>
        <input type="checkbox" name="department[]" value="English"> English
        <input type="checkbox" name="department[]" value="Computer"> Computer
        <input type="checkbox" name="department[]" value="Business"> Business<br><br>

        Course: <select name="course" style="background-color: lightgrey;" >
            <option value="select_course">Select Course</option>
            <option value="html/css">HTML/CSS</option>
            <option value="ai">AI</option>
            <option value="php">PHP</option>
            </select><br><br>

        City: <input type="text" name="city" ><br><br>

        Address: <br><textarea name="address" rows="4" cols="50" ></textarea><br><br> 

        <input type="submit" value="Register">
    </form>
</body>
</html>
