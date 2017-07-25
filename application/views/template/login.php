<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
        <link rel="stylesheet" href="<?php echo base_url()?>assets/login/css/style.css">
  </head>

  <body>

    
<div class="container">
	<section id="content">
		
		<?php echo validation_errors()?>
		<?php echo form_open('admin/Login')?>
			<h1>Login Form</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="txtUsername" id="username" />
			</div>
			<div>
				<input type="password" name="txtPass" placeholder="Password" required="" id="password" />
				<span style="font-weight:bold;color:red;"><?php echo $msg?></span>
			</div>
			<div>

				<input type="submit" value="Log in" />
				<a href="#">Lost your password?</a>
				<a href="#">Register</a>
			</div>
		</form><!-- form -->
		
	</section><!-- content -->
</div><!-- container -->
    
        <script src="<?php echo base_url()?>assets/login/js/index.js"></script>
  </body>
</html>
