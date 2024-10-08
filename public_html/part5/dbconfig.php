<?php
require_once("password.php");
/**
 * Configuration for database connection
 *
 */
function configure($host, &$username, &$password, &$options, $dbname, &$dsn)
{
    $host = $host ? $host : "localhost";
    $options = $options ? $options : array(PDO::ATTR_ERRMODE =>
    PDO::ERRMODE_EXCEPTION);
    $dbname = $dbname ? $dbname : "c_espinozaa_project";
    //$dbname = "University";
    $dsn = "mysql:host=$host;dbname=$dbname";
}
?>