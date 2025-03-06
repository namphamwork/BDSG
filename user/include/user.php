<?php
include "function.php";
$user;

if(isset($_REQUEST['q']) && $_REQUEST['q'] != ''){
    $q = $_REQUEST["q"];
    $user = connect("SELECT user.*, delivery_info.* FROM user INNER JOIN delivery_info ON user.user_id = delivery_info.user_id where user_id = '$q' ")[0];

}else{
    $user = connect("SELECT user.*, delivery_info.* FROM user INNER JOIN delivery_info ON user.user_id = delivery_info.user_id");
}

$myJSON = json_encode($user);
echo $myJSON;
?>

