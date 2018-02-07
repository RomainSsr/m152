<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 24.01.2018
 * Time: 13:55
 */
require_once 'mySql.inc.php';

/**
 * Crée et conserve une instance de connection à la base de données
 * @return PDO la connection
 */
function myDatabase() {
    static $dbc = null;

    if ($dbc == null) {
        try {
            $dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_PERSISTENT => true));
        }
        catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            die('Could not connect to MySQL');
        }
    }
    return $dbc;
}

/**
 * Enregistre un commentaire en base
 * @return boolean si tout est ok ou pas
 */
function comment() {



}

function InsertPost($comment, $fileName, $fileType) {
    $db = myDatabase();

    try {

        $db->beginTransaction();
        $sql = $db->prepare("INSERT INTO post (commentaire) VALUES (:comment)");
        $sql->bindParam(':comment', $comment, PDO::PARAM_STR);
        $sql->execute();
        $lastId = $db->lastInsertId();
        $nbMedias = count($fileName);
        for ($i=0;$i<$nbMedias;$i++) {
            $sql = $db->prepare("INSERT INTO media (nomFichierMedia,typeMedia,idPost) VALUES (:fileName,:fileType,:idPost)");
            $sql->bindParam(':fileName', $fileName[$i], PDO::PARAM_STR);
            $sql->bindParam(':fileType', $fileType[$i], PDO::PARAM_STR);
            $sql->bindParam(':idPost', $lastId, PDO::PARAM_INT);
            $sql->execute();
        }
        $db->commit();
        return true;
    }


    catch (PDOException $e) {
        $db->rollBack();
        return false;
    }

}

function getPostAndAssociatedMedias()
{
    try {
        $db = myDatabase();
        $sql = $db->prepare("SELECT idPost FROM Post ");
        $sql->execute();
        $result = $sql->fetchAll();
        for($i=0;$i<count($result);$i++) {
            $sql = $db->prepare("SELECT nomFichierMedia FROM media WHERE idPost = :idPostMedia");
            $sql->bindParam(':idPostPost', $result[$i], PDO::PARAM_STR);
            $sql->fetchAll();
            $sql->execute();
        }
        return $result;

    }
    catch (PDOException $e) {
        return false;
    }
}


?>