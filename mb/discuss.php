<?php
	header('content-type:text/html;charset=utf-8');
	$link=mysql_connect('localhost','root','root');
	if(!$link){
		die('服务器连接失败！');
	}
	$db=mysql_select_db('mb',$link);
	if($db==false){
		die('数据库连接失败！');
	}
	mysql_query("set names utf8");
	$id=$_POST['idd'];
	$text=$_POST['text'];
	$sql="insert into `discuss`(`content`,`id`) values('".$text."','".$id."')";
	$query=mysql_query($sql);
	if($query==true){
		echo "评论成功！";
	}else{
		echo "评论失败！";
	}
	header("refresh:.5;url=http://localhost/mb/message.php");
?>