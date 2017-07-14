 <?php

class IndexAction extends Action{
    function _initialize(){
    	header("Content-type:text/html;charset=utf-8");
    }
    function index(){
    	$url=U("login");
    	header("Location:$url");
    }
    function login(){    //登录模块
    	$this->display();
    }
    function check_login(){  //判断是否登录成功
    	session_start();
    	if($_POST['type']=="stu")
    	      $user=M('Student');
    	else
    	      $user=M('Teacher');

    	switch($_POST['type']){                 //根据是学生登录还是教师登录跳转到不同的页面
    		case "stu":$condition['id']=$_POST['userid'];
                        $url=U("student");
                        break;
            case "teac":$condition['id']=$_POST['userid'];
    	                 $url=U("teacher");
    	                 break;
    	}
    	$us=$user->where($condition)->find();
    	if(!$us){ $this->error("用户名或者密码错误！！");}
    	if($us['password']!=md5($_POST['password'])){$this->error("用户名或者密码错误！！");}
    	$_SESSION['userid']=$_POST['userid'];
    	$this->assign("jumpUrl",$url);
    	$this->success("登录成功");
    }
    function checkStu_logined(){       //检测学生是否已经登录
    	session_start();
    	$user=M('Student');
    	$condition['id']=$_SESSION['userid'];
    	$us=$user->where($condition)->find();
        if(!$us){$url=U('login');$this->assign("jumpUrl",$url);$this->error("还没有登录！！");}
    }
    function checkTeac_logined(){       //检测教师是否已经登录
    	session_start();
    	$user=M('Teacher');
    	$condition['id']=$_SESSION['userid'];
    	$us=$user->where($condition)->find();
        if(!$us){$url=U('login');$this->assign("jumpUrl",$url);$this->error("还没有登录！！");}
    }
    function admin_exit(){
    	unset($_SESSION['userid']);
        $url=U("login");
    	$this->assign("jumpUrl",$url);
    	$this->success("退出成功");
    }
    function teacher(){               //教师管理模块
        $this->checkTeac_logined();
        session_start();
    	$user=M('Teacher');
    	$us=$user->where("id=$_SESSION[userid]")->find();
        $username=$us['name'];
    	$date=date("Y年m月d日 H:i",time());
    	$this->assign(date,$date);
    	$this->assign('username',$username);
    	$this->display();
    }
    function teacher_page(){          //教师管理首页信息
    	$this->checkTeac_logined();
    	$this->display();
    }

    function publishCourse(){      //发布课程模块
    	$this->checkTeac_logined();
    	$this->display();
    }
    function addCourse(){     //添加课程
    	$this->checkTeac_logined();
    	session_start();
        $course=M("Course");
        if(!$data=$course->create()) $this->error("发布失败");
        $data['time']=$_POST['week'].",".$_POST['jie'];
        $user=M('Teacher');
    	$us=$user->where("id=$_SESSION[userid]")->find();
        $data['teacher_name']=$us['name'];
        $data['teacher_id']=$_SESSION['userid'];
        if($course->where(array('teacher_name'=>$data['teacher_name'],'time'=>$data['time']))->find())
             $this->error("上课时间有冲突");   //同一个老师同一时间只能上一门课
        if($course->where(array('place'=>$data['place'],'time'=>$data['time']))->find())
             $this->error("上课地点有冲突");   //同一教室同一时间只能由一个老师来上课
        if(!$course->add($data)) $this->error("发布失败");
        $url=U("publishCourse");
        $this->assign("jumpUrl",$url);
        $this->success("发布成功");
    }
    function manageCourse(){        //管理课程
    	$this->checkTeac_logined();
    	session_start();
    	$course=M("Course");
        $teac=M("Teacher");
        $teac_info=$teac->where("id=$_SESSION[userid]")->find();
        $count=$course->where(array("teacher_name"=>$teac_info['name']))->count();
    	$listRows=5;
        import("ORG.Util.Page");
        $p=new Page($count,$listRows);
        $limit_options=$p->firstRow.",".$p->listRows;
    	$course_info=$course->where(array("teacher_name"=>$teac_info['name']))->limit($limit_options)->findAll();
    	$displaypage=0;
    	if(count($course_info)>0) $displaypage=1;  //如果有课程信息才显示分页。
    	$page=$p->show();
    	$this->assign("displaypage",$displaypage);
    	$this->assign("page",$page);
    	$this->assign("pagestyle","green-black");
    	$this->assign("course_info",$course_info);
    	$this->display();
    }
    function deleteCourse(){         //删除课程信息
    	$this->checkTeac_logined();
    	$id=$_GET['id'];
    	$course=M("Course");
    	if(!$course->delete($id)) $this->error("删除失败");
        $selected=M("selected");
        if($selected->where("course_id=$id")->find()){     //如果有学生选了这门课，那么选课信息中也要删除掉选了这门课的学生。
        	if(!$selected->where("course_id=$id")->delete()) $this->error("删除失败");
        }
        $url=U("manageCourse");
        $this->assign("jumpUrl",$url);
        $this->success("删除成功");

    }
    function editCourse(){      //编辑课程信息
    	$this->checkTeac_logined();
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
    function updateCourse(){      //更新课程信息
    	$this->checkTeac_logined();
    	session_start();
    	$course=M("Course");
    	if(!$data=$course->create()) $this->error("修改失败");
    	$data['time']=$_POST['week'].",".$_POST['jie'];
    	$user=M('Teacher');
    	$course_data=$course->where("id=$_GET[id]")->find();
    	$us=$user->where("id=$_SESSION[userid]")->find();
        $data['teacher_name']=$us['name'];
        if($course->where(array('teacher_name'=>$data['teacher_name'],'time'=>$data['time']))->find() && $course_data['time']!=$data['time'])
             $this->error("上课时间有冲突");
        if($course->where(array('place'=>$data['place'],'time'=>$data['time']))->find() && $course_data['place']!=$data['place'])
             $this->error("上课地点有冲突");
    	if(!$course->where("id=$_GET[id]")->save($data)) $this->error("修改失败");
    	$this->success("修改成功");
    }
    function editTeacPassword(){      //修改教师密码
    	$this->checkTeac_logined();
    	$this->display();
    }
    function updateTeacPassword(){     //更新教师密码
    	$this->checkTeac_logined();
    	session_start();
    	$teac=M("Teacher");
    	$oldpass=md5($_POST['oldpass']);
    	$condition['password']=$oldpass;
    	if(!$teacInfo=$teac->where($condition)->findAll()) $this->error("旧密码错误");
    	$newpass=md5($_POST['newpass']);
    	$condition['id']=$_SESSION['userid'];
    	$data['password']=$newpass;
    	if(!$teac->where($condition)->save($data)) $this->error("修改失败");
    	$this->success("修改成功");
    }
    function student(){        //学生管理首页
    	$this->checkStu_logined();
    	session_start();
    	$user=M('Student');
    	$us=$user->where("id=$_SESSION[userid]")->find();
    	$username=$us['name'];
    	$date=date("Y年m月d日 H:i",time());
    	$this->assign(date,$date);
    	$this->assign('username',$username);
    	$this->display();
    }
    function student_page(){    //学生管理首页信息
    	$this->checkStu_logined();
    	$this->display();
    }
    function listCourse(){    //课程列表
    	$this->checkStu_logined();
    	if($_POST['submit']){   //判断是根据课程编号还是课程名来搜索
    		switch($_POST['search_type']){
    			case "course_no":$condition['no']=array("like","%$_POST[keyword]%");break;
    			case "course_name":$condition['name']=array("like","%$_POST[keyword]%");break;
    		}
    	}
    	$course=M("Course");
    	$count=$course->count();
    	$listRows=5;
        import("ORG.Util.Page");
        $p=new Page($count,$listRows);
        $limit_options=$p->firstRow.",".$p->listRows;
    	$course_info=$course->where($condition)->limit($limit_options)->findAll();
    	$displaypage=0;
    	if(count($course_info)>0) $displaypage=1;
    	$page=$p->show();
    	$this->assign("displaypage",$displaypage);
    	$this->assign("page",$page);
    	$this->assign("pagestyle","green-black");
    	$this->assign("course_info",$course_info);
    	$this->display();
    }
    function selectCourse(){     //选课操作
    	$this->checkStu_logined();
    	session_start();
    	$id=$_GET['id'];
    	$data['stu_id']=$_SESSION['userid'];
    	$selected=M("Selected");
    	if($selected->where(array("course_id"=>$id,"stu_id"=>$data[stu_id]))->find()) $this->error("已经选过");
    	$course=M("Course");
    	$course_info=$course->find($id);
        $selected_info=$selected->where("stu_id=$_SESSION[userid]")->select();
        for($i=0;$i<count($selected_info);$i++){
        	$course_id[$i]=$selected_info[$i][course_id];
        }
        for($i=0;$i<count($course_id);$i++){
        	$course_info2=$course->find($course_id[$i]);
        	if($course_info[time]==$course_info2[time]) $this->error("上课时间有冲突");
        }
    	if($course_info['selectedMan']>=$course_info['capacity']) $this->error("名额已满");
    	$data['course_id']=$id;
    	if(!$selected->add($data)) $this->error("选课失败");
    	if(!$course->setInc('selectedMan',"id=$id")) $this->error("选课失败");
    	$this->success("选课成功");
    }
    function selectedCourse(){     //已选课程信息
        $this->checkStu_logined();
        session_start();
    	$selected=M("Selected");
    	$selected_info=$selected->where("stu_id=$_SESSION[userid]")->select();
        for($i=0;$i<count($selected_info);$i++)
             $course_id[$i]=$selected_info[$i]['course_id'];
        $course=M("Course");
        $condition['id']=array('in',$course_id);
        $course_info=$course->where($condition)->select();
        $export=0;
        if(count($selected_info)>0) $export=1;
        $this->assign("export",$export);
        $this->assign("course_info",$course_info);
        $this->display();
    }
    function quitCourse(){         //退课操作
    	$this->checkStu_logined();
    	$id=$_GET['id'];
    	$selected=M("Selected");
    	if(!$selected->where("course_id=$id")->delete()) $this->error("退课失败");
    	$course=M("Course");
    	if(!$course->setDec('selectedMan',"id=$id")) $this->error("退课失败");
        $this->success("退课成功");
    }
    function editStuPassword(){      //修改学生密码
    	$this->checkStu_logined();
    	$this->display();
    }
    function updateStuPassword(){      //更新学生密码操作
    	$this->checkStu_logined();
    	session_start();
    	$stu=M("Student");
    	$oldpass=md5($_POST['oldpass']);
    	$condition['password']=$oldpass;
    	if(!$stuInfo=$stu->where($condition)->findAll()) $this->error("旧密码错误");
    	$newpass=md5($_POST['newpass']);
    	$condition['id']=$_SESSION['userid'];
    	$data['password']=$newpass;
    	if(!$stu->where($condition)->save($data)) $this->error("修改失败");
    	$this->success("修改成功");
    }
    function exportCourse(){       //导出课程表操作
    	$this->checkStu_logined();
    	session_start();
    	header("Content-type:application/vnd-ms-excel");
    	header("Content-Disposition:attachment;filename=course.xls");
        $selected=M("selected");
        $selected_info=$selected->where("stu_id=$_SESSION[userid]")->select();
        for($i=0;$i<count($selected_info);$i++)
             $course_id[$i]=$selected_info[$i]['course_id'];
        $course=M("Course");
        $condition['id']=array('in',$course_id);
        $course_info=$course->where($condition)->select();
        for($i=0;$i<count($course_info);$i++){
        	$course_time[$i]=$course_info[$i]['time'];
        	$course_name[$i]=$course_info[$i]['name'];
        }
        $course_names[13][8]=array();
        for($i=1;$i<=12;$i++){
        	$course_names[$i]['zero']=$i;
        }
        for($i=0;$i<count($course_time);$i++){
        	$coursetime_arr=explode(",",$course_time[$i]);
        	$time_arr=explode("--",$coursetime_arr[1]);
        	switch($coursetime_arr[0]){
                  case "星期一":$j="one";break;
                  case "星期二":$j="two";break;
                  case "星期三":$j="three";break;
                  case "星期四":$j="four";break;
                  case "星期五":$j="five";break;
                  case "星期六":$j="six";break;
                  case "星期日":$j="seven";break;
        	}
        	for($k=0;$k<count($time_arr);$k++){
        		$course_names[$time_arr[$k]][$j]=$course_name[$i];
        	}

        }
        $this->assign("course_names",$course_names);
        $this->display();
    }
	
	 function manageCourseStu(){        //已选课学生
       $this->checkTeac_logined();
       session_start();
       $selected=D("SelectedView");    //实例化select表
       $condition['teacher_id']=$_SESSION[userid];
       $student_info=$selected->where($condition)->order('course_id desc')->select();
       $this->assign("student_info",$student_info);
       $this->display();
     }
}
?>