<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</nav>
	<div id="page-wrapper">
		<div class="container_fluid" style="margin-top:40px;">		
		<div class="row">
			<div class="col-lg-12">
				<?php echo form_open($action)?>
				<h1 class="page-header">Form Add <?php echo $pageHeader?></h1>
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
									if ($row['type']=='text') {
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
										echo form_dropdown($row['name'],$option,'',$row['class']);
										echo "</div>";
										echo "</div>";
									}
									elseif($row['type']=='upload')
									{
										echo "<div class='col-lg-12'>";
										echo "<div class='form-group'>";
										echo "<label>".$row['label']."</label>";
										echo form_upload($row);
										echo "</div>";
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
	$("#btnCancel").click(function(){
    	window.location.assign('<?php echo base_url().$cancel?>');
	});
</script>
