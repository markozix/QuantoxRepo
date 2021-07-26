<?php
include '../database/db_conn.php';
require_once "../classes/Student.php";
require_once "../classes/CSM.php";
require_once  "../classes/CSMB.php";
error_reporting(0);

$id = $_GET['id'];

$res = $conn -> query('SELECT * FROM Student WHERE student_id = '.$id);

$row = $res -> fetch_assoc();

$student = new Student($row['name'], $row['grades']);
$grades = $student->get_grades();
$avg = $student->calculate_avg_grade($grades);
$student -> set_average_grade($avg);

$student -> set_student_id($id);

$csm = new CSM("CSM Board");
$csm -> add_student($student);
$csm -> did_student_pass($student -> student_id, $conn);