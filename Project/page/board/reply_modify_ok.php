<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";

$rno = $_POST['rno']; //댓글번호
$sql = mq("SELECT * FROM reply WHERE idx = '{$rno}'");
$reply = $sql->fetch_array();

$bno = $_POST['b_no']; //게시글 번호
$sql2 = mq("SELECT * FROM board WHERE idx ='{$bno}'");
$board = $sql2->fetch_array();

$sql3 = mq("UPDATE reply SET content = '{$_POST['content']}' WHERE idx = '{$rno}'");
?> 
<script type="text/javascript">alert('수정되었습니다.'); location.replace("read.php?idx=<?php echo $bno; ?>");</script>