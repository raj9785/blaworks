<?php
if (!empty($cities)) {
    ?>
    <div class="form-group">
        <label class="control-label">City <span class="symbol required"></span></label>
	<?php echo $this->Form->input('Coupon.city_id', array('type' => 'select','id'=>'city_id' ,'options' => $cities, 'multiple' => 'checkbox', 'class' => '', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 3)); ?>
        <span id="phone_no-error" class="help-block"></span>
    </div>
<?php } else { ?>
    <div class="form-group">
        <label class="control-label">City <span class="symbol required"></span></label>
	<?php echo $this->Form->input('Coupon.city_id', array('type' => 'select','id'=>'city_id', 'options' => array(), 'class' => 'form-control', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 3, 'empty' => 'Select')); ?>
        <span id="phone_no-error" class="help-block"></span>
    </div>


<?php } ?>
