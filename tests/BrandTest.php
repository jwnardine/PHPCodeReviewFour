<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoe_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    Class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function testGetBrandName()
        {
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);

            $result = $test_brand->getBrandName();

            $this->assertEquals($brand_name, $result);
        }

        function testSetBrandName()
        {
           //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);
            //Act
            $test_brand->setBrandName("Nike");
            $result = $test_brand->getBrandName();
            //Assert
            $this->assertEquals("Nike", $result);
        }

       function testGetId()
        {
            //Arrange
            $brand_name = "Nike";
            $id = 1;

            $test_brand = new Brand($brand_name, $id);
            //Act
            $result = $test_brand->getId();
            //Assert
            $this->assertEquals(1, $result);
        }

    }
?>
