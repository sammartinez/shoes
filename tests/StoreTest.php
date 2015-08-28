<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Brand.php';
    require_once 'src/Store.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes_tests';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function TestSave()
        {
            //Arrange
            $id = null;
            $store_name = "Nike";
            $test_store = new Store($id, $store_name);
            $test_store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store], $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $id = null;
            $store_name = "Nike";
            $test_store = new Store($id, $store_name);
            $test_store->save();

            $id2 = null;
            $store_name2 = "Poler";
            $test_store2 = new Store($id2, $store_name2);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $id = null;
            $store_name = "Nike";
            $test_store = new Store($id, $store_name);
            $test_store->save();

            $store_name2 = "Poler";
            $test_store2 = new Store($id, $store_name);
            $test_store2->save();

            //Act
            Store::deleteAll();

            //Assert
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }

        function testUpdate()
        {
            //Arrange
            $id = null;
            $store_name = "Nike";
            $test_store = new Store($id, $store_name);
            $test_store->save();

            $new_store_name = "Camera World";

            //Act
            $test_store->update($new_store_name);

            //Assert
            $this->assertEquals($test_store->getStoreName(), $new_store_name);
        }

        function test_addBrand()
        {
            //Arrange
            $store_name = "Fred Meyers";
            $test_store = new Store($id, $store_name);
            $test_store->save();

            $brand_name = "Nike";
            $test_brand = new Brand($id, $brand_name);
            $test_brand->save();
            //var_dump($test_brand);

            //Act
            $test_store->addBrand($test_brand);
            //var_dump($test_store);


            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand]);
            //var_dump($test_brand);
        }

        function test_getBrands()
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
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);
            $test_store2->addBrand($test_brand2);
            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand, $test_brand2]);
        }

        function test_find()
        {
            //Arrange
            $store_name = "Fred Meyers";
            $test_store = new Store($id, $store_name);
            $test_store->save();

            $store_name2 = "Walmart";
            $test_store2 = new Store($id, $store_name2);
            $test_store2->save();

            //Act
            $result = Store::find($test_store->getId());
            //Assert
            $this->assertEquals($test_store, $result);
        }

    }
 ?>
