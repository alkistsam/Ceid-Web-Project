<?php 
  include('config.php');
  include('api/functions.php');
  $category = (!isset($_GET["category"])) ? "all" : htmlspecialchars(addslashes($_GET["category"]));
  $query = (!isset($_GET["query"])) ? null : htmlspecialchars(addslashes($_GET["query"]));
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="css/foundation.min.css" />
    <!-- personnal css -->
    <link rel="stylesheet" href="css/app.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- modernizr -->
    <!-- javascript library-->
    <script src="js/vendor/modernizr.js"></script>

    <!-- google map api -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
  </head>
  <body>
  <!-- the nav -->
  <nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
      <li class="name">
        <h1><a href="./">Ceid</a></h1>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
    </ul>

    <section class="top-bar-section">


      <!-- Nav Section -->
      <ul class="left">
        <li class="has-form">
          <form method="GET" id="searchform">
            <div class="row collapse"> 
              <div class="small-10 columns"> 
                <input type="hidden" name="category" value="<?php print $category; ?>"> 
                <input type="text" placeholder="Search for events" name="query" value="<?php print $query; ?>">
              </div>
              <div class="small-2 columns">
                <a class="button expand" onclick="document.getElementById('searchform').submit(); return false;"><i class="fa fa-search"></i></a>
              </div>
            </div>
          </form>
        </li>
      </ul>
    </section>
  </nav>

  <!-- the map -->
  <div class="row row-fluid">
    <div class="small-12 columns googlemap">
      <div id="map-canvas"></div>
    </div>
  </div>

  <div class="row">
    <!-- the menu -->
    <div class="small-12 medium-3 columns">
      <ul class="side-nav">
        <h4>Type of events</h4>
        <li <?php if($category == "all") print 'class="active"' ?>><a href="?category=all&query=<?php print $query; ?>">All</a></li>
        <li class="divider"></li>
        <?php
          $categories = json_decode(getCategories(),true);
          foreach($categories as $item) {
            ?>
              <li <?php if($category == $item["catName"]) print 'class="active"' ?>><a href="?category=<?php print $item["catName"]; ?>&query=<?php print $query; ?>"><?php print $item["newName"]; ?></a></li>
              <li class="divider"></li>
            <?php
          }
        ?>
      </ul>      
    </div>

    <!-- the events -->
    <div class="small-12 medium-9 columns">
      <div class="row">

        <div id="content"></div>
      </div>      
    </div>
  </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        function initialize() {
          var mapCanvas = document.getElementById('map-canvas');
          var myLatlng = new google.maps.LatLng(38.2466395, 21.734574000000066);
          var mapOptions = {
            center: myLatlng,
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
          }
          map = new google.maps.Map(mapCanvas, mapOptions);

          getEvents("<?php print $category; ?>","<?php print $query; ?>");
        }
        google.maps.event.addDomListener(window, 'load', initialize);

        function getEvents(category,query) {
          $.ajax({
            method: "GET",
            url: "api/calls.php?action=getEvents&category=" + category + "&query=" + query,
          }).done(function( response ) {
              response = JSON.parse(JSON.parse(response));

              $("#content").empty();
              for(var eventId in response) {
                if(response[eventId].show == 0) continue;
                var place = JSON.parse(response[eventId].place);

                if(place["location"] != undefined) {
                  var marker = new google.maps.Marker({
                      position: {lat: place["location"]["latitude"], lng: place["location"]["longitude"]},
                      map: map,
                      title: response[eventId].name,
                  });
                }
                
                $("#content").append(
                  '<div class="small-12 medium-4 columns left box">' +
                    '<p class="date-clock"><i class="fa fa-user"></i> ' + response[eventId].owner + '<br/><i class="fa fa-clock-o"></i> ' + response[eventId].hour + ' <br> <i class="fa fa-calendar-o"></i> ' + response[eventId].date + '</p>' + 
                    '<a class="th" role="button" aria-label="Thumbnail" href="' + response[eventId].photo + '"><img aria-hidden=true src="' + response[eventId].photo + '"/></a>' +
                    '<p class="text-justify description">' + response[eventId].description + '</p>' +
                  '</div>');
              }
          });
        }
      });
    </script>
  </body>
</html>
