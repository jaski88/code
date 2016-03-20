<?php
include_once 'actions.php';


process_request( $_SERVER['REQUEST_METHOD'] );

$ip = get_current_ip( );

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Dynamic IP Checker">
    <meta name="author" content="Rafał Jaskurzyński">

    <title>Dynamic IP Checker</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">

          <a class="navbar-brand" href="#">Dynamic IP Checker</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Your IP is: <?php  echo $ip['ip'] ?></h1>
        <p>Host: <?php echo $ip['host'] ?> <small>Added at: <?php echo $ip['time'] ?></small></p> 
        <p>
          <a id="show-more-btn" class="btn btn-lg btn-primary" href="#" role="button">Show older IPs &raquo;</a>
        </p>

        <p>
        <div id="show-more-tbl" style="display: none">
            <table  class="table table-bordered ips" >
                <tr>
                    <th>IP</th><th>Host</th><th>Time added</th>
                </tr>
                
                <?php foreach( more_ips( ) as $row ): ?>
                <tr>
                    <td><?php echo $row['ip'] ?></td><td><?php echo $row['host'] ?></td><td><?php echo $row['time'] ?></td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
        </p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <script>
    
    $(function(){
        $( "#show-more-btn" ).click(function() {
            $( "#show-more-tbl" ).slideToggle( "slow" );
            return false;
        }); 
    });
    
    </script>

  </body>
</html>









