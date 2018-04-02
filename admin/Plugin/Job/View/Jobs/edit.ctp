<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        get_state();
        $("#check_all_f").on("click", function() {
            $("input[id^=education_id]").each(function() {
                $("#" + $(this).attr('id')).prop('checked', 'checked');
            });
        });
        $("#uncheck_all_f").on("click", function() {
            $("input[id^=education_id]").each(function() {
                $("#" + $(this).attr('id')).removeAttr('checked');
            });
        });

        $("#state_id").on('change', function() {
            $("#submit_button").attr('disabled', 'disabled');
            $("#distrcit_id").attr('disabled', 'disabled');
            $("#distrcit_id").empty();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Html->url(array('plugin' => 'job', 'controller' => 'jobs', 'action' => 'get_district_list')) ?>',
                data: 'state_id=' + $("#state_id").val(),
                success: function(data) {
                    $("#submit_button").removeAttr('disabled');
                    $("#district_id").removeAttr('disabled');
                    $("#district_id").html(data);
                }
            });
        });

        jQuery("#JobEditForm").validationEngine();

    });

    function get_state() {
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->Html->url(array('plugin' => 'job', 'controller' => 'jobs', 'action' => 'get_district_list')) ?>',
            data: {'state_id': '<?php echo $record['Job']['state_id']; ?>', 'district_id': '<?php echo $record['Job']['district_id']; ?>'},
            success: function(data) {
                $("#submit_button").removeAttr('disabled');
                $("#district_id").removeAttr('disabled');
                $("#district_id").html(data);
            }
        });

    }

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
                        <div class="col-sm-8">
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                        </div>
                        <div class="col-sm-4 text-align-right">	
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Job List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                     <?php
                    echo $this->Form->create($model, array('url' => array('plugin' => 'job', 'controller' => 'jobs', 'action' => 'edit'), 'enctype' => 'multipart/form-data'));
                    echo $this->Form->hidden('id');
                    ?>

                    <div class="row">
                        <div class="col-md-12">


                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select State <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('state_id', array('type' => 'select', 'empty' => 'Select','options' => $state_list, 'class' => 'form-control  validate[required]', 'id' => 'state_id', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select District <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('district_id', array('type' => 'select', 'empty' => 'Select','options' => array(), 'class' => 'form-control  validate[required]', 'id' => 'district_id', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('code')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.name', __('Job Code', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('code')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".code", array('class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.code', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Experience Year <span class="symbol required"></span></label>


                                           <?php 
                                        echo $this->Form->text($model . ".year_of_experience", array('class' => 'form-control'));
                                        ?> 
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Experience Month <span class="symbol required"></span></label>

                                           <?php 
                                        echo $this->Form->text($model . ".month_of_experience", array('class' => 'form-control'));
                                        
                                        ?> 
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('salary_start')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.name', __('Salary Start', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('salary_start')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".salary_start", array('class' => 'form-control textbox')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.salary_start', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('salary_end')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.name', __('Salary End', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('salary_end')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".salary_end", array('class' => 'form-control textbox')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.salary_end', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mult_chk types" id="type_1">
                                        <label class="control-label">Choose Education <span class="symbol required"></span>
                                            <?php
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Check All', 'javascript:void(0)', array('escape' => false, 'id' => 'check_all_f'));
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Uncheck All', 'javascript:void(0)', array('escape' => false, 'id' => 'uncheck_all_f'));
                                            ?>
                                        </label>
                                        <?php echo $this->Form->input('education_id', array('type' => 'select', 'div' => false, 'multiple' => 'checkbox', 'options' => $education_list, 'class' => '', 'id' => 'education_id', 'label' => false, 'tabindex' => 4, 'required' => true)); ?>
                                        <span id="type1-error" class="help-block"></span>
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select Job Category <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('job_category_id', array('type' => 'select', 'empty' => 'Select','options' => $jobcat_list, 'class' => 'form-control  validate[required]', 'id' => 'job_category_id', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>
                            </div>
                            <div class="row">	
				<?php foreach($language_list as $lang){
				?>

                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('title')) ? 'error' : ''; ?>">
                                        <label for="districtName" style="">Title (<?php echo $lang['Language']['name']; ?>) :<span class="symbol required"></span></label>
                                        <div class="input <?php echo ($this->Form->error('title')) ? 'error' : ''; ?>" style="" >
										    <?php 
											if($lang['Language']['id']==1){
												$req=" validate[required]";
											}else{
												$req="";
											}
											?>

                                            <?php echo $this->Form->text("LanguageMapJob.".$lang['Language']['id'].".title", array('class' => 'form-control textbox '.$req)); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.title', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                               <?php
			      } ?>
                            </div>
                            <div class="row">	
				<?php foreach($language_list as $lang){
				?>

                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('company_profile')) ? 'error' : ''; ?>">
                                        <label for="districtName" style="">Company Profile (<?php echo $lang['Language']['name']; ?>) :<span class="symbol required"></span></label>
                                        <div class="input <?php echo ($this->Form->error('company_profile')) ? 'error' : ''; ?>" style="" >
										    <?php 
											if($lang['Language']['id']==1){
												$req=" validate[required]";
											}else{
												$req="";
											}
											?>

                                            <?php echo $this->Form->textarea("JobDetail.".$lang['Language']['id'].".company_profile", array('class' => 'form-control textbox '.$req)); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.title', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                               <?php
			      } ?>
                            </div>



                            <div class="row">	
				<?php foreach($language_list as $lang){
				?>

                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('job_description')) ? 'error' : ''; ?>">
                                        <label for="districtName" style="">Job Description (<?php echo $lang['Language']['name']; ?>) :<span class="symbol required"></span></label>
                                        <div class="input <?php echo ($this->Form->error('job_description')) ? 'error' : ''; ?>" style="" >
										    <?php 
											if($lang['Language']['id']==1){
												$req=" validate[required]";
											}else{
												$req="";
											}
											?>

                                            <?php echo $this->Form->textarea("JobDetail.".$lang['Language']['id'].".job_description", array('class' => 'form-control textbox '.$req)); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.title', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                               <?php
			      } ?>
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
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>
