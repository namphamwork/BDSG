<?php
include "function.php";


$post;
if(isset($_REQUEST['q']) && $_REQUEST['q'] != ''){
    $q = $_REQUEST["q"];
    $post = connect("SELECT * FROM post WHERE post_id = '$q'")[0];
}else{
    
    $post = connect("SELECT * FROM post");
}
$myJSON = json_encode($post);

echo $myJSON;
?>