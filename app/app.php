<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";
    $app = new Silex\Application();
    $app['debug'] = true;
    $server = 'mysql:host=localhost;dbname=shoe';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/stores", function() use ($app) {
        $store_name = $_POST['store_name'];
        $stores_name = new Store($store_name);
        $stores_name->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->get("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->get("/stores/{id}/edit", function($id) use($app){
        $store = Store::find($id);
        return $app['twig']->render('store_edit.html.twig', array('store' => $store));
    });

    $app->patch("stores_update/{id}", function($id) use ($app) {
        $store_name = $_POST['store_name'];
        $store = Store::find($id);
        $store->update($store_name);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->delete("/delete_store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/delete_stores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/add_brands", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $store->addBrand($brand);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'stores' => Store::getAll(), 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->get("/brands", function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });
    $app->post("/brands", function() use ($app) {
        $brand_name = $_POST['brand_name'];
        $brand = new Brand($brand_name);
        $brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });
    $app->get("/brands/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->get("/brands/{id}/edit", function($id) use($app){
        $brand = Brand::find($id);
        return $app['twig']->render('brand_edit.html.twig', array('brand' => $brand));
    });

    $app->patch("brands_update/{id}", function($id) use ($app) {
        $brand_name = $_POST['brand_name'];
        $brand = Brand::find($id);
        $brand->update($brand_name);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->delete("/delete_brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->delete();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->post("/delete_brands", function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/add_stores", function() use($app){
      $store = Store::find($_POST['store_id']);
      $brand = Brand::find($_POST['brand_id']);
      $brand->addStore($store);
      return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brands' => Brand::getAll(), 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->get("/index", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });
    return $app;
 ?>
