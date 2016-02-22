<?php
    /**
    * @backupGlobals disabled
    * @backupAttributes disabled
    */

    require_once 'src/Item.php';

    $server = 'mysql:host=localhost;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ItemTest extends PHPUnit_Framework_TestCase
    {
        function test_save()
        {

            // Arrange
            $name = "juno 106";
            $test_item = new Item($name);

            // Act
            $test_item->save();

            // Assert
            $result = Item::getAll();
            $this->assertEquals($test_item, $result[0]);
        }
    }

?>
