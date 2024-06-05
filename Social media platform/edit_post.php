<?php

require_once '/var/www/wits.ruc.dk/db.php';

$pid = $_GET['pid'];
$uid = $_GET['uid'];




$post = get_post($pid);
$user = get_user($uid);

$iid_pid_list = get_iids_by_pid($pid);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['Title'];
    $content = $_POST['Text'];

    modify_post($pid, $title, $content);

    // Process the uploaded image
    if (!empty($_FILES['image']['tmp_name'])) {
        $temp_path = $_FILES['image']['tmp_name'];
        $type = pathinfo($temp_path, PATHINFO_EXTENSION);

        $new_iid = add_image($temp_path, $type);

        // Use the add_attachment function to associate the new image with the post
        add_attachment($pid, $new_iid);
    }

    header("Location: vis_post.php?uid=$uid");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <label>Title:</label>
    <input type="text" name="Title" value="<?php echo $post['title']; ?>">
    <br><br>
    <label>Content:</label>
    <br>
    <textarea name="Text"><?php echo $post['content']; ?></textarea>
    <br>

    <?php
    // Display the current image
    foreach ($iid_pid_list as $iid) {
        $image = get_image($iid);
        if ($image) {
            echo '<img src="'.$image['path'].'" alt="Image for post '.$pid.'"><br>';
            break;
        }
    }
    // home button
echo '<button type="button" id="home-button"onclick="location.href=\'secretpage.php\'">Home</button>';
    ?>

    <label>Change Image:</label>
    <input type="file" name="image">
    <br>
    <input type="submit" value="Update">
    
</form>
</body>
</html>
