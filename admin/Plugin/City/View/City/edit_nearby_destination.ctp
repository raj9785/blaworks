<?php

echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false));
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
echo $this->Html->script(array('destination'));

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
                            <h1 class="mainTitle"><?php echo isset($title_for_page)?$title_for_page:'Add New Destination';?></h1>
                        </div>        
                        <div class="col-sm-4 text-align-right">	
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'city','controller' => 'city',"action" => "nearby_destinations",'?' => array('id' => $city_id)), array("class" => "btn btn-green add-row", "escape" => false)); ?>	
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
		    echo $this->Form->create($model, array('url' => array('plugin' => 'city', 'controller' => 'city', 'action' => 'edit_nearby_destination',$resultArr['CityNearbyDestination']['id']), 'enctype' => 'multipart/form-data'));
		    ?>								


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Destination <span class="symbol required"></span></label>  
				    <?php echo $this->Form->text("destination_name", array('id'=>'destination_name','label' => false,'div' => false,'class' => 'form-control textbox validate[required]')); ?>
                                    <span id="destination_name-error" class="help-block"></span>
                                </div>				
                            </div>
                            <div class="col-md-6">				
                                <div class="form-group">
                                    <label class="control-label">Description <span class="symbol required"></span></label>
                                    <?php echo $this->Form->textarea('description', array('class' => 'form-control textarea validate[required,ajax[validate_plate]]', 'id' => 'description', 'label' => false, 'div' => false)); ?>
                                    <span id="description-error" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Upload Image <span class="symbol required"></span></label>  
                                     <?php echo $this->Form->hidden('destination_imgs', array("value"=>$resultArr['CityNearbyDestination']['image'],"id" => "destination_imgs"));
                                        if(!empty($resultArr['CityNearbyDestination']['image'])){
                                        echo $this->Form->hidden('destination_img_id', array("value"=>$resultArr['CityNearbyDestination']['image'],"id" => "destination_img_id".$resultArr['CityNearbyDestination']['id']));
                                        ?>
                                    <div class="box"><a class="popup" id="popup_<?php echo $resultArr['CityNearbyDestination']['id'];?>" href="<?php echo WEBSITE_URL . 'uploads/nearby_destination/'.$resultArr['CityNearbyDestination']['image']; ?>" >
                                            <img src="<?php echo WEBSITE_URL.'uploads/nearby_destination/'.$resultArr['CityNearbyDestination']['image']; ?>" id="destination_img_<?php echo $resultArr['CityNearbyDestination']['id'];?>" width="100px" height="100px" class="img-rounded"/></a> 
                                        <div style="text-align: center;"> <img title="<?php echo $resultArr['CityNearbyDestination']['destination_name'];?>" src="<?php echo WEBSITE_URL . "img/inactive.png"; ?>" width="20" height="20" id="<?php echo $resultArr['CityNearbyDestination']['id'];?>" class = "delete_destination_img" /></div>
                                    </div>
                                        <?php }
				     echo $this->Form->input('destination_image', array('type' => 'file','label' => false,'div' => false,'id'=>'destination_image','class' => "")); 
                                    echo $this->Form->hidden('destination_image_wt', array("id" => "destination_image_wt"));
                                    echo $this->Form->hidden('destination_image_ht', array("id" => "destination_image_ht"));?>

                                    <span id="destination_image-error" class="help-block"></span>
                                </div>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">                                        
                            </div>
                            <div class="col-md-4">
			    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'edit_destination', 'style' => 'margin-left:46px')) ?>
			    <?php echo $this->Html->link(__('Cancel', true), array("action" => "nearby_destinations",'?' => array('id' => $city_id)), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
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
        //delete destination image
        $('.delete_destination_img').click(function () {
            var id = $(this).attr('id');
            var destination_img = $('#destination_img_id' + id).val();
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
                            url: "<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'delete_destination_img')); ?>",
                            data: {'destination_id': id, 'destination_img': destination_img},
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
    });
</script>