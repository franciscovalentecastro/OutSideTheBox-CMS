<?php include TEMPLATE_PATH."/include/header.php" ?>
 
      <ul id="headlines">
 
<?php foreach ( $results['articles'] as $article ) { ?>
 
        <li>
          <h3>
            <span > <?php echo $article->Article_PublicationDate?> </span>
            	<a href=".?action=viewArticle&amp;articleId=<?php echo $article->Article_Id?>">
	            	<?php echo $article->Article_Title ?>
            	</a>
          </h3>
          <p> <?php echo $article->Article_Summary ?> </p>
        </li>
 
<?php } ?>
 
      </ul>
 
      <p> <a href="./?action=archive">Article Archive</a> </p>
 
<?php include TEMPLATE_PATH."/include/footer.php" ?>