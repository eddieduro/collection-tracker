<?php

    class Item
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO items (name) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_items = $GLOBALS['DB']->query("SELECT * FROM items;");
            $items = array();
            foreach($returned_items as $item){
                $name = $item['name'];
                $id = $item['id'];
                $new_item = new Item($name, $id);
                array_push($items, $new_item);
            }
            return $items;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM items;");
        }

        static function findId($search_id)
        {
            $found_item = null;
            $items = Item::getAll();

            foreach($items as $item){
                $item_id = $item->getId();
                if($search_id == $item_id){
                    $found_item = $item_id;
                }
            }
            return $found_item;
        }
        
        static function findName($search_name)
        {
            $found_item = null;
            $items = Item::getAll();

            foreach($items as $item){
                $item_name = $item->getName();
                if($search_name == $item_name){
                    $found_item = $item_name;
                }
            }
            return $found_item;
        }
    }
?>
