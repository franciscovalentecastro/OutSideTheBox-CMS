<?php include TEMPLATE_PATH."/include/header.php" ?>
 
      <ul id="headlines">
 
<?php foreach ( $results['articles'] as $article ) { ?>
 
        <li>
           	<div class="list-option">
          		<h3>
            		<span class="list-date" > <?php echo $article->Article_PublicationDate?> </span>
            			<a href=".?action=viewArticle&articleId=<?php echo $article->Article_Id?>" class="list-title">
	            			<?php echo $article->Article_Title ?>
            			</a>
          		</h3>
          		<p> <?php echo $article->Article_Summary ?> </p>
				</div>    
        </li>
 
<?php } ?>
 
      </ul>
 
      <p> <a href="./?action=archive">Article Archive</a> </p>
 
<?php include TEMPLATE_PATH."/include/footer.php" ?>