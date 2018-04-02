<div class="row">
    <div class="col-md-12 space20">
        <div class="pull-left1 driver_index1">
            <?php
            echo $this->Form->create('Dashboard', array('class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
            echo $this->Form->select('country', $country_list, array('empty' => __('Country', true), 'class' => 'form-control input-medium','style' => 'width:15% !important;')) . '&nbsp;';
            echo $this->Form->select('state', array(), array('empty' => __('State', true), 'class' => 'form-control input-medium','style' => 'width:15% !important;')) . '&nbsp;';
            echo $this->Form->select('city', array(), array('empty' => __('City', true), 'class' => 'form-control input-medium','style' => 'width:15% !important;')) . '&nbsp;';
            echo $this->Form->text('from_date', array('placeholder' => __('From Date', true), 'class' => 'form-control input-medium')) . '&nbsp;';
            echo $this->Form->text('end_date', array('placeholder' => __('To Date', true), 'class' => 'form-control input-medium')) . '&nbsp;';
            ?>
            &nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary', 'escape' => false,'id' => 'dashboard_search_button')); ?>
            &nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Reset", true), array('class' => 'btn btn-primary', 'escape' => false,'id' => 'dashboard_reset_button')); ?>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<div class="clear"></div>