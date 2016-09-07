<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>留言板</title>
	<style>
		body,input,p,form,ul,li{margin: 0;padding: 0;}
		.cf:after{content:"\200b";display:block;height:0;clear:both;}
		.fl{float:left;}
		.fr{float:right;}
		.wrap{width:500px;margin:50px auto;}
		a{text-decoration: none;color:#333;margin:0 5px;}
		a:hover{text-decoration: underline;}
		input{outline: none;}
		li{list-style:none;}
		.ta{width:480px;height:100px;font-size:15px;font-family:"microsoft yahei";padding:10px;}
		.show img{width:50%;}
		.ta2{width:480px;padding:10px;height:40px;}
		.content{margin-top:30px;}
		.discuss{text-align:center;border:0;display:block;width:50px;padding:5px 10px;background:green;border-radius:8px;}
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
	 ?>
	<div class="wrap">
		<form action="insert.php" method="post" enctype="multipart/form-data">
			<textarea class="ta" name="content" id="" cols="30" rows="10"></textarea>
			<div class="cf">
				<input type="file" name="file">
				<input class="fr" type="submit" value="发表">
			</div>
		</form>
		<div class="show">
			<ul>
				<?php
					if(empty($_GET['page'])){
						$page=1;
					}else{
						$page=$_GET['page'];
					}
					$pageSize=2;
					$sql="select * from `message`";
					$query=mysql_query($sql);
					$num=mysql_num_rows($query);
					$pageNum=ceil($num/$pageSize);
					$start=($page-1)*$pageSize;
					$sql="select * from `message` order by id desc limit ".$start.",".$pageSize." ";
					$query=mysql_query($sql);
					while($rs=mysql_fetch_assoc($query)){
				?>
				<li class="cf">
					<div>
						<p class="content"><?php echo $rs['content'] ?></p>
						<img src="<?php echo 'images/'.$rs['img_href'] ?>" alt="">
						<div class="fr">
							<a href="update.php?id=<?php echo $rs['id']?>">修改</a>
							<a href="del.php?id=<?php echo $rs['id']?>">删除</a>
						</div>
					</div>
					<div>
						<form action="discuss.php" method="post">
							<textarea class="ta2" name="text"></textarea>
							<input type="hidden" name="idd" value="<?php echo $rs['id']?>">
							<input class="discuss" type="submit" value="评论">
						</form>
					</div>
					<?php
						$id=$rs['id'];
						$sqld="select * from `discuss` where `id`=$id";
						$queryd=mysql_query($sqld);
						while($rsd=mysql_fetch_assoc($queryd)){
					?>
					<p style="padding:5px 0;margin-left:50px;"><?php echo $rsd['content'] ?></p>
					<?php } ?>
				</li>
				<?php } ?>
			</ul>
		</div>
		<div class="page">
			<?php
				if($page>1){
					$prev=$page-1;
				}else{
					$prev=1;
				}
				if($page<4){
					$next=$page+1;
				}else{
					$next=$pageNum;
				}
			?>
			<ul style="margin-left:100px;margin-top:50px;" class="cf">
				<li class="fl"><a href="message.php?page=1">首页</a></li>
				<li class="fl"><a href="message.php?page=<?php echo $prev ?>">上一页</a></li>
				<li class="fl"><a href="message.php?page=<?php echo $next ?>">下一页</a></li>
				<li class="fl"><a href="message.php?page=<?php echo $pageNum ?>">尾页</a></li>
			</ul>
		</div>
	</div>
</body>
</html>