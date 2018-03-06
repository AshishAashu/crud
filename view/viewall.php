<?php
	require_once('../Controller/Data.php');
	require_once('../Controller/Connection.php');
	$dataobj = new Data;
	if(isset($_SESSION['dataobj'])) {
		$dataobj = unserialize($_SESSION['dataobj']);
	}
	$email = $dataobj->getValue('email');
	$c = new Connection;
	$c->set_pass("1234");
	$c->set_dbname("crud");
	$conn = $c->get_connection();
?>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="text-center">Name</th>
					<th class="text-center">Mobile</th>
					<th class="text-center">Email</th>
					<th class="text-center">User Type</th>
					<th class="text-center">Options<th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql= "select * from user_info";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()){
						if($row['email'] != $email){ 
				?>
				<tr id="tr<?php echo $row['id'];?>">
					<div id="viewdiv@<?php echo $row['id'];?>" style="display: none;">	
					<td class="text-center"><?php echo $row['name'];?></td>
					<td class="text-center"><?php echo $row['mobile'];?></td>
					<td class="text-center"><?php echo $row['email'];?></td>
					<td class="text-center"><?php echo $row['type'];?></td>
					<td class="text-center"><button
									id="change@<?php echo $row['id'];?>" class="btn btn-success">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</button>
						<button id="del@<?php echo $row['id'];?>" class="btn btn-danger">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
						</td>
					</div> 	
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>	
	</div>


 <div class="modal" id="formModal" style="width:50%;height: 50%;margin-left:25%;margin-top:5%;">
    
 </div>
	<script>
		$("document").ready(function(){
			$("button").click(function(){
				var id = $(this).attr("id");
				var idarr = id.split("@");
				if(idarr[0] == 'change'){
					$.ajax({
						url: './Controller/controlurl.php?type=<?php echo $dataobj->getValue('type')?>&'
						+'action=modalform&id='+idarr[1],
						success: function(data){
							$('#formModal').html(data).show();
						}
					});
				}else if(idarr[0] == 'del'){
					if(confirm("Are you sure to delete user:")){ 
						$.ajax({
							url:  './Controller/controlurl.php?type=<?php echo $dataobj->getValue('type')?>&'
							+'action=deleteuser&id='+idarr[1],
							success: function(data){
								alert("User Deleted");
								$.ajax({
									url: "./Controller/controlurl.php?type=admin&action=viewallprofile",
									success: function(result){
										$("#contentdiv").html(result);
									}
								});
							}
						});
					}	
				}
			});
		});
			
	</script>	
	