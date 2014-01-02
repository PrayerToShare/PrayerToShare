<div class="title">Prayer Book</div>
<div class="followers_cnt">
	Friends 
    <span>
    	<a href="#">
			<?php
                $sql = "SELECT id FROM friends WHERE uid = " . $_SESSION['user']['id'];
                $r = mysql_query($sql);
                echo mysql_num_rows($r) ? '(' . mysql_num_rows($r) . ')' : '(0)'; 
            ?>
    	</a>
    </span>
</div>
<div class="notebook_cnt">Notebook <span>(<a href="#"><?php echo $_SESSION['user']['notebook_cnt'] != '' ? $_SESSION['user']['notebook_cnt'] : '0'; ?></a>)</span></div>