  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
			<li><a href="<?=base_url('app/sample')?>"><i class="fa fa-car"></i> <span>Vehicle Requests </span></a></li>
			   
<?php if((bool)$_SESSION['is_admin']) {?>
        <li class="header">ADMIN NAVIGATION</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url('app/users')?>"><i class="fa fa-circle-o"></i> User Management</a></li>
            <li><a href="<?=base_url('app/roles')?>"><i class="fa fa-circle-o"></i> Roles Management</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-asterisk"></i> <span>Libraries</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"> 
            <li><a href="<?=base_url('app/offices')?>"><i class="fa fa-circle-o"></i> Offices</a></li>
            <li><a href="<?=base_url('app/request_status')?>"><i class="fa fa-circle-o"></i> Request Status</a></li>
          </ul>
        </li>
<?php }?>        

        <li><a href="<?=base_url('app/user_guide')?>"><i class="fa fa-book"></i> <span>User Guide</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>