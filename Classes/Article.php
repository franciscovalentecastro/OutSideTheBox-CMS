<?php
	/**
	* Clase que gestiona articulos en la BD Mysql
	*/
	
	class Article{
		//Properties
		
		public $id=null;
		
		public $publicationDate=null;
		
		public $title=null;
		
		public $summary=null;
		
		public $content=null;
		
		//Metodos
		
		public function __constuct( $data=array() ){
			
			 if( isset( $data['id'] ) ) {  $this->id = (int) $data['id'];   }
			 if( isset( $data['publicationDate'] ) ){ $this->publicationDate = (int) $data['publicationDate'];  }
			 if( isset( $data['title'] ) )   { $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] ); }
			 if( isset( $data['summary'] ) ) { $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['summary'] ); }
			 if( isset( $data['content'] ) ) { $this->content = $data['content']; } 	
							
		}	
		
			
		public function storeFormValues ( $params ) {
 
		    // Store all the parameters
		    $this->__construct( $params );
		 
		    // Parse and store the publication date
		    if ( isset($params['publicationDate']) ) {
		      	$publicationDate = explode ( '-', $params['publicationDate'] );
		 
		      	if ( count($publicationDate) == 3 ) {
		        		list ( $y, $m, $d ) = $publicationDate;
		        		$this->publicationDate = mktime ( 0, 0, 0, $m, $d, $y );
		      	}
		    }
		}

		 
		  public static function getById( $id ) {
		    	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		    	$sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles WHERE id = :id";
		    	$st = $conn->prepare( $sql );
		    	$st->bindValue( ":id", $id, PDO::PARAM_INT );
		    	$st->execute();
		    	$row = $st->fetch();
		    	$conn = null;
		    	if ( $row ) { return new Article( $row ); }
		  }
		  
		  
		  
		  public static function getList( $numRows=1000000, $order="Article_PublicationDate DESC" ) {
		    	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		    	$sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP( Article_PublicationDate ) AS Article_PublicationDate FROM Articles
		            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
		 
		      $st = $conn->prepare( $sql );
		    	$st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
		    	$st->execute();
		    	$list = array();
		 
		    	while ( $row = $st->fetch() ) {
		      	$article = new Article( $row );
		      	$list[] = $article;
		    	}
		 
		    	// Now get the total number of articles that matched the criteria
		    	$sql = "SELECT FOUND_ROWS() AS totalRows";
		    	$totalRows = $conn->query( $sql )->fetch();
		    	$conn = null;
		    	return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
		  }
		 
		 
		  
		 
		  public function insert() {
		 
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
		  }			
	}	
?>