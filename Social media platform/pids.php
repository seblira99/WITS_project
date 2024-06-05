<?php
require_once '/var/www/wits.ruc.dk/db.php';

$uid = $_GET['uid'];


$pids = get_pids_by_uid($uid);
$user = get_user($uid);

echo "This is a list of posts by:  ";
echo $user['firstname']."   ";
echo $user['lastname'];


echo "<br>";

foreach ($pids as $pid) {
    $post=get_post($pid);


    echo "<a href='pid.php?pid=".$pid."&uid=".$uid."'>".$post['title']."</a>";
    echo "<br>";
    
    //$user=get_user($uid);
    //echo "<br>"
}