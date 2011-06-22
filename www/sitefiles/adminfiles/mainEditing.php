<h2 style="margin:0;padding:0;">Edit the <?php echo strtoupper(substr($_GET['page'], 0, 1)).substr($_GET['page'], 1)?> Page</h2>
<br /><br />
<a href="javascript:formatting();">Click here for instructions on how to properly format the page</a>
<?php include ("instructions.php"); ?>

<?php

	$query = mysql_query("SELECT * from `page_data` WHERE `page`='".$_GET['page']."'");
	$data = mysql_fetch_array($query);
?>

<form action="" method="post">
<textarea name="main_content" cols="100" rows="20"><?php echo $data['content'];?></textarea>
<br />
<input type="submit" value="Modify the Page" />
</form>