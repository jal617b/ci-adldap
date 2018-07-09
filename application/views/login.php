<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
     <title><?=$this->config->item('app_title');?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url('assets/plugins')?>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
    </style>
    <script src="<?=base_url('assets/plugins')?>/jquery/dist/jquery.min.js"></script>
    <script src="<?=base_url('assets/plugins')?>/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url('assets/plugins')?>/bootbox/bootbox.min.js"></script>
</head>
<body>
	    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#"> </a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post" action="<?php echo base_url('user/login');?>">
								<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>"> 
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username" required>                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required>
                                    </div>
                                    

<!--                           
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>
-->
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">
                                    
									    <input type="submit" id="btn-login" href="#" class="btn btn-success btn-block" value="Login">  </input>
                                   </div>
                                </div>
								
								
                            </form>     
                        </div>                     
                    </div>  
					
<?php if(isset($_SESSION['login_msg'])) {?>
		 <div class="alert alert-danger" role="alert">
				<strong>Login: </strong><?php echo $_SESSION['login_msg'];?>.  
		</div>
		<?php } else {?>
    <div class="alert alert-info" role="alert">
      Please login with your DSWD Active Directory account. 
          <a href="#"  data-toggle="modal" data-target="#about-ad" title="What is this?">
              <span class="glyphicon glyphicon-info-sign pull-right"></span>
            </a>
     </div>
	<?php }?>
        </div>
		
    </div>
    
	<script type="text/javascript">
     
    </script>
    
     
 
 
    <div id="about-ad" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Login Info</h4>
                </div>
                <div class="modal-body">
                    <p>Add the <code>.modal-lg</code> class on <code>.modal-dialog</code> to create this large modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
          
                </div>
            </div>
        </div>
    

</body>
</html>