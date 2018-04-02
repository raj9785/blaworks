<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function () {

        $("#check_all").on("click", function () {
            $("input[id^=city_id_]").each(function () {
                $("#" + $(this).attr('id')).prop('checked', 'checked');
            });
        });

        $("#uncheck_all").on("click", function () {
            $("input[id^=city_id_]").each(function () {
                $("#" + $(this).attr('id')).removeAttr('checked');
            });
        });


        $("#submit_button").on("click", function () {
            if ($("#MotorTypeName").val() == "") {
                alert("Please enter Vehicle Type");
                $("#MotorTypeName").focus();
                return false;
            }
            if ($("#MotorTypeMotorCategoryId").val() == "") {
                alert("Please Select Category");
                $("#MotorTypeMotorCategoryId").focus();
                return false;
            }
            if ($("#capacity").val() == "") {
                alert("Please enter capacity");
                $("#capacity").focus();
                return false;
            }
            if ($("#image").val() == "") {
                alert("Please upload small image");
                $("#image").focus();
                return false;
            }
            if ($("#image_medium").val() == "") {
                alert("Please upload medium image");
                $("#image_medium").focus();
                return false;
            }
//            if ($("#image_large").val() == "") {
//                alert("Please upload large image");
//                $("#image_large").focus();
//                return false;
//            }
//            if ($.trim($("#image_large_width").val()) != "1200" && $.trim($("#image_large_height").val()) != "470") {
//                alert("Please upload 1200 X 470 size image");
//                $("#image_large").focus();
//                return false;
//            }
//            if ($("input[id^=city_id_]:checked").length == 0) {
//                alert("Please select at least one city");
//                $("#MotorModelVendorId").focus();
//                return false;
//            }

        });
        //jQuery("#MotorTypeAddForm").validationEngine();
        $('#image_large_width').val('');
        $('#image_large_height').val('');
        $("#image_large").change(function () {
            var file = this.files[0];
            displayPreview(file);
        });
    });
    function displayPreview(files) {
        var reader = new FileReader();
        var img = new Image();
        reader.onload = function (e) {
            img.src = e.target.result;
            fileSize = Math.round(files.size / 1024);
            //alert("File size is " + fileSize + " kb");

            img.onload = function () {
                var height = this.height;
                var width = this.width;
                $('#image_large_width').val(width);
                $('#image_large_height').val(height);
            };
        };
        reader.readAsDataURL(files);

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
                            <h1 class="mainTitle">Add New Vehicle Type</h1>
                        </div>
                        <div class="col-sm-4 text-align-right">	
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Vehicle Types List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php echo $this->Form->create($model, array('url' => array('plugin' => 'motor_type', 'controller' => 'motor_types', 'action' => 'add'), 'enctype' => 'multipart/form-data')); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.name', __('Vehicle Type', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".name", array('class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.name', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>
<!--				    <div class="form-group <?php echo ($this->Form->error('laguage')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.laguage', __('Laguage', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                    ?>
                                        <div class="input <?php echo ($this->Form->error('laguage')) ? 'error' : ''; ?>" style="" >
                                    <?php echo $this->Form->text($model . ".laguage", array('class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                    <?php echo $this->Form->error($model . '.laguage', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('motor_category_id')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.motor_category_id', __('Category Id', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('motor_category_id')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->select($model . '.motor_category_id', $motor_cat_list, array('empty' => 'Please Select', 'class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.motor_category_id', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.status', __('Status', true) . ' :<span class="required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->select($model . '.status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => false, 'class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.status', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>                                    
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('capacity')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.capacity', __('Capacity', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('capacity')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".capacity", array('id'=>'capacity','class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.capacity', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Upload Small Image <span class="symbol required"></span></label>  
				     <?php  echo $this->Form->input('image', array('type' => 'file','label' => false,'div' => false,'id'=>'image','class' => "")); ?>

                                        <span id="image-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Upload Medium Image <span class="symbol required"></span></label>  
				     <?php  echo $this->Form->input('image_medium', array('type' => 'file','label' => false,'div' => false,'id'=>'image_medium','class' => "")); ?>

                                        <span id="image_medium-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Upload Large Image </label>
                                    <?php echo $this->Form->input('image_large', array('type' => 'file', 'label' => false, 'div' => false, 'id' => 'image_large', 'class' => "image_large"));?>
                                    <?php echo $this->Form->input('image_large_width',array('type' => 'hidden','id' => 'image_large_width')); ?>
                                    <?php echo $this->Form->input('image_large_height',array('type' => 'hidden','name' => 'image_large_height')); ?>
                                        <span id="image_large-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Advance Payment Mandatory</label>  
				     <?php echo $this->Form->input('advance_payment_mandatory', array('type' => 'checkbox', 'div' => false, 'class' => '', 'id' => 'advance_payment_mandatory', 'label' => false)); ?>
                                        <span id="advance_payment_mandatory-error" class="help-block"></span>
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

