<?php

include_once 'config.php';

ini_set( 'display_errors', 'On' );
error_reporting( E_ALL );

function db_connect( )
{
    try {
        $dbh = new PDO('mysql:host='. Config::DB_HOST .';dbname='. Config::DB_NAME , Config::DB_LOGIN, Config::DB_PASS);
        
    } catch (PDOException $e) {
        http_response_code( 500 );
        exit( 'Internal Server Error '. $e->getMessage( ) );
    }

    if( $dbh == null ) exit( "db error" );
    return $dbh;
}

function validate( )
{
	$headers = apache_request_headers( );
	return isset( $headers['Authorization'] ) && $headers['Authorization'] == Config::SECRET_KEY;
}

function db_insert( )
{
    if( empty( $_POST['ip'] ) or empty( $_POST['host']) )
    {
        return false;
    }
        
    $dbh = db_connect( );
    $ip = $_POST['ip'];
    $host = $_POST['host'];
    $insert = "INSERT INTO ip (ip, host) VALUES ('$ip','$host')";
    $result =  $dbh->query( $insert );
    $dbh = null;
    return $result;
}

function show_user_ip( )
{
    if( !isset( $_GET['show'] ) )
    {
       return false;
    }
    echo $_SERVER['REMOTE_ADDR'];
    return true;
}


function process_request( $method )
{
    if( show_user_ip( ) ) exit;
    
    switch( $method ) 
    {
        case 'POST':
	if( validate( ) )
	{
	 	if( db_insert( ) )
		{
                    http_response_code( 201 );
                    echo "Created\n";
		}
                else
                {
                    http_response_code( 400 );
                    echo "Bad Request\n";
                }
        }
	else
        {
	 	http_response_code( 401 );
		echo "Unauthorized\n";
        }

        exit;

        case 'GET':
        // show site content
        break;
    
        default:
        // invalid request method
        header( 'HTTP/1.1 405 Method Not Allowed' );
        header( 'Allow: GET, PUT' );
        exit;
  }
    
}

function get_current_ip( )
{
    $dbh = db_connect( );
    $stmt = $dbh->prepare( 'SELECT * from ip  order by id desc limit 1' ); 
    $stmt->execute( ); 
    $result = $stmt->fetch( );
    $dbh = null;
    return $result;
}

function more_ips( )
{
    $dbh = db_connect( );
    $result = $dbh->query( 'SELECT * from ip  order by id desc limit 10' );
    $dbh = null;
    return $result;
}

?>