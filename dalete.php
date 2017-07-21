<?php
include 'commom.php';
if($_GET['id']){  //如果id为真的话就不跳转
	$sql="delete from member where id=".$_GET["id"];
	//echo $sql;
	$result=$pdo->exec($sql);
	if($result){
		header("location:getall.php");
	}else {
		//如果删除失败弹出警告框，如果删除成功就会直接删除信息跳转到首页
		echo "<script>alert('删除失败');location.href='getall.php'</script>";
	}
}else {
	//防止用户直接访问delete.php这个文件
	//如果没有id的话就跳转
	header("location:getall.php");//跳转到...
}
?>