<?php
include 'commom.php';
//var_dump($_POST);
if($_POST['send']){
	$searchSql="select * from member where username='".$_POST['username']."'";
	$searchResult=$pdo->query($searchSql);
	$oneUser=$searchResult->fetchAll(PDO::FETCH_OBJ);
	//var_dump($oneUser[0]); //如果用户存在，出现一个已有的对象
	if($oneUser[0]){
		echo "<script>alert('用户名已存在，请重试');history.go(-1);</script>";
		return false;
	}
	//终止代码执行
	//exit();
	//添加数据
	$sql="insert into member(
		username,
		pwd,
		email,
		regTime		
		)values(
		'".$_POST['username']."',
		'".md5($_POST['pwd'])."',
		'".$_POST['email']."',
		'".date('Y-m-d H-i-s')."'
		)";
	//echo $sql;  //如果出错打印sql语句，查看错误在哪里
	$result=$pdo->exec($sql);
	if($result){
		echo "ok";
		echo "<script>alert('数据添加成功');location.href='getall.php';</script>";
	}else {
		echo "failed";
	}
}
?>
<style>
body{
background-color: #78E0E9;

}
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
height:160px;
box-shadow:0 0 3px #ddd;
background-color: #98E0E9;
}
.reg input{
margin-top:5px;
width:95%;
}
</style>

<form action="" method="post" class="reg">
	用户名：<input type="text" name="username" placeholder="用户名"><br>
	密码：<input type="password" name="pwd" placeholder="密码"><br>
	邮箱：<input type="text" name="email" placeholder="邮箱" class="email"><br>
	<input type="submit" value="submit" name="send" class="addBtn"><br>
</form>

<script src="Tools.js"></script>

<script>
var addBtn=document.querySelector(".addBtn");
var addBtn=document.querySelector(".email");
//console.log(addBtn);
addBtn.addEventListener("click",function(evt){
		//return false;
		//evt.preventDefault();
		

	
});

</script>











