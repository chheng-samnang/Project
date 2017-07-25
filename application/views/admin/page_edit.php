<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</nav>
	<div id="page-wrapper">
		<div class="container_fluid" style="margin-top:40px;">
		<div class="row">
			<div class="col-lg-12">
				<?php echo isset($multipart)?form_open_multipart($action):form_open($action)?>
				<h1 class="page-header">Form Edit <?php echo $pageHeader?></h1>
				<div class="row">
					<div class="col-lg-12">
					<?php
						if(!empty($error) OR validation_errors())
						{
					?>
						<div class="alert alert-danger" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
							<strong>Attention!</strong><?php if(!empty($error)){echo $error;}if(validation_errors()){echo validation_errors();}?>
						</div>
					<?php }?>
					</div>
				</div>

				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $pageHeader?> Information</h3>
					</div>
					<div class="panel-body">
						<div class="row">
						<?php
							foreach ($ctrl as $row) {
								if(!isset($row[0]['type']))
								{
									if ($row['type']=='text' || $row['type']=="email") {
										echo "<div class='col-lg-4'>";
										echo "<div class='form-group'>";
										echo "<label>".$row['label']."</label>";
										echo form_input($row);
										echo "</div>";
										echo "</div>";
									}elseif($row['type']=='password')
									{
										echo "<div class='col-lg-4'>";
										echo "<div class='form-group'>";
										echo "<label>".$row['label']."</label>";
										echo form_password($row);
										echo "</div>";
										echo "</div>";
									}
									elseif($row['type']=='hidden')
									{
										echo "<div class='col-lg-4'>";
										echo "<div class='form-group'>";
										echo "<label>".$row['label']."</label>";
										echo form_hidden($row);
										echo "</div>";
										echo "</div>";
									}
									elseif($row['type']=='dropdown')
									{
										echo "<div class='col-lg-4'>";
										echo "<div class='form-group'>";
										echo "<label>".$row['label']."</label>";
										echo form_dropdown($row['name'],$row['option'],$row['selected'],$row['class']);
										echo "</div>";
										echo "</div>";
									}
									elseif($row['type']=='upload')
									{
										echo "<div class='col-lg-2'>";
										echo "<div class='form-group'>";
										echo "<label>".$row['label']."</label><br/>";
										echo '<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal">Upload Image</button>';
										echo "</div>";
										echo "</div>";
										echo "<div class='col-lg-1'>";
										echo $row['img'];
										echo "</div>";										
									}
									elseif($row['type']=='textarea')
									{
										echo "<div class='col-lg-12'>";
										echo "<div class='form-group'>";
										echo "<label>".$row['label']."</label>";
										echo form_textarea($row);
										echo "</div>";
										echo "</div>";
									}	
								}
								else
								{
									if($row[0]['type']=='checkbox')
									{
										echo "<div class='col-lg-4'>";
										echo "<div class='form-group'>";
										echo "<label>".$row[0]['chkLabel']."</label> <br />";
										foreach ($row as $value) 
										{
											
											echo $value['label']." ";
											echo form_checkbox($value);
												
										}
										echo "</div>";
											echo "</div>";	
									}elseif($row[0]['type']=='radio')
									{
										echo "<div class='col-lg-4'>";
										echo "<div class='form-group'>";
										foreach ($row as $value) 
										{
											
											echo "<label>".$value['label']."</label>";
											echo form_radio($value);
										}
										echo "</div>";
											echo "</div>";
									}
									
									
								}
							}
							
						?>

						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Browse Image</h4>
										  </div>
										  <div class="modal-body">
											<input	type="file" name="txtUpload" />
											<input type="hidden" id="txtImgName" name="txtImgName" />
											<div id="response" style="margin-top:10px;color:green;font-weight:bold;"></div>
										  </div>
										  <div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary" onclick="uploadFile()">Upload</button>
										  </div>
										</div>
									  </div>
									</div>
							</div>
						</div>
						<hr />
						<div class="row">
							<div class="col-lg-12">
								<?php echo form_submit('btnSubmit','Update','class="btn btn-success"');?>
								<?php echo form_button('btnCancel','Cancel','id="btnCancel" class="btn btn-default"');?>
							</div>
						</div>
					</div>
				</div>
				<?php echo form_close()?>
			</div>
		</div>
	</div>
</div>

<script>
	function uploadFile() {
		var formData = new FormData();
		formData.append('image', $('input[type=file]')[0].files[0]); 
		$.ajax({
			url: '<?php echo base_url()?>ng/upload.php',
			data: formData,
			type: 'POST',
			// THIS MUST BE DONE FOR FILE UPLOADING
			contentType: false,
			processData: false,
			// ... Other options like success and etc
			
			success: function(data) {
				document.getElementById("response").innerText = "Upload Complete!"; 
				document.getElementById("txtImgName").value = data;
			}
			
		});
		
	}
</script>
<script>
	$("#btnCancel").click(function(){
    	window.location.assign('<?php echo base_url().$cancel?>');
	});
</script>
