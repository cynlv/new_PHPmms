<?php

//把包含的commom的文件包含进来
include 'commom.php';
include "checkLogin.php";
/* echo "<pre>";
var_dump($_SESSION);
var_dump($_COOKIE);
echo "</pre>"; */
//验证管理员是否登录，未登录跳转到登录界面
/* if(!$_SESSION['admin']){
	header('location:login.php');
}else {
	echo $_SESSION["aimin"]->username."登录，";
	echo "<a href='getall.php?action=logout'>注销</a>";
}
if($_GET['action']=='logout'){
	unset($_SESSION['admin']);
	header('location:login.php');
} */
//总记录数
$total=$pdo->query("select * from member")->rowCount();
//echo $total;  //查看是否能获取总记录数
//每页的条数
$pagesize=3;
//获取总页数
$pageTotal=ceil($total/$pagesize);
//当前页等于查询字符串中的page的值
if($_GET['page']){
	$page=$_GET['page']; //获取地址栏的值
	//当前页大于总页数的话就等于总页数
	if($page>=$pageTotal){
		$page=$pageTotal;
	}
}else {
	$page=1;
}


//查询的sql语句
$sql="select * from member order by id desc limit ".($page-1)*$pagesize.",".$pagesize;
//$result:结果集
$result=$pdo->query($sql);
$data=$result->fetchAll(PDO::FETCH_OBJ);
echo "<h2>用户信息表：</h2><hr>";
echo "<table border='1' alig='center' width=95% cellspacing=0>";
echo "<tr><th>用户名</th><th>邮箱</th><th>注册时间</th><th>操作</th></tr>";
//$value:对象，每一条数据
foreach ($data as $key=>$value){
	//var_dump($value->username);
	
	echo "<tr>";
	echo "<td>".$value->username."</td>";
	echo "<td>".$value->email."</td>";
	echo "<td>".$value->regTime."</td>";
	echo "<td>";
	echo "<a href='update.php?id=".$value->id."'>修改</a>&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href='dalete.php?id=".$value->id."'>删除</a>";
	echo "</td>";
	echo "</tr>";
}

echo "<tr><td colspan='4'><a href='add.php'>添加数据</a></td></tr>";
echo "</table>";
echo "<div class='page'>";
echo "<ul>";
echo "<li><a href='?page=".($page-1)."'>上一页</a></li>";  //page=".($page-1).":代表查找字符串
echo "<li><a href='?page=".($page+1)."'>下一页</a></li>";
echo "<li><input tupe='text' value='".$page."' class='changePage'></li>";
echo "<li><span class='present'>".$page."</span>/".$pageTotal."</li>";
echo "</ul>";
echo "</div>";
/*  echo "<pre>";
 //var_dump($result);//打印sql语句查看是否获取，正确的话返回一个对象，出错的话返回false
 var_dump($result->fetchAll(PDO::FETCH_OBJ));//返回一个包含所有结果集条数的数组
 echo "</pre>"; */


?>
<script>
var changePage=document.querySelector(".changePage");
changePage.addEventListener("keyup",function(){
	location.href="?page="+this.value;
	console.log(location.href);
})

</script>


<style>
body{
background-color: #78E0E9;

}
table,tr,td{
border:1px solid white;
}
table{
background-color: #98E0E9;
}
.changePage{
	width:30px;
}
.page{
border:1px solid green;
}
.page ul{
	text-align:center;
}
.page ul li{
display:inline-block;
margin-left:5px;
}
.present{
color:red;
}
</style>








