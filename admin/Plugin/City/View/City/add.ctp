<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'city', 'action' => 'index')); ?>';
        });
        $("#country_id").on('change',function(){
            $("#submit_button").attr('disabled','disabled');
            $("#state_id").attr('disabled','disabled');
            $("#state_id").empty();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'getStatesByCountry')) ?>',
                data: 'country_id=' + $("#country_id").val(),
                success: function(data) {
                    $("#submit_button").removeAttr('disabled');
                    $("#state_id").removeAttr('disabled');
                    $("#state_id").html(data);
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
        <div class="main-content" >
            <div class="wrap-content container" id="container">
                <!-- start: PAGE TITLE -->
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Add New City</h1>
                        </div>        
						<div class="col-sm-4 text-align-right">	
						<?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Cities List', true) . "", array('plugin' => false,'controller' => 'city',"action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>	
						</div> 
						
                    </div>
                </section>
                <!-- end: PAGE TITLE -->
                <!-- Global Messages -->
                <?php echo $this->Session->flash(); ?>
                <!-- Global Messages End -->
                <!-- start: FORM VALIDATION EXAMPLE 1 -->
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12 space20">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">   
                            <?php echo $this->Form->create('City', array('method' => 'post', 'class' => 'form', 'role' => 'form')); ?>
                            <?php echo $this->Form->input('lat',array('type' => 'hidden','name' => 'lat')); ?>
                            <?php echo $this->Form->input('lng',array('type' => 'hidden','name' => 'lng')); ?>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select Country <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('country_id', array('type' => 'select', 'empty' => 'Select','options' => $country_list, 'class' => 'form-control', 'id' => 'country_id', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">City <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('name', array('type' => 'text', 'maxlength' => '100','class' => 'form-control', 'id' => 'city_name', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="phone_no-error" class="help-block"></span>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select State <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('state_id', array('type' => 'select', 'empty' => 'Select','options' => '', 'class' => 'form-control', 'id' => 'state_id', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="phone_no-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">City Code <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('city_code', array('type' => 'text', 'maxlength' => '100','class' => 'form-control', 'id' => 'city_code', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="phone_no-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                     <div class="form-group">
                                        <label class="control-label">MMT City Code </label>
                                        <?php echo $this->Form->input('mmt_ct_code', array('type' => 'text', 'maxlength' => '20','class' => 'form-control', 'id' => 'mmt_ct_code', 'div' => false, 'label' => false)); ?>
                                        <span id="phone_no-error" class="help-block"></span>
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
                                    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button')) ?>
                                    <?php echo $this->Form->button('Cancel', array('class' => 'btn btn-primary btn-wide pull-right', 'type' => 'button', 'id' => 'cancel_button')) ?>
                                </div>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
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
<?php
//if (URL_DOMAIN == "live") {
echo $this->Html->script('https://maps.googleapis.com/maps/api/js?key=' . MAP_API_KEY . '&libraries=places', array('inline' => false));
//} else {
//  echo $this->Html->script('http://maps.googleapis.com/maps/api/js?libraries=places', array('inline' => false));
//}
?>
<?php echo $this->Html->script('geocomplete.js',array('inline' => false)); ?>
<script type="text/javascript">
    $(function () {
        $("#city_name").geocomplete({
            details: "form",
            types: ["geocode", "establishment"]
        });
    });
</script>
