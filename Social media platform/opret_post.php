<?php
require_once '/var/www/wits.ruc.dk/db.php';
$uids = get_uids();
$pids = get_pids();

$pids_by_users = get_pids_by_uid($uids);




echo '<html>';
echo '<head>';
echo '<title>Opret post</title>';
echo '</head>';
echo '<body>';
echo '<div id="clock"></div>';
echo '<form method="post" enctype="multipart/form-data">'; // Add enctype attribute for file upload
echo '<label>Bruger:</label>';
echo '<select name="User">';
foreach ($uids as $uid) {
    $user = get_user($uid);
    echo '<option value="'.$user['uid'].'">'.$user['firstname'].' '.$user['lastname'].' '.$user['uid'].'</option>';
}
echo '</select>';
echo '<br><br>';
echo '<label>Titel:</label>';
echo '<input type="text" name="Title">';
echo '<br><br>';
echo '<label>Indhold:</label>';
echo '<br>';
echo '<textarea name="Text">Indsæt tekst</textarea>';
echo '<br>';
echo '<label>Billede:</label>'; // Add a label for the file input
echo '<input type="file" name="image">'; // Add file input
echo '<br>';
echo '<input type="submit" value="SUBMIT">';
// home button
echo '<button type="button" id="home-button"onclick="location.href=\'secretpage.php\'">Home</button>';
echo '</form>';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['Title']) && !empty($_POST['Text']) && !empty($_POST['User'])) {
    $title = $_POST['Title'];
    $content = $_POST['Text'];
    $userid = $_POST['User'];

    $new_pid = add_post($userid, $title, $content);

    // Process the uploaded image
    if (!empty($_FILES['image']['tmp_name'])) {
        $temp_path = $_FILES['image']['tmp_name'];
        $image_info = getimagesize($temp_path);
        $mime_type = $image_info['mime'];
        $type = str_replace('image/', '', $mime_type);
        
        $new_iid = add_image($temp_path, $type);

        // Use the add_attachment function to associate the image with the post
        add_attachment($new_pid, $new_iid);
    }

    echo "Post added successfully!";
    echo '<br>';
    echo "New Post ID: " . $new_pid; // Display the new post's PID
    echo '<br>';
    echo '<a href="vis_post.php?title='.$title.'&uid='.$userid.'&pid='.$new_pid.'">'.$title.'</a>';
    echo '<br>';
    echo $content;
    echo '<br>';
    echo $userid;
    echo '<br>';
    if (isset($new_iid)) {
        $image_info = get_image($new_iid);
        if (is_array($image_info)) {
            echo '<img src="' . $image_info['path'] . '" alt="' . $title . '">';
            echo '<br>';
        } else {
            echo 'Error retrieving image information.';
        }
    }
    
    
}

?>

<script>
    function updateTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        var timeString = hours + ':' + minutes + ':' + seconds;
        document.getElementById('clock').textContent = 'Current time: ' + timeString;
    }

    updateTime();
    setInterval(updateTime, 1000);
