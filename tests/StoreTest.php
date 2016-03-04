<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once "src/Brand.php";

    // $server = 'mysql:host=localhost;dbname=shoe_test';
    // $username = 'root';
    // $password = 'root';
    // $DB = new PDO($server, $username, $password);

    Class StoreTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Store::deleteAll();
        //     Brand::deleteAll();
        // }

        function testGetStoreName()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;

            $test_store = new Store($store_name, $id);
            //Act
            $result = $test_store->getStoreName();
            //Assert
            $this->assertEquals("Foot Locker", $result);
        }

       function testGetId()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;

            $test_store = new Store($store_name, $id);
            //Act
            $result = $test_store->getId();
            //Assert
            $this->assertEquals(1, $result);
        }

        function testSave()
        {
            //Arrange

            $store_name = "Foot Locker";
            $test_store = new Store($store_name);
            //Act
            $test_store->save();
            //Assert
            $result = Store::getAll();

            $this->assertEquals($test_store, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $store_name = "Foot Locker";
            $store_name2 = "Nike Outlet";
            $test_store = new Store($store_name);
            $test_store->save();
            $test_store2 = new Store($store_name2);
            $test_store2->save();
            //Act
            $result = Store::getAll();
            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $store_name = "Foot Locker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $store_name2 = "Nike Outlet";
            $id = 2;
            $test_store2 = new Store($store_name2, $id);
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
            $store_name = "Foot Locker";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
            $store_name = "Lady Foot Locker";
            //Act
            $test_store->update($store_name);
            //Assert
            $this->assertEquals("Lady Foot Locker", $test_store->getStoreName());
        }








    }
?>
