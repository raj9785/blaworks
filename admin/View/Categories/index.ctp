<?php

echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'select2.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('select2.min.js', 'jquery.dataTables.min.js', 'table-data.js', 'select2.min.css', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        UINotifications.init();
        //TableData.init();
        jQuery("#add_new_user").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'categories', 'action' => 'add')); ?>';
        });
        jQuery('a[id ^= delete_customer_]').click(function () {
            var thisID = $(this).attr('id');
            var breakID = thisID.split('_');
            var record_id = breakID[2];
            swal({
                title: "Are you sure?",
                text: "Category will be deleted permanently",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function () {
                        $.ajax({
                            type: 'get',
                            url: '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'categories', 'action' => 'delete')) ?>',
                            data: 'id=' + record_id,
                            dataType: 'json',
                            success: function (data) {
                                if (data.succ == '1') {
                                    swal({
                                        title: "Deleted!",
                                        text: data.msg,
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: '#d6e9c6',
                                        confirmButtonText: 'OK',
                                        closeOnConfirm: false,
                                    }, function () {
                                        window.location.reload();
                                    });
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: data.msg,
                                        type: "error",
                                        showCancelButton: false,
                                        confirmButtonColor: '#d6e9c6',
                                        confirmButtonText: 'OK',
                                        closeOnConfirm: false,
                                    }, function () {
                                        window.location.reload();
                                    });
                                }
                            }
                        });
                    });
        });
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
                            <h1 class="mainTitle">Categories List</h1>                            
                        </div>                        
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12 space20">
                            <button class="btn btn-green add-row" id='add_new_user'>
                                Add Category <i class="fa fa-plus"></i>
                            </button>
                            <?php if(isset($parent_of_parent) && $parent_of_parent !=""){ ?>
                            <?php if($parent_of_parent != '-1'){ ?>
                                <?php echo $this->html->link('Go Back',array('plugin' => false,'controller' => 'categories','action' => 'index','?' => array('parent_id' => $parent_of_parent)),array('escape' => false,'class' => 'btn btn-green add-row')); ?>
                            <?php }else{?>
                                <?php echo $this->html->link('Go Back',array('plugin' => false,'controller' => 'categories','action' => 'index'),array('escape' => false,'class' => 'btn btn-green add-row')); ?>
                            <?php }}?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($categories_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs" style="width:20%;">Name</th>
                                        <th class="hidden-xs">Created On</th>
                                        <th class="hidden-xs">Status</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($categories_list)) { ?>
                                        <?php foreach ($categories_list as $user) { ?>  
                                    <tr>
                                        <td width="10%"><?php echo $user['Category']['name']; ?></td>
                                        <td><?php echo $this->Time->format("M d, Y H:i:s A", $user['Category']['created']); ?></td>
                                        <td> 
                                            <?php
                                            if ($user['Category']['status'] == 'A') {
                                                echo $this->Html->image('/img/test-pass-icon.png', array('border' => 0, 'alt' => 'activated', 'title' => 'activated'));
                                            } else {
                                                echo $this->Html->image('/img/cross.png', array('border' => 0, 'alt' => 'activated', 'title' => 'deactivated'));
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                <?php
                                                if ($user['Category']['status'] == 'A') {
                                                    echo $this->Html->link('Inactivate', array('controller' => 'categories', 'action' => 'status', 'id' => $user['Category']['id'], 'status' => 'D'), array('title' => 'Click here to inactivate.', 'escape' => false, 'class' => 'btn btn-transparent btn-xs', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to inactivate.'));
                                                } else {
                                                    echo $this->Html->link('Activate', array('controller' => 'categories', 'action' => 'status', 'id' => $user['Category']['id'], 'status' => 'A'), array('title' => 'Click here to activate.', 'escape' => false, 'class' => 'btn btn-transparent btn-xs', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to activate.'));
                                                }
                                                echo $this->Html->link('Sub Categories', array('controller' => 'categories', 'action' => 'index', '?' => array('parent_id' => $user['Category']['id'])), array('title' => 'Click here to inactive.', 'escape' => false, 'class' => 'btn btn-transparent btn-xs', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to inactive.'));
                                                echo $this->Html->link('<i class="fa fa-times fa fa-white"></i>', 'javascript:void(0)', array('class' => 'btn btn-transparent btn-xs tooltips', 'tooltip-placement' => 'top', 'tooltip' => 'Remove', 'id' => 'delete_customer_' . $user['Category']['id'], 'escape' => false));
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                    <tr>
                                        <td colspan="9">No category exists.</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <ul class="pagination" style="float: right;">
                                <li><?php echo $this->Paginator->prev('&laquo;', array( 'escape' => false), null, array('class' => 'previous disabled prv previous' , 'escape' => false));?></li>
                                <li><?php echo $this->Paginator->numbers(array('separator' => '',  'currentClass' => 'active', 'currentTag' => 'a' , 'escape' => false));?></li>
                                <li><?php echo $this->Paginator->next('&raquo;', array(  'escape' => false), null, array('class' => 'number-end disabled nxt number-end' , 'escape' => false));?></li>
                            </ul>
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
