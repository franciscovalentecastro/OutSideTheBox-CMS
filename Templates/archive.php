<?php include TEMPLATE_PATH."/include/header.php" ?>
 
      <h1>Article Archive</h1>
 
      <ul id="headlines" class="archive">
 
<?php foreach ( $results['articles'] as $article ) { ?>
 
        <li>
        		<div class="list-option">
         		 <h3>
            		<span class="list-date"><?php echo $article->Article_PublicationDate ?></span>
            			<a class="list-title" href=".?action=viewArticle&articleId=<?php echo $article->Article_Id?>"><?php echo $article->Article_Title ?></a>
          		 </h3>
          		<p><?php echo  $article->Article_Summary ?></p>
          	</div>
        </li>
 
<?php } ?>
 
      </ul>
 
      <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
      <p><a href="./">Return to Homepage</a></p>
 
<?php include TEMPLATE_PATH."/include/footer.php" ?>