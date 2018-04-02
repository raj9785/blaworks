<?php
echo $this->Html->css(array('validationEngine.jquery', 'jquery-ui-1.8.22.custom', 'jquery-ui_new'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#UsermgmtAddForm").validationEngine();
    });
</script>
<table class="table table-bordered table-striped">
    <thead>
        <tr >
            <th  style="background-color: #EEEEEE;"> <div class="row-fluid">
        <h1>
            <?php echo __('Add Employee'); ?>
            <div class="pull-right">
                <?php
                echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back To Employee', true) . "", array("action" => "index"), array("class" => "btn btn-primary", "escape" => false));
                ?>
            </div>
        </h1>
    </div>
</th>
</tr>
<tr>
    <td><?php
                echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'add'), 'enctype' => 'multipart/form-data'));
                ?>
        <div class="row-fluid">
            <div class="span12" >
            </div>
            <div class="row-fluid">
                <div class="span5" >
                    <div class="control-group <?php echo ($this->Form->error('firstname')) ? 'error' : ''; ?>">
                        <?php
                        echo $this->Form->label($model . '.firstname', __('First Name', true) . ' :<span class="required">*</span>', array('style' => "float:left;width:155px;"));
                        ?>
                        <div class="input <?php echo ($this->Form->error('firstname')) ? 'error' : ''; ?>" style="margin-left:150px;" >
                            <?php echo $this->Form->text($model . ".firstname", array('class' => 'textbox validate[required]')); ?>
                            <span class="help-inline" style="color: #B94A48;">
                                <?php echo $this->Form->error($model . '.firstname', array('wrap' => false)); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="span5" >
                    <div class="clearfx control-group <?php echo ($this->Form->error('lastname')) ? 'error' : ''; ?>">
                        <?php
                        echo $this->Form->label($model . '.lastname', __('Last Name', true) . ' :', array('style' => "float:left;width:155px;"));
                        ?>
                        <div class="input <?php echo ($this->Form->error('lastname')) ? 'error' : ''; ?>" style="margin-left:150px;" >
                            <?php echo $this->Form->text($model . ".lastname", array('class' => '')); ?>
                            <span class="help-inline" style="color: #B94A48;">
                                <?php echo $this->Form->error($model . '.lastname', array('wrap' => false)); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span5" >
                    <div class="clearfx control-group <?php echo ($this->Form->error('username')) ? 'error' : ''; ?>">
                        <?php
                        echo $this->Form->label($model . '.username', __('User Name', true) . ' :<span class="required">*</span>', array('style' => "float:left;width:155px;"));
                        ?>
                        <div class="input <?php echo ($this->Form->error('username')) ? 'error' : ''; ?>" style="margin-left:150px;" >
                            <?php echo $this->Form->text($model . ".username", array('class' => 'textbox validate[required]')); ?>
                            <span class="help-inline" style="color: #B94A48;">
                                <?php echo $this->Form->error($model . '.username', array('wrap' => false)); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="span5" >
                    <div class="clearfx control-group <?php echo ($this->Form->error('email')) ? 'error' : ''; ?>">
                        <?php
                        echo $this->Form->label($model . '.email', __('User Email', true) . ' :<span class="required">*</span>', array('style' => "float:left;width:155px;"));
                        ?>
                        <div class="input <?php echo ($this->Form->error('email')) ? 'error' : ''; ?>" style="margin-left:150px;" >
                            <?php echo $this->Form->text($model . ".email", array('class' => 'textbox validate[required,custom[email]]')); ?>
                            <span class="help-inline" style="color: #B94A48;">
                                <?php echo $this->Form->error($model . '.email', array('wrap' => false)); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span5" >
                    <div class="clearfx control-group <?php echo ($this->Form->error('password')) ? 'error' : ''; ?>">
                        <?php
                        echo $this->Form->label($model . '.password', __('Password', true) . ' :<span class="required">*</span>', array('style' => "float:left;width:155px;"));
                        ?>
                        <div class="input <?php echo ($this->Form->error('password')) ? 'error' : ''; ?>" style="margin-left:150px;" >
                            <?php echo $this->Form->password($model . ".password", array('class' => 'textbox validate[required]')); ?>
                            <span class="help-inline" style="color: #B94A48;">
                                <?php echo $this->Form->error($model . '.password', array('wrap' => false)); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="span5" >
                    <div class="clearfx control-group <?php echo ($this->Form->error('confirm_password')) ? 'error' : ''; ?>">
                        <?php
                        echo $this->Form->label($model . '.password', __('Confirm Password', true) . ' :<span class="required">*</span>', array('style' => "float:left;width:155px;"));
                        ?>
                        <div class="input <?php echo ($this->Form->error('confirm_password')) ? 'error' : ''; ?>" style="margin-left:150px;" >
                            <?php echo $this->Form->password($model . ".confirm_password", array('class' => 'textbox validate[required,equals[UsermgmtPassword]]')); ?>
                            <span class="help-inline" style="color: #B94A48;">
                                <?php echo $this->Form->error($model . '.confirm_password', array('wrap' => false)); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span5" >
                    <div class="clearfx control-group <?php echo ($this->Form->error('image')) ? 'error' : ''; ?>">
                        <?php
                        echo $this->Form->label($model . '.image', __('Upload Photo', true) . ' :<span class="required">*</span>', array('style' => "float:left;width:155px;"));
                        ?>
                        <div class="input" style="margin-left:155px;">
                            <?php echo $this->Form->file($model . ".image", array('class' => 'textbox validate[required]')); ?>
                            <span class="help-inline" style="color: #B94A48;">
                                <?php echo $this->Form->error($model . '.image', array('wrap' => false)); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="span5" >
                    <div class="clearfx control-group <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>">
                        <?php
                        echo $this->Form->label($model . '.status', __('Status', true) . ' :', array('style' => "float:left;width:155px;"));
                        ?>
                        <div class="input <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>" style="margin-left:150px;" >
                            <?php echo $this->Form->select($model . '.status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => false)); ?>
                            <span class="help-inline" style="color: #B94A48;">
                                <?php echo $this->Form->error($model . '.status', array('wrap' => false)); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <div class="input" > <?php echo $this->Form->button(__d("users", "Save", true), array("class" => "btn btn-primary")); ?> <?php
                                echo $this->Html->link(__("Cancel", true), array("action" => "index"), array("class" => "btn", "escape" => false));
                                ?>&nbsp;&nbsp;
                </div>
            </div>

        </div>
        <?php echo $this->Form->end(); ?></td>
</tr>
</thead>
</table>
