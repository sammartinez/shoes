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

    }
 ?>
