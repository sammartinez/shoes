<?php


    class Brand
    {
        private $id;
        private $brand_name;

        //Constructors
        function __construct($id, $brand_name)
        {
            $this->id = $id;
            $this->brand_name = $brand_name;
        }

        //Getters
        function getId()
        {
            return $this->id;
        }

        function getBrandName()
        {
            return $this->brand_name;
        }

        //Setters
        function setBrandName($new_brand_name)
        {

        }
    }
?>
