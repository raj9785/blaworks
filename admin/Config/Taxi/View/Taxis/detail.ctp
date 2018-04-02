<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false));
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->css(array('chosen/chosen'));
echo $this->Html->script('chosen/chosen.jquery', array('inline' => false));
echo $this->Html->script('chosen/chosen.ajaxaddition.jquery', array('inline' => false));
?>
<?php
echo $this->Html->css(array('prettyPhoto'));
echo $this->Html->script(array('jquery.prettyPhoto'));
?>

<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar'); ?>

    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
        <?php
        //pr($result);
        echo $this->element('header');
        ?>
        <!-- end: TOP NAVBAR -->
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 class="mainTitle">Vehicle Details</h1>
                        </div>
                        <div class="col-md-2">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Vehicles List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>

                <div class="container-fluid container-fullw bg-white">
                    <?php //pr($result);  ?>
                    <div class="row">
                        <div class="">
                            
                            <div class="col-md-6">

                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.name', __('Vendor ID', true) . ' :', array('class' => "col-sm-6"));
                                    ?>
                                    <div class="col-sm-6" style="" >
                                        <?php echo isset($result[$model]['uniqid']) ? $result[$model]['uniqid'] : ''; ?>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
				    <?php
				    echo $this->Form->label($model . '.name', __('Vehicle Number', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php echo $result[$model]['plate_no']; ?>
                                    </div>
                                </div>

                                <div class="col-sm-12">
				    <?php
				    echo $this->Form->label($model . '.name', __('Vehicle Manufacturer', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php echo $result['Motor']['name']; ?>
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-12">
				    <?php
				    echo $this->Form->label($model . '.name', __('Status', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php if ($result['Taxi']['status'] == 1 && $result['Taxi']['status_by_admin'] == 1) {
                                               
                                                $chang = "Active";
                                            }else if ($result['Taxi']['status'] == 0 && $result['Taxi']['status_by_admin'] == 0) {
                                               
                                                $chang = "Inactivated By Admin";
                                            }else if ($result['Taxi']['status'] == 2) {
                                                
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
				    echo $this->Form->label($model . '.name', __('Permit Type', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php echo $result['Permit']['name']; ?>
                                    </div>
                                </div>

                                <div class="col-sm-12">
				    <?php
				    echo $this->Form->label($model . '.name', __('Permit Expiry Date', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php echo $result[$model]['cab_permit_expire']?date("d-m-Y",strtotime($result[$model]['cab_permit_expire'])):"N.A"; ?>
                                    </div>
                                </div>



                                <div class="col-sm-12">
				    <?php
				    echo $this->Form->label($model . '.name', __('Insurance Company', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php echo $result[$model]['vehicle_insurance_comp']?$result[$model]['vehicle_insurance_comp']:"N.A"; ?>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="col-sm-12">
                                    <?php
                                    echo $this->Form->label($model . '.name', __('Vendor Name', true) . ' :', array('class' => "col-sm-6"));
                                    ?>
                                    <div class="col-sm-6" style="" >
                                        <?php echo $result[$model]['firstname'] . ' ' . $result[$model]['lastname']; ?>
                                    </div>
                                </div>


                                <div class="col-sm-12">
				    <?php
				    echo $this->Form->label($model . '.name', __('Vehicle Type', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php echo $result[$model]['motor_type']; ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
				    <?php
				    echo $this->Form->label($model . '.name', __('Vehicle Model', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php echo $result[$model]['motor_model']; ?>
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-12">
				    <?php
				    echo $this->Form->label($model . '.name', __('Verified', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					 <?php
					    if ($result['Taxi']['verified'] == 1) {
						
						$chang = "Verified";
					    }else if ($result['Taxi']['verified'] == 2) {
						
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
				    echo $this->Form->label($model . '.name', __('Permit Number', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php echo $result[$model]['permit_no']; ?>
                                    </div>
                                </div>


                                <div class="col-sm-12">
				    <?php
				    echo $this->Form->label($model . '.name', __('Fitness Expiry Date', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php echo $result[$model]['fitness_expiry']?date("d-m-Y",strtotime($result[$model]['fitness_expiry'])):"N.A"; ?>
                                    </div>
                                </div>



                                <div class="col-sm-12">
				    <?php
				    echo $this->Form->label($model . '.name', __('Insurance Expiry Date', true) . ' :', array('class' => "col-sm-6"));
				    ?>
                                    <div class="col-sm-6" style="" >
					<?php echo $result[$model]['vehicle_insurance_expiry']?date("d-m-Y",strtotime($result[$model]['vehicle_insurance_expiry'])):"N.A"; ?>
                                    </div>
                                </div>




                            </div>	  
                        </div>
                        
                          <div class="clr clear" style="height: 15px;"></div>
                        <div class="">

                            <div class="detalimgdtl">
                                <ul class="gallery clearfix" style="list-style: outside none none;">
                                            <?php
					if (!empty($result["TaxiInformation"])) {
					    foreach ($result["TaxiInformation"] as $k => $v) {
                                                ?>
                                               <?php
						$file_path = TAXI_DOC_STORE_PATH;
						$file_name = $v['registration_certificate'];

						    if (is_file($file_path . $file_name)) {
						?>
                                    <li>
                                        <a href="<?php echo WEBSITE_URL."uploads/taxi/docs/".$file_name; ?>" rel="prettyPhoto[gallery2]">
                                            View Uploaded Documents
                                        </a> | 
                                    </li>
                                                    <?php } ?>


                                            <?php
						$file_path = TAXI_DOC_STORE_PATH;
						$file_name = $v['permit'];

						    if (is_file($file_path . $file_name)) {
						?>
                                    <li>
                                        <a href="<?php echo WEBSITE_URL."uploads/taxi/docs/".$file_name; ?>" rel="prettyPhoto[gallery2]">

                                        </a>
                                    </li>
                                                    <?php } ?>


                                            <?php
						$file_path = TAXI_DOC_STORE_PATH;
						$file_name = $v['insurance'];

						    if (is_file($file_path . $file_name)) {
						?>
                                    <li>
                                        <a href="<?php echo WEBSITE_URL."uploads/taxi/docs/".$file_name; ?>" rel="prettyPhoto[gallery2]">

                                        </a>
                                    </li>
                                                    <?php } ?>

                                             <?php
						$file_path = TAXI_DOC_STORE_PATH;
						$file_name = $v['fitness'];

						    if (is_file($file_path . $file_name)) {
						?>
                                    <li>
                                        <a href="<?php echo WEBSITE_URL."uploads/taxi/docs/".$file_name; ?>" rel="prettyPhoto[gallery2]">

                                        </a>
                                    </li>
                                                    <?php } ?>
                                             <?php
						$file_path = TAXI_DOC_STORE_PATH;
						$file_name = $v['puc'];

						    if (is_file($file_path . $file_name)) {
						?>
                                    <li>
                                        <a href="<?php echo WEBSITE_URL."uploads/taxi/docs/".$file_name; ?>" rel="prettyPhoto[gallery2]">

                                        </a>
                                    </li>
                                                    <?php } ?>




                                        <?php } } ?>
                                </ul>

                            </div>

					<?php
					if (!empty($result["TaxiInformation"])) {
					    foreach ($result["TaxiInformation"] as $k => $v) {
						//pr($v);
						?>
                            <div class="detalimgdtl">
                                                                <?php
                                                                $file_path = TAXI_DOC_STORE_PATH;
                                                                $file_name = $v['registration_certificate'];

                                                                if (is_file($file_path . $file_name)) {
                                                                    ?>
                                <a href='<?php echo WEBSITE_URL ?>admin/app/download/<?php echo $file_name . "/taxidoc"; ?>'>Download Registration Certificate</a> | 

                                                                    <?php
                                                                }
                                                                ?>  

                            </div>
                            <div class="detalimgdtl">
                                                                <?php
                                                                $file_path = TAXI_DOC_STORE_PATH;
                                                                $file_name = $v['permit'];

                                                                if (is_file($file_path . $file_name)) {
                                                                    ?>
                                <a href='<?php echo WEBSITE_URL ?>admin/app/download/<?php echo $file_name . "/taxidoc"; ?>'>Download Permit</a> | 

                                                                    <?php
                                                                }
                                                                ?>  

                            </div>
                            <div class="detalimgdtl">
						    <?php
						    $file_path = TAXI_DOC_STORE_PATH;
						    $file_name = $v['insurance'];

						    if (is_file($file_path . $file_name)) {
							?>
                                <a href='<?php echo WEBSITE_URL ?>admin/app/download/<?php echo $file_name . "/taxidoc"; ?>'>Download Insurance</a> | 

							<?php
						    }
						    ?>  

                            </div>
                            <div class="detalimgdtl">
						    <?php
						    $file_path = TAXI_DOC_STORE_PATH;
						    $file_name = $v['fitness'];

						    if (is_file($file_path . $file_name)) {
							?>
                                <a href='<?php echo WEBSITE_URL ?>admin/app/download/<?php echo $file_name . "/taxidoc"; ?>'>Download Fitness</a> | 

							<?php
						    }
						    ?>  

                            </div>
                            <div class="detalimgdtl">
						    <?php
						    $file_path = TAXI_DOC_STORE_PATH;
						    $file_name = $v['puc'];

						    if (is_file($file_path . $file_name)) {
							?>
                                <a href='<?php echo WEBSITE_URL ?>admin/app/download/<?php echo $file_name . "/taxidoc"; ?>'>Download PUC Certificate</a>  

							<?php
						    }
						    ?>  

                            </div>

						<?php
					    }
					} else {
					    //echo "<p class='alert alert-warning'>There are no documents attached.</p>";
					}
					?>

                        </div>

						
						 <?php
						if (!empty($TaxiImage)) {
							$i=0;
								foreach ($TaxiImage as $k => $v) {							
						?>						
						<?php if($i==0){?>			
								<div class="col-sm-12">
										<h3> Taxi Image </h3>
								</div>
						<?php }?>
						
						<div class="col-sm-3">
                            <div class="detalimgdtl">
								<?php
								$file_path = TAXI_DOC_STORE_PATH;
								$file_name = $v['TaxiImage']['front'];
								//echo $file_path . $file_name;
								//if (is_file($file_path . $file_name)) {
									if ($file_name) {
									?>					 
										 
										 <div class="box" id="box<?php echo $v['TaxiImage']['id']; ?>">
												 <a class="popup" id="popup_<?php echo $v['TaxiImage']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/taxi/' . $v['TaxiImage']['front']; ?>" >
														<img src="<?php echo WEBSITE_URL . 'uploads/taxi/' . $v['TaxiImage']['front']; ?>" id="taxi_img_<?php echo $v['TaxiImage']['id']; ?>"  width="220px" height="200px" class="img-rounded "/>
												</a>                                                 
										</div>
										 

									<?php
								}
								?>  

                            </div>
                         </div> 

							<?php $i++; } }?>
						
						
                      

                        <?php
						if (!empty($TaxiRegistrationCertificate)) {
							$i=0;
								foreach ($TaxiRegistrationCertificate as $k => $v) {							
						?>						
						<?php if($i==0){?>			
								<div class="col-sm-12">
										<h3> Registration Certificate </h3>
								</div>
						<?php }?>
						
						<div class="col-sm-3">
                            <div class="detalimgdtl">
								<?php
								$file_path = TAXI_DOC_STORE_PATH;
								$file_name = $v['TaxiDocument']['document_image'];
								//echo $file_path . $file_name;
								//if (is_file($file_path . $file_name)) {
									if ($file_name) {
									?>
										  <div class="box" id="registration_box<?php echo $v['TaxiDocument']['id']; ?>">
												 <a class="popup" id="registration_popup_<?php echo $v['TaxiDocument']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/taxi_documents/' . $v['TaxiDocument']['document_image']; ?>" >
														<img src="<?php echo WEBSITE_URL . 'uploads/taxi_documents/' . $v['TaxiDocument']['document_image']; ?>" id="registration_img_<?php echo $v['TaxiDocument']['id']; ?>"  width="220px" height="200px" class="img-rounded "/>
												</a>                                                 
										</div>
									<?php
								}
								?>  

                            </div>
                         </div> 

							<?php $i++; } }?>
							
							
						 <?php
						if (!empty($TaxipermitDoc)) {
							$i=0;
								foreach ($TaxipermitDoc as $k => $v) {							
						?>						
						<?php if($i==0){?>			
								<div class="col-sm-12">
										<h3> Permit Documents </h3>
								</div>
						<?php }?>
						
						<div class="col-sm-3">
                            <div class="detalimgdtl">
								<?php
								$file_path = TAXI_DOC_STORE_PATH;
								$file_name = $v['TaxiDocument']['document_image'];
								//echo $file_path . $file_name;
								//if (is_file($file_path . $file_name)) {
									if ($file_name) {
									?>
										
										 <div class="box" id="permit_box<?php echo $v['TaxiDocument']['id']; ?>">
												 <a class="popup" id="permit_popup_<?php echo $v['TaxiDocument']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/taxi_documents/' . $v['TaxiDocument']['document_image']; ?>" >
														<img src="<?php echo WEBSITE_URL . 'uploads/taxi_documents/' . $v['TaxiDocument']['document_image']; ?>" id="registration_img_<?php echo $v['TaxiDocument']['id']; ?>"  width="220px" height="200px" class="img-rounded "/>
												</a>                                                 
										</div>

									<?php
								}
								?>  

                            </div>
                         </div> 

							<?php $i++; } }?>

						<?php
						if (!empty($TaxiInsuranceDoc)) {
							$i=0;
								foreach ($TaxiInsuranceDoc as $k => $v) {							
						?>						
						<?php if($i==0){?>			
								<div class="col-sm-12">
										<h3> Insurance Documents </h3>
								</div>
						<?php }?>
						
						<div class="col-sm-3">
                            <div class="detalimgdtl">
								<?php
								$file_path = TAXI_DOC_STORE_PATH;
								$file_name = $v['TaxiDocument']['document_image'];
								//echo $file_path . $file_name;
								//if (is_file($file_path . $file_name)) {
									if ($file_name) {
									?>
																				
										 
										  <div class="box" id="insurance_box<?php echo $v['TaxiDocument']['id']; ?>">
												 <a class="popup" id="insurance_popup_<?php echo $v['TaxiDocument']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/taxi_documents/' . $v['TaxiDocument']['document_image']; ?>" >
														<img src="<?php echo WEBSITE_URL . 'uploads/taxi_documents/' . $v['TaxiDocument']['document_image']; ?>" id="registration_img_<?php echo $v['TaxiDocument']['id']; ?>"  width="220px" height="200px" class="img-rounded "/>
												</a>                                                 
										</div>

									<?php
								}
								?>  

                            </div>
                         </div> 

							<?php $i++; } }?>	
							
						<?php
						if (!empty($TaxiFitnessDoc)) {
							$i=0;
								foreach ($TaxiFitnessDoc as $k => $v) {							
						?>						
						<?php if($i==0){?>			
								<div class="col-sm-12">
										<h3> Fitnes Documents </h3>
								</div>
						<?php }?>
						
						<div class="col-sm-3">
                            <div class="detalimgdtl">
								<?php
								$file_path = TAXI_DOC_STORE_PATH;
								$file_name = $v['TaxiDocument']['document_image'];
								//echo $file_path . $file_name;
								//if (is_file($file_path . $file_name)) {
									if ($file_name) {
									?>											
										 <div class="box" id="fitnes_box<?php echo $v['TaxiDocument']['id']; ?>">
												 <a class="popup" id="fitnes_popup_<?php echo $v['TaxiDocument']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/taxi_documents/' . $v['TaxiDocument']['document_image']; ?>" >
														<img src="<?php echo WEBSITE_URL . 'uploads/taxi_documents/' . $v['TaxiDocument']['document_image']; ?>" id="registration_img_<?php echo $v['TaxiDocument']['id']; ?>" width="220px" height="200px" class="img-rounded "/>
												</a>                                                 
										</div>

									<?php
								}
								?>  

                            </div>
                         </div> 

							<?php $i++; } }?>
							
							
							<?php
						if (!empty($TaxiPucDoc)) {
							$i=0;
								foreach ($TaxiPucDoc as $k => $v) {							
						?>						
						<?php if($i==0){?>			
								<div class="col-sm-12">
										<h3> Puc Documents </h3>
								</div>
						<?php }?>
						
						<div class="col-sm-3">
                            <div class="detalimgdtl">
								<?php
								$file_path = TAXI_DOC_STORE_PATH;
								$file_name = $v['TaxiDocument']['document_image'];
								//echo $file_path . $file_name;
								//if (is_file($file_path . $file_name)) {
									if ($file_name) {
									?>
																				
										
										 <div class="box" id="puc_box<?php echo $v['TaxiDocument']['id']; ?>">
												 <a class="popup" id="puc_popup_<?php echo $v['TaxiDocument']['id']; ?>" href="<?php echo WEBSITE_URL . 'uploads/taxi_documents/' . $v['TaxiDocument']['document_image']; ?>" >
														<img src="<?php echo WEBSITE_URL . 'uploads/taxi_documents/' . $v['TaxiDocument']['document_image']; ?>" id="registration_img_<?php echo $v['TaxiDocument']['id']; ?>" width="220px" height="200px" class="img-rounded"/>
												</a>                                                 
										</div>

									<?php
								}
								?>  

                            </div>
                         </div> 

							<?php $i++; } }?>		
							

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
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
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $("area[rel^='prettyPhoto']").prettyPhoto();
        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed: 'normal', theme: 'light_square', slideshow: 3000, autoplay_slideshow: false});
        $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed: 'fast', slideshow: 10000, hideflash: true});




    });
</script>

