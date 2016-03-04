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
    }
?>
