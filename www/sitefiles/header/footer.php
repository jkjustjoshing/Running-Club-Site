<div style="height:40px;"><!-- Creates empty space beneath content -->
</div>

</div></div>

<div id="footer-gradient"><!-- Creates gradient beneath content - make this changeable with GD -->
</div>

<div id="editFooter" style="height:15px;width:964px;"><!-- Creates white space beneath content -->

	<?php 
		if (@!isset($_GET['admin']) || $_GET['admin'] != 'true')
			echo '<a href="admin">Edit this Page</a>';
	?>
	<a style="float:right;" href="<?php echo $webDir; ?>/settings">Site Settings</a>
</div>
</body>
</html>
