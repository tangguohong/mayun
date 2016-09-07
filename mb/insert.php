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
	$content=$_POST['content'];
	if(!empty($_FILES['file']['name'])){
		$oldName=$_FILES['file']['name'];
		$tmp=explode('.',$oldName);
		$newName=time().'.'.$tmp[1];
		$imgPath='images/'.$newName;
		if(is_uploaded_file($_FILES['file']['tmp_name'])){
			if(move_uploaded_file($_FILES['file']['tmp_name'],$imgPath)){
				$sql="insert into `message`(`content`,`img_href`)values('".$content."','".$newName."')";
				$query=mysql_query($sql);
				if($query==true){
					echo "<script>alert('已评论成功！点击确定返回！');</script>";
					header("refresh:.5;url=http://localhost/mb/message.php");
				}else{
					echo "<script>alert('已评论失败！点击确定返回！');</script>";
					header("refresh:.5;url=http://localhost/mb/message.php");
				}
			}
		}
	}else{
		echo "<script>alert('图片上传失败！');</script>";
		header("refresh:.5;url=http://localhost/mb/message.php");
	}
?>