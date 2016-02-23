<?php

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Item.php';

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider, array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function () use ($app){
        return $app['twig']->render("index.html.twig");
    });

    $app->get("/items", function () use ($app){
        return $app['twig']->render("items.html.twig", array(
            'items' => Item::getAll()
        ));
    });

    $app->post("/items", function () use ($app){
        $new_item = new Item($_POST['name']);
        $new_item->save();
        return $app['twig']->render("items.html.twig", array(
            'items' => Item::getAll()
        ));
    });

    $app->get("/search_items", function () use ($app){
        return $app['twig']->render("search.html.twig");
    });

    $app->post("/results", function () use ($app){
        $items = array();
        $search_item = strtolower($_POST['itemSearch']);
        $current_items = Item::getAll();
        foreach($current_items as $item ){
            if(strtolower($item->getName()) == $search_item ){
                array_push($items, $item);
            }
        }
        return $app['twig']->render("results.html.twig", array(
            'items' => $items
        ));
    });
    // $app->post("/search_items", function () use ($app){
    //     $results = Item::findName();
    //     return $app['twig']->render("results.html.twig", array(
    //         'items' => Item::getAll(), 'results' => $results
    //     ));
    // });

    $app->post("/delete_items", function () use ($app) {
        Item::deleteAll();
        return $app['twig']->render("index.html.twig");
    });
    return $app;
?>
