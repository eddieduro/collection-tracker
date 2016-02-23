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
        protected function tearDown()
        {
            Item::deleteAll();
        }

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

        function test_getId()
        {
            // Arrange
            $name = "minimoog";
            $id = 1;
            $test_item = new Item($name, $id);

            // Act
            $result = $test_item->getId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function test_getAll()
        {
            // Arrange
            $name1 = "juno 106";
            $test_item1 = new Item($name1);
            $test_item1->save();

            $name2 = "juno 60";
            $test_item2 = new Item($name2);
            $test_item2->save();

            // Act
            $result = Item::getAll();

            // Assert
            $this->assertEquals([$test_item1, $test_item2], $result);
        }

    
        function test_findName()
        {
            // Arrange
            $name1 = "juno 106";
            $test_item1 = new Item($name1);
            $test_item1->save();

            // Act
            $result = Item::findName($test_item1->getName());

            // Assert
            $this->assertEquals($name1, $result);
        }
        function test_deleteAll()
        {
            // Arrange
            $name1 = "juno 106";
            $test_item1 = new Item($name1);
            $test_item1->save();

            $name2 = "juno 60";
            $test_item2 = new Item($name2);
            $test_item2->save();

            // Act
            Item::deleteAll();

            // Assert
            $result = Item::getAll();
            $this->assertEquals([], $result);

        }
    }

?>
