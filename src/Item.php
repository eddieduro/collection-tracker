<?php

    class Item
    {
        private $name;

        function __construct($name)
        {
            $this->name = $name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO items (description) VALUES ('{$this->getName()}')");
        }

        static function getAll()
        {
            $returned_items = $GLOBALS['DB']->query("SELECT * FROM items;");
            $items = array();
            foreach($returned_items as $item){
                $name = $item['description'];
                $new_item = new Item($name);
                array_push($items, $new_item);
            }
            return $items;
        }
    }
?>
