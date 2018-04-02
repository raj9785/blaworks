<?php 
	echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5','validationEngine.jquery','jquery-ui-1.8.22.custom','jquery-ui_new'));
	echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5','jquery.validationEngine-en','jquery.validationEngine'));

 ?>
<script type="text/javascript">
	jQuery(document).ready(function(){	
		jQuery("#UsermgmtEditCompanyForm").validationEngine();
		 $("#UsermgmtCountryId").live('change',function(){
		cat_id	=	$(this).val();
		$.ajax({
			url:"<?php echo $this->Html->url(array('plugin'=>'state','controller'=>'states','action'=>'get_state'));?>",
			data:{'cat_id':cat_id},
			type:'post',
			dataType:'json',
			success:function(subcat_data){
				options	=	"<option value=''><?php echo __('Select State');?></option>";
				$.each(subcat_data,function(index,value){
					options	+=	"<option value='"+index+"'>"+value+"</option>";	
				});
				$("#UsermgmtStateId").empty().html(options);
			}
		});
		});
		$("#UsermgmtStateId").live('change',function(){
		cat_id	=	$(this).val();
		$.ajax({
			url:"<?php echo $this->Html->url(array('plugin'=>'city','controller'=>'cities','action'=>'get_city'));?>",
			data:{'cat_id':cat_id},
			type:'post',
			dataType:'json',
			success:function(subcat_data){
				options	=	"<option value=''><?php echo __('Select City');?></option>";
				$.each(subcat_data,function(index,value){
					options	+=	"<option value='"+index+"'>"+value+"</option>";	
				});
				$("#UsermgmtCityId").empty().html(options);
			}
		});
		});
		jQuery( "#UsermgmtDob" ).datepicker();
	});
</script>
<table class="table table-bordered table-striped">
  <thead>
    <tr >
      <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
          <h1>
            <?php  echo __('Edit Company'); ?>
            <div class="pull-right">
               <?php 
						echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>". __('Back To Company',true)."", array("action" => "company"), array("class" => "btn btn-primary", "escape" => false) );
					 ?>
            </div>
          </h1>
        </div>
      </th>
    </tr>
    <tr>
      <td><?php 
				echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt','controller' => 'usermgmt', 'action' => 'edit_company'),'enctype' => 'multipart/form-data')); 
				echo $this->Form->hidden('id');
		  ?>
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
					<div class="clearfx control-group <?php echo ($this->Form->error('mobile'))? 'error':'';?>">
						<?php 
							echo $this->Form->label($model.'.mobile', __('Mobile Number',true).' :<span class="required">*</span>', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input <?php echo ($this->Form->error('mobile'))? 'error':'';?>" style="margin-left:150px;" >
							<?php echo $this->Form->text($model.".mobile",array('class'=>'textbox validate[required,custom[phone]]')); ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.mobile', array('wrap' => false) ); ?>
							</span>
						</div>
					</div>
			</div>
			<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error('address'))? 'error':'';?>">
						<?php 
							echo $this->Form->label($model.'.address', __('Address',true).' :<span class="required">*</span>', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input <?php echo ($this->Form->error('address'))? 'error':'';?>" style="margin-left:150px;" >
							<?php echo $this->Form->textarea($model.".address",array('class'=>'textbox ')); ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.address', array('wrap' => false) ); ?>
							</span>
						</div>
					</div>
			</div>
			</div>
			<div class="row-fluid">
			<div class="span5" >
				<div class="clearfx control-group <?php echo ($this->Form->error('country_id'))? 'error':'';?>">
				<?php 
					echo $this->Form->label($model.'.country_id', __('Select Country',true).' :<span class="required"></span>', array('style' => "float:left;width:130px;") ); 
				?>
				<div class="input <?php echo ($this->Form->error('country_id'))? 'error':'';?>" style="margin-left:150px;" >
					<?php echo $this->Form->select($model.'.country_id',$country, array("class"=>"validate[required]",'empty' => "Select Country")); ?>
					<span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model.'.country_id', array('wrap' => false) ); ?>
					</span>
				</div>
				</div>
			</div>
		<div class="span5" >
		<div class="clearfx control-group <?php echo ($this->Form->error('state_id'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.state_id', __('Select State',true).' :<span class="required"></span>', array('style' => "float:left;width:130px;") ); 
			?>
			<div class="input <?php echo ($this->Form->error('state_id'))? 'error':'';?>" style="margin-left:150px;" >
				<?php echo $this->Form->select($model.'.state_id',$state, array("class"=>"validate[required]",'empty' => "Select State")); ?>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.state_id', array('wrap' => false) ); ?>
				</span>
			</div>
		</div>
		</div>
			</div>
			
		<div class="row-fluid">
		
		<div class="span5" >
		<div class="clearfx control-group <?php echo ($this->Form->error('city_id'))? 'error':'';?>">
			<?php 
				echo $this->Form->label($model.'.city_id', __('Select City',true).' :<span class="required"></span>', array('style' => "float:left;width:130px;") ); 
			?>
			<div class="input <?php echo ($this->Form->error('city_id'))? 'error':'';?>" style="margin-left:150px;" >
				<?php echo $this->Form->select($model.'.city_id',$city, array("class"=>"validate[required]",'empty' => "Select City")); ?>
				<span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model.'.city_id', array('wrap' => false) ); ?>
				</span>
			</div>
		</div>	
		</div>	
		<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error('bank_card_detail'))? 'error':'';?>">
						<?php 
							echo $this->Form->label($model.'.bank_card_detail', __('Bank Card Detail',true).' :<span class="required">*</span>', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input <?php echo ($this->Form->error('bank_card_detail'))? 'error':'';?>" style="margin-left:150px;" >
							<?php echo $this->Form->text($model.".bank_card_detail",array('class'=>'textbox ')); ?>
							<span class="help-inline" style="color: #B94A48;">
								<?php echo $this->Form->error($model.'.bank_card_detail', array('wrap' => false) ); ?>
							</span>
						</div>
					</div>
				</div>
		</div>
			<div class="row-fluid">
				<div class="span5" >
					<div class="clearfx control-group <?php echo ($this->Form->error('image'))? 'error':'';?>">
						<?php 
							echo $this->Form->label($model.'.image', __('Upload Photo',true).' :<span class="required">*</span>', array('style' => "float:left;width:155px;") ); 
						?>
						<div class="input" style="margin-left:155px;">
							<?php echo $this->Form->file($model.".image",array('class'=>'textbox '));  ?>
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
				echo $this->Html->link( __("Cancel",true),array("action" => "company"), array("class" => "btn", "escape" => false) ); 
			?>&nbsp;&nbsp;
              </div>
            </div>
      
        </div>
        <?php echo $this->Form->end();?></td>
    </tr>
  </thead>
</table>