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
	$id=$_POST['id'];
	$content=$_POST['content'];
	$sql="update `message` set `content`='".$content."' where `id`='".$id."'";
	$query=mysql_query($sql);
	if($query==false){
		echo "修改失败！";
		header("refresh:.1;url=http://localhost/mb/message.php");
	}
	if(!empty($_FILES['file']['name'])){
		$sql="select * from `message` where `id`='".$id."'";
		$query=mysql_query($sql);
		$rs=mysql_fetch_assoc($query);
		unlink('images/'.$rs['img_href']);
		$oldName=$_FILES['file']['name'];
		$tmp=explode('.',$oldName);
		$newName=time().'.'.$tmp[1];
		$imgPath='images/'.$newName;
		if(is_uploaded_file($_FILES['file']['tmp_name'])){
			if(move_uploaded_file($_FILES['file']['tmp_name'],$imgPath)){
				$sql="update `message` set `img_href`='".$newName."' where `id`='".$id."'";
				$query=mysql_query($sql);
				if($query==false){
					echo "<script>alert('修改失败！点击确定返回！');</script>";
				}
			}
		}else{
			echo "<script>alert('修改失败！点击确定返回！');</script>";
			header("refresh:.1;url=http://localhost/mb/message.php");
		}
	}
	echo "<script>alert('修改成功！点击确定返回！');</script>";
	header("refresh:.1;url=http://localhost/mb/message.php");
 ?>