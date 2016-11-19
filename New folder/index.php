<?php

// Server infomation
$conn = new mysqli('localhost', 'root', 'apmsetup', 'zfifth');


// Create Database
$sql = 'CREATE DATABASE zfifth';
$conn->query($sql);

// Create Table
$sql = 'CREATE TABLE mydb(
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	reg_date TIMESTAMP
	)';
$conn->query($sql);


// Insert DATA into Database
$sql = "INSERT INTO mydb (firstname, lastname, email) VALUES ('aff', 'aaafw', 'aaa@gmail.com')";
$conn->query($sql);

// Show the last number of data
$last_id = $conn->insert_id;
echo $last_id.' <br><br>';


// Read data from table
$sql = 'SELECT id, firstname, lastname FROM mydb';
$result = $conn->query($sql);

if($result->num_rows > 0){
	while($row = $result -> fetch_assoc()){
		echo $row['id']." ".$row['firstname']." ".$row['lastname']."<br> ";
	}
} else {
	echo '0 results';
}


// Drop Table 
$sql = 'DROP TABLE IF EXISTS mydb';
//$conn -> query($sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<article>
		<h3>자유게시판</h3>
		<table border='1'>
			<caption class="readHide">자유게시판</caption>
			<thead>
				<tr>
					<th scope="col" class="no">번호</th>
					<th scope="col" class="title">제목</th>
					<th scope="col" class="author">작성자</th>
					<th scope="col" class="date">작성일</th> 
				</tr>
			</thead>
			<tbody>
					<?php
						$sql = 'select * from mydb order by id desc';
						$result = $conn->query($sql);
						while($row = $result->fetch_assoc())
						{
							$datetime = explode(' ', $row['reg_date']);
							$date = $datetime[0];
							$time = $datetime[1];
							if($date == Date('Y-m-d'))
								$row['reg_date'] = $time;
							else
								$row['reg_date'] = $date;
					?>
				<tr>
					<td class="no"><?php echo $row['id']?></td>
					<td class="title"><?php echo $row['firstname']?></td>
					<td class="author"><?php echo $row['lastname']?></td>
					<td class="date"><?php echo $row['email']?></td> 
				</tr>
					<?php
						}
					?>
			</tbody>
		</table>
	</article>
</body>
</html>














