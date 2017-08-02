<?php
	require_once("dbconfig.php");

	//$_GET['bno']이 있을 때만 $bno 선언
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}
		 
	if(isset($bNo)) {
		$sql = 'select b_title, b_content, b_id from board_free where b_no = ' . $bNo;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Contact</title>
	<link rel="stylesheet" href="./css/normalize.css" />
	<link rel="stylesheet" href="./css/board.css" />
</head>
<body>
<center>
	<article class="boardArticle">
		<h3>Contact</h3>
		<div id="boardWrite">
			<form action="./write_update.php" method="post">
				<?php
				if(isset($bNo)) {
					echo '<input type="hidden" name="bno" value="' . $bNo . '">';
				}
				?>
				<table id="boardWrite">
					<caption class="readHide">Contact</caption>
					<tbody>
						<tr>
							<th scope="row"><label for="bID">Name</label></th>
							<td class="id">
								<?php
								if(isset($bNo)) {
									echo $row['b_id'];
								} else { ?>
									<input type="text" name="bID" id="bID">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="bPassword">E-mail</label></th>
							<td class="password"><input type="email" name="bPassword" id="bPassword"></td>
						</tr>
						<tr>
							<th scope="row"><label for="bTitle">Title</label></th>
							<td class="title"><input type="text" name="bTitle" id="bTitle" value="<?php echo isset($row['b_title'])?$row['b_title']:null?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="bContent">Context</label></th>
							<td class="content"><textarea name="bContent" id="bContent"><?php echo isset($row['b_content'])?$row['b_content']:null?></textarea></td>
						</tr>
					</tbody>
				</table>
				<div class="btnSet">
					<button type="submit" class="btnSubmit btn">
						<?php echo isset($bNo)?'Modify':'Write'?>
					</button>
					<a href="./index.php" class="btnList btn button"> List </a>
				</div>
			</form>
		</div>
	</article>
</center>
</body>
</html>