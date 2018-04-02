<?php

echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false));
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
echo $this->Html->script(array('city_details'));

?>
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
                <!-- start: PAGE TITLE -->
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle"><?php echo isset($title_for_page)?$title_for_page:'City Details';?></h1>
                        </div>        
                        <div class="col-sm-4 text-align-right">	
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'city','controller' => 'city',"action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>	
                        </div> 
                    </div>
                </section>
                <!-- end: PAGE TITLE -->
                <!-- Global Messages -->
                <?php echo $this->Session->flash(); ?>
                <!-- Global Messages End -->
                <!-- start: FORM VALIDATION EXAMPLE 1 -->
                <div class="container-fluid container-fullw bg-white">
                    <div class="">
                        <?php echo $this->Session->flash(); ?>
		    <?php
		    echo $this->Form->create($model, array('url' => array('plugin' => 'city', 'controller' => 'city', 'action' => 'city_details', $city_id), 'enctype' => 'multipart/form-data'));
		    ?>								


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">City color code <span class="symbol required"></span></label>  
				    <?php echo $this->Form->text("city_color_code", array('id'=>'city_color_code','label' => false,'div' => false,'class' => 'form-control textbox validate[required]')); ?>
                                    <span id="city_color_code-error" class="help-block"></span>
                                </div>				
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tag Line<span class="symbol required"></span></label>  
				    <?php echo $this->Form->text("tag_line", array('id'=>'tag_line','label' => false,'div' => false,'class' => 'form-control textbox validate[required]')); ?>
                                    <span id="tag_line-error" class="help-block"></span>
                                </div>				
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Video Url<span class="symbol required"></span></label>  
				    <?php echo $this->Form->text("video_url", array('id'=>'video_url','label' => false,'div' => false,'class' => 'form-control textbox validate[required]')); ?>
                                    <span id="video_url-error" class="help-block"></span>
                                </div>				
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Founded In <span class="symbol required"></span></label>  
				    <?php echo $this->Form->text("founded_in", array('id'=>'founded_in','label' => false,'div' => false,'class' => 'form-control textbox validate[required]')); ?>
                                    <span id="founded_in-error" class="help-block"></span>
                                </div>				
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Per year visitors <span class="symbol required"></span></label>  
				    <?php echo $this->Form->text("per_year_visitors", array('id'=>'per_year_visitors','label' => false,'div' => false,'class' => 'form-control textbox validate[required]')); ?>
                                    <span id="per_year_visitors-error" class="help-block"></span>
                                </div>				
                            </div>
                            <div class="col-md-6">				
                                <div class="form-group">
                                    <label class="control-label">Description <span class="symbol required"></span></label>
                                    <?php echo $this->Form->textarea('description', array('class' => 'form-control textarea validate[required,ajax[validate_plate]]', 'id' => 'description', 'label' => false, 'div' => false)); ?>
                                    <span id="description-error" class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Header Image <span class="symbol required"></span></label>  
				     <?php echo $this->Form->hidden('header_imgs', array("value"=>$resultArr['CityDetail']['header_image'],"id" => "header_imgs"));
                                        if(!empty($resultArr['CityDetail']['header_image'])){
                                        echo $this->Form->hidden('header_img_id', array("value"=>$resultArr['CityDetail']['header_image'],"id" => "header_img_id".$resultArr['CityDetail']['id']));
                                        ?>
                                    <div class="box"><a class="popup" id="popup_<?php echo $resultArr['CityDetail']['id'];?>" href="<?php echo WEBSITE_URL . 'uploads/cities/'.$resultArr['CityDetail']['header_image']; ?>" >
                                            <img src="<?php echo WEBSITE_URL.'uploads/cities/'.$resultArr['CityDetail']['header_image']; ?>" id="header_img_<?php echo $resultArr['CityDetail']['id'];?>" width="100px" height="100px" class="img-rounded"/></a> 
                                        <div style="text-align: center;"> <img title="header image" src="<?php echo WEBSITE_URL . "img/inactive.png"; ?>" width="20" height="20" id="<?php echo $resultArr['CityDetail']['id'];?>" class = "delete_header_img" /></div>
                                    </div>
                                        <?php } echo $this->Form->input('header_image', array('type' => 'file','label' => false,'div' => false,'id'=>'header_image','class' => "")); ?>

                                    <span id="header_image-error" class="help-block"></span>
                                </div>	
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Footer Image <span class="symbol required"></span></label>  
				     <?php echo $this->Form->hidden('footer_imgs', array("value"=>$resultArr['CityDetail']['footer_image'],"id" => "footer_imgs"));
                                        if(!empty($resultArr['CityDetail']['footer_image'])){
                                        echo $this->Form->hidden('footer_img_id', array("value"=>$resultArr['CityDetail']['footer_image'],"id" => "footer_img_id".$resultArr['CityDetail']['id']));
                                        ?>
                                    <div class="box"><a class="popup" id="popup_<?php echo $resultArr['CityDetail']['id'];?>" href="<?php echo WEBSITE_URL . 'uploads/cities/'.$resultArr['CityDetail']['footer_image']; ?>" >
                                            <img src="<?php echo WEBSITE_URL.'uploads/cities/'.$resultArr['CityDetail']['footer_image']; ?>" id="footer_img_<?php echo $resultArr['CityDetail']['id'];?>" width="100px" height="100px" class="img-rounded"/></a> 
                                        <div style="text-align: center;"> <img title="footer image" src="<?php echo WEBSITE_URL . "img/inactive.png"; ?>" width="20" height="20" id="<?php echo $resultArr['CityDetail']['id'];?>" class = "delete_footer_img" /></div>
                                    </div>
                                        <?php } echo $this->Form->input('footer_image', array('type' => 'file','label' => false,'div' => false,'id'=>'footer_image','class' => "")); ?>

                                    <span id="footer_image-error" class="help-block"></span>
                                </div>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">                                        
                            </div>
                            <div class="col-md-4">
			    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'city_details', 'style' => 'margin-left:46px')) ?>
			    <?php echo $this->Html->link(__('Cancel', true), array("action" => "index"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
                            </div>
                        </div>
		    <?php echo $this->Form->end(); ?>
                    </div>
                </div>
                <!-- end: FORM VALIDATION EXAMPLE 1 -->
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>

<script type="text/javascript">

    jQuery(document).ready(function () {
        $(".popup").fancybox({
            helpers: {
                title: {
                    type: 'float'
                }
            }
        });
        //delete header image
        $('.delete_header_img').click(function () {
            var id = $(this).attr('id');
            var header_img = $('#header_img_id' + id).val();
            swal({
                title: "Are you sure?",
                text: "Image will be deleted permanently",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function () {
                        $.ajax({
                            url: "<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'delete_cities_img')); ?>",
                            data: {'id': id, 'header_img': header_img, 'type': '0'},
                            type: 'post',
                            dataType: 'json',
                            success: function (data) {
                                if (data.succ == 1) {
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
                            },
                            error: function (e) {
                                alert('fail');
                                // window.location.reload();
                            }
                        });
                    });
        });
        //delete footer image
        $('.delete_footer_img').click(function () {
            var id = $(this).attr('id');
            var footer_img = $('#footer_img_id' + id).val();
            swal({
                title: "Are you sure?",
                text: "Image will be deleted permanently",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function () {
                        $.ajax({
                            url: "<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'delete_cities_img')); ?>",
                            data: {'id': id, 'footer_img': footer_img, 'type': '1'},
                            type: 'post',
                            dataType: 'json',
                            success: function (data) {
                                //console.log(data);
                                if (data.succ == 1) {
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
                            },
                            error: function (e) {
                                alert('fail');
                                // window.location.reload();
                            }
                        });
                    });
        });
    });
</script>