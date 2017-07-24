<?php
include 'commom.php';
include "checkLogin.php";
//如果没有id传递，跳转到首页
if($_GET['id']){
	$sql="select * from member where id=".$_GET['id'];
	//echo $sql;
	$result=$pdo->query($sql);
	//从结果中获取所有的数据
	$date=$result->fetchAll(PDO::FETCH_OBJ);
	//var_dump($date[0]); 
	//echo $date[0]->username;  //打印是否获取value值
	if($date[0]==null){
		echo "数据不存在";
	}
	//如果点击了提交，就把提交的数据读取
	if($_POST['send']){
		if($_POST['pwd2']==$_POST['pwd']){  //如果没有修改，$pwd的值就是原来的密码
			$pwd=$_POST['pwd'];
		}else {
			$pwd=md5($_POST['pwd']);   //如果修改了，$pwd的值就是加密后的值
		}
		//var_dump($_POST); //查看是否可以获取修改的数据
		$sql="update member 
				set username='".$_POST['username']."',
					pwd='".$pwd."',
					email='".$_POST['email']."'
			 where id=".$_GET['id'];
		//echo $sql;
		$result=$pdo->exec($sql); //查看是否有新的值
		if($result){
			//echo "修改成功";
			echo "<script>alert('修改成功');location.href='getall.php';</script>";
		}else if($result==0){
			echo "没有修改";
		}else {
			echo "修改失败";
		}
	}
}else {
	header("location:getall.php");
}


?>

<style>

.reg{
border:1px solid black;
position:absolute;
padding:15px;
left:0;
right:0;
top:0;
bottom:0;
margin:auto;
width:205px;
height:130px;
box-shadow:0 0 3px #ddd;
}
.reg input{
margin-top:5px;
width:95%;
}
</style>

<form action="" method="post" class="reg">
	<input type="hidden" name="pwd2" value=<?php echo $date[0]->pwd;?>>  <!-- 保存原来的密码 -->
	用户名：<input type="text" name="username" value=<?php echo $date[0]->username;?>><br>
	密码：<input type="password" name="pwd" value=<?php echo $date[0]->pwd;?>><br>
	邮箱：<input type="text" name="email" value=<?php echo $date[0]->email;?>><br>
	<input type="submit" value="submit" name="send"><br>
</form>
