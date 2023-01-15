<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";

// 각 변수에 write.php에서 input name 값들을 저장

$username = $_POST['name'];
$userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d');

if($username && $userpw && $title && $content){
    $sql_i = mq("INSERT INTO board(idx, name, pw, title, content, date, hit, boardcol) VALUES(NULL, '{$username}', '{$userpw}', '{$title}', '{$content}', '{$date}', '0', '' )");
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='../../index.php';</script>";
} else{
    echo"<script> alert('글쓰기 실패했습니다.');
    history.back();</script>";
}

?>