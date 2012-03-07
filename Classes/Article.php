<?php
	/**
	* Clase que gestiona articulos en la BD Mysql
	*/
	
	class Article{
		//Properties
		
		public $Article_Id=null;
		
		public $Article_PublicationDate=null;
		
		public $Article_Title=null;
		
		public $Article_Summary=null;
		
		public $Article_Content=null;
		
		//Metodos
		
		public function __construct( $data=array() ){			
			
			 if( isset( $data['Article_Id'] ) ) {  $this->Article_Id = (int) $data['Article_Id'];   }
			 if( isset( $data['Article_PublicationDate'] ) ){ $this->Article_PublicationDate = (string) $data['Article_PublicationDate'];  }
			 if( isset( $data['Article_Title'] ) )   { $this->Article_Title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['Article_Title'] ); }
			 if( isset( $data['Article_Summary'] ) ) { $this->Article_Summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['Article_Summary'] ); }
			 if( isset( $data['Article_Content'] ) ) { $this->Article_Content = $data['Article_Content']; } 	
			 				
		}	
		
			
		public function storeFormValues ( $params = array() ) {
 
		    // Store all the parameters
		    $this->__construct( $params );

		}
		
		/**
		*	Regresa un articulo basandose en su id
		*/
		 
		public static function getById( $id ) { // Get Article BY Id				
								
				$sql = "SELECT * FROM Articles WHERE Article_Id = $id ";
		    	$conn = mysql_connect( DB_HOST, DB_USERNAME, DB_PASSWORD ) or die('Not Connected : ' . mysql_error($conn) );
		    	$db_selected = mysql_select_db(DB_NAME,$conn) or die('Cant Select DB : '. mysql_error($conn));
				
				$query_result= mysql_query( $sql,$conn) or die('Query Error : '. mysql_error($conn));
						    	
		    	mysql_close($conn);
			
				if( mysql_num_rows($query_result) ){
					return mysql_fetch_array($query_result);		  
				}else{
					return false;				
				}						 
		 }
		  
		  /**
		  *Regresa todos los Articulos
		  */
		  
		  
		  public static function getList( $numRows=1000000, $order="Article_PublicationDate DESC" ) {
		    	$conn = mysql_connect( DB_HOST, DB_USERNAME, DB_PASSWORD ) or die('Not Connected : ' . mysql_error($conn) );
		    	$sql = "SELECT * FROM Articles ORDER BY $order LIMIT $numRows";
		 		$db_selected = mysql_select_db(DB_NAME,$conn) or die('Cant Select DB : '. mysql_error($conn));		
				$query_result= mysql_query( $sql,$conn) or die('Query Error : '. mysql_error($conn));
		 		mysql_close($conn);
		 		
		 		$totalRows=0;
		 		
		    	while ( $row = mysql_fetch_array($query_result) ) {
		      	$article = new Article( $row );
		      	$list[] = $article;
		      	
		      	$totalRows++;
		    	}
		 		if($totalRows){
		    		return ( array ( "results" => $list, "totalRows" => $totalRows ) );
				}else{
					return  array("results" => array(), "totalRows" => $totalRows  );
				}								  
		  }
		 
		 
		  /**
		  	*Inserting Article into DB
		  	*/ 
		 
		  public function insert() {
		 
		    	// Does the Article object already have an ID?
		     	if ( !is_null( $this->Article_Id ) ) {
		     		trigger_error ( "Article::insert(): Attempt to insert an Article object that already has its ID property set (to $this->Article_Id).", E_USER_ERROR );
				}		 
		 		
		    	// Insert the Article
		    	$conn =  mysql_connect( DB_HOST, ADMIN_USERNAME, ADMIN_PASSWORD ) or die('Not Connected : ' . mysql_error($conn) );
		  		$db_selected = mysql_select_db(DB_NAME,$conn) or die('Cant Select DB : '. mysql_error($conn));
		    	$sql = "INSERT INTO Articles ( Article_PublicationDate, Article_Title, Article_Summary, Article_Content ) 
		    	VALUES ( '$this->Article_PublicationDate' , '$this->Article_Title', '$this->Article_Summary', '$this->Article_Content' )";
		    	
		    	
		    	$query_result= mysql_query( $sql,$conn) or die('Query Error : '. mysql_error($conn));		 		
		 		
		 		mysql_close($conn);
		 		
		 		return $query_result;
		  }
		 
		
		/**
		*	Update Article in MYsql DB
		*/ 
		  public function update() {
		 
		    	// Does the Article object have an ID?
		    	if ( is_null( $this->Article_Id ) ) {
		    			trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );
		    	}
		    	
		    	// Update the Article
		    	$conn =  mysql_connect( DB_HOST, ADMIN_USERNAME, ADMIN_PASSWORD ) or die('Not Connected : ' . mysql_error($conn) );
		    	$db_selected = mysql_select_db(DB_NAME,$conn) or die('Cant Select DB : '. mysql_error($conn));
		    	
		    	$sql = "UPDATE Articles SET 
		    	 Article_PublicationDate = '$this->Article_PublicationDate' ,
		    	 Article_Title = '$this->Article_Title' , 
		    	 Article_Summary = '$this->Article_Summary' , 
		    	 Article_Content = '$this->Article_Content' 
		    	  WHERE Article_Id = '$this->Article_Id' ";
		    	 
		    	$query_result= mysql_query( $sql,$conn) or die('Query Error : '. mysql_error($conn));		 		
		 		mysql_close($conn);
		 		
		 		return $query_result;
		  }
		 
		 /**
		 * Delete Article 
		 */
		  public function delete() {
		 
		    	// Does the Article object have an ID?
		    	if ( is_null( $this->Article_Id ) ) {
		    		trigger_error ( "Article::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );
				}		 
		    	// Delete the Article
		    	$conn =  mysql_connect( DB_HOST, ADMIN_USERNAME, ADMIN_PASSWORD ) or die('Not Connected : ' . mysql_error($conn) );
		    	$db_selected = mysql_select_db(DB_NAME,$conn) or die('Cant Select DB : '. mysql_error($conn));
		    	
		    	
		    	$sql= "DELETE FROM Articles WHERE Article_Id = '$this->Article_Id' LIMIT 1" ;
		    	$query_result= mysql_query( $sql,$conn) or die('Query Error : '. mysql_error($conn));		 		
		 		mysql_close($conn);
		 		return $query_result;
		  }			
	}	
?>