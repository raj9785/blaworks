<?php echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'pages', 'action' => 'index')); ?>';
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
                            <h1 class="mainTitle">Edit Page</h1>                            
                        </div>     
                        <div class="col-sm-4 text-align-right">	
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to page List', true) . "", array('plugin' => false, 'controller' => 'Pages', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        <div class="col-md-12">   
                            <?php echo $this->Form->create('Page', array('method' => 'post', 'class' => 'form', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>                    
                            <br/>
                            <?php echo $this->Form->input('Page.id', array('type' => 'hidden')) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Page Title <span class="symbol required"></span></label> 
                                        <?php echo $this->Form->input('title', array('type' => 'text', 'maxlength' => '100', 'class' => 'form-control', 'id' => 'name', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>   

                                    

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Meta Title </label>
                                        <?php echo $this->Form->input('meta_title', array('type' => 'text', 'maxlength' => '255', 'class' => 'form-control', 'id' => 'icon_image', 'div' => false, 'label' => false)); ?>
                                        <span id="email-error" class="help-block"></span>                                        
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Meta Keywords </label>
                                        <?php echo $this->Form->input('meta_keywords', array('type' => 'textarea','rows'=>3, 'maxlength' => '1600', 'class' => 'form-control', 'id' => 'icon_image', 'div' => false, 'label' => false)); ?>
                                        <span id="email-error" class="help-block"></span>                                        
                                    </div>
                                </div>                                                                    
                                <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label class="control-label">Meta Description </label>
                                        <?php echo $this->Form->input('meta_description', array('type' => 'textarea','rows'=>3,'class' => 'form-control', 'id' => 'icon_image', 'div' => false, 'label' => false)); ?>
                                        <span id="email-error" class="help-block"></span>                                        
                                    </div>
                                </div> 
                                <div class="col-md-12">                                    
                                    <div class="form-group">
                                        <label class="control-label">Content <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('content', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'content', 'div' => false, 'label' => false)); ?>
                                        <span id="testimonial-error" class="help-block"></span>
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
                                    <?php echo $this->Form->button('Save ', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button', 'style' => 'margin-left:58px')) ?>
                                    <?php echo $this->Form->button('Cancel ', array('class' => 'btn btn-primary btn-wide pull-right', 'type' => 'button', 'id' => 'cancel_button')) ?>
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