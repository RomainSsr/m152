<?php
/**
 * Created by PhpStorm.
 * User: Romain Sauser
 * Date: 24.01.2018
 * Time: 13:27
 */
require_once 'functions.inc.php';

if(isset($_POST['comment']) && isset($_FILES['file']['name']) && isset($_FILES['file']['type']))
{
    for($i=0;$i<count($_FILES['file']['name']);$i++)
    {
        comment($_POST['comment']);
        post($_FILES['file']['name'],$_FILES['file']['type']);
        move_uploaded_file($_FILES['file']['tmp_name'],'img/'.$_FILES['file']['name']);
    }

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
        <?php  for($i=0;$i<count(getNamePost());$i++){echo '<img src="./img/'.getNamePost()[$i]['nomMedia'] .'" height="100" width="150"> </br>';}?>
    </fieldset>
    </aside>

	</body>
</html>