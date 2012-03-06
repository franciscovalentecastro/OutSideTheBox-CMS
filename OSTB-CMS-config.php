<?php
	ini_set( "display_errors", true ); //Desplieg Errores PHP -iNSEGURO -Solo Debug
	
	date_default_timezone_set( "America/Mexico_City" );  // Zona Horario Fechs Script

	//Definicion Constantes
	
	//Conection Onfiguration	
	define( "DB_DSN", "mysql:host=localhost;dbname=OSTB-CMS" ); 
	define( "DB_USERNAME", "ostb-usr" );
	define( "DB_PASSWORD", "" );
	define( "ADMIN_USERNAME", "ostb-admin" );
	define( "ADMIN_PASSWORD", "ostb-admin" );
	
	//Site Configuration
	define( "CLASS_PATH", "Classes" );
	define( "TEMPLATE_PATH", "Templates" );
	define( "HOMEPAGE_NUM_ARTICLES", 5 );
	
 	// Exception Handler
	function handleException( $exception ) {
  		echo "Sorry, a problem occurred. Please try later.";
  		error_log( $exception->getMessage() );
	}
	set_exception_handler( 'handleException' );
	
	
	//Include Files
	require( CLASS_PATH . "/Article.php" ); //Include Article Class
	
?>