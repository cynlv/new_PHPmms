<?php
include "commom.php";
/* *
 * 一周内不用登录
 *  */
//如果cookie有效，就跳转首页，无需登录
/* if($_COOKIE['username']){
	$_SESSION['admin']=$_COOKIE['username'];//$_SESSION['admin']：保存后台管理员在session中,把cookie保存到session中
	header("location:getall.php");
} */
//点击登录
if($_POST['send']){
	if(strtolower($_POST['code']!=strtolower($_SESSION['captcha']))){
		echo "<script>alert('验证码错误');location.href='login.php'</script>";
		return false;
	}
	//判断是否可以打印出输入的值
	//echo "<pre>";
	//var_dump($_POST);
	//echo "</pre>";
	$sql="select * from admin where username='".$_POST['username']."'
		and pwd='".md5($_POST['pwd'])."'";
	//echo $sql;  //如果出现sql语句错误，可以打印sql语句查看哪里出错
	$result=$pdo->query($sql);
	$oneUser=$result->fetchAll(PDO::FETCH_OBJ);
	if($oneUser[0]){
		if($_POST['oneweek']=='1'){
			//一周内不用登录
			setcookie("username",$_POST['username'],time()+3600*24*7);
			//跳转到首页
			header("location:getall.php?oneweek=1");
		}else {
			setcookie("username",$_POST['username']);
			//跳转到首页
			header("location:getall.php?oneweek=0");
		}
		//echo 'ok';
	
		//把用户对象保存到sessionz中
		$_SESSION['admin']=$oneUser[0];
	}else {
		//弹出信息，并刷新页面
		echo "<script>alert('用户名或验证码错误');location.href='login.php'</script>";
	}
}

?>
<dl class="login" >
	<form action="" method="post">
		<dt>欢迎登录</dd>
		<dd><input type="text" name="username" placeholder="用户名"></dd>
		<dd><input type="text" name="pwd" placeholder="密码"></dd>
		<dd>
			<input type="text" name="code" class="code" placeholder="验证码">
			<img src="captcha.php">
		</dd>
		<dd><input type="checkbox" name="oneweek" class="oneweek" value="1">一周内不用登录</dd>
		<dd><input type="submit" name="send" value="登录" class="loginBtn"></dd>
	</form>
</dl>


<style>
dl,dt,dd{
	margin:0;
	padding:0;
}

.login{
	border:1px solid #ddd;
	width:220px;
	height:230px;
	padding:5px;
	position:absolute;
}
.login dt{
	text-align:center;
}
.login dd {
	margin:5px auto;
}
.login dd input{
	width:100%;
}
.login .code{
	width:90px;
}
.login .oneweek{
	width:20px;
}
</style>

<script src="Tools.js"></script>
<script>
	center(document.querySelector('.login'));
</script>
