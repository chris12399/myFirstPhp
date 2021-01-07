<?php
$servername = "localhost";
$username = "member";
$password =  "123456";
$dbname = "member";

//連線資料庫
$conn = mysqli_connect($servername, $username, $password, $dbname);

//測試連線
if (!$conn) {
    die('連線失敗' . mysqli_connect_error());
}
echo '連線成功</br>';

//選擇要撈取的資料， * 表示全部。
$sql = 'SELECT * FROM member';


//找出 result 的語法
$result = mysqli_query($conn, $sql);

//新增一個 PHP 陣列，用來轉成 Json 格式
$myarray = array();

//加入判斷式
if(!$result){
    echo("Error: ".mysqli_error($conn));
    exit();
}

//判斷資料表有沒有內容，如果是空的就不執行查詢
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {   //因為不知道資料有多少筆，所以用 While 迴圈
        // echo $row['Username'], '</br>';
        // echo '</br>';
        // echo $row['Email'];
        $myarray[] = $row;
    }
    //轉成 json 語法
    echo json_encode($myarray);
    print ("sucess to json");
    // if(json_decode($myarray)){
    //     print ("sucess to json");
    // }

} else {
    echo '沒有資料內容';
}
//每次連線完都要寫關閉，才不會讓伺服器負載過大
mysqli_close($conn);

?>
