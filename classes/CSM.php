<?php

class CSM
{
    private $name;
    private $passing_grade = 7;
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
                if ($s->get_average_grade() >= $this->passing_grade)
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
                                            final_result = ?
                                        WHERE
                                            student_id = ?');
                $ps -> bind_param("si", $s -> get_final_result(), $student_id);
                $ps -> execute();
                $ps -> close();

                echo "<pre>";
                echo json_encode($s);
                echo "</pre>";
            }
        }
    }

    function add_student($student)
    {
        array_push($this -> students, $student);
    }


}
