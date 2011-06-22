<?php


if (isset($_POST["submittedAdd"])){

	mysql_query("INSERT into members 
	(username, firstName, lastName, mailingList, preferredEmail, memberType_id) 
	VALUES 
	('".$_POST["username"]."', '".$_POST["firstName"]."', '".$_POST["lastName"]."', '".$_POST["mailingList"]."', '".$_POST["preferredEmail"]."', '".$_POST["memberType_id"]."')");
	
}

else if (isset($_POST["submittedEdit"])){
	$result = mysql_query("SELECT * from members"); //selects entire table
	while ($row = mysql_fetch_array($result)){
		$i = $row["username"];
		mysql_query("UPDATE members SET firstName='".$_POST[$i."firstName"]."' WHERE username='".$i."'");
		mysql_query("UPDATE members SET lastName='".$_POST[$i."lastName"]."' WHERE username='".$i."'");
		mysql_query("UPDATE members SET mailingList='".$_POST[$i."mailingList"]."' WHERE username='".$i."'");
		mysql_query("UPDATE members SET preferredEmail='".$_POST[$i."preferredEmail"]."' WHERE username='".$i."'");
		mysql_query("UPDATE members SET memberType_id='".$_POST[$i."memberType_id"]."' WHERE username='".$i."'");
	}

}

else if (isset($_POST["submittedmyEdit"])){

		$i = $_SERVER["REMOTE_USER"];
		mysql_query("UPDATE members SET firstName='".$_POST[$i."myfirstName"]."' WHERE username='".$i."'");
		mysql_query("UPDATE members SET lastName='".$_POST[$i."mylastName"]."' WHERE username='".$i."'");
		mysql_query("UPDATE members SET mailingList='".$_POST[$i."mymailingList"]."' WHERE username='".$i."'");
		mysql_query("UPDATE members SET preferredEmail='".$_POST[$i."mypreferredEmail"]."' WHERE username='".$i."'");
	

}

else if (isset($_POST["deleteradio"])){

	mysql_query("DELETE from members WHERE username='".$_POST["deleteradio"]."'");
}

else if (isset($_POST["selfDelete"])){

	mysql_query("DELETE from members WHERE username='".$_SERVER['REMOTE_USER']."'");
}

else if (isset($_POST["mailSent"])){
	include ("recognized/php_mailer.php");
}

else if (isset($_POST["newMemberSelf"])){
	$memberType = mysql_fetch_array(mysql_query("SELECT `id` FROM `member_types` WHERE `admin`=0"));

	mysql_query("INSERT into members 
	(username, firstName, lastName, mailingList, preferredEmail, memberType_id) 
	VALUES 
	('".$_SERVER["REMOTE_USER"]."', '".$_POST["firstName"]."', '".$_POST["lastName"]."', '".$_POST["mailingList"]."', '".$_POST["preferredEmail"]."', '".$memberType['id']."')");
}

else if (isset($_POST["submittedNewBlog"])){
	mysql_query("INSERT INTO `blog` (`username`, `title`, `content`)
	VALUES(
	'".$_SERVER['REMOTE_USER']."', 
	'".$_POST['blogTitle']."', 
	'".$_POST['blogContent']."')");
	$title = mysql_fetch_array(mysql_query("SELECT `title` FROM `blog` ORDER BY `date` DESC"));
	$title=$title['title'];
	//$successMessage = 'Your blog entry title "'.parseContent($title).'" has been published<br /><br />';
}
?>