<?php

echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {

    });
</script>
<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar'); ?>

    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
        <?php echo $this->element('header'); ?>
        <!-- end: TOP NAVBAR -->
        <div class="main-content" >
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle"><?php echo isset($title_for_page)?$title_for_page:'Enquiries';?></h1>
                        </div>  

                        <div class="col-sm-4 text-align-right">
                            <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New Enquiry', true) . "", array('plugin' => false, 'controller' => 'users', "action" => "import_database_users"), array("class" => "btn btn-green add-row", "escape" => false));?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <!--<div class="row">
                        <div class="col-md-12 space20">
                            
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($user_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs" width="5%">S.No.</th>
                                        <th class="hidden-xs">Name </th>
                                        <th class="hidden-xs">Email</th>
                                        <th class="hidden-xs">Mobile</th> 
                                        <th class="hidden-xs">Created On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($user_list)) { 
                                        $count_new_user=$this->Paginator->counter(array('format' => '%count%'));
                                        if ($page == 0 || $page == 1) {
                                            $i = $count_new_user;
                                        } else {
                                            $i = $count_new_user - $limit * ($page - 1);
                                        }
                                        ?>
                                        <?php foreach ($user_list as $user) { ?>
                                    <tr>
                                        <td width="10%"><?php echo $i; ?></td>
                                        <td><?php echo $user['DatabaseUser']['name']; ?></td>
                                        <td><?php echo $user['DatabaseUser']['email']; ?></td>
                                        <td><?php echo $user['DatabaseUser']['mobile']; ?></td>
                                        <td> <?php echo date(DATE_FORMAT, strtotime($user['DatabaseUser']['created'])); ?></td>
                                    </tr>
                                            <?php
                                            $i--;
                                        }
                                        ?>
                                    <tr>
                                        <td colspan="20"><?php echo $this->element('pagination'); ?></td>
                                    </tr>
                                    <?php } else {
                                        ?>
                                    <tr>
                                        <td colspan="9">No User exists.</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>
