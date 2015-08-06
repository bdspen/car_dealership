<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";
    // starts the $_SESSION superglobal variable, which is an array of arrays
    session_start();

    if (empty($_SESSION['list_of_cars'])) {
      $_SESSION['list_of_cars'] = array(); //created 'list of cars' array///////////////////////////
    }

    $app = new Silex\Application();//created Silex object

$app['debug']=true; //use this tool to debug silex

    //tells twig to look for our template in the views folder
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
    ));
    //call get function on app object, sending results from getAll static method to
    //array called cars which is sent to .twig file.
    $app->get("/", function() use ($app){
      return $app['twig']->render('car_select.html.twig');
    });

    //shows html create ad form
    $app->get("/create_ad", function() use ($app) {

      return $app['twig']->render('create_ad.html.twig');
  });
    //uses the show.all template...sends ALL cars in session to be viewed
    $app->post("/show_all", function() use ($app) {
      $car = new Car($_POST['model'], $_POST['image'], $_POST['miles'], $_POST['price']); //all the stuff from the ad
      $car->save();
      return $app['twig']->render('show_all.html.twig', array('cars' => Car::getAll()));
    });


    //goes to the same twig template, but uses logic to filter the array, so you only
    //see cars within your search parameters $matching_cars
    $app->get("/search_results", function() use ($app){

      $cars = Car::getAll();
      $user_miles = $_GET['mileage'];
      $user_price = $_GET['price'];
      $matching_cars = array();

      foreach ($cars as $car) {
        if ($car->getMiles() < $user_miles && $car->getPrice() < $user_price){
          array_push($matching_cars, $car);
        }
      }


      return $app['twig']->render('show_all.html.twig',array('cars' => $matching_cars));
    });

    //route which deletes all car instances and displays the create ad form
    $app->get("/delete_ads",function() use ($app)
    {
      Car::deleteAll();
      return $app['twig']->render('create_ad.html.twig');
    });

    return $app;
 ?>
