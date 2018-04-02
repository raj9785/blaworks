<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'));
?>

<script type='text/javascript'>
    $(document).ready(function () {


    })

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
                            <h1 class="mainTitle">
                                <?php
                                /* $file_path = USERDOCS;
                                  $file_name = $result['UserDocument']['image'];
                                  $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 75, 75, base64_encode($file_path), $file_name), true);
                                  //$big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);
                                  if (is_file($file_path . $file_name)) {
                                  $images = $this->Html->image($image_url);
                                  ?>

                                  <?php echo $images; ?>
                                  </a>
                                  <?php
                                  } else {
                                  echo $this->Html->image('no_image.jpg', array('width' => '75px', 'height' => '75px'));
                                  } */
                                //Configure::write('debug', 2);
                                //pr($result['UserDocument']);
                                /* if(isset($result['UserDocument']) && !empty($result['UserDocument']))	{
                                  $file_path = USERDOCS;
                                  $file_name = $result['UserDocument'][0]['document_image'];

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
                                /*
                                $file_name = '';
                                if (isset($result["UserDocument"]) && !empty($result["UserDocument"])) {
                                    foreach ($result["UserDocument"] as $UserDocument) {
                                        if ($UserDocument['type'] == 8) {
                                            $file_name = $UserDocument['document_image'];
                                        }
                                    }
                                }
                                if (isset($file_name) && !empty($file_name)) {
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
                                }*/
                                ?>


                                <?php echo __('Driver Detail');    ///pr($result); ?> </h1>
                        </div>
                        <div class="col-md-2">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back To DCO List', true) . "", array("action" => "driver_list"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>


                <div class="container-fluid container-fullw bg-white">

                    <div class="row">

                        <div class="col-md-12">
                            <h4>Individual Driver Detail</h4>


                            <div class="col-md-6">
                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.name', __('First Name', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-8" style="" >
                                        <?php echo $result[$model]['firstname']; ?>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.name', __('Mobile Number', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-8" style="" >
                                        <?php echo $result[$model]['mobile']; ?>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.name', __('Alternate Mobile Number', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-8" style="" >
                                        <?php echo $result[$model]['alternate_mobile']; ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.name', __('Address', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-8" style="" >
                                        <?php echo $result[$model]['address']; ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.created', __(' Created', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-8" style="" >
                                        <?php echo $result[$model]['created']; ?>
                                    </div>
                                </div>
								
								<div class="col-sm-12">
                                        <?php
                                        echo $this->Form->label($model . '.name', __('Operation Cities', true) . ' :', array('class' => "col-sm-4"));
                                        ?>
                                        <div class="col-sm-8" style="" >
                                            <?php
                                           // pr($cities_list);
                                            if (!empty($cities_list)) {
                                                foreach ($cities_list as $dtl) {
													//pr($dtl);
                                                    echo $dtl['City']['name'] . ",";
                                                }
                                            } else {

                                                echo "--";
                                            }
                                            ?>
                                        </div>
                                    </div>
								
								
                            </div>
                            <div class="col-md-6">
                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.name', __('Last Name', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-8" style="" >
                                        <?php echo $result[$model]['lastname']; ?>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.license_no', __('License No', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-8" style="" >
                                        <?php echo $result[$model]['license_no']; ?>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.license_from', __('License from', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-8" style="" >
                                        <?php echo $result[$model]['license_from']; ?>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.license_to', __('License to', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-8" style="" >
                                        <?php echo $result[$model]['license_to']; ?>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.modified', __(' Modified', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                    <div class="col-sm-8" style="" >
                                        <?php echo $result[$model]['modified']; ?>
                                    </div>
                                </div>
								
								
								<div class="col-sm-12">
                                        <?php
                                        echo $this->Form->label($model . '.name', __('Operation Zone', true) . ' :', array('class' => "col-sm-4"));
                                        ?>
                                        <div class="col-sm-8" style="" >
                                            <?php
                                         //  pr($Zone_list);
                                            if (!empty($Zone_list)) {
                                                foreach ($Zone_list as $dtl) {
													//pr($dtl);
                                                    echo $dtl['Zone']['name'] . ",";
                                                }
                                            } else {

                                                echo "--";
                                            }
                                            ?>
                                        </div>
                                    </div>


                            </div> 


                        </div>
                        <?php if (isset($result["Company"])) { ?>
                            <div class="col-md-12">

                                <h4><?php
                                    if ($result[$model]["user_role_id"] == 4) {
                                        echo __(" Bank Detail", true);
                                    } else {
                                        echo __(" Bank Detail", true);
                                    }
                                    ?></h4>




                                <div class="col-md-6">
                                    <div class="col-sm-12">
                                        <?php
                                        echo $this->Form->label($model . '.bank_name', __('Bank Name', true) . ' :', array('class' => "col-sm-4"));
                                        ?>
                                        <div class="col-sm-8" style="" >
                                            <?php echo $company["Company"]['bank_name']; ?>
                                        </div>
                                    </div>
                                    <?php //if ($company[$model]["user_role_id"] == 2) { ?>

                                    <div class="col-sm-12">
                                        <?php
                                        echo $this->Form->label($model . '.bank', __('A/C No', true) . ' :', array('class' => "col-sm-4"));
                                        ?>
                                        <div class="col-sm-8" style="" >
                                            <?php echo $company["Company"]['bank']; ?>
                                        </div>
                                    </div>

                                    <?php //} ?>
                                    <div class="col-sm-12">
                                        <?php
                                        echo $this->Form->label($model . '.branch_name', __('Branch Name', true) . ' :', array('class' => "col-sm-4"));
                                        ?>
                                        <div class="col-sm-8" style="" >
                                            <?php echo $company["Company"]['branch_name']; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <?php
                                        echo $this->Form->label($model . '.branch_address', __('Branch Address', true) . ' :', array('class' => "col-sm-4"));
                                        ?>
                                        <div class="col-sm-8" style="" >
                                            <?php echo $company["Company"]['branch_address']; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <?php
                                        echo $this->Form->label($model . '.ifsc_code', __('Ifsc Code', true) . ' :', array('class' => "col-sm-4"));
                                        ?>
                                        <div class="col-sm-8" style="" >
                                            <?php echo $company["Company"]['ifsc_code']; ?>
                                        </div>
                                    </div>
                                    <!--div class="col-sm-12">
                                    <?php
                                    //	echo $this->Form->label($model . '.name', __('Operation Cities', true) . ' :', array('class' => "col-sm-4"));
                                    ?>
                                <div class="col-sm-8" style="" >
                                    <?php
                                    //pr($OperationCity);
                                    if (!empty($OperationCity)) {
                                        foreach ($OperationCity as $dtl) {
                                            echo $dtl['City']['name'] . ",";
                                        }
                                    } else {

                                        echo "--";
                                    }
                                    ?>
                                </div>
                            </div-->

                                </div>




                            </div>
                            <?php /* ?>
                              <div class="col-md-12">
                              <h4>Additional info(Scan copy of Document):</h4>
                              <?php
                              if (!empty($result["CompanyInformation"])) {
                              foreach ($result["CompanyInformation"] as $k => $v) {
                              ?>
                              <div class="col-sm-12">

                              <div class="col-sm-6" style="margin-left: 15px;">
                              <?php
                              $file_path = USER_DOC_STORE_PATH;
                              $file_name = $v['image'];
                              if ($file_name) {
                              ?>

                              <a href='<?php echo WEBSITE_ADMIN_URL ?>app/download/<?php echo $file_name . "/doc"; ?>'>Download Docs</a>
                              <?php
                              }
                              ?>
                              </div>
                              </div>
                              <?php
                              }
                              } else {
                              echo "<p class='alert alert-warning'>There are no documents attached.</p>";
                              }
                              ?>
                              </div>
                              <?php */ ?>
                        <?php } ?>
                        <?php /*

                          <div class="col-md-12" style="margin-top:20px">
                          <h4>Passport Images:</h4>
                          <?php

                          if ($result[$model]['passport_proof_img']) {
                          ?>
                          <div class="detalimg" style="display: block !important;margin-right: 30px;">
                          <?php
                          $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                          $v = $result[$model]['passport_proof_img'];
                          $file_name = $v;
                          if (is_file($file_path . $file_name)) {
                          ?>

                          <?php $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 100, 100, base64_encode($file_path), $file_name), true);
                          $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);


                          $images = $this->Html->image($image_url, array('alt' => '', 'title' =>''));
                          ?>

                          <a id="single_1" href="<?php echo $big_image_url; ?>" title=''>
                          <?php echo $images; ?>
                          </a>
                          </br> </br>



                          &nbsp;<a href='<?php echo WEBSITE_ADMIN_URL ?>app/download/<?php echo $file_name . "/vendrodoc"; ?>'> Download Images </a>
                          <?php
                          }
                          ?>

                          </div>
                          <?php

                          } else {
                          echo "<p style='color: red;'>There are no documents attached.</p>";
                          }
                          ?>

                          </div>


                          <div class="col-md-12" style="margin-top:20px">
                          <h4>Voter ID Images:</h4>
                          <?php

                          if ($result[$model]['identity_proof_img']) {
                          ?>
                          <div class="detalimg" style="display: block !important;margin-right: 30px;">
                          <?php
                          $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                          $v = $result[$model]['identity_proof_img'];
                          $file_name = $v;
                          if (is_file($file_path . $file_name)) {
                          ?>

                          <?php $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 100, 100, base64_encode($file_path), $file_name), true);
                          $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);


                          $images = $this->Html->image($image_url, array('alt' => '', 'title' =>''));
                          ?>

                          <a id="single_1" href="<?php echo $big_image_url; ?>" title=''>
                          <?php echo $images; ?>
                          </a>
                          </br> </br>



                          &nbsp;<a href='<?php echo WEBSITE_ADMIN_URL ?>app/download/<?php echo $file_name . "/vendrodoc"; ?>'> Download Images </a>
                          <?php
                          }
                          ?>

                          </div>
                          <?php

                          } else {
                          echo "<p style='color: red;'>There are no documents attached.</p>";
                          }
                          ?>

                          </div>

                          <div class="col-md-12" style="margin-top:20px">
                          <h4>Aadhar Card Images:</h4>
                          <?php

                          if ($result[$model]['aadhar_proof_img']) {
                          ?>
                          <div class="detalimg" style="display: block !important;margin-right: 30px;">
                          <?php
                          $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                          $v = $result[$model]['aadhar_proof_img'];
                          $file_name = $v;
                          if (is_file($file_path . $file_name)) {
                          ?>

                          <?php $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 100, 100, base64_encode($file_path), $file_name), true);
                          $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);


                          $images = $this->Html->image($image_url, array('alt' => '', 'title' =>''));
                          ?>

                          <a id="single_1" href="<?php echo $big_image_url; ?>" title=''>
                          <?php echo $images; ?>
                          </a>
                          </br> </br>



                          &nbsp;<a href='<?php echo WEBSITE_ADMIN_URL ?>app/download/<?php echo $file_name . "/vendrodoc"; ?>'> Download Images </a>
                          <?php
                          }
                          ?>

                          </div>
                          <?php

                          } else {
                          echo "<p style='color: red;'>There are no documents attached.</p>";
                          }
                          ?>

                          </div>

                          <div class="col-md-12" style="margin-top:20px">
                          <h4>Driving License Images:</h4>
                          <?php

                          if ($result[$model]['license_proof_img']) {
                          ?>
                          <div class="detalimg" style="display: block !important;margin-right: 30px;">
                          <?php
                          $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                          $v = $result[$model]['license_proof_img'];
                          $file_name = $v;
                          if (is_file($file_path . $file_name)) {
                          ?>

                          <?php $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 100, 100, base64_encode($file_path), $file_name), true);
                          $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);


                          $images = $this->Html->image($image_url, array('alt' => '', 'title' =>''));
                          ?>

                          <a id="single_1" href="<?php echo $big_image_url; ?>" title=''>
                          <?php echo $images; ?>
                          </a>
                          </br> </br>



                          &nbsp;<a href='<?php echo WEBSITE_ADMIN_URL ?>app/download/<?php echo $file_name . "/vendrodoc"; ?>'> Download Images </a>
                          <?php
                          }
                          ?>

                          </div>
                          <?php

                          } else {
                          echo "<p style='color: red;'>There are no documents attached.</p>";
                          }
                          ?>

                          </div>

                         */ ?>


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

                                                <a id="single_1" href="<?php echo $big_image_url; ?>" title=''>
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

                                                <a id="single_1" href="<?php echo $big_image_url; ?>" title=''>
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

                                                <a id="single_1" href="<?php echo $big_image_url; ?>" title=''>
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

                                                <a id="single_1" href="<?php echo $big_image_url; ?>" title=''>
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
                            <h4>Cheque Copy:</h4>

								<?php
								if (isset($result["UserDocument"]) && !empty($result["UserDocument"])) {
									foreach ($result["UserDocument"] as $UserDocument) {
										if ($UserDocument['type'] == 9) {

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

                                                <a id="single_1" href="<?php echo $big_image_url; ?>" title=''>
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

<?php echo $this->element('footer'); ?>	

</div>





