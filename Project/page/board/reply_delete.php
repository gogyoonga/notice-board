<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";
$rno = $_POST['rno']; 
$sql = mq("SELECT * FROM reply WHERE idx ='{$rno}'");
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = mq("SELECT * FROM board WHERE idx = '{$bno}'");
$board = $sql2->fetch_array();

$pwk = $_POST['pw'];
$bpw = $reply['pw'];

if(password_verify($pwk, $bpw)) 
	{
        $sql = mq("DELETE FROM reply WHERE idx='{$rno}'");
        ?>
	<script type="text/javascript">alert('댓글이 삭제되었습니다.'); location.replace("read.php?idx=<?php echo $board["idx"]; ?>");</script>
	<?php 
	}else{ ?>
		<script type="text/javascript">alert('비밀번호가 틀립니다');history.back();</script>
	<?php } ?>