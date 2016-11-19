<?php
 
// Connect Server
$conn = new mysqli('localhost', 'root', 'apmsetup', 'mydb');

// Create Database
$sql = 'CREATE DATABASE mydb';
$conn->query($sql);

//CREATE TABLE
$sql = 'CREATE TABLE board_free(  
	b_no INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	b_title INT(30) NOT NULL,
	b_content TEXT NOT NULL,
	b_date DATETIME NOT NULL,
	b_hit INT UNSIGNED NOT NULL,
	b_id VARCHAR(30) NOT NULL,
	b_password VARCHAR(100) NOT NULL
)';
$conn->query($sql); 

// Select from board_free
$sql = 'SELECT count(*) as cnt FROM board_free';
$result = $conn->query($sql);
$row	= $result->fetch_assoc();
$allPost = $row['cnt'];

if(empty($allPost)) {
	$emptyData = '<tr><td class="textCenter" colspan="5"> 글이 존재하지 않습니다. </td></tr>';
} else {

};

 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>자유게시판 | Kurien's Library</title>
	<link rel="stylesheet" href="./css/normalize.css" />
	<link rel="stylesheet" href="./css/board.css" />
</head>
<body style='padding:20px'>
	<?php echo $allPost ?> Topics
	<article class="boardArticle">
		<h3>자유게시판</h3>
		<div id="boardList">
			<table>
				<caption class="readHide">자유게시판</caption>
				<thead>
					<tr>
						<th scope="col" class="no">번호</th>
						<th scope="col" class="title">제목</th>
						<th scope="col" class="author">작성자</th>
						<th scope="col" class="date">작성일</th>
						<th scope="col" class="hit">조회</th>
					</tr>
				</thead>
				<tbody>
						<?php 
							if(isset($emptyData)){
								echo $emptyData;
							} else { 
								while($row = $result->fetch_assoc())
								{
									$datetime = explode(' ', $row['b_date']);
									$date = $datetime[0];
									$time = $datetime[1];
									if($date == Date('Y-m-d'))
										$row['b_date'] = $time;
									else
										$row['b_date'] = $date;
						?>
						<tr>
							<td class="no"><?php echo $row['b_no']?></td>
							<td class="title">
								<a href="./view.php?bno=<?php echo $row['b_no']?>"><?php echo $row['b_title']?></a>
							</td>
							<td class="author"><?php echo $row['b_id']?></td>
							<td class="date"><?php echo $row['b_date']?></td>
							<td class="hit"><?php echo $row['b_hit']?></td>
						</tr>
						<?php 
							}
						}
						?>
				</tbody>
			</table>
			<div class="btnSet">
				<a href="./write.php" class="btnWrite btn">글쓰기</a>
			</div>
			<div class="paging">
				<?php echo $paging ?>
			</div>
			<div class="searchBox">
				<form action="./index.php" method="get">
					<select name="searchColumn">
						<option <?php echo $searchColumn=='b_title'?'selected="selected"':null?> value="b_title">제목</option>
						<option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>
						<option <?php echo $searchColumn=='b_id'?'selected="selected"':null?> value="b_id">작성자</option>
					</select>
					<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
					<button type="submit">검색</button>
				</form>
			</div>
		</div>
	</article>
</body>
</html>