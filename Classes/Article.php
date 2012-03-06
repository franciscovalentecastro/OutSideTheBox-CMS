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
					return 0;				
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
		 
		    	return ( array ( "results" => $list, "totalRows" => $totalRows ) );
		  }
		 
		 
		  
		 
		  /*public function insert() {
		 
		    	// Does the Article object already have an ID?
		     	if ( !is_null( $this->id ) ) trigger_error ( "Article::insert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );
		 
		    	// Insert the Article
		    	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		    	$sql = "INSERT INTO Articles ( Article_PublicationDate, 
		    	Article_Title, 
		    	Article_Summary, 
		    	Article_Content ) 
		    	VALUES ( FROM_UNIXTIME(:publicationDate), :title, :summary, :content )";
		    	$st = $conn->prepare ( $sql );
		    	$st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
		    	$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
		    	$st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
		    	$st->bindValue( ":content", $this->content, PDO::PARAM_STR );
		    	$st->execute();
		    	$this->id = $conn->lastInsertId();
		    	$conn = null;
		  }
		 
		
		 
		  public function update() {
		 
		    	// Does the Article object have an ID?
		    	if ( is_null( $this->id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );
		    
		    	// Update the Article
		    	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		    	$sql = "UPDATE Articles SET Article_PublicationDate=FROM_UNIXTIME(:publicationDate), title=:title, summary=:summary, content=:content WHERE Article_Id = :id";
		    	$st = $conn->prepare ( $sql );
		    	$st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
		    	$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
		    	$st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
		    	$st->bindValue( ":content", $this->content, PDO::PARAM_STR );
		    	$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
		    	$st->execute();
		    	$conn = null;
		  }
		 
		 
		  public function delete() {
		 
		    	// Does the Article object have an ID?
		    	if ( is_null( $this->id ) ) trigger_error ( "Article::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );
		 
		    	// Delete the Article
		    	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		    	$st = $conn->prepare ( "DELETE FROM Articles WHERE Article_Id = :id LIMIT 1" );
		    	$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
		    	$st->execute();
		    	$conn = null;
		  }			*/
	}	
?>