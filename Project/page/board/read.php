<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>웰시코딩</title>
    <link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css" />
    <link rel="stylesheet" href="../../css/style.css?after">
    <script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
</head>
<body>
    <?php
$bno = $_GET['idx'];
$sql = mq("SELECT * FROM board WHERE idx ='{$bno}'");
$hit = $sql -> fetch_array();
$hit = $hit['hit'] + 1;

$sql2 = mq("UPDATE board SET hit = '{$hit}' WHERE idx = '{$bno}'");
 //bno 수정

$sql3 = mq("SELECT * FROM board WHERE idx = '{$bno}'"); //수정된 bno 선택
$board = $sql3->fetch_array();

?>
<!-- 글 불러오기 -->

<div id="board_read">
    <h2><br><?php echo $board['title']; ?></h2><br>
    <div id="user_info">
        🐣<?php echo $board['name'];?>🔸<?php echo $board['date'];?>🔸<?php echo $board['hit'];?>
        <div id="bo_line"></div>
    </div>
    <div id="bo_content">
        <?php echo nl2br("$board[content]");?>
    </div>

    <!-- 목록, 수정, 삭제 -->
    <div id="bo_ser">
        <ul>
            <li><a href="../../index.php">[목록으로]</a></li>
            <li><a href="modify.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
            <li><a href="delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
        </ul>
    </div>
</div>

<!-- 댓글 불러오기 -->

<div class="reply_view">
    <h3>댓글목록</h3>
    <?php
    $sql = mq("SELECT * FROM reply WHERE con_num = '{$bno}' ORDER BY idx desc");
    while($reply = $sql->fetch_array()){

    
    ?>
    <div class="dap_lo">
        <div><b><?php echo $reply['name'];?></b></div>
        <div class="dap_to comt_edit"><?php echo nl2br("$reply[content]");?></div>
        <div class="rep_me dap_to"><?php echo $reply['date'];?></div>
        <div class="rep_me rep_menu">
            <a href="#" class="dat_edit_bt">수정</a>
            <a href="#" class="dat_delete_bt">삭제</a>
        </div>
        <!-- 댓글 수정 폼 dialog -->
        <div class="dat_edit">
            <form action="reply_modify_ok.php" method="post">
                <input type="hidden" name="rno" value="<?php echo $reply['idx'];?>"/><input type="hidden" name="b_no" value="<?php echo $bno;?>">
                <input type="password" name="pw" class="dap_sm" placeholder="비밀번호" />
                <textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
                <input type="submit" value="수정하기" class="re_mo_bt">
            </form>
        </div>
        <!-- 댓글 삭제 비밀번호 확인 -->
        <div class='dat_delete'>
            <form action="reply_delete.php" method="post">
                <input type="hidden" name="rno" value="<?php echo $reply['idx'];?>"/><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                <p>비밀번호<input type="password" name="pw" /> <input type="submit" value="확인"> </p>
            </form>
        </div>
    </div>

<?php } ?>

<!-- 댓글 입력 폼 -->

    <div class="dap_ins">
        <form action="reply_ok.php?idx=<?php echo $bno; ?>" method="post">
            <input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">
            <input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
            <div style="margin-top:10px;">
                <textarea name="content" id="re_content" class="reply_content"></textarea>
                <button id="rep_bt" class="re_bt new_btn">댓글</button>
            </div>
        </form>
    </div>
</div><!-- 댓글 불러오기 끝 -->
<div id="foot_box"></div>
</body>
</html>