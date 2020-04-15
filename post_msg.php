<?php
	$from = $_GET['from'];
	$to = $_GET['to'];
	$msg = $_GET['msg_text'];
	//$postid = $_GET['postid'];
	$conn = mysqli_connect('localhost','root','','socialnetwork');
	$sql = "INSERT INTO user_chat(chat_from,chat_to,chat_msg) VALUES ($from,$to,'$msg')";
	$res1 = mysqli_query($conn, $sql);
	$sql_chat = "SELECT *, CASE WHEN chat_from=$to THEN 0 ELSE 1 END LEFT_FLG FROM user_chat WHERE ((chat_from=$from AND chat_to=$to) OR (chat_from=$to AND chat_to=$from)) ORDER BY chat_id";
	$res = mysqli_query($conn,$sql_chat);
	echo "<div style='display:;background-color:#DDD; width:100%;border-radius:4pt;padding-top:10pt;padding-bottom:10pt;padding-left:10pt; padding-right:10pt'><div id='chatbox'>";
	if(mysqli_num_rows($res)==0)
		echo "<CENTER><span style='color:#999'>Feel free to start private chat with admin</span></CENTER>";
	else{
		while($row = mysqli_fetch_array($res)){
			//echo $row[1].$row[2].$row[3].$row[4]."<BR>";
			if($row[6]!=1){
				echo "<div style='font-size:13pt;float:left;padding:5pt;background-color:#0A2A9A;color:#DDD;border-radius:10pt;padding-right:5pt; padding-left:5pt'>".$row[3]."<BR><span style='font-size:8pt;opacity:0.4;float:left'>".$row[5]."</span></div><BR><BR><BR><BR>";
			}else{
				echo "<div style='font-size:13pt;float:right;padding:5pt;background-color:#0A2A9A;color:#DDD;border-radius:10pt;padding-right:5pt; padding-left:5pt'>".$row[3]."<BR><span style='font-size:8pt;opacity:0.4;float:right'>".$row[5]."</span></div><BR><BR><BR><BR>";
			}
		}
	}
	mysqli_close($conn);
	echo '</div></div>';
?>