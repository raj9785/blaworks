<?php

echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
 echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); 
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));

echo $this->Html->script(array('jquery-ui.min'));


?>
<style>
    .help-block {
        color: #a94442;
    }
</style>
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
                            <h1 class="mainTitle"><?php echo isset($title_for_page)?$title_for_page:'City Images';?></h1>
                        </div>
                        <div class="col-md-2">
			    <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'city','controller' => 'city',"action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
		<?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <div class="">
                        <?php echo $this->Session->flash(); ?>
		    <?php
		    echo $this->Form->create($model, array('url' => array('plugin' => 'city', 'controller' => 'city', 'action' => 'city_images',$city_id), 'enctype' => 'multipart/form-data'));
		    ?>								

                        <div class="row">

                            <div class="col-md-12">

                                <?php echo $this->Form->hidden('city_imgs', array("value"=>count($resultArr),"id" => "city_imgs"));?>
                                    <?php 
                                    if(count($resultArr)>0){
                                        foreach($resultArr as $img){
                                    ?>
                                <div class="col-sm-3">

                                        <?php echo $this->Form->hidden('city_img_id', array("value"=>$img['CityImage']['image'],"id" => "city_img_id".$img['CityImage']['id']));?>
                                    <div class="box"><a class="popup" id="popup_<?php echo $img['CityImage']['id'];?>" href="<?php echo WEBSITE_URL.'uploads/cities/large/'.$img['CityImage']['image']; ?>" ><img src="<?php echo WEBSITE_URL.'uploads/cities/medium/'.$img['CityImage']['image']; ?>" id="city_img_<?php echo $img['CityImage']['id'];?>" width="100px" height="100px" class="img-rounded"/></a> 
                                        <div style="text-align: center;"> <img title="city image" src="<?php echo WEBSITE_URL . "img/inactive.png"; ?>" width="20" height="20" id="<?php echo $img['CityImage']['id'];?>" class = "delete_city_images" /></div>
                                    </div>
                                </div>
                                    <?php    }
                                    }
                                    ?>

                            </div>
                        </div>	

                        <div class="row">	
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="control-label">Upload images <span class="symbol required"></span></label>
                                    <div id="filediv"> 
                                        <?php 
                             // echo $this->Form->input('room_images', array('type' => 'file', 'multiple'));
                              echo $this->Form->input('city_images.', array('type' => 'file','multiple','label' => false,'div' => false,'id'=>'city_images_0','class' => "city_images textbox validate[required]")); ?>

                                    </div>
                                    <a href="javascript:void(0);" id="add_more" class="upload"><i class="fa fa-plus-circle"></i> Add More</a>
                                    <a href="javascript:void(0);" style="display:none" id="remove_file"><i class="fa fa-minus-circle"></i> Remove</a>
                                    <span id="city_images-error" class="help-block"></span>
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
			    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'add_city_images', 'style' => 'margin-left:46px')) ?>
			    <?php echo $this->Html->link(__('Cancel', true), array("action" => "index"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
                            </div>
                        </div>
		    <?php echo $this->Form->end(); ?>
                    </div>
                </div>
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
        var counter = 1;
        $('#add_more').click(function () {
            if (counter == 1) {
                $('#remove_file').show();
            }
            $(this).before($("<div/>", {
                id: 'filediv_' + counter
            }).fadeIn('slow').append($("<input/>", {
                name: 'data[City][city_images][]',
                type: 'file',
                id: 'city_images_' + counter,
                class: 'city_images',
                multiple: true,
            }), $("<br/>")));
            counter++;
        });
        $('#remove_file').click(function () {
            if (counter == 2) {
                $('#remove_file').hide();
            }
            counter--;
            $("#filediv_" + counter).remove();
        });
        //delete hotel room image
        $('.delete_city_images').click(function () {
            var id = $(this).attr('id');
            var city_img = $('#city_img_id' + id).val();
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
                            url: "<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'delete_city_images')); ?>",
                            data: {'city_image_id': id, 'city_img': city_img},
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

        $("#add_city_images").click(function () {
            if ($.trim($("#city_images_0").val()) == "" && $.trim($("#city_imgs").val()) == "0") {
                $("#city_images-error").html("Please upload city images");
                $("#city_images").parent('div').addClass('has-error');
                $("#city_images").focus();
                return false;
            } else {
                $("#city_images").parent('div').removeClass('has-error');
                $("#city_images-error").html("");
            }
        });
    });
</script>
