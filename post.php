<?php
/**
 * Created by PhpStorm.
 * User: Romain Sauser
 * Date: 24.01.2018
 * Time: 13:38
 */

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>

<body>
<a href="index.php">Home</a></br>
<a href="post.php">Post</a>

<fieldset>
    <legend>Commenter </legend>
    <form action="index.php" method="post" enctype="multipart/form-data">
        Commentaire : <textarea type="" name="comment" id="comment"></textarea>
        <br />
        Image: <input type="file" multiple accept="image/*" name="file[]" id="file" >
            <br />
        <input type="submit" name="submit" value="Poster" >
    </form >
</fieldset>
</body>
</html>