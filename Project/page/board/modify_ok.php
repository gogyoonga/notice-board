<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";

$bno = $_GET['idx'];
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$sql = mq("UPDATE board SET name = '$username', pw = '$userpw', title = '$title', content = '$content' WHERE idx = '$bno'");

?>
<script type="text/javascript">alert("수정되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=./read.php?idx=<?php echo $bno; ?>">