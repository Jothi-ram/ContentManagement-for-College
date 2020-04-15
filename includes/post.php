<div class="post_items">
	<div class="post_items_header">
		<span class="postedby-name"><?php  echo '<a class="profilelink" data-toggle="modal" data-target="#showProfileModal" onclick="show_profile('.$row['user_id'].')">'.$row['user_firstname'].' '.$row['user_lastname'].'</a>'; ?></span>
		<div style="float:right"> <?php 
			if($row['post_time']>=172800)
	      		echo (int)($row['post_time']/172800)." days ago";
	      	else if($row['post_time']>86400)
	      		echo (int)($row['post_time']/86400)." day ago";
	      	else if($row['post_time']>3600 && (int)($row['post_time']/3600)>1 )
	      		echo (int)($row['post_time']/3600)." hours ago";
	      	else if((int)($row['post_time']/3600)==1)
	      		echo (int)($row['post_time']/3600)." hour ago";
	      	else if($row['post_time']>60)
	      		echo (int)($row['post_time']/60)." mins ago";
	      	else echo "Just Now";
		?></div>
	</div>
	<div class="post_items_body" style="padding-left:15pt; padding-top: 10pt">
		<?php echo $row['post_caption'];
				if($row['has_attachment']!=""){
					if(strtolower($row['has_attachment'])=='tiff'||strtolower($row['has_attachment'])=='jpg'||strtolower($row['has_attachment'])=='gif'||strtolower($row['has_attachment'])=='png')
						echo '<center><img src="data/images/posts/'.$row['post_id'].'.'.$row['has_attachment'].'" 	style="width:40%;border:solid 1px #2A4AAA" alt="'.$row['attachment_name'].'"><BR><BR></center>';
					else
						echo '<BR><a target="_blank" class="post_link_attachment" href="data/images/posts/'.$row['post_id'].'.'.$row['has_attachment'].'"><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;&nbsp;'.$row['attachment_name']."</a>";
				}
		 ?>
	</div>
	<div class="post_items_footer">
<?php
	if($row['user_id'] == $_SESSION['user_id'])
		echo '<form action="deletepost.php" method="post"><input type="text" name="postid" value="'.$row['post_id'].'" style="display:none"><button type="submit" class=" btn btn-default post_button glyphicon glyphicon-trash"></button></form>';
	else 
		echo '<form action="chatroom.php" method="post"><input type="text" name="recipient" value="'.$row['user_id'].'" style="display:none"><span data-toggle="modal" data-target="#ChatModal" onclick="open_chat_room('.$row['user_id'].','.$_SESSION['user_id'].')" class="post_button glyphicon glyphicon-comment btn btn-default post_button"></span></form>';
?>		
	<BR>
	</div>
</div>