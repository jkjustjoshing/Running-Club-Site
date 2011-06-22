<br />
	
	<h3>
		As a club we go to many local races.  They are by no means mandatory, however
		they are a great club bonding experience and a lot of fun.  If you are a consistent
		club member the club will pay some or all of the race fee for many of the races we 
		go to. See the <a href="../gallery">gallery</a> for pictures!
	</h3>	
	
<br />
<u>Upcoming Races</u><br />
<span class="tab">
	<?php 
	$currentFilling = "past";//variable that stores whether we are filling in past of future events
	
	$row = mysql_query("SELECT * from races ORDER BY date");
	while ($result = mysql_fetch_array($row)){
		if (time() <= strtotime($result["date"])){ //in the future or today
			echo "<a href=\"".$result["url"]."\">".date("M jS", strtotime($result["date"]))." - "
					.$result["linkText"]." (".$result["location"].")</a><br />";
		}
	}
	?>
	
</span><br /><br /><br /><u>Past Races</u> <span style="font-size:9pt;">(the past month)</span><br /><span class="tab">
<?php	
	$row = mysql_query("SELECT * from races ORDER BY date DESC");
	while ($result = mysql_fetch_array($row)){
		if (time() > strtotime($result["date"]) && (time() - (60*60*24*30)) < strtotime($result["date"])){ //in the future or today
			echo "<a href=\"".$result["url"]."\">".date("M jS", strtotime($result["date"]))." - "
					.$result["linkText"]." (".$result["location"].")</a><br />";
		}
	}
	?>
	
</span>
<br /><br />

<!--Bryce asked me to post these, 10/20/10. make better in future?  -josh -->
<u>Results</u><br />
<a href="Brick-City-2010-Results.htm">October 17th, 2010 - Brick City 5k (RIT Campus)</a>


<br /><br />
Other race information can be found at:<br />
<span class="tab"><a href="www.grtconline.org">www.grtconline.org</a><br />
<a href="www.yellowjacketracing.com">www.yellowjacketracing.com</a></span>
<br /><br /><br />