<?php
	require_once("dbconfig.php");

	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
	}

	//bno이 없다면(글 쓰기라면) 변수 선언
	if(empty($bNo)) {
		$bID = $_POST['bID'];
		$date = date('Y-m-d H:i:s');
	}

	//항상 변수 선언  
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $bPassword = null;
	  $bTitle = test_input($_POST["bTitle"]);
	  $bContent = test_input($_POST["bContent"]);
	  $bEmail = test_input($_POST["b_email"]);
	  $b_hit = test_input($_POST["b_hit"]);
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	} 

	if($b_hit>=1) {
		$b_hit = 1;
	} else {
		$b_hit = 0;
	}

//글 수정
if(isset($bNo)) {
	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select * from board_free where b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	 
	$sql = 'update board_free set b_title="' . $bTitle . '", b_content="' . $bContent . '", b_hit="' . $b_hit . '", b_email="' . $bEmail . '" where b_no = ' . $bNo;
	$msgState = '수정'; 

	?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
	<?php 
	
//글 등록
} else {
	$sql = 'insert into board_free (b_no, b_title, b_content, b_email, b_date, b_hit, b_id, b_password) values(null, "' . $bTitle . '", "' . $bContent . '", "' . $bEmail . '", "' . $date . '", 1, "' . $bID . '", password("' . $bPassword . '"))';

 	$sql = 'select count(b_password) as cnt from board_free where b_password=password("' . $bPassword . '") and b_no = ' . $bNo+1;

	$sql = 'insert into board_free (b_no, b_title, b_content, b_email, b_date, b_hit, b_id, b_password) values(null, "' . $bTitle . '", "' . $bContent . '", "' . $bEmail . '", "' . $date . '", 1, "' . $bID . '", password("' . $bPassword . '"))';

	$msgState = '등록';
}

//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	$result = $db->query($sql);
	
	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
		if(empty($bNo)) {
			$bNo = $db->insert_id;
		}
		$replaceURL = './view.php?bno=' . $bNo;
	} else {
		$msg = '글을 ' . $msgState . '하지 못했습니다.';
?>
		<script> 
			history.back();
		</script>
<?php
		exit;
	}
}

?>
<script> 
	location.replace("<?php echo $replaceURL?>");
</script>