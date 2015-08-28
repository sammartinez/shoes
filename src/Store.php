<?php


    class Store
    {
        private $id;
        private $store_name;

        //Constructors
        function __construct($id = null, $store_name)
        {
            $this->id = $id;
            $this->store_name = $store_name;
        }

        //Getters
        function getId()
        {
            return $this->id;
        }

        function getStoreName()
        {
            return $this->store_name;
        }

        //Setters
        function setStoreName($new_store_name)
        {
            $this->store_name = $new_store_name;
        }

        //Save function
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getStoreName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //Update function
        function update($new_store_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_store_name}' WHERE store_id = {$this->getId()};");
            $this->setStoreName($new_store_name);
        }

        //Delete function
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }

        //Adds a single brand to the join table
        function addBrand($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
        }

        //Gets all the brands from the join table in order to see which stores the brands are available at
        function getBrands()
        {
            $results = $GLOBALS['DB']->query(
                "SELECT brands.*FROM
                    stores JOIN brands_stores ON (stores.id = brands_stores.store_id)
                            JOIN brands ON (brands.id = brands_stores.brand_id)
                    WHERE stores.id = {$this->getId()};");

            $brands = array();

            foreach ($results as $result){
                $id = $result['id'];
                $brand_name = $result['name'];
                $new_brand_name = new Brand($id, $brand_name);
                array_push($brands, $new_brand_name);
            }
            return $brands;
        }

        //Static Functions
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();

            foreach ($returned_stores as $store) {
                $store_name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($id, $store_name);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function find($search_id)
        {
            $found_store = null;
            $all_stores = Store::getAll();
            foreach ($all_stores as $store) {
                if ($store->getId() == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }
    }
?>
