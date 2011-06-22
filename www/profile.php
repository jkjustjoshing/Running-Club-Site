<?php
/**************************

This is the location for site-specific data

Code by Josh Kramer, unless otherwise stated. 
Adapted from his initial design for the RIT
Running Club site.

**************************/

/*******    RIT Web Environment
* If the site is being used in the RIT web environment
* If this is set to true, RIT LDAP must be accessable
* via .htaccess
**/
$ritWebEnvironment = true;

/*******    Production and Staging URLs
* indicate staging and production URLs. Have
* them point to the directory that this file
* is sitting in. Please DO NOT PUT a trailing slash

Only use $productionURL if $ritWebEnvironment = true
**/

$productionURL = 'https://www.rit.edu/sg/runningclub';
$stagingURL = 'https://www-staging.rit.edu/sg/runningclub';



/*******    Database
* either specify an ABSOLUTE path to a file containing 
* the following variables:
* $dbusername, $dbpassword, $dbserver, and $dbdatabase
* or those variables here (less secure)
**/

$dbpath = '/../mysql_connect.php';

//OR

/*
$dbusername = '';
$dbpassword = '';
$dbserver = '';
$dbdatabase = '';
*/


/*******    Images
* Store all images in this section in the 
* media folder in the top web directory.
*
*
*
* The filename of the fovicon 
* Comment out for no favicon
**/

$faviconName = 'favicon.gif';


/* Either indicate a banner image (make sure it fits)
*  or banner text (make sure it isn't too big)
*/
$bannerName = 'header.gif';
//or
//$bannerText = NOT WORKING YET!!!!!
//or
//$bannerHTML = '<img src="http://www-staging.rit.edu/sg/quidditch/quidd-logo.jpg" style="height:150px;border-width:0px;" alt="RIT QUIDDITCH LOGO" /><span style="font-size:82pt;text-decoration:none;">RIT Quidditch</span>';



/*******    Global Navigation
* If you want Global Navigation to use images
* indicate the path for the folder containing 
* the images and the file extension. Use the
* naming convention contact1.jpg and contact2.jpg
* for the up and down images, respectively,
* for jpg's for the contact page.
*
* Comment all out for plain text
**/

$globalNavPath = 'sitefiles/media/nav_static/';
$globalNavImageExtension = 'jpg';

?>