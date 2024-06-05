<?php
// https://wits.ruc.dk/~tapm/Aflevering3/forside.php
require_once '/var/www/wits.ruc.dk/db.php';

session_start();



$brugernavn = $_POST['Brugernavn'];
$pass = $_POST['Adgangskode'];
if (login($brugernavn, $pass)) {
    echo $brugernavn . ' du er logget ind';
    echo "<br>" . "<br>";
    $uid = get_user($brugernavn);
    echo 'Fornavn ' . $uid['firstname'] . ' Efternavn ' . $uid['lastname'] . ' Brugernavn ' . $uid['uid'];
    echo '<a href="#" onclick="logout()">Log ud</a>';
echo "<p><a href='opret_post.php'>lav opslag</a></p>";
// echo "<p><a href='vis_post.php'>rediger opslag</a></p>";
    echo '<a href="vis_post.php?pid='.$pid.'&$uid='.$uid.'>Link to post</a>';

    $_SESSION['loggedIn'] = true;
} else {
    echo "Forkert password og eller brugernavn! Prøv igen";
    echo "<br>" . "<br>";
    echo " <p><a href='login.php'>Login side</a> </p>";
}
//user list

echo '<div class="brugerListe">';
echo 'Brugere:';
$uids=get_uids();
foreach ($uids as $uid) {
    $user=get_user($uid);
    echo '<br>';
    echo '<a href="pids.php?uid=' . $uid . '" >' . $user['firstname'] . '</a>';
    echo "<br>";
}echo '</div>';
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    echo '<script type="text/javascript">';
    echo 'function logout() {
            window.location.href = "logout.php";
        }';
    echo '</script>';
} else {
    echo '<script type="text/javascript">';
    echo 'function logout() {
            alert("You must be logged in to perform this action.");
        }';
    echo '</script>';
}
?>
<style>
    .brugerListe{
        background-color: #0077B5;
        margin: auto;
        padding: 20px;
        width: 20%;
        position: absolute;
        top: 50px;
        right: 50px;
    }
    
</style>
