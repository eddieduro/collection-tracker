<?php
    /**
    * @backupGlobals disabled
    * @backupAttributes disabled
    */

    require 'src/Inventory.php';

    $server = 'mysql:host=localhost;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class InventoryTest extends PHPUnit_Framework_TestCase
    {
        
    }

?>
