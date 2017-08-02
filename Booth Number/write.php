<?php

	require_once("dbconfig.php");

	//$_GET['bno']이 있을 때만 $bno 선언
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}
		 
	if(isset($bNo)) {
		$sql = 'select b_title, b_content, b_hit, b_email, b_id from board_free where b_no = ' . $bNo;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
	}
		 
	if(isset($row['b_hit'])&&$row['b_hit']>=1) {
		$row['b_hit'] = 1;
	} else {
		$row['b_hit'] = 0;
	}
 

?>
<!DOCTYPE html>
<html>
<?php
	include_once('header.php');
?>
<body>
<center>
	<article class="boardArticle">
		<h3>Apply for Booth</h3>
		<div id="boardWrite">
			<form action="./write_update.php" method="post">
				<?php
				if(isset($bNo)) {
					echo '<input type="hidden" name="bno" value="' . $bNo . '">';
				}
				?>
				<table id="boardWrite"> 
					<tbody>
						<tr>
							<th scope="row"><label for="bID">Name</label></th>
							<td class="id">
								<?php
								if(isset($bNo)) {
									echo $row['b_id'];
								} else { ?>
									<input required type="text" name="bID" id="bID">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="b_email">E-mail</label></th>
							<td class="title"><input required type="email" name="b_email" id="b_email" value="<?php echo isset($row['b_email'])?$row['b_email']:null?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="bTitle">Booth Number</label></th>
							<td class="title"><input required type="text" name="bTitle" id="bTitle" value="<?php echo isset($row['b_title'])?$row['b_title']:null?>"></td>
						</tr>

						<?php
							if(isset($_GET['bno'])) {
						?> 

						<tr>
							<th scope="row"><label for="bTitle"> Lease </label></th>
							<td class="title">    
					            <input type="radio" name="b_hit" itemname="b_hit" value="0" <?php if($row['b_hit'] == '0') { echo "checked=\"checked\""; } ?> label="0"  /> Available   
					            <input type="radio" name="b_hit" itemname="b_hit" value="1" <?php if($row['b_hit'] == '1') { echo "checked=\"checked\""; } ?> label="1"  /> Not Available   
							</td>
						</tr>  

						<?php } else { } ?>  

						<tr>
							<th scope="row"><label for="bContent">Context</label></th>
							<td class="content"><textarea required name="bContent" id="bContent"><?php echo isset($row['b_content'])?$row['b_content']:null?></textarea></td>
						</tr>
					</tbody>
				</table>
				<div class="btnSet">

					<button type="submit" class="btn btn-success btn-md">
						<?php echo isset($bNo)?'Submit':'Submit'?>
					</button>

					<?php
						if(isset($_GET['bno'])) {
					?> 

						<a href="./index.php" class="btnList btn">
							<button type="button" class="btn btn-info btn-md">
							  List
							</button>
						</a>
						
					<?php } else { } ?>  
				</div>
			</form>
		</div>
	</article>
</center>
</body>
</html>



