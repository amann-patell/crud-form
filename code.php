<?php
session_start();
require 'dbcon.php';

// Code for admin login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'root' && $password == 'password') {
        $_SESSION['message'] = "Login Successfull!";
        $_SESSION['user_name'] = $username;
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Wrong Credentials!";
        // $_SESSION['user_name'] = $username;
        header("Location: login.php");
        exit(0);
    }
}

// Delete Button Code
if (isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);
    $query = "DELETE FROM students WHERE id = '$student_id'";
    $query_run =  mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Couldn't be Deleted";
        header("Location: index.php");
        exit(0);
    }
}

// Update Button Code
if (isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    $query = "UPDATE students SET name = '$name', email='$email', phone='$phone', course='$course' 
                WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: index.php");
        exit(0);
    }
}

// Save Button Code
if (isset($_POST['save_student'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    $query = "INSERT INTO students (name,email,phone,course) VALUES('$name','$email','$phone','$course')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: student-create.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}
