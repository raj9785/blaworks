<?php
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<?php 
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->css(array('jquery.validationEngine-en','jquery.validationEngine'));

?>


<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#AccessRightCategoryEditForm").validationEngine();

        jQuery('.pcheckbox').on('click', function () {
            var gettitleval = jQuery(this).attr('title');
            //alert(gettitleval);
            if ($(this).is(':checked')) {
                $('.' + gettitleval).prop('checked', true)
            } else {
                $('.' + gettitleval).prop('che cked', false)
            }
        })

        jQuery('.desccheckbox').on('click', function () {
            var checkedclass = $(this).attr('class').replace('desccheckbox', '');

            if ($(this).is(':checked')) {
                $('.check' + checkedclass).prop('checked', true)
            } else {
                var count = 0;
                $('.' + checkedclass).each(function () {
                    if ($(this).is(':checked')) {
                        count++;
                    }

                });
                if (count) {
                    $('.check' + checkedclass).prop('checked', true);
                } else {

                    $('.check' + checkedclass).prop('checked', false);
                }


            }
        })

        jQuery('.desccheckbox').each(function () {
            var checkedclass = $(this).attr('class').replace('desccheckbox', '');
            if ($(this).is(':checked')) {
                $('.check' + checkedclass).prop('checked', true)
            } else {
                var count = 0;
                $('.' + checkedclass).each(function () {
                    if ($(this).is(':checked')) {
                        count++;
                    }

                });
                if (count) {
                    $('.check' + checkedclass).prop('checked', true);
                } else {

                    $('.check' + checkedclass).prop('checked', false);
                }
            }
        })

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
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 class="mainTitle">Edit Role</h1>
                        </div>
                        <div class="col-md-2">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php
                    echo $this->Form->create($model, array('url' => array('plugin' => 'access_right_category', 'controller' => 'access_right_categories', 'action' => 'edit', $id), 'enctype' => 'multipart/form-data'));
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row" style="">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.name', __('Role Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . '.name', array("class" => "form-control textbox validate[required]")); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.name', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <span class="symbol required"></span>Required Fields
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <span class='access_title'><u>Access Permission</u></span><br/><br/>
                                </div>
                            </div>
                        </div>
                        <table class="table">
                            <tr>

                                <td style='vertical-align:top'>
                                    <table class="table">

                                        <tr>
                                            <td><a href="javascript:void(0);" class='clicklink'  title='partner'>System Masters</a>
                                                <span style='float:right'>
                                                    <?php echo $this->Form->checkbox($model . '.masters', array('class' => 'checkmasters pcheckbox', 'title' => 'System Masters', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>

                                                </span>

                                            </td>
                                            <td>
                                                <?php
                                                echo $this->Form->checkbox($model . '.Language', array('value' => 1, 'class' => 'masters desccheckbox', 'hiddenField' => false)) . ' <b>Languages</b>' . '&nbsp;';
                                                echo $this->Form->checkbox($model . '.State', array('value' => 1, 'class' => 'masters desccheckbox', 'hiddenField' => false)) . ' <b>States</b>' . '&nbsp;';
                                                echo $this->Form->checkbox($model . '.Disctict', array('value' => 1, 'class' => 'masters desccheckbox', 'hiddenField' => false)) . ' <b>Districts</b>' . '&nbsp;';
                                                echo $this->Form->checkbox($model . '.Block', array('value' => 1, 'class' => 'masters desccheckbox', 'hiddenField' => false)) . ' <b>Blocks</b>' . '&nbsp;';
                                                echo $this->Form->checkbox($model . '.Education', array('value' => 1, 'class' => 'masters desccheckbox', 'hiddenField' => false)) . ' <b>Educations</b> &nbsp;';
                                                
                                                echo $this->Form->checkbox($model . '.Technical_Courses', array('value' => 1, 'class' => 'masters desccheckbox', 'hiddenField' => false)) . ' <b>Technical Courses</b> &nbsp;';
                                                echo $this->Form->checkbox($model . '.Job_Categories', array('value' => 1, 'class' => 'masters desccheckbox', 'hiddenField' => false)) . ' <b>Job Categories</b> &nbsp;';
                                                echo $this->Form->checkbox($model . '.Training_Categories', array('value' => 1, 'class' => 'masters desccheckbox', 'hiddenField' => false)) . ' <b>Training Categories</b> &nbsp;';
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><a href="javascript:void(0);" class='clicklink' title='customer'>Job & Training</a>
                                                <span style='float:right'>
                                                    <?php echo $this->Form->checkbox($model . '.jobtraining', array('class' => 'checkjobtraining pcheckbox', 'title' => 'customer', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>
                                                </span>

                                            </td>
                                            <td>
                                                <?php
                                                echo $this->Form->checkbox($model . '.Jobs', array('value' => 1, 'class' => 'jobtraining desccheckbox', 'hiddenField' => false)) . ' <b>Jobs</b>&nbsp;';
                                                echo $this->Form->checkbox($model . '.Trainings', array('value' => 1, 'class' => 'jobtraining desccheckbox', 'hiddenField' => false)) . ' <b>Trainings</b>';
                                                ?>
                                            </td>
                                        </tr>
                                        
                                        
                                         <tr>
                                            <td><a href="javascript:void(0);" class='clicklink' title='customer'>Access Control</a>
                                                <span style='float:right'>
                                                    <?php echo $this->Form->checkbox($model . '.accesscontrol', array('class' => 'checkaccesscontrol pcheckbox', 'title' => 'customer', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>
                                                </span>

                                            </td>
                                            <td>
                                                <?php
                                                echo $this->Form->checkbox($model . '.System_Roles', array('value' => 1, 'class' => 'accesscontrol desccheckbox', 'hiddenField' => false)) . ' <b>System Roles</b>&nbsp;';
                                                echo $this->Form->checkbox($model . '.System_Users', array('value' => 1, 'class' => 'accesscontrol desccheckbox', 'hiddenField' => false)) . ' <b>System Users</b>';
                                                ?>
                                            </td>
                                        </tr>

                                        

                                    </table>
                                </td>	
                            </tr> 	
                        </table>
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button', 'style' => 'margin-left:46px')) ?>
                                <?php echo $this->Html->link(__('Cancel', true), array("action" => "index"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
                            </div>
                        </div>



                    </div>
                </div>

                <?php echo $this->Form->end(); ?>

            </div>
        </div>

    </div>

    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>

