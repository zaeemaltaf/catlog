<?php session_start();

$a = $_GET["id"];
$i = $_SESSION["index"];

if (!isset($_SESSION["count"])) {
    $_SESSION["count"] = array();
}

if (in_array($a, $_SESSION["count"])) {
    ?>
    <script>
        alert('Already in your Cart');
        window.location.href = "index.php";
    </script>
    <!-- echo " Already in your Cart"; -->
    <?php
}else{
    $_SESSION["count"][$i] = $a;
$i++;
$_SESSION["index"] = $i;
header("location: index.php");
}
    ?>