
<table class="table table-bordered table-striped">
	<thead>
		<tr>
      		<th style="background-color: #EEEEEE;">
				<div class="row-fluid"><h1><?php echo __("Customer Detail",true); ?><div class="pull-right">
                 <?php 
				 echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>".__('Back to Customer',true),array('action'=> 'customer'),array('class'=>'btn btn-primary','escape'=>false));	
				?> 
				</div></h1></div>
			</th>
		</tr>
		<tr>
			<td>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('First Name',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['firstname'];?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Last Name',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['lastname'];?>
						</div>
					</div>
				</div>
			    <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Email',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['email'];?>
						</div>
					</div>
				</div>
			    <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Gender',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php if(!empty($result[$model]['gender']))echo $result[$model]['gender']=1?"Male":"Female";?>
						</div>
					</div>
				</div>
			    <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Mobile Number',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['mobile'];?>
						</div>
					</div>
				</div>
			    <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Status',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php if(!empty($result[$model]['status']))echo $result[$model]['status']==1?"Active":"Deactove";?>
						</div>
					</div>
				</div>
			    <div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Address',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['address'];?>
						</div>
					</div>
				</div>
			     <?php /*?><div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.name', __('Bank Card Detail',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['bank_card_detail'];?>
						</div>
					</div>
				</div><?php */?>
			     
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.image_name', __(' Image',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php
							$file_path    = ALBUM_UPLOAD_IMAGE_PATH ;
							$file_name    = $result[$model]['image'];
							$image_url   = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',250,250,base64_encode($file_path),$file_name),true);
							$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',400,400,base64_encode($file_path),$file_name),true);
							if(is_file($file_path . $file_name)) {
								$images = $this->Html->image($image_url);
							 ?>
							
								<?php echo $images; ?>
							</a>
							<?php } else {
								echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
							}
							?>
							<?php // echo $result[$model]['image_name'];?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.created', __(' Created',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['created'];?>
						</div>
					</div>
				</div>
				<div class="row" style="padding:7px 33px;">
					<div class="clearfx control-group">
						<?php 
							echo $this->Form->label($model.'.modified', __(' Modified',true).' :', array('style' => "float:left;width:180px;") ); 
						?>
						<div class="input" style="margin-left:150px;" >
							<?php echo $result[$model]['modified'];?>
						</div>
					</div>
				</div>
			</td>
		</tr>
		
	</thead> 
</table>