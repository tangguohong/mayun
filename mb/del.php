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
	$id=$_GET['id'];
	$sql="select * from `message` where `id`=".$id;
	$query=mysql_query($sql);
	$rs=mysql_fetch_assoc($query);
	unlink('images/'.$rs['img_href']);
	$sql="delete from `message` where `id`='".$id."'";
	$query=mysql_query($sql);
	if($query==true){
		echo "删除成功！";
	}else{
		echo "删除失败！";
	}
	header("refresh:.1;url=http://localhost/mb/message.php");
 ?>