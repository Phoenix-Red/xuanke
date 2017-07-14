<?php
//以下为后台模块的操作
class IndexAction extends Action{
    function _initialize(){
    	header("Content-type:text/html;charset=utf-8");
    }
    function index(){
        $url=U("login");
    	header("Location:$url");
    }
    function login(){      //登录模块
    	$this->display();
    }
    function check_logined(){    //检测是否已经登录，注意跟下面的判断是否登录成功是不同的，这个要调用在各个页面中。
    	session_start();
    	$user=M('Admin');
    	$condition['username']=$_SESSION['username'];
    	$us=$user->where($condition)->find();
        if(!$us){$url=U('login');$this->assign("jumpUrl",$url);$this->error("还未登陆");}
    }
    function admin() {     //后台管理首页
    	$this->check_logined();
    	$date=date("Y年m月d日 H:i",time());
    	$this->assign(date,$date);
    	$this->assign('username',$_SESSION['username']);
    	$this->display();

    }
    function siteinfo(){  //后台管理的首页信息
    	$this->check_logined();
    	$this->display();
    }
    function check_login(){       //判断是否登录成功
    	session_start();
    	$user=M('Admin');
    	if(!$data=$user->create()){
    		$this->error("登录失败");
    	}
    	$condition['username']=$data['username'];
    	$us=$user->where($condition)->find();
    	if(!$us){ $this->error("用户名或者密码错误！！");}
    	if($us['password']!=md5($data['password'])){$this->error("用户名或者密码错误！！");}
    	$_SESSION['username']=$data['username'];
    	$this->assign("jumpUrl",U('admin'));
    	$this->success("登录成功");
    }
    function admin_exit(){      //退出系统
    	$this->check_logined();
    	unset($_SESSION['username']);
    	$this->assign("jumpUrl",U('login'));
    	$this->success("退出成功");
    }
    function manageStuInfo(){     //管理学生信息
    	$this->check_logined();
    	$stu=M("Student");
    	$count=$stu->count();
    	$listRows=5;
        import("ORG.Util.Page");
        $p=new Page($count,$listRows);
        $limit_options=$p->firstRow.",".$p->listRows;
    	$stu_info=$stu->order("id desc")->limit($limit_options)->findAll();
    	$page=$p->show();
    	$this->assign("page",$page);
    	$this->assign("pagestyle","green-black");
    	$this->assign("stu_info",$stu_info);
    	$this->display();
    }
    function editStuInfo(){      //编辑学生信息
            $this->check_logined();
            $stu=M("Student");
            $id=$_GET['id'];
            if(empty($id))   $this->error("参数为空");
            $stuInfo=$stu->where("id=$id")->find();
            $checked="";
            if($stuInfo[sex]=="女") $checked="checked";
            $this->assign("checked",$checked);
            $this->assign("stuInfo",$stuInfo);
            $this->display();
    }
    function updateStuInfo(){    //更新学生信息
        $this->check_logined();
        $stu=M('Student');
    	$id=$_GET['id'];
    	if(!$data=$stu->create()){
    		$this->error("修改失败");
    	}
    	if(!$stu->where("id=$id")->save($data)){
    		$this->error("修改失败");
    	}
    	$this->success("修改成功");
    }
    function deleteStuInfo(){      //删除学生信息
    	 $this->check_logined();
    	 $id=$_GET['id'];
    	 $condition['id']=$id;
    	 $stu=M('Student');
    	 if(!$stu->where($condition)->limit('1')->delete()){
    	 	$this->error("删除失败");
    	 }
    	 $selected=M("selected");
    	 if($selected_info=$selected->where("stu_id=$id")->select()){
    	 	 $selected->where("stu_id=$id")->delete();    //如果这个学生有选课信息，把该学生选课信息删除掉。
    	 	 for($i=0;$i<count($selected_info);$i++){
    	 	 	 $course_id[$i]=$selected_info[$i]['course_id'];
    	 	 }
    	 	 $course=M("Course");
    	 	 $map['id']=array("in",$course_id);
    	 	 $course->setDec("selectedMan",$map);   //并把这个学生选的课的已选人数减少一个。
    	 }
    	 $this->success("删除成功");
    }
    function importStuInfo(){    //添加学生信息，分手工添加和sql添加两种
    	$this->check_logined();
    	$this->display();
    }
    function addStuInfo(){      //手工添加学生信息
    	$this->check_logined();
    	$stu=M('Student');
    	if(!$stu->create()){
    		$this->error("添加失败");
    	}
    	if(!$stu->add()){
    		$this->error("添加失败");
    	}
    	$this->success("添加成功");
    }
    function importStuSql(){      //sql添加学生信息，这主要用于从其它数据库导出学生信息，再导入到本数据库来，注意字段跟表要构造出一致来。
    	$this->check_logined();
    	if(!empty($_FILES['sqlStuFile']['name'])) {
            // 判断文件后缀
            $pathinfo = pathinfo($_FILES['sqlStuFile']['name']);
            $ext  =   $pathinfo['extension'];
            if(!in_array($ext,array('sql','txt'))) {
                $this->error("文件格式不符合！！");
            }
            // 导入SQL文件
           $sql = file_get_contents($_FILES['sqlStuFile']['tmp_name']);
        }else{
            $this->error("请选择文件！！");
        }
           unlink($_FILES['sqlStuFile']['tmp_name']);
           if ($sql !== mb_convert_encoding(mb_convert_encoding($sql, "UTF-32", "UTF-8"), "UTF-8", "UTF-32")) {
                 $sql=iconv("gb2312","utf-8",$sql);
           }
           $check_arr=array("select","delete","drop");
           for($i=0;$i<count($check_arr);$i++){
           	    if(strchr($sql,$check_arr[$i])){$this->error("含有非法字符！！");}
           }
           $sql=str_replace("\r\n","\n",$sql);
           $sql=trim($sql);
           if((strrpos($sql,";")+1)==strlen($sql)) $sql=substr($sql,0,-1);
           $query_sql=explode(";",$sql);
           $stu=M("Student");
           foreach($query_sql as $sql){
           	     if(!$stu->execute(trim($sql))){$this->error("sql语句有误！！请仔细检查！！");}
           }
           $this->success("导入成功");
    }
    function manageTeacInfo(){     //管理教师信息
    	$this->check_logined();
    	$teac=M("Teacher");
    	$count=$teac->count();
    	$listRows=5;
        import("ORG.Util.Page");
        $p=new Page($count,$listRows);
        $limit_options=$p->firstRow.",".$p->listRows;
    	$teac_info=$teac->order("id desc")->limit($limit_options)->findAll();
    	$page=$p->show();
    	$this->assign("page",$page);
    	$this->assign("pagestyle","green-black");
    	$this->assign("teac_info",$teac_info);
    	$this->display();
    }
    function editTeacInfo(){      //编辑教师信息
            $this->check_logined();
            $teac=M("Teacher");
            $id=$_GET['id'];
            if(empty($id))   $this->error("参数为空");
            $teacInfo=$teac->where("id=$id")->find();
            $checked="";
            if($teacInfo[sex]=="女") $checked="checked";
            $this->assign("checked",$checked);
            $this->assign("teacInfo",$teacInfo);
            $this->display();
    }
    function updateTeacInfo(){       //更新教师信息
        $this->check_logined();
        $teac=M('Teacher');
    	$id=$_GET['id'];
    	if(!$data=$teac->create()){
    		$this->error("修改失败");
    	}
    	if(!$teac->where("id=$id")->save($data)){
    		$this->error("修改失败");
    	}
    	$this->success("修改成功");
    }
    function deleteTeacInfo(){      //删除教师信息
    	 $this->check_logined();
    	 $id=$_GET['id'];
    	 $teac=M('Teacher');
    	 $teac_info=$teac->where("id=$id")->find();
    	 if(!$teac->where("id=$id")->limit('1')->delete()){
    	 	$this->error("删除失败");
    	 }
         $course=M("Course");
         if($course_info=$course->where("teacher_id=$id")->select()){
         	 $course->where("teacher_id=$id")->delete();      //如果这个老师有发布课程，把它删除掉。
         	 for($i=0;$i<count($course_info);$i++){
         	 	$course_id[$i]=$course_info[$i]['id'];
         	 }
         	 $map['course_id']=array("in",$course_id);
         	 $selected=M("selected");
         	 if($selected->where($map)->select()){
         	 	$selected->where($map)->delete();  //如果有学生选了这个老师的课，把选课信息删除掉。
         	 }
         }
    	 $this->success("删除成功");
    }
    function importTeacInfo(){    //添加教师信息，分手工添加和sql添加两种
    	$this->check_logined();
    	$this->display();
    }
    function addTeacInfo(){     //手工添加教师信息
    	$this->check_logined();
    	$teac=M('Teacher');
    	if(!$teac->create()){
    		$teac->error("添加失败");
    	}
    	if(!$teac->add()){
    		$this->error("添加失败");
    	}
    	$this->success("添加成功");
    }
    function importTeacSql(){     //sql添加教师信息
    	$this->check_logined();
    	if(!empty($_FILES['sqlTeacFile']['name'])) {
            // 判断文件后缀
            $pathinfo = pathinfo($_FILES['sqlTeacFile']['name']);
            $ext  =   $pathinfo['extension'];
            if(!in_array($ext,array('sql','txt'))) {
                $this->error("文件格式不符合！！");
            }
            // 导入SQL文件
           $sql = file_get_contents($_FILES['sqlTeacFile']['tmp_name']);
        }else{
            $this->error("请选择文件！！");
        }
           unlink($_FILES['sqlTeacFile']['tmp_name']);
           if ($sql !== mb_convert_encoding(mb_convert_encoding($sql, "UTF-32", "UTF-8"), "UTF-8", "UTF-32")) {
                 $sql=iconv("gb2312","utf-8",$sql);
           }
           $check_arr=array("select","delete","drop");
           for($i=0;$i<count($check_arr);$i++){
           	    if(strchr($sql,$check_arr[$i])){$this->error("含有非法字符！！");}
           }
           $sql=str_replace("\r\n","\n",$sql);
           $sql=trim($sql);
           if((strrpos($sql,";")+1)==strlen($sql)) $sql=substr($sql,0,-1);
           $query_sql=explode(";",$sql);
           $teac=M("Teacher");
           foreach($query_sql as $sql){
           	     if(!$teac->execute(trim($sql))){$this->error("sql语句有误！！请仔细检查！！");}
           }
           $this->success("导入成功");
    }
       function manageCourseInfo(){     //管理课程信息
        $this->check_logined();
        session_start();
        $course=M("Course");
        $count=$course->count();
        $listRows=5;
        import("ORG.Util.Page");
        $p=new Page($count,$listRows);
        $limit_options=$p->firstRow.",".$p->listRows;
        $course_info=$course->order("teacher_id asc")->limit($limit_options)->findAll();
        $displaypage=0;
        if(count($course_info)>0) $displaypage=1;  //如果有课程信息才显示分页。
        $page=$p->show();
        $this->assign("displaypage",$displaypage);
        $this->assign("page",$page);
        $this->assign("pagestyle","green-black");
        $this->assign("course_info",$course_info);
        $this->display();
    }  
    function deleteCourseInfo(){         //删除课程信息
        $this->check_logined();
        $id=$_GET['id'];
        $course=M("Course");
        if(!$course->delete($id)) $this->error("删除失败");
        $selected=M("selected");
        if($selected->where("course_id=$id")->find()){     //如果有学生选了这门课，那么选课信息中也要删除掉选了这门课的学生。
            if(!$selected->where("course_id=$id")->delete()) $this->error("删除失败");
        }
        $url=U("manageCourseInfo");
        $this->assign("jumpUrl",$url);
        $this->success("删除成功");
    }
        function editCourseInfo(){      //编辑课程信息
        $this->check_logined();
        $id=$_GET['id'];
        $course=M("Course");
        $course_info=$course->find($id);
        $time_arr=explode(",",$course_info['time']);
        switch($time_arr[0]){       //获取星期几上课
            case "星期一":$week1="selected";$this->assign("week1",$week1);break;
            case "星期二":$week2="selected";$this->assign("week2",$week2);break;
            case "星期三":$week3="selected";$this->assign("week3",$week3);break;
            case "星期四":$week4="selected";$this->assign("week4",$week4);break;
            case "星期五":$week5="selected";$this->assign("week5",$week5);break;
            case "星期六":$week6="selected";$this->assign("week6",$week6);break;
            case "星期日":$week7="selected";$this->assign("week7",$week7);break;
        }
        switch($time_arr[1]){   //获取第几节上课
            case "1--2":$jie1="selected";$this->assign("jie1",$jie1);break;
            case "2--3":$jie2="selected";$this->assign("jie2",$jie2);break;
            case "3--4":$jie3="selected";$this->assign("jie3",$jie3);break;
            case "5--6":$jie4="selected";$this->assign("jie4",$jie4);break;
            case "6--7":$jie5="selected";$this->assign("jie5",$jie5);break;
            case "7--8":$jie6="selected";$this->assign("jie6",$jie6);break;
            case "9--10":$jie7="selected";$this->assign("jie7",$jie7);break;
            case "10--11":$jie8="selected";$this->assign("jie8",$jie8);break;
            case "11--12":$jie9="selected";$this->assign("jie9",$jie9);break;
            case "1--2--3":$jie10="selected";$this->assign("jie10",$jie10);break;
            case "2--3--4":$jie11="selected";$this->assign("jie11",$jie11);break;
            case "5--6--7":$jie12="selected";$this->assign("jie12",$jie12);break;
            case "6--7--8":$jie13="selected";$this->assign("jie13",$jie13);break;
            case "9--10--11":$jie14="selected";$this->assign("jie14",$jie14);break;
            case "10--11--12":$jie15="selected";$this->assign("jie15",$jie15);break;
        }
        switch($course_info['credit']){      //获取学分
            case "1":$credit1="selected";$this->assign("credit1",$credit1);break;
            case "2":$credit2="selected";$this->assign("credit2",$credit2);break;
            case "3":$credit3="selected";$this->assign("credit3",$credit3);break;
            case "4":$credit4="selected";$this->assign("credit4",$credit4);break;
        }
        $this->assign("course_info",$course_info);
        $this->display();
    }
     function updateCourseInfo(){      //更新课程信息
        $this->check_logined();
        session_start();
        $course=M("Course");
        if(!$data=$course->create()) $this->error("修改失败!");
        $data['time']=$_POST['week'].",".$_POST['jie'];
        $user=M('Teacher');
        $course_data=$course->where("id=$_GET[id]")->find();
        $us=$user->where("id=$_SESSION[userid]")->find();
        $data['teacher_name']=$us['name'];
        if($course->where(array('teacher_name'=>$data['teacher_name'],'time'=>$data['time']))->find() && $course_data['time']!=$data['time'])
             $this->error("上课时间有冲突");
        if($course->where(array('place'=>$data['place'],'time'=>$data['time']))->find() && $course_data['place']!=$data['place'])
             $this->error("上课地点有冲突");
        if(!$course->where("id=$_GET[id]")->save($data)) $this->error("修改失败!");
        $this->success("修改成功");
    }
    function editPassword(){     //修改密码
    	$this->check_logined();
    	$this->display();
    }
    function updatePassword(){   //更新密码
    	$this->check_logined();
    	$admin=M("Admin");
    	$oldpass=md5($_POST['oldpass']);
    	$condition['password']=$oldpass;
    	if(!$adminInfo=$admin->where($condition)->find()) $this->error("旧密码错误");
    	$newpass=md5($_POST['newpass']);
    	$condition['username']=$_SESSION['username'];
    	$data['password']=$newpass;
    	if(!$admin->where($condition)->save($data)) $this->error("修改失败");
    	$this->success("修改成功");

    }
}
?>