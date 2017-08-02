<?php
	require_once("dbconfig.php");
	$bNo = $_GET['bno']; 

	if(!empty($bNo) && empty($_COOKIE['board_free_' . $bNo])) {
		$sql = 'update board_free set b_hit = b_hit + 1 where b_no = ' . $bNo;
		$result = $db->query($sql); 
		if(empty($result)) {
			?>
			<script>
				alert('오류가 발생했습니다.');
				history.back();
			</script>
			<?php 
		} else {
			setcookie('board_free_' . $bNo, TRUE, time() + (60 * 60 * 24), '/');
		}
	}
	
	$sql = 'select b_title, b_content, b_email, b_password, b_date, b_hit, b_id from board_free where b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<?php
	include_once('header.php');
?> 
<body>
	<center>
		<article class="boardArticle">
			<h3>View</h3>
			<div id="boardView">
				<h3 id="boardTitle"><?php echo $row['b_title']?></h3>
				<table>
					<tr>
						<td width="60px" class='viewTitle'>
							Date:
						</td>
						<td>
							<?php echo $row['b_date']?>
						</td>
					</tr>
					<tr>
						<td class='viewTitle'>
							Name:
						</td>
						<td>
							<?php echo $row['b_id']?>
						</td>
					</tr>
					<tr>
						<td class='viewTitle'>
							E-mail:
						</td>
						<td>
							<?php echo $row['b_email']?>
						</td>
					</tr>
					<tr>
						<td class='Lease'>
							Lease
						</td>
						<td class='<?php if($row["b_hit"] == 0) echo "Available"; ?>'>
							<?php 
								if($row['b_hit'] == 1) {
									echo 'Not Available';
								} else {
									echo ' &nbsp; Available';
								}
							?> 
						</td>
					</tr>
				</table> 
				<div id="boardContent">
					<br>
					<?php echo $row['b_content']?>
				</div>
				<br><br><br><br><br><br><br><br>

				<div class="row">
					<div class="col-xs-6">
						<a href="./write.php?bno=<?php echo $bNo?>">
							<button type="button" class="btn btn-warning btn-md">
							  Modify
							</button>
						</a> 
					</div>
					<div class="col-xs-6 text-right">
						<a href="./">
							<button type="button" class="btn btn-info btn-md">
							  List
							</button>
						</a>
						<a href="./write.php">
							<button type="button" class="btn btn-success btn-md">
							  Write
							</button>
						</a>
					</div>
				</div> 

			</div>
		</article>
	</center>
</body>
</html>

<hr>

<?php

include('index.php')

?>

