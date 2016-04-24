<?php
session_start();
?>

<?php
$pildid = array(
    array("src"=>"pildid/nameless1.jpg", "name"=>"pilt", "alt"=>"nimetu 1"),
    array("src"=>"pildid/nameless2.jpg", "name"=>"pilt", "alt"=>"nimetu 2"),
    array("src"=>"pildid/nameless3.jpg", "name"=>"pilt", "alt"=>"nimetu 3"),
    array("src"=>"pildid/nameless4.jpg", "name"=>"pilt", "alt"=>"nimetu 4"),
    array("src"=>"pildid/nameless5.jpg", "name"=>"pilt", "alt"=>"nimetu 5"),
    array("src"=>"pildid/nameless6.jpg", "name"=>"pilt", "alt"=>"nimetu 6")
);

require_once ("head.html");

if (!empty($_GET["mode"])) {
    $mode = $_GET["mode"];
} else {
    $mode = "pealeht";
}
switch ($mode) {
    case 'pealeht':
        include("pealeht.html");
        break;
    case 'galerii':
        include("galerii.html");
        break;
    case 'vote':
        if(!isset($_SESSION['voted_for'])) {
            include ("vote.html");
        } else {
            include ("tulemus.php");
        }
        break;
    case 'tulemus':
        include("tulemus.php");
        break;
    case 'lopeta_sessioon':
        $_SESSION = array();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }
        include ("pealeht.html");
        session_destroy();
        break;
    default:
        include("pealeht.html");
        break;
}


require_once("foot.html");
?>