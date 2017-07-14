<?php
class SelectedModel extends RelationModel
{
       public $_link = array(
        'Course'=> array(  
                   'mapping_type'=>MANY_TO_MANY,
                   'class_name'=>'Course',
                   'foreign_key'=>'course_id',
                   'relation_foreign_key'=>'id'                   
                  ) 
       );
}
?>