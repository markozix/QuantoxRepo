<?php

class CSMB
{
    private $name;
    private $passing_grade = 8;
    private $students = array();

    function __construct($name) {
        $this -> name = $name;
    }

    function get_name()
    {
        return $this -> name;
    }

    function get_passing_grade()
    {
        return $this -> passing_grade;
    }

    function get_student_list()
    {
        return $this -> students;
    }

    function did_student_pass($student_id, $conn)
    {
        foreach ($this -> students as $s)
        {
            if($s -> get_student_id() == $student_id)
            {
                $arr_grades = explode(",", $s -> get_grades());
                sort($arr_grades);
                unset($arr_grades[0]);
                $avg = 0;
                $cnt = 0;
                foreach ($arr_grades as $a)
                {
                    if($a > 4 OR $a < 1) continue;
                    $avg += $a;
                    $cnt++;
                }
                $avg = $avg / $cnt;
                $s -> set_average_grade($avg);
                echo '---------------'.$avg.'-----------';
                if ($avg >= $this->passing_grade)
                {
                    $s->set_final_result("Pass");
                }
                else
                {
                    $s->set_final_result("Fail");
                }
                $ps = $conn -> prepare('UPDATE 
                                           Student
                                        SET 
                                            final_result = ?,
                                            avg_grade = ?
                                        WHERE
                                            student_id = ?');
                $ps -> bind_param("sii", $s -> get_final_result(), $avg, $student_id);
                $ps -> execute();
                $ps -> close();
//                header('Content-Type: application/xml');
//                $output = '<root><name>'.$s.'</name></root>';
//                print ($output);
                print_r($s);
            }
        }
    }

    function add_student($student)
    {
        array_push($this -> students, $student);
    }


}