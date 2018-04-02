<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>
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
                            <?php
                            /* $file_name = '';
                              if(isset($result["UserDocument"]) && !empty($result["UserDocument"])){
                              foreach($result["UserDocument"] as $UserDocument){
                              if($UserDocument['type'] == 8 ){
                              $file_name =  $UserDocument['document_image'];
                              }
                              }
                              }
                              if(isset($file_name) && !empty($file_name))	{
                              $file_path = USERDOCS;
                              //$file_name = $result['UserDocument'][0]['document_image'];

                              $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 100, 100, base64_encode($file_path), $file_name), true);
                              $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);
                              if (is_file($file_path . $file_name)) {

                              $images = $this->Html->image($image_url, array('alt' => $result[$model]['firstname'], 'title' => $result[$model]['firstname']));
                              ?>
                              <a id="single_1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($result[$model]['firstname']); ?>'>
                              <?php echo $images; ?>
                              </a>
                              <?php
                              } else {
                              echo $this->Html->image('no_image.jpg', array('width' => '100px', 'height' => '100px'));
                              }
                              } else {
                              echo $this->Html->image('no_image.jpg', array('width' => '100px', 'height' => '100px'));
                              } */
                            ?>
                            <h1 class="mainTitle">

                                Driver Details</h1>
                        </div>
                        <div class="col-md-2">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Drivers List', true) . "", array("action" => "driver"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">


                        <div class="col-md-6 space20">
                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Vendor ID', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo isset($result['Vendor']['uniqid']) ? $result['Vendor']['uniqid'] : ''; ?>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Name', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo $result[$model]['firstname'] . " " . $result[$model]['lastname']; ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Status', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php
                                    if ($result[$model]['status'] == 1 && $result[$model]['status_by_admin'] == 1) {

                                        $chang = "Active";
                                    } else if ($result[$model]['status'] == 0 && $result[$model]['status_by_admin'] == 0) {

                                        $chang = "Inactivated By Admin";
                                    } else if ($result[$model]['status'] == 2) {

                                        $chang = "Pending For Approval";
                                    } else {

                                        $chang = "Inactive";
                                    }
                                    echo $chang;
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Current Address', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo $result[$model]['address']; ?>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Date of Birth', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo (($result[$model]['dob'] != NULL) ? date(DATE_FORMAT, strtotime($result[$model]['dob'])) : 'N.A'); ?>
                                </div>
                            </div>







                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('License No', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo $result[$model]['license_no']; ?>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Badge No', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo (($result[$model]['rto_batch_no'] != NULL) ? $result[$model]['rto_batch_no'] : 'N.A'); ?>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Adhaar Card No', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo (($result[$model]['aadhar_no'] != NULL) ? $result[$model]['aadhar_no'] : 'N.A'); ?>
                                </div>
                            </div>



                        </div>
                        <div class="col-md-6">
                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Vendor Name', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo $result['Vendor']['firstname'] . ' ' . $result['Vendor']['lastname']; ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Mobile No', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo $result[$model]['mobile']; ?>
                                </div>
                            </div>
							
							<div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.alternate_mobile', __('Alternate Mobile Number', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-7" style="" >
                                        <?php //echo @$result[$model]['alternate_mobile']; ?>
										 <?php echo (($result[$model]['alternate_mobile'] != NULL) ? $result[$model]['alternate_mobile'] : 'N.A'); ?>
                                    </div>
                                </div>

                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Verified', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php
                                    if ($result[$model]['verified'] == 1) {
                                        $chang = "Verified";
                                    } else if ($result[$model]['verified'] == 2) {
                                        $chang = "Pending For Approval";
                                    } else {
                                        $chang = "Unverified";
                                    }
                                    echo $chang;
                                    ?>
                                </div>
                            </div>




                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Permanent Address', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo $result[$model]['permanent_address']; ?>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Gender', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo ($result[$model]['gender'] == 1) ? 'Male' : 'Female'; ?>
                                </div>
                            </div>









                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('License Expiry Date', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo (($result[$model]['license_to'] != NULL) ? date(DATE_FORMAT, strtotime($result[$model]['license_to'])) : 'N.A'); ?>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Badge Expiry Date', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php
                                    //echo $result[$model]['batch_end_date'];1970-01-01
                                    echo (($result[$model]['batch_end_date'] != NULL && $result[$model]['batch_end_date'] != "1970-01-01") ? date(DATE_FORMAT, strtotime($result[$model]['batch_end_date'])) : 'N.A');
                                    ?>
                                </div>
                            </div>



                            <div class="col-sm-12">
                                <?php
                                echo $this->Form->label($model . '.name', __('Voter ID Card No', true) . ' :', array('class' => "col-sm-5"));
                                ?>
                                <div class="col-sm-7" style="" >
                                    <?php echo $result[$model]['voter_id'] ? $result[$model]['voter_id'] : "N.A"; ?>
                                </div>
                            </div>


                        </div>
                        
                        <?php /* 	
                          <!-- Registration Certificate -->
                          <?php	if (!empty($RegistrationCertificate)) { ?>

                          <div class="row space20">

                          <?php 	$i=0;
                          foreach ($RegistrationCertificate as $k => $v) {
                          ?>
                          <?php if($i==0){?>
                          <div class="col-sm-12">
                          <h3> Driver License </h3>
                          </div>
                          <?php }?>

                          <div class="col-sm-3">
                          <div class="detalimgdtl">
                          <?php
                          $file_path = TAXI_DOC_STORE_PATH;
                          $file_name = $v['UserDocument']['document_image'];
                          //echo $file_path . $file_name;
                          //if (is_file($file_path . $file_name)) {
                          if ($file_name) {
                          ?>
                          <div class="box" id="registration_box<?php echo $v['UserDocument']['id']; ?>">
                          <a class="popup" id="registration_popup_<?php echo $v['UserDocument']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/user_documents/' . $v['UserDocument']['document_image']; ?>" >
                          <img src="<?php echo WEBSITE_URL . 'uploads/user_documents/' . $v['UserDocument']['document_image']; ?>" id="registration_img_<?php echo $v['UserDocument']['id']; ?>" width="150px" height="130px" class="img-rounded "/>
                          </a>
                          </div>
                          <?php
                          }
                          ?>

                          </div>
                          </div>

                          <?php $i++; }?>
                          </div>

                          <?php  }?>



                          <!-- Adhaar Card-->
                          <?php	if (!empty($AdhaarCard)) { ?>

                          <div class="row space20">

                          <?php 	$i=0;
                          foreach ($AdhaarCard as $k => $v) {
                          ?>
                          <?php if($i==0){?>
                          <div class="col-sm-12">
                          <h3> Adhaar Card </h3>
                          </div>
                          <?php }?>

                          <div class="col-sm-3">
                          <div class="detalimgdtl">
                          <?php
                          $file_path = TAXI_DOC_STORE_PATH;
                          $file_name = $v['UserDocument']['document_image'];
                          //echo $file_path . $file_name;
                          //if (is_file($file_path . $file_name)) {
                          if ($file_name) {
                          ?>
                          <div class="box" id="permit_box<?php echo $v['UserDocument']['id']; ?>">
                          <a class="popup" id="permit_popup_<?php echo $v['UserDocument']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/user_documents/' . $v['UserDocument']['document_image']; ?>" >
                          <img src="<?php echo WEBSITE_URL . 'uploads/user_documents/' . $v['UserDocument']['document_image']; ?>" id="registration_img_<?php echo $v['UserDocument']['id']; ?>" width="150px" height="130px" class="img-rounded "/>
                          </a>
                          </div>
                          <?php
                          }
                          ?>

                          </div>
                          </div>

                          <?php $i++; }?>
                          </div>

                          <?php  }?>


                          <!-- Adhaar Card-->
                          <?php	if (!empty($RationCard)) { ?>
                          <div class="row space20">
                          <?php 	$i=0;
                          foreach ($RationCard as $k => $v) {
                          ?>
                          <?php if($i==0){?>
                          <div class="col-sm-12">
                          <h3> Ration Card </h3>
                          </div>
                          <?php }?>
                          <div class="col-sm-3">
                          <div class="detalimgdtl">
                          <?php
                          $file_path = TAXI_DOC_STORE_PATH;
                          $file_name = $v['UserDocument']['document_image'];
                          //echo $file_path . $file_name;
                          //if (is_file($file_path . $file_name)) {
                          if ($file_name) {
                          ?>
                          <div class="box" id="Ration_box<?php echo $v['UserDocument']['id']; ?>">
                          <a class="popup" id="Ration_popup_<?php echo $v['UserDocument']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/user_documents/' . $v['UserDocument']['document_image']; ?>" >
                          <img src="<?php echo WEBSITE_URL . 'uploads/user_documents/' . $v['UserDocument']['document_image']; ?>" id="registration_img_<?php echo $v['UserDocument']['id']; ?>"  width="150px" height="130px" class="img-rounded "/>
                          </a>
                          </div>
                          <?php
                          }
                          ?>

                          </div>
                          </div>

                          <?php $i++; }?>
                          </div>

                          <?php  }?>



                          <!--Driver Image-->
                          <?php	if (!empty($DriverImage)) { ?>

                          <div class="row space20">

                          <?php 	$i=0;
                          foreach ($DriverImage as $k => $v) {
                          ?>
                          <?php if($i==0){?>
                          <div class="col-sm-12">
                          <h3> Driver Image </h3>
                          </div>
                          <?php }?>

                          <div class="col-sm-3">
                          <div class="detalimgdtl">
                          <?php
                          $file_path = TAXI_DOC_STORE_PATH;
                          $file_name = $v['UserDocument']['document_image'];
                          //echo $file_path . $file_name;
                          //if (is_file($file_path . $file_name)) {
                          if ($file_name) {
                          ?>
                          <div class="box" id="Voter_box<?php echo $v['UserDocument']['id']; ?>">
                          <a class="popup" id="Voter_popup_<?php echo $v['UserDocument']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/user_documents/' . $v['UserDocument']['document_image']; ?>" >
                          <img src="<?php echo WEBSITE_URL . 'uploads/user_documents/' . $v['UserDocument']['document_image']; ?>" id="registration_img_<?php echo $v['UserDocument']['id']; ?>"  width="150px" height="130px" class="img-rounded "/>
                          </a>
                          </div>
                          <?php
                          }
                          ?>

                          </div>
                          </div>

                          <?php $i++; }?>
                          </div>

                          <?php  }?>


                          <!--Pan Card-->
                          <?php	if (!empty($PanCard)) { ?>

                          <div class="row space20">

                          <?php 	$i=0;
                          foreach ($PanCard as $k => $v) {
                          ?>
                          <?php if($i==0){?>
                          <div class="col-sm-12">
                          <h3> Pan Card</h3>
                          </div>
                          <?php }?>

                          <div class="col-sm-3">
                          <div class="detalimgdtl">
                          <?php
                          $file_path = TAXI_DOC_STORE_PATH;
                          $file_name = $v['UserDocument']['document_image'];
                          //echo $file_path . $file_name;
                          //if (is_file($file_path . $file_name)) {
                          if ($file_name) {
                          ?>
                          <div class="box" id="Voter_box<?php echo $v['UserDocument']['id']; ?>">
                          <a class="popup" id="Voter_popup_<?php echo $v['UserDocument']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/user_documents/' . $v['UserDocument']['document_image']; ?>" >
                          <img src="<?php echo WEBSITE_URL . 'uploads/user_documents/' . $v['UserDocument']['document_image']; ?>" id="registration_img_<?php echo $v['UserDocument']['id']; ?>"  width="150px" height="130px" class="img-rounded "/>
                          </a>
                          </div>
                          <?php
                          }
                          ?>

                          </div>
                          </div>

                          <?php $i++; }?>
                          </div>

                          <?php  }?>
                         */ ?>
                        <div class="col-sm-12">
                        <div class="col-md-12" style="margin-top:20px">
                            <h4>Driver Images:</h4>

                            <?php
                            if (isset($result["UserDocument"]) && !empty($result["UserDocument"])) {
                                foreach ($result["UserDocument"] as $UserDocument) {
                                    if ($UserDocument['type'] == 8) {
                                        $v = $UserDocument['document_image'];
                                        ?>
                                        <div class="detalimg" style="display: block !important;margin-right: 30px;">
                                            <?php
                                            $file_path = USERDOCS;
                                            $file_name = $v;
                                            if (is_file($file_path . $file_name)) {
                                                ?> 

                                                <?php
                                                $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 100, 100, base64_encode($file_path), $file_name), true);
                                                $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);


                                                $images = $this->Html->image($image_url, array('alt' => '', 'title' => ''));
                                                ?>

                                                <a class="popup" id="profileimage_popup_<?php echo @$v['UserDocument']['id']; ?>" href="<?php echo $big_image_url; ?>" >
                                                    <?php echo $images; ?>
                                                </a>
                                                </br> </br>



                                                &nbsp;<a href='<?php echo WEBSITE_ADMIN_URL ?>app/download/<?php echo $file_name . "/userdoc"; ?>'> Download Images </a> 						
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                echo "<p style='color: red;'>There are no documents attached.</p>";
                            }
                            ?>

                        </div>


                        </br>
                        <div class="col-md-12" style="margin-top:20px">
                            <h4>Driver License:</h4>

                            <?php
                            if (isset($result["UserDocument"]) && !empty($result["UserDocument"])) {
                                foreach ($result["UserDocument"] as $UserDocument) {
                                    if ($UserDocument['type'] == 1) {

                                        // pr($UserDocument);

                                        $v = $UserDocument['document_image'];
                                        ?>
                                        <div class="detalimg" style="display: block !important;margin-right: 30px;">
                                            <?php
                                            $file_path = USERDOCS;
                                            $file_name = $v;
                                            if (is_file($file_path . $file_name)) {
                                                ?>   

                                                <?php
                                                $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 100, 100, base64_encode($file_path), $file_name), true);
                                                $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);


                                                $images = $this->Html->image($image_url, array('alt' => '', 'title' => ''));
                                                ?>

                                                <a class="popup" id="dl_popup_<?php echo @$v['UserDocument']['id']; ?>" href="<?php echo $big_image_url; ?>" >
                                                    <?php echo $images; ?>
                                                </a>
                                                </br> </br>


                                                &nbsp;<a href='<?php echo WEBSITE_ADMIN_URL ?>app/download/<?php echo $file_name . "/userdoc"; ?>'> Download Images </a> 					
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                echo "<p style='color: red;'>There are no documents attached.</p>";
                            }
                            ?>

                        </div>
                        <div class="col-md-12" style="margin-top:20px">
                            <h4>PAN Card:</h4>

                            <?php
                            if (isset($result["UserDocument"]) && !empty($result["UserDocument"])) {
                                foreach ($result["UserDocument"] as $UserDocument) {
                                    if ($UserDocument['type'] == 7) {

                                        // pr($UserDocument);

                                        $v = $UserDocument['document_image'];
                                        ?>
                                        <div class="detalimg" style="display: block !important;margin-right: 30px;">
                                            <?php
                                            $file_path = USERDOCS;
                                            $file_name = $v;
                                            if (is_file($file_path . $file_name)) {
                                                ?>   

                                                <?php
                                                $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 100, 100, base64_encode($file_path), $file_name), true);
                                                $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);


                                                $images = $this->Html->image($image_url, array('alt' => '', 'title' => ''));
                                                ?>

                                                <a class="popup" id="pancard_popup_<?php echo @$v['UserDocument']['id']; ?>" href="<?php echo $big_image_url; ?>" >
                                                    <?php echo $images; ?>
                                                </a>
                                                </br> </br>


                                                <a href='<?php echo WEBSITE_ADMIN_URL ?>app/download/<?php echo $file_name . "/userdoc"; ?>'> Download Images </a> 					
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                echo "<p style='color: red;'>There are no documents attached.</p>";
                            }
                            ?>

                        </div>


                        <div class="col-md-12" style="margin-top:20px">
                            <h4>Aadhar Card:</h4>

                            <?php
                            if (isset($result["UserDocument"]) && !empty($result["UserDocument"])) {
                                foreach ($result["UserDocument"] as $UserDocument) {
                                    if ($UserDocument['type'] == 2) {

                                        // pr($UserDocument);

                                        $v = $UserDocument['document_image'];

                                        $file_path = USERDOCS;
                                        $file_name = $UserDocument['document_image'];
                                        if (is_file($file_path . $file_name)) {
                                            ?>
                                            <div class="detalimg" style="display: block !important;margin-right: 30px;">


                                                <?php
                                                $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 100, 100, base64_encode($file_path), $file_name), true);
                                                $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);


                                                $images = $this->Html->image($image_url, array('alt' => '', 'title' => ''));
                                                ?>


                                                <a class="popup" id="Voter_popup_<?php echo @$v['UserDocument']['id']; ?>" href="<?php echo $big_image_url; ?>" >
                                                    <?php echo $images; ?>
                                                </a> 




                                                </br> </br>
                                                &nbsp;<a href='<?php echo WEBSITE_ADMIN_URL ?>app/download/<?php echo $file_name . "/userdoc"; ?>'> Download Images </a> 					

                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                echo "<p style='color: red;'>There are no documents attached.</p>";
                            }
                            ?>

                        </div>
                        </div>

                    </div>               

                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
</div>
<script>

    jQuery(document).ready(function () {
        $(".popup").fancybox({
            helpers: {
                title: {
                    type: 'float'
                }
            }
        });
    });
</script>