<?php

class Student
{
    public $student_id;
    public $grades;
    public $name;
    public $average_grade;
    public $final_result;

    function __construct($name, $grades) {
        $this -> name = $name;

        $this -> grades = $grades;
    }

    function calculate_avg_grade($grades)
    {
        $avg = 0;
        $cnt = 0;
        $arr = explode(",", $grades);
        foreach ($arr as $a)
        {
            if($a > 4 || $a < 1)
            {
                continue;
            }
            $avg += $a;
            $cnt++;
        }
        $avg = $avg / $cnt;

        return $avg;
    }


    function  get_student_id()
    {
        return $this -> student_id;
    }

    function  set_student_id($id)
    {
        $this -> student_id = $id;
    }

    function get_grades()
    {
        return $this -> grades;
    }

    function set_grades($grades)
    {
        $this -> grades = $grades;
    }

    function get_average_grade()
    {
        return $this -> average_grade;
    }

    function set_average_grade($grade)
    {
        $this -> average_grade = $grade;
    }

    function get_final_result()
    {
        return $this -> final_result;
    }

    function set_final_result($fr)
    {
        $this -> final_result = $fr;
    }

    function get_name()
    {
        return $this -> name;
    }

}
