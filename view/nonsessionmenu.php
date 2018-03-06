<div class="container panel panel-info" id="contentdiv" style="">
	<div class="">
		<div class="panel-body" style="padding-bottom:0;">
			<div class="row" >
				<div class="col-md-6 well" align="center" style="height: 50%;">
					<button class="btn btn-warning btn-lg" style="margin-top: 20%;" id="guestuserbtn">
						I am new here
					</button>
				</div>
				<div class="col-md-6 well" align="center" style="height: 50%;" >
					<button class="btn btn-primary btn-lg" style="margin-top: 20%;" id="existuserbtn">
						I am existing here
					</button>
				</div>
			</div>	
		</div>
	</div>	
</div>	
<script>
	$("document").ready(function(){
		$("button").on("click",function(){
			var x = $(this).attr('id');
			
        	
			switch(x){
				case 'guestuserbtn':
					$.ajax({
						url: 'model/signup.php',
						success: function(result){
							$('#contentdiv').html(result);	
						}
					});
					break;
				case 'existuserbtn':
					$.ajax({
						url: 'model/signin.php',
						success: function(result){
							$('#contentdiv').html(result);	
						}
					});
					break;
			}		
		});	
	});	
</script>