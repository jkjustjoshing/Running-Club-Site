<?php

if ($admin == 1)
echo '<br />
<div id="menu" style="position:relative;left:-70px;width:950px;">
<a id="showmemberList" style="border:2px solid black;" href="javascript: menuChange(\'memberList\', 1);">MEMBER LIST</a>
<a id="showmyEdit" style="border:2px solid black;" href="javascript: menuChange(\'myEdit\', 1);">EDIT MY PREFS</a>
<a id="showeditMember" style="border:2px solid black;" href="javascript: menuChange(\'editMember\', 1);">EDIT ALL MEMBER INFO</a>
<a id="showaddMember" style="border:2px solid black;" href="javascript: menuChange(\'addMember\', 1);">ADD A MEMBER</a>
<a id="showmail" style="border:2px solid black;" href="javascript: menuChange(\'mail\', 1);">SEND AN EMAIL</a>
</div>';

else if ($admin == 0)
echo '<br />
<div id="menu">
<a id="showmemberList" style="border:2px solid black;" href="javascript: menuChange(\'memberList\', 2);">MEMBER LIST</a>
<a id="showmyEdit" style="border:2px solid black;" href="javascript: menuChange(\'myEdit\', 2);">EDIT MY PREFS</a>
</div>';

?>