<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>웰시코딩</title>
    <link rel="stylesheet" href="./css/style.css?after">

</head>
<body>
    <div id="board_area">
        <h1>웰시코딩</h1>
        <h4>과제 제출용 게시판입니다. (2022-12-23 수정 완료)</h4>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                </tr>
            </thead>
<?php
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$sql = mq("SELECT * FROM board");
$row_num = mysqli_num_rows($sql); // 게시판 총 레코드 수
$list = 5; // 한 페이지에 보여줄 개수
$block_ct = 5; //블록당 보여줄 페이지 개수

$block_num = ceil($page/$block_ct); //현재 페이지 블록 구하기
$block_start = (($block_num - 1) * $block_ct) + 1;  //블록의 시작번호
$block_end = $block_start + $block_ct - 1; // 블록 마지막 번호

$total_page = ceil($row_num/$list); //페이징한 페이지 수 구하기
if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지막 번호가 페이지수보다 많다면 마지막 번호는 페이지수
$total_block = ceil($total_page/$block_ct); //블럭 총 개수
$start_num = ($page-1) * $list;

$sql2 = mq("SELECT * FROM board ORDER BY idx desc limit $start_num, $list");



//board table에서  idx(index)를 기준으로 desc해서 5개까지 표시
$sql5 = mq("SELECT * FROM board ORDER BY idx desc limit 0,5");
while($board = $sql5->fetch_array())
{
    // title 변수에 DB에서 가져온 title을 선택
    $title = $board["title"];

    if(strlen($title)>30){
        // title 글자수 30 넘으면 ...표시
        //substr은 영어일 경우 잘랐을 때 문제 없지만, 한글일 경우 오류날 수 있음. mb_substr사용!
        $title = str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);

    }

    
    // 댓글 수 카운트
    $sql3 = mq("SELECT * FROM reply WHERE con_num = '{$board['idx']}'");//reply테이블에서 con_num이 board의 idx와 같은 것을 선택
    // $rep_count = mysqli_num_rows($result); //num_rows로 정수 형태 출력
    $rep_count = $sql3 -> num_rows;
    ?>
<tbody>
    <tr>
        <td width="70"><?php echo $board['idx']; ?></td>
        <td width="500"><?php 
        $lockimg = "<img src='./img/lock.png' alt='lock' title='lock' with='20' height='20' />";
        if($board['lock_post']=="1")
        {?><a href="./page/board/ck_read.php?idx=<?php echo $board['idx'];?>"><?php echo $title, $lockimg;
        }else{ ?>
<a href="./page/board/read.php?idx=<?php echo $board['idx'];?>"><?php echo $title; } ?><span class="re_ct"> [<?php echo $rep_count; ?>]</span></a></td>
        <td width="120"><?php echo $board['name']; ?></td>
        <td width="100"><?php echo $board['date']; ?></td>
        <td width="100"><?php echo $board['hit']; ?></td>
    </tr>
</tbody>


<?php
}
?>

        </table>

        <!-- 페이징 넘버 -->
        <div id="page_num">
            <ul>
                <?php 
            if($page <= 1)
            { //만약 page가 1보다 크거나 같다면
                echo "<li class='fo_re'>처음</li>"; //처음이라는 글자에 빨간색 표시
            } else{
                echo "<li><a href='?page=1'>처음</a></li>"; //아니라면 처음 글자에 1번 페이지로 갈 수 있게 링크
            }
            if($page <= 1){
                //만약 page가 1보다 크거나 같다면 빈값
            }
            else{
                $pre = $page -1; // 이전페이지
                echo "<li><a href='?page={$pre}'>이전</a></li>";
            }
            for($i=$block_start; $i<=$block_end; $i++){
                if($page == $i){
                    echo "<li class='fo_re'>[{$i}]</li>"; //현재 페이지 굵은 빨간색
                }else{
                    echo "<li><a href='?page={$i}'>[{$i}]</a></li>";
                }
            }
            if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
            }else{
              $next = $page + 1; //next변수에 page + 1을 해준다.
              echo "<li><a href='?page={$next}'>다음</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
            }
            if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
              echo "<li class='fo_re'>마지막</li>"; //마지막 글자에 긁은 빨간색을 적용한다.
            }else{
              echo "<li><a href='?page={$total_page}'>마지막</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
            }
            ?></ul>
        </div>
        <div id="write_btn">
            <a href="./page/board/write.php">
                <button class="new_btn"> NEW </button>
            </a>
        </div>
    </div>
</body>
</html>