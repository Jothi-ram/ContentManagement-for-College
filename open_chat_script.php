<?php
	$from = $_GET['from'];
	$reci = $_GET['reci'];
	require('functions/functions.php');
	session_start();
	$conn = connect();
//	echo "From: ".$from."<BR>To: ".$reci."<BR>";
	$active_user=0;
	if(isset($_GET['reci']))
		$active_user = $_GET['reci'];
	$get_user_list_sql = "SELECT Q1.chat_to, CONCAT(Q2.user_firstname,' ',Q2.user_lastname), Q1.CNT FNAME FROM (SELECT chat_to,SUM(CNT) CNT FROM ( SELECT DISTINCT chat_to,0 cnt FROM user_chat WHERE chat_from=".$_SESSION['user_id']."
							UNION 
							SELECT chat_from,SUM(1) cnt FROM user_chat WHERE red_by_admin=0 AND chat_to=".$_SESSION['user_id']." GROUP BY chat_from) A GROUP BY chat_to
							";
		if(isset($_GET['reci']))
			$get_user_list_sql.="UNION SELECT $active_user,0";
		$get_user_list_sql.=") Q1 INNER JOIN USERS Q2 ON Q2.user_id = Q1.chat_to";
		//echo $get_user_list_sql;
		$get_user_res = mysqli_query($conn,$get_user_list_sql);
	//echo $from." ".$reci;
?>
<table width="100%">
			<tr>
				<td width="20%" rowspan="2" style="vertical-align: top;padding-bottom: 2pt">
					<div id="user_list">
						<?php
							while($get_user_row = mysqli_fetch_array($get_user_res)){
								?>
								<div style="color:#2A4AAA;background-color:#CCC;padding:5pt;border-bottom:solid #888 1px;cursor:pointer" class="user_lists" onclick="load_chat(this,<?php echo $get_user_row[0].",'".$get_user_row[1]?>')">
									<h4><?php echo $get_user_row[1];
									if($get_user_row[2]>0)
										echo " - <i>".$get_user_row[2]."</i>";
									?> 
								</div>
								<?php
							}
						?>
					</div>
				</td>
				<td width="100%">
					<div style="height: 49vh;overflow-y: scroll" id="chat_display"></div>
				</td>
			</tr>
			<tr>
				<td style="border-top:solid 0px #FFF;">
					<div id="msgtxtbox" style="opacity:0">
					<input type='text' id='msgbox' onkeypress="check_to_send(event)" placeholder='Message text here' max-length=750 style='width:85%;font-size:12pt;padding: 3pt' autofocus>&nbsp;&nbsp;&nbsp;<button onclick="post_message()" class="btn btn-default" style="background-color:#2A4AAA; color:#EEE">Send</button></div>
				</td>
			</tr>
		</table>