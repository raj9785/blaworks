<?php
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $("#submit_button").on("click",function(){
           if($("#MotorModelMotorTypeId").val() == ""){
               alert("Please select vehicle category");
               $("#MotorModelMotorTypeId").focus();
               return false;
           } 
           if($("#MotorModelMotorId").val() == ""){
               alert("Please select vehicle category");
               $("#MotorModelMotorId").focus();
               return false;
           }
           if($("#MotorModelName").val() == ""){
               alert("Please enter vehicle model name");
               $("#MotorModelName").focus();
               return false;
           }
           if($("#MotorModelCapacity").val() == ""){
               alert("Please enter vehicle capacity");
               $("#MotorModelCapacity").focus();
               return false;
           }
           
        });
        $("#MotorModelMotorCategoryId").on('change', function() {
            cat_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'motor_type', 'controller' => 'motor_types', 'action' => 'get_motor_type')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function(subcat_data) {
                    options = "<option value=''><?php echo __('Select Motor Type'); ?></option>";
                    $.each(subcat_data, function(index, value) {
                        options += "<option value='" + index + "'>" + value + "</option>";
                    });
                    $("#MotorModelMotorTypeId").empty().html(options);
                }
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
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Update Vehicle Model</h1>
                        </div>
                        <div class="col-md-4 text-align-right">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __(' Back to Vehicle Models List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php
                    echo $this->Form->create($model, array('url' => array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'edit'), 'enctype' => 'multipart/form-data'));
                    echo $this->Form->hidden('id');
                    ?>        
                    <div class="row">
                        <div class="col-md-12">  
                            <div class="row" style="">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('motor_type_id')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.motor_id', __('Select Vehicle Category', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('motor_type_id')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->select($model . '.motor_type_id', $motor_type, array("class" => "form-control validate[required]", 'empty' => "Select")); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.motor_type_id', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo ($this->Form->error('motor_id')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.motor_id', __('Select Vehicle Manufacturer', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('motor_id')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->select($model . '.motor_id', $motor, array("class" => "form-control validate[required]", 'empty' => "Select")); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.motor_id', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.status', __('Status', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->select($model . '.status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => false, 'class' => 'form-control')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.status', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.name', __('Vehicle Model Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".name", array('class' => 'form-control validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.name', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo ($this->Form->error('capacity')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.capacity', __('Vehicle Capacity', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('capacity')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".capacity", array('class' => 'form-control validate[required,custom[number]]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.capacity', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('laguage')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.laguage', __('Maximum Luggage', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('laguage')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".laguage", array('class' => 'form-control validate[required,custom[number]]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.laguage', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>                                    
                                    <div class="form-group <?php echo ($this->Form->error('description')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.description', __('Vehicle Overview', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('description')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->textarea($model . ".description", array('class' => 'form-control validate[required]', 'cols' => '30', 'rows' => '5')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.description', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('image')) ? 'error' : ''; ?>">
                                        <?php echo $this->Form->label($model . '.image', __('Image', true) . ' :<span class="symbol required"></span>', array('style' => "")); ?>
                                        <div class="input <?php echo ($this->Form->error('image')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->input($model . ".image", array('class' => 'validate[required]', 'type' => 'file', 'label' => false, 'div' => false)); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.image', array('wrap' => false)); ?>
                                            </span><br/>
                                            <?php if (isset($users_data[$model]['image']) && file_exists(WEBSITE_APP_WEBROOT_ROOT_PATH . '/uploads/motor_images/small/' . $users_data[$model]['image'])) { ?>
                                                <?php echo $this->Html->image(WEBSITE_URL . '/uploads/motor_images/small/' . $users_data[$model]['image'], array('border' => 0, 'width' => '100')); ?>
                                            <?php } else { ?>
                                                <?php echo $this->Html->image(WEBSITE_URL . '/img/no_image.jpg', array('border' => 0, 'width' => '75')); ?>
                                            <?php } ?>
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
                                <div class="col-md-8"></div>
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










