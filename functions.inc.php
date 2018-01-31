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
function comment($comment) {

    try {
        $db = myDatabase();
        $sql = $db->prepare("INSERT INTO post (commentairea) VALUES (:comment)");
        $sql->bindParam(':comment', $comment, PDO::PARAM_STR);

        $sql->execute();
        return true;

    }
    catch (PDOException $e) {
        return false;
    }

}

function post($fileName, $fileType) {

    try {
        $db = myDatabase();
        $sql = $db->prepare("INSERT INTO media (nomFichierMedia,typeMedia) VALUES (:fileName,:fileType)");
        $sql->bindParam(':fileName', $fileName, PDO::PARAM_STR);
        $sql->bindParam(':fileType', $fileType, PDO::PARAM_STR);
        $sql->execute();
        return true;

    }
    catch (PDOException $e) {
        return false;
    }

}

function getNamePost()
{
    try {
        $db = myDatabase();
        $sql = $db->prepare("SELECT nomFichierMedia FROM media ");
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;

    }
    catch (PDOException $e) {
        return false;
    }
}
?>