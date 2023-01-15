<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>웰시코딩</title>
    <link rel="stylesheet" href="../../css/style.css?after">
</head>
<body>
    <div id="board_write">
    <br><h1><a href="../../index.php">웰시코딩</a></h1><br>
        <h4>글을 신중히 작성해주세요.<br>
            관리자 기능을 구현하지 않아서) 비밀번호를 까먹었는데 글 삭제를 하고 싶다면 데이터를 찢어버려야 합니다.</h4>
        <div id="write_area">
            <form action="write_ok.php" method="post">
                <div id="in_title">
                    <textarea name="title" id="utitle" cols="55" rows="1" placeholder="제목" maxlength="100" required></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_name">
                    <textarea name="name" id="uname" cols="55" rows="1" placeholder="글쓴이" maxlength="100" required></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
                </div>
                <div id="in_pw">
                    <input type="password" name="pw" id="upw" placeholder="비밀번호" required />
                </div>
            <div class="bt_se">
                <button type="submit" class="new_btn">글 작성</button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>