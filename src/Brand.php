<?php


    class Brand
    {
        private $id;
        private $brand_name;

        //Constructors
        function __construct($id = null, $brand_name)
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
            $this->brand_name = $new_brand_name;
        }

        //Save function
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getBrandName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //Static functions
        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();

            foreach ($returned_brands as $brand) {
                $brand_name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($id, $brand_name);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
        }
    }
?>
