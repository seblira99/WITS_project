<?php

require_once '/var/www/wits.ruc.dk/db.php';

$pid = $_GET['pid'];
$uid = $_GET['uid'];

$post = get_post($pid);
$user = get_user($uid);

$iids = get_iids_by_pid($pid);

echo '<a href="pids.php?uid='.$uid.'" >'.$user['firstname'].'</a>';

echo "post af: ".$post['uid'];
echo "<br>";
echo "title: ".$post['title'];
echo "<br>";
echo "indhold: ".$post['content'];
echo "<br>";
echo "kommentarer:";
echo "<br>";
echo "pid:".$post['pid'];
echo "<br>";
// home button
echo '<button type="button" id="home-button"onclick="location.href=\'secretpage.php\'">Home</button>';

// Display image(s) matching the pid
foreach ($iids as $iid) {
    $image = get_image($iid);
    if ($image) {
        echo 'Image path: '.$image['path'].'<br>'; // Display the image path
        echo '<img src="'.$image['path'].'" alt="Image for post '.$pid.'"><br>';
    }
}

$cids = get_cids_by_pid($pid);

// Display comments
foreach ($cids as $cid) {
    $comment = get_comment($cid);
    echo '<a href="pids.php?uid='.$comment['uid'].'" >'.$comment['uid'].'</a> ';
    echo "<br>";
    echo $comment['content'];
    echo "<br>";
}

?>
