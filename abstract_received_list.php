<?php include_once("header.php"); ?>
<div id="columnA">
	<h2>Abstracts Received List</h2>
	<div>
		<?php 
			$query="select * from UT_15 as a LEFT JOIN UT15_Abstract_Upload as b on a.utId=b.utId where a.delFlag='N' and b.delFlag='N' order by a.utId";
			$datas=exec_query($query); 
		?>
		<!-- <p style="font-weight:bold;text-align:right;">Total Abstracts are <?php //echo count($datas);?></p> -->
		<div class="admin_table">
		<?php
			if(count($datas)>0){?>
					<table id="" cellspacing="0" cellpadding="5" style="width:90%;">
						<tr>
							<th>Registration Id</th>
							<th>Author Name</th>
							<th>Abstract Title</th>
							
						</tr>
						<?php 
							foreach($datas as $key => $val){
									echo '
										<tr>
											<td>'.$val['utRegId'].'</td>
											<td>'.$val['title'].". ".ucfirst($val['name']).'</td>
											<td>'.ucfirst($val['utAbstractName']).'</td>
											
										</tr>
									';
							}
						?>				
					</table>
			<?php } else{
					echo "<p class='no_data'>No Abstract Avaliable.</p>";
				}

		?>
		</div>
	</div>
</div>
<?php include_once("side_menu.php"); ?>
<?php include_once("footer.php"); ?>