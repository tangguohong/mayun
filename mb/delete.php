<?php 
	header("Content-type:text/html;charset=utf-8");
	$con=mysql_connect('localhost','root','root');
	if(!$con){
		die("连接服务器失败");
	}
	$db=mysql_select_db("aspc",$con);
	mysql_query("set nemas utf8");
	$id=$_GET["id"];
	$sql="select * from `carousel` where `id`=".$id;
	$query=mysql_query($sql);
	$rs=mysql_fetch_assoc($query);
	unlink('images/'.$rs['href']);
	$sql="delete from `carousel` where `id`=".$id;
	$query=mysql_query($sql);
	if($query==true){
		echo "删除成功";
	}else{
		echo "删除失败";
	}
	header("refresh:.5;url=http://localhost/aspc/carousel.php");
?>