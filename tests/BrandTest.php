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

        function testSave()
        {
           //Arrange

            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);
            //Act
            $test_brand->save();
            //Assert
            $result = Brand::getAll();

            $this->assertEquals($test_brand, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $brand_name = "Nike";
            $brand_name2 = "Adidas";
            $test_brand = new Brand($brand_name);
            $test_brand->save();
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();
            //Act
            $result = Brand::getAll();
            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $brand_name = "Nike";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);
            $test_brand->save();

            $brand_name2 = "Adidas";
            $id2 = 2;
            $test_brand2 = new Brand($brand_name2, $id2);
            $test_brand2->save();
            //Act
            Brand::deleteAll();
            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }



    }
?>
