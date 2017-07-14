<?php
  class SelectedViewModel extends ViewModel{
		 public $viewFields = array(
			 'Selected'=>array('stu_id','course_id'),
			 'Course'=>array('name'=>'course_name', '_on'=>'Selected.course_id=Course.id'),
			 'Student'=>array('id'=>'student_id','name'=>'student_name','major'=>'student_major','class'=>'student_class','sex'=>'student_sex','_on'=>'Selected.stu_id=Student.id'),
		 );    
  } 	
 
?>