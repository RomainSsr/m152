<?php
/**
 * Created by PhpStorm.
 * User: Romain Sauser
 * Date: 24.01.2018
 * Time: 13:27
 */
require_once 'functions.inc.php';

if(isset($_POST['comment']) && isset($_FILES['file']['name']) && isset($_FILES['file']['type'])) {
    $names = $_FILES['file']['name'];
    $types = $_FILES['file']['type'];
    $tmpNames = $_FILES['file']['tmp_name'];

    for ($i = 0; $i < count($names); $i++) {
        comment($_POST['comment']);
        post($names[$i], $types[$i]);
        move_uploaded_file($tmpNames[$i], 'img/' . $names[$i]);
    }
    $nbNamePost = getNamePost();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
	</head>

	<body>
    <a href="index.php">Home</a></br>
        <a href="post.php">Post</a>

    <h1><img src="./img/smileyFace.jpg" alt="Smiley face" height="100" width="150" >Bienvenue !</h1>
    <aside>
    <fieldset>
        <legend>Vos Posts</legend>
        <?php  for($i=0;$i<count($nbNamePost);$i++){echo '<img src="./img/'.$nbNamePost[$i]['nomMedia'] .'" height="100" width="150"> </br>';}?>
    </fieldset>
    </aside>

	</body>
</html>