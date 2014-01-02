<label>Prayer Requests</label>
<div class="requests">
<?php
	$sql = "SELECT * FROM posts INNER JOIN friends ON friends.fid = posts.uid INNER JOIN users ON friends.fid = users.id WHERE friends.uid = ".$_SESSION['user']['id']." ORDER BY posts.date DESC";
	if ($r = mysql_query($sql)) {
		if (mysql_num_rows($r) > 0) {
			while ($row = mysql_fetch_array($r)) {
				$t = $row['date'];
				echo '<div class="req">';
				echo '<div class="i"><a href="' . $absolute_url . '!u/' . $row['folder'] . '"><img src="';
				if ($row['profile_img_url'] != '') 
					echo $row['profile_img_url'];
				else 
					echo $absolute_url.$theme_path.'/images/noprofileimage.jpg';
				echo '" /></a></div>';
				echo '<div class="post">';
				echo '<div class="n"><a href="' . $absolute_url . '!u/' . $row['folder'] . '">' . $row['first_name'] . ' ' . $row['last_name'] . '</a></div>';
				echo '<div class="t">' . $row['text'] . '<div class="oq"></div><div class="cq"></div></div>';
				echo '<div class="d"><b>' . date('l, F d, Y',$t) . '</b><br />' . date('g:i A T',$t) . '</div>';
				echo '</div>';
				echo '</div>';
			}
		} else {
			echo "No prayer requests";	
		}
	} else {
		echo "No prayer requests";
	}
?>
</div>