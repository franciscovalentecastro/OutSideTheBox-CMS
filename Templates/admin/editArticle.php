<?php include TEMPLATE_PATH."/include/header.php" ?>
	   <div class="pres-class">
			      <div id="adminHeader">
			        <h2>Outside The Box</h2>
			        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
			      </div>
			 
			      <h1><?php echo $results['pageTitle']?></h1>
			 
			      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
			        <input type="hidden" name="articleId" value="<?php echo $results['article']->Article_Id ?>"/>
			 
			<?php if ( isset( $results['errorMessage'] ) ) { ?>
			        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
			<?php } ?>
			 
			        <ul class="form-input">
			 
			          <li>
			            <label for="title">Article Title</label>
			            <input type="text" name="Article_Title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->Article_Title )?>" />
			          </li>
			 
			          <li>
			            <label for="summary">Article Summary</label>
			            <textarea name="Article_Summary" id="summary" placeholder="Brief description of the article" required maxlength="1000" style="height: 5em;"><?php echo htmlspecialchars( $results['article']->Article_Summary )?></textarea>
			          </li>
			 
			          <li>
			            <label for="content">Article Content</label>
			            <textarea name="Article_Content" id="content" placeholder="The HTML content of the article" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['article']->Article_Content )?></textarea>
			          </li>
			 
			          <li>
			            <label for="publicationDate">Publication Date</label>
			            <input type="date" name="Article_PublicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['article']->Article_PublicationDate  ?>" />
			          </li>
			 
			 
			        </ul>
			 
			        <div class="buttons">
			          <input type="submit" name="saveChanges" value="Save Changes" />
			          <input type="submit" name="cancel" value="Cancel" />
			        </div>
			 
			      </form>
			 
			<?php if ( $results['article']->Article_Id ) { ?>
			      <p><a href="admin.php?action=deleteArticle&articleId=<?php echo $results['article']->Article_Id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
			<?php } ?>
	</div>
 
<?php include TEMPLATE_PATH."/include/footer.php" ?>