<div class="sidebar app-aside" id="sidebar">
    <div class="sidebar-container perfect-scrollbar">
        <nav>
            <ul class="main-navigation-menu">

                <?php if (!isset($permissions) || (isset($permissions) && ((isset($permissions['checkdashboard4']) && $permissions['checkdashboard4'] == 1) || (isset($permissions['checkdashboard1']) && $permissions['checkdashboard1'] == 1) || isset($permissions['dcustomer_invoices']) && $permissions['dcustomer_invoices'] == 1) || (isset($permissions['ddaily_booking_trend']) && $permissions['ddaily_booking_trend'] == 1) || (isset($permissions['dcity_wise_bookings']) && $permissions['dcity_wise_bookings'] == 1) || (isset($permissions['dbooking_types']) && $permissions['dbooking_types'] == 1) || (isset($permissions['dbooking_types']) && $permissions['dbooking_status'] == 1) || (isset($permissions['dtrip_feedback']) && $permissions['dtrip_feedback'] == 1) || (isset($permissions['duser_pattern']) && $permissions['duser_pattern'] == 1) || (isset($permissions['dpanic_button']) && $permissions['dpanic_button'] == 1) || (isset($permissions['dcity']) && $permissions['dcity'] == 1) || (isset($permissions['dvendors']) && $permissions['dvendors'] == 1) || (isset($permissions['dvehicles']) && $permissions['dvehicles'] == 1) || (isset($permissions['ddrivers']) && $permissions['ddrivers'] == 1) || (isset($permissions['dcustomer_invoices']) && $permissions['dcustomer_invoices'] == 1) || (isset($permissions['dcustomer_receipts']) && $permissions['dcustomer_receipts'] == 1) || (isset($permissions['dcustomer_refunds']) && $permissions['dcustomer_refunds'] == 1) || (isset($permissions['dvendor_receipts']) && $permissions['dvendor_receipts'] == 1) )) { ?>



                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'dashboard') ? 'active open' : '' ?>">
                    <a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'dashboard')); ?>">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-home"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Dashboard </span>
                            </div>
                        </div>
                    </a>
                </li>       


                <?php } ?>





          <?php if (!isset($permissions) || (isset($permissions) && ((isset($permissions['masters']) && $permissions['masters'] == 1) ))) { ?>

                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'sys_masters') ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> System Masters </span><i class="icon-arrow"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">

                        <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['Language'] == 1))) { ?>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'language', 'controller' => 'languages', 'action' => 'index')); ?>"><span
                                    class="title"> Languages </span></a>
                        </li>
                        <?php } ?>

                         <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['State'] == 1))) { ?>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'state', 'controller' => 'states', 'action' => 'index')); ?>"><span
                                    class="title"> States </span></a>
                        </li>
                        <?php } ?>

                        <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['Disctict'] == 1))) { ?>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'district', 'controller' => 'districts', 'action' => 'index')); ?>"><span
                                    class="title"> Districts </span></a>
                        </li>
                        <?php } ?>
                         <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['Block'] == 1))) { ?>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'block', 'controller' => 'blocks', 'action' => 'index')); ?>"><span
                                    class="title"> Blocks </span></a>
                        </li>
                        <?php } ?>

                         <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['Education'] == 1))) { ?>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'education', 'controller' => 'educations', 'action' => 'index')); ?>"><span
                                    class="title"> Educations </span></a>
                        </li>
                        <?php  } ?>
                         <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['Technical_Courses'] == 1))) { ?>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'technical_course', 'controller' => 'technical_courses', 'action' => 'index')); ?>"><span
                                    class="title"> Technical Courses </span></a>
                        </li>
                        <?php } ?>
                         <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['Job_Categories'] == 1))) { ?>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'job_category', 'controller' => 'job_categories', 'action' => 'index')); ?>"><span
                                    class="title"> Job Categories </span></a>
                        </li>
                         <?php } ?>
                         <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['Training_Categories'] == 1))) { ?>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'training_category', 'controller' => 'training_categories', 'action' => 'index')); ?>"><span
                                    class="title"> Training Categories </span></a>
                        </li>
                        <?php } ?>


                        <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['Panchayat'] == 1))) { ?>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'panchayat', 'controller' => 'panchayats', 'action' => 'index')); ?>"><span
                                    class="title"> Panchayats </span></a>
                        </li>
                        <?php } ?>
                        
                        
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'experience', 'controller' => 'experiences', 'action' => 'index')); ?>"><span
                                    class="title"> Experience </span></a>
                        </li>
                        
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'salary', 'controller' => 'salaries', 'action' => 'index')); ?>"><span
                                    class="title"> Salaries </span></a>
                        </li>


                    </ul>
                </li>

                <?php 
          }
                ?>
                 <?php if (!isset($permissions) || (isset($permissions) && ((isset($permissions['jobtraining']) && $permissions['jobtraining'] == 1) ))) { ?>

                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'jobs_training') ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Job & Training </span><i class="icon-arrow"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['Jobs'] == 1))) { ?>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'job', 'controller' => 'jobs', 'action' => 'index')); ?>"><span
                                    class="title"> Jobs </span></a>
                        </li>
                        <?php } ?>
                        <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['Trainings'] == 1))) { ?>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'training', 'controller' => 'trainings', 'action' => 'index')); ?>"><span
                                    class="title"> Trainings </span></a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>


                 <?php }  ?>


                <?php
                if (isset($loggedin_user) && $loggedin_user['user_role_id'] == 1) {
                    ?>
                <li class="slide_class <?php echo (isset($tab_open) && in_array($tab_open, array('accessrightcategory', 'accessrightuser'))) ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Access Control <i class="icon-arrow"></i></span>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['System_Roles'] == 1))) { ?>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'access_right_category', 'controller' => 'access_right_categories', 'action' => 'index')); ?>">
                                <span class="title">System Roles</span>
                            </a>

                        </li>
                        <?php } ?>
                        <?php if (!isset($permissions) || (isset($permissions) && (@$permissions['System_Users'] == 1))) { ?>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'user', 'controller' => 'users', 'action' => 'index')); ?>">
                                <span class="title">System Users</span>
                            </a>

                        </li>
                        <?php } ?>

                    </ul>
                </li>
                <?php } ?> 


                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'applicants') ? 'active open' : '' ?>">
                    <a href="<?php echo $this->Html->url(array('plugin' => 'applicant', 'controller' => 'applicants', 'action' => 'index')); ?>">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Applicants </span>
                            </div>
                        </div>
                    </a>

                </li>
                
                 <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'emp_programs') ? 'active open' : '' ?>">
                    <a href="<?php echo $this->Html->url(array('plugin' => 'employment_program', 'controller' => 'employment_programs', 'action' => 'index')); ?>">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Employment Programs </span>
                            </div>
                        </div>
                    </a>

                </li>








            </ul>
        </nav>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
        $(".heading_left").on("dblclick", function() {
            $(this).removeClass('open');
            var idthis = $(this).attr("id");
            // alert(idthis);
            var href = $("." + idthis + "_1").attr('href');
            //alert(href);
            window.location = href;
        });
    });

</script>