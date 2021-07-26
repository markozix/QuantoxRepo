<?php

include "../database/db_conn.php";
require_once "../classes/Student.php";
require_once "../classes/CSM.php";
require_once  "../classes/CSMB.php";

error_reporting(0);


echo '<pre>';
echo '<a href="./csm_page.php?id=">CSM Board</a><br><br>';
echo '<a href="./csmb_page.php?id=">CSMB Board</a>';
echo '</pre>';

$grades = "1,5,3,3,6,88,0,0";

$student = new Student("Joco", $grades);

$arr = explode(",", $student->get_grades());
foreach($arr as $a)
{
    if($a > 2) continue;
    echo $a;
}


//$csm = new CSM("CSM Board");
//$csmb = new CSMB("CSMB Board");
//
//$conn -> query('INSERT INTO
//                         Student(name, grades, avg_grade)
//                       VALUES(
//                       "'.$student->get_name().'",
//                       "'.$grades.'",
//                       "'.$student->get_average_grade().'")
//                                ');
//
//$last_id = $conn->insert_id;
//$student -> set_student_id($last_id);
//
//$csm -> add_student($student);
//
//$csm -> did_student_pass($last_id, $conn);

