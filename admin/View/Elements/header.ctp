<header class="navbar navbar-default navbar-static-top">
    <!-- start: NAVBAR HEADER -->
    <div class="navbar-header">
        <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
            <i class="ti-align-justify"></i>
        </a>
         
         
         <span id="site_logo1" class="show_me1" style="font-size:30px;padding:0px 30px;"><?php 
	 
	 //echo $this->Html->image('/img/logo.jpg', array('border' => 0,'width'=>'165px','height'=>'60px'))
	 echo SITETITLE; ?>
	 </span>

        <a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <i class="ti-view-grid"></i>
        </a>
    </div>
    <!-- end: NAVBAR HEADER -->
    <!-- start: NAVBAR COLLAPSE -->
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-right">                    
            <li class="dropdown current-user">
                <a href class="dropdown-toggle" data-toggle="dropdown">
                     <span class="username"><?php 
		     if($loggedin_user['user_role_id']==6){
			echo ucfirst($loggedin_user['firstname']);
		     }else{
			echo "Admin"; 
		     }
		     ?> <i class="ti-angle-down"></i></i></span>
                </a>
                <ul class="dropdown-menu dropdown-dark">
                   
                <li><?php echo $this->Html->link('Change Password',array('plugin' => false,'controller' => 'users','action' => 'changepassword')); ?></li>
                     <li><?php echo $this->Html->link('Logout',array('plugin' => false,'controller' => 'users','action' => 'logout')); ?></li>
                
                </ul>
            </li>
            <!-- end: USER OPTIONS DROPDOWN -->
        </ul>
    </div>
        <!-- end: NAVBAR COLLAPSE -->
</header>
