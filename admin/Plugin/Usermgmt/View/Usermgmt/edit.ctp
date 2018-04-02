<?php 
	echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5','validationEngine.jquery','jquery-ui-1.8.22.custom','jquery-ui_new'));
	echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5','jquery.validationEngine-en','jquery.validationEngine'));

 ?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#UsermgmtEditForm").validationEngine();
		 $("#single_1").fancybox({
          helpers: {
              title : {
                  type : 'float'
              }
          }
      });
	});
</script>
<table class="table table-bordered table-striped">
  <thead>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('Edit Employee'); ?>
            <div class="pull-right">
               <?php 
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>". __('Back To Employee',true)."", array("action" => "index"), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td><?php 
				echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt','controller' => 'usermgmt', 'action' => 'edit'),'enctype' => 'multipart/form-data')); 
				echo $this->Form->hidden('id');
		  ?>
        <div class="row-fluid">
          <div class="span12" >
          </div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="control-group <?php echo ($this->Form->error('firstname'))? 'error':'';?>">
						<?php 
							echo $this->Form->label($model.'.firstname', __('First Name',true).' :<span class="required">*</span>', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input <?php echo ($this->Form->error('firstname'))? 'error':'';?>" style="margin-left:150px;" >
							<?php echo $this->Form->text($model.".firstname",array('class'=>'textbox validate[required]'));  ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.firstname', array('wrap' => false) ); ?>
							</span>
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error('lastname'))? 'error':'';?>">
						<?php 
							echo $this->Form->label($model.'.lastname', __('Last Name',true).' :', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input <?php echo ($this->Form->error('lastname'))? 'error':'';?>" style="margin-left:150px;" >
							<?php echo $this->Form->text($model.".lastname",array('class'=>''));  ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.lastname', array('wrap' => false) ); ?>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error('username'))? 'error':'';?>">
						<?php 
						echo $this->Form->label($model.'.username', __('User Name',true).' :<span class="required">*</span>', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input <?php echo ($this->Form->error('username'))? 'error':'';?>" style="margin-left:150px;" >
							<?php echo $this->Form->text($model.".username",array('class'=>'textbox validate[required]'));  ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.username', array('wrap' => false) ); ?>
							</span>
						</div>
				 </div>
				</div>
				<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error('email'))? 'error':'';?>">
						<?php 
							echo $this->Form->label($model.'.email', __('User Email',true).' :<span class="required">*</span>', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input <?php echo ($this->Form->error('email'))? 'error':'';?>" style="margin-left:150px;" >
							<?php echo $this->Form->text($model.".email",array('class'=>'textbox validate[required,custom[email]]')); ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.email', array('wrap' => false) ); ?>
							</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error('image'))? 'error':'';?>">
						<?php 
							echo $this->Form->label($model.'.image', __('Upload Photo',true).' :<span class="required"></span>', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input" style="margin-left:155px;">
							<?php echo $this->Form->file($model.".image",array('class'=>''));  ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.image', array('wrap' => false) ); ?>
							</span>
						</div>
					</div>
				</div>
				<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error('status'))? 'error':'';?>">
						<?php 
							echo $this->Form->label($model.'.status', __('Status',true).' :', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input <?php echo ($this->Form->error('status'))? 'error':'';?>" style="margin-left:150px;" >
						<?php echo $this->Form->select($model.'.status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => false)); ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.status', array('wrap' => false) ); ?>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="clearfx control-group">
						<div class="input" style="margin-left:155px;">
							<?php
								$file_path    = ALBUM_UPLOAD_IMAGE_PATH ;
								$file_name    = isset($result[$model]['image'])? $result[$model]['image'] : '';
								$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',150,150,base64_encode($file_path),$file_name),true);
								$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
								if(is_file($file_path . $file_name)) {
									$images = $this->Html->image($image_url,array('alt' => $result['Usermgmt']['firstname'],'title' => $result['Usermgmt']['firstname']));	
								?>
								<a id="single_1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($result['Usermgmt']['firstname']); ?>'>
									<?php echo $images; ?>
								</a>
								<?php
								}else {
								echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
								}
							?>
							<span class="help-inline" style="color: #B94A48;">
							</span>
						</div>
		</div>
				</div>
			</div>
			<div class="form-actions">
              <div class="input" > <?php echo $this->Form->button(__d("users", "Save", true),array("class"=>"btn btn-primary")); ?> <?php 
				echo $this->Html->link( __("Cancel",true),array("action" => "index"), array("class" => "btn", "escape" => false) ); 
			?>&nbsp;&nbsp;
              </div>
            </div>
      
        </div>
        <?php echo $this->Form->end();?></td>
    </tr>
  </thead>
</table>
