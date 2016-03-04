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

        function testUpdate()
        {
            //Arrange
            $brand_name = "Nike";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);
            $test_brand->save();
            $new_brand_name = "Nike Kids";
            //Act
            $test_brand->update($new_brand_name);
            //Assert
            $this->assertEquals("Nike Kids", $test_brand->getBrandName());
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

        function testFind()
        {
            //Arrange
            $brand_name = "Nike";
            $brand_name2 = "Adidas";
            $test_brand = new Brand($brand_name);
            $test_brand->save();
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();
            //Act
            $result = Brand::find($test_brand->getId());
            //Assert
            $this->assertEquals($test_brand, $result);
        }

        function testAddStore()
       {
           //Arrange
           $store_name = "Foot Locker";
           $id = 1;
           $test_store = new Store($store_name, $id);
           $test_store->save();

           $brand_name = "Nike";
           $id2 = 2;
           $test_brand = new Brand($brand_name, $id2);
           $test_brand->save();

           //Act
           $test_brand->addStore($test_store);
           //Assert
           $this->assertEquals($test_brand->getStores(), [$test_store]);
       }

       function testGetStores()
       {
       //Arrange
           $store_name = "Foot Locker";
           $id = 1;
           $test_store = new Store($store_name, $id);
           $test_store->save();

           $store_name2 = "Nike Outlet";
           $id2 = 2;
           $test_store2 = new Store($store_name2, $id2);
           $test_store2->save();

           $brand_name = "Nike";
           $id3 = 3;
           $test_brand = new Brand($brand_name, $id3);
           $test_brand->save();

           //Act
           $test_brand->addStore($test_store);
           $test_brand->addStore($test_store2);
           //Assert
           $this->assertEquals($test_brand->getStores(), [$test_store, $test_store2]);
       }

       function testDelete()
       {
           //Arrange
           $store_name = "Foot Locker";
           $id = 1;
           $test_store = new Store($store_name, $id);
           $test_store->save();

           $brand_name = "Nike";
           $id2 = 2;
           $test_brand = new Brand($brand_name, $id2);
           $test_brand->save();
           //Act
           $test_brand->addStore($test_store);
           $test_brand->delete();
           //Assert
           $this->assertEquals([], $test_store->getBrands());
       }
    }
?>
