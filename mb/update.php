<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改</title>
	<style>
		body,p,h1{margin: 0;padding: 0;}
		.cf:after{content:"\200b";display:block;height:0;clear:both;}
		.fl{float:left;}
		.fr{float:right;}
		.wrap{width:500px;margin:50px auto;}
		h1{font-size:20px;}
		.form-line{margin:20px 0;}
		label{margin-right: 20px;}
		img{width:50%;}
	</style>
</head>
<body>
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
		$sql="select * from `message` where `id`='".$id."'";
		$query=mysql_query($sql);
		$rs=mysql_fetch_assoc($query);
	?>
	<div class="wrap">
		<form action="update2.php" method="post" enctype="multipart/form-data">
			<div class="form-line cf">
				<label class="fl" for="">内容</label>
				<textarea class="fl" name="content" id="" cols="30" rows="10"><?php echo $rs['content'] ?></textarea>
			</div>
			<div class="form-line cf">
				<label class="fl" for="">旧图</label>
				<img class="fl" src="<?php echo 'images/'.$rs['img_href'] ?>" alt="">
			</div>
			<div class="form-line cf">
				<label class="fl" for="">上传新图片</label>
				<input type="file" name="file">
				<input type="hidden" name="id" value="<?php echo $rs['id'] ?>">
			</div>
			<input type="submit" value="点击修改">
		</form>
	</div>
</body>
</html>