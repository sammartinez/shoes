<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_tests';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $id = null;
            $brand_name = "Nike";
            $test_brand = new Brand($id, $brand_name);
            $test_brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $id = null;
            $brand_name = "Nike";
            $test_brand = new Brand($id, $brand_name);
            $test_brand->save();

            $id2 = null;
            $brand_name2 = "Salamon";
            $test_brand2 = new Brand($id2, $brand_name2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $id = null;
            $brand_name = "Nike";
            $test_brand = new Brand($id, $brand_name);
            $test_brand->save();

            $brand_name2 = "Salamon";
            $test_brand2 = new Brand($id, $brand_name);
            $test_brand2->save();

            //Act
            Brand::deleteAll();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($id, $brand_name);
            $test_brand->save();

            $brand_name2 = "Adidas";
            $test_brand2 = new Brand($id, $brand_name2);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand->getId());
            //Assert
            $this->assertEquals($test_brand, $result);
        }

        function test_addStore()
        {
            //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($id, $brand_name);
            $test_brand->save();

            $store_name = "Fred Meyers";
            $test_store = new Store($id, $store_name);
            $test_store->save();

            //Act
            $test_brand->addStore($test_store);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store]);
        }

        function test_getStores()
        {
            //Arrange
            $id = null;
            $store_name = "Fred Meyers";
            $test_store = new Store($id, $store_name);
            $test_store->save();

            $id2 = null;
            $store_name2 = "Safeway";
            $test_store2 = new Store($id2, $store_name2);
            $test_store2->save();

            $id3 = null;
            $brand_name = "Nike";
            $test_brand = new Brand($id3, $brand_name);
            $test_brand->save();

            $id4 = null;
            $brand_name2 = "Vans";
            $test_brand2 = new Brand($id4, $brand_name2);
            $test_brand2->save();

            //Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);
            $test_brand2->addStore($test_store2);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store, $test_store2]);
        }
    }

 ?>
