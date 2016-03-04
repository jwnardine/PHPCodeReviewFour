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






    }
?>
