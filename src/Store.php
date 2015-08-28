<?php


    class Store
    {
        private $id;
        private $store_name;

        //Constructors
        function __construct($id, $store_name)
        {
            $this->id = $id;
            $this->store_name = $store_name;
        }

        //Getters
        function getId()
        {
            return $this->id;
        }

        function getBrandName()
        {
            return $this->store_name;
        }

        //Setters
        function setBrandName($new_store_name)
        {

        }
    }
?>
