<?php
    class Brand
    {
        private $brand_name;
        private $id;

        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }

        function setBrandName($new_brand_name)
        {
            $this->brand_name = (string) $new_brand_name;
        }

        function getBrandName()
        {
            return $this->brand_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name)  VALUES ('{$this->getBrandName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_brand_name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET brand_name = '{$new_brand_name}' WHERE id = {$this->getId()};");
            $this->setBrandName($new_brand_name);
        }

        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand) {
                if ($brand->getId() == $search_id) {
                  $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
        }

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM
                brands JOIN stores_brands ON (brands.id = stores_brands.brand_id)
                    JOIN stores ON (stores_brands.store_id = stores.id)
                    WHERE brands.id = {$this->getId()};");

            $stores = array();
            foreach($returned_stores as $returned_store) {
                $store_name = $returned_store['store_name'];
                $id = $returned_store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
        }
        return $stores;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE brand_id = {$this->getId()};");
        }
    }
?>
