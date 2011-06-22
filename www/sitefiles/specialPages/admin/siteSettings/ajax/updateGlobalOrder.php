<?php
	header("Content-type: text/xml");
?>
 
 <globalnav success="true">
<?php
	//absolute path to web directory
	$indexWebPathEnd=0;
	while(strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd) !== false){
		if (strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1) !== false){
			$indexWebPathEnd = strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1);
		}else {
			break;
		}
	}
	$absolutePath = substr($_SERVER['SCRIPT_FILENAME'], 0, $indexWebPathEnd)."/../../../../../";
	
	//gets all the required site-specific information
	require ($absolutePath.'profile.php');
	
	require($absolutePath.'/sitefiles/extras/dbconnect.php');
	
	for($i=0;isset($_POST[(string)$i]);$i++){
		$foofers = "UPDATE `page_data` SET `navIndex`='".$i."' WHERE `page`='".$_POST[(string)$i]."'";
		mysql_query($foofers);
		echo $_POST[(string)$i];
	}
	
?>
</globalnav>
<?php /*
-- phpMyAdmin SQL Dump
-- version 2.11.11
-- http://www.phpmyadmin.net
--
-- Host: www-db-staging.rit.edu
-- Generation Time: Jan 26, 2011 at 06:11 PM
-- Server version: 5.1.52
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `w_quidd`
--

-- --------------------------------------------------------

--
-- Table structure for table `page_data`
--

CREATE TABLE `page_data` (
  `navIndex` int(3) NOT NULL,
  `page` varchar(20) NOT NULL,
  `dataType` varchar(7) NOT NULL,
  `head` varchar(5000) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `adminContent` varchar(5000) NOT NULL,
  PRIMARY KEY (`page`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_data`
--

INSERT INTO `page_data` (`navIndex`, `page`, `dataType`, `head`, `content`, `adminContent`) VALUES
(0, 'main', 'content', '', '[big]Welcome to the RIT Quidditch Website![/big]\r\n\r\n\r\nMuggle Quidditch is the new sport that is <span style="font-style:italic">sweeping</span> the nation! Check out the [link url="http://internationalquidditch.org"]International Quidditch Association[/link] to see what''s new with quidditch and to see the hundreds of college and high school teams involved!\r\n\r\n\r\nFor more information, join us on [link url="http://www.facebook.com/group.php?gid=177210694136"]facebook[/link] and feel free to contact us with any questions, concerns or comments!\r\n\r\nAlso, don''t forget to like RIT''s IQA quidditch team: the Dark Marks!', ''),
(1, 'schedule', 'content', '', '[medium]Winter Quarter, 2010[/medium]\r\n\r\n\r\nWe are meeting sporadically during winter quarter. Send an email to RITQuidditch@gmail.com to join our mailing list or check back here for updated times.\r\n', ''),
(4, 'members', 'path', '', '../sitefiles/specialPages/members.php', '../sitefiles/specialPages/admin/editingNotSupported.php'),
(2, 'rules', 'content', '', '[big]Rules[/big]\r\n\r\nThere are 7 players per team: 3 Chasers, 2 Beaters, 1 Keeper, and 1 Seeker.  There is also an unbiased Snitch Runner on the field during game play.\r\n\r\nChasers score points by shooting the quaffle through the other team''s hoops.\r\n\r\nBeaters throw bludgers at opposing players to delay their team.  Players who are hit by an opposing bludger must drop the ball if they one have in their possession and touch one of their team''s hoops before returning to play.\r\n\r\nKeepers are quidditch''s version of a goalie.  They defend their team''s hoops, but are also allowed to leave the keeper zone and assume the role of a Chaser.\r\n\r\nSeekers are responsible for catching the snitch (a tennis ball in a sock hanging out the back of the Snitch Runner''s shorts).  \r\n\r\nThere is no set game duration unless agreed upon by both teams before the game begins; the game ends ONLY when the snitch is snatched.  10 points are awarded for each hoop goal scored, and 30 points are awarded to the team who caught the snitch.  The team with the most points after the snitch has been caught wins the game.  The snitch cannot be caught by a seeker if the Snitch Runner is on the ground, or the snitch is not securely attached to the Snitch Runner; any snitch catch that occurs under these conditions is invalid.  Seekers and Snitch Runners are allowed to leave the pitch (the field of game play) and travel between any set boundaries agreed upon by both teams before the game.  If a snitch snatch occurs off of the pitch, the Seeker who caught the snitch must return to the pitch before the catch can be acknowledged by a referee.\r\n\r\nPlayers are allowed to tackle or charge opposing players of only the same position (with the exception of a Keeper outside of the Keeper Zone) with clear intent to gain control of or defend the possession of the target ball.\r\n\r\nIQA rules require that at least 2 members of the opposite gender to the team''s field majority be on the field at all times.\r\n\r\nAll players must have a broom securely between their legs.  Any player who "dismounts" his/her broom is considered knocked-out and must touch one of his/her goal hoops before rejoining play.  Any plays made while out of play do not count.', ''),
(3, 'contact', 'path', '../sitefiles/specialPages/contact/contactHead.php', '../sitefiles/specialPages/contact/contactBody.php', '../sitefiles/specialPages/admin/editingNotSupported.php'),
(-1, 'communicationportal', 'path', '../../sitefiles/specialPages/admin/communicationPortal/communicationPortalHead.php', '../sitefiles/specialPages/admin/communicationPortal/index.php', '../sitefiles/specialPages/admin/communicationPortal/index.php'),
(-1, 'settings', 'path', '../../sitefiles/jquery/jquery_css_latest.php', '../sitefiles/specialPages/admin/siteSettings/index.php', '../sitefiles/specialPages/admin/siteSettings/index.php'),
(5, 'facebook', 'content', '', '<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like-box href="http://www.facebook.com/pages/RIT-Dark-Marks/158217877553813" width="570" connections="10" stream="true" header="true"></fb:like-box>', '');
*/?>