<?php
session_start();

// Connect to the database (similar to your existing code)
$servername = "localhost";
$username = "root";
$password = "";
$database = "sem_exam";
$con = mysqli_connect($servername, $username, $password, $database);
if (!$con) {
    die("Error in connecting" . mysqli_error($con));
}

if (isset($_POST['update'])) {
    // Retrieve data from the form
    $studentId = $_POST['student_id'];
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $Tamil = $_POST['Tamil'];
    $English = $_POST['English'];
    $CTPS = $_POST['CTPS'];
    $Maths = $_POST['Maths'];
    $ITES = $_POST['ITES'];
    $Economics = $_POST['Economics'];
    $CTPS_LAB = $_POST['CTPS_LAB'];
    $ITES_LAB = $_POST['ITES_LAB'];
    $EE_1 = $_POST['EE_1'];
    $Crop = $_POST['Crop'];
    $EA_LAB = $_POST['EA_LAB'];
    $cgpa = $_POST['cgpa'];
    
    // Use prepared statements to prevent SQL injection
    $updateQuery = "UPDATE sem1 SET 
                    roll_no = ?, 
                    name = ?, 
                    Tamil= ?, 
                    English = ?, 
                    CTPS = ?, 
                    Maths = ?, 
                    ITES = ?, 
                    Economics = ?, 
                    CTPS_LAB = ?, 
                    ITES_LAB = ?, 
                    EE_1 = ?, 
                    Crop = ?,
                    EA_LAB = ?,
                    cgpa = ?
                    WHERE id = ?";

    $stmt = mysqli_prepare($con, $updateQuery);
    
    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ssssssssssssssi", $roll_no, $name, $Tamil, $English, $CTPS, $Maths, $ITES, $Economics, $CTPS_LAB, $ITES_LAB, $EE_1, $Crop, $EA_LAB,$cgpa, $studentId);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success_message'] = "Student Grades updated successfully.";
        } else {
            $_SESSION['error_message'] = "Error updating student details: " . mysqli_error($con);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error_message'] = "Error preparing statement: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);

    // Redirect back to the details page
    header("Location: sem1.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
