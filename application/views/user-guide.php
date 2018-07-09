<?php require ('includes/head.php');?>
<?php require ('includes/nav-sidebar.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?=$this->config->item('app_full_name');?>
        <small>User Guide</small>
      </h1>
  
    </section>

    <!-- Main content -->
    <section class="content">
			<section id="dependencies">
        <h2 class="page-header first"><a href="#dependencies">Dependencies</a></h2>
        <p>AdminLTE depends on two main frameworks.
            The downloadable package contains both of these libraries, so you don't have to manually download them.</p>
        <ul class="bring-up">
            <li><a href="http://getbootstrap.com" target="_blank">Bootstrap 3</a></li>
            <li><a href="http://jquery.com/" target="_blank">jQuery 1.11+</a></li>
            <li><a href="#plugins">All other plugins are listed below</a></li>
        </ul>
    </section>
 

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; <?=date('Y')?> <a href="#">DSWD Caraga ICTMS</a>.</strong> All rights
    reserved.
  </footer>

   
<?php require ('includes/control-sidebar.php');?>
<!-- jQuery 3 -->
<script src="<?=base_url('assets/plugins')?>/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('assets/plugins')?>/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url('assets/plugins')?>/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url('assets/plugins')?>/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/plugins')?>/adminLTE/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets/plugins')?>/adminLTE/js/demo.js"></script>
<script src="<?=base_url('assets/plugins')?>/initialjs/initial.min.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('.profile').initial(); 
  })
</script>
</body>
</html>
