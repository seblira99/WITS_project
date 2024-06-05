<?php

require_once '/var/www/wits.ruc.dk/db.php';

// Get uid from URL
$uid = $_GET['uid'];

// Fetch user information
$user = get_user($uid);

// Fetch all post IDs by the user
$post_ids = get_pids_by_uid($uid);

// Display user's name and a link to their posts
echo 'Logged in as: ';
echo '<a href="pids.php?uid='.$uid.'" >'.$user['firstname'].'</a>';
echo '<br><br>';

// Iterate through each post ID and display its details along with an edit link
foreach ($post_ids as $pid) {
    $post = get_post($pid);

    echo "Post by: ".$post['uid'];
    echo '<br><br>';
    echo "Title: ".$post['title'];
    echo '<br><br>';
    echo "Content: ".$post['content'];
    echo "<br>";
    echo "Pid:".$post['pid'];
    echo "<br>";
    echo '<a href="edit_post.php?uid='.$uid.'&pid='.$pid.'">Edit</a>';
    echo '<br><br>';
    // home button
echo '<button type="button" id="home-button"onclick="location.href=\'secretpage.php\'">Home</button>';
}

?>
