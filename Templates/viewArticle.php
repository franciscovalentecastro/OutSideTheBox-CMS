<?php include TEMPLATE_PATH."/include/header.php" ?>
 	<div id="article">
      <h1 style="width: 75%; "><?php echo $results['article']->Article_Title ?></h1>
      <div style="width: 75%; font-style: italic;"><?php echo $results['article']->Article_Summary ?></div>
      <div style="width: 75%;"><?php echo $results['article']->Article_Content?></div>
      <p class="pubDate">Published on <?php echo $results['article']->Article_PublicationDate ?></p>
 
      <p><a href="./">Return to Homepage</a></p>
 	</div>
<?php include TEMPLATE_PATH ."/include/footer.php" ?>