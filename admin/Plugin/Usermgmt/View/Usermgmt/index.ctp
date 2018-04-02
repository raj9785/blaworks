<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'));
?>
<SCRIPT language="javascript">
    $(function() {

        var Message = 'Confirmation';
        $("#show_message_div").dialog({
            title: Message,
            resizable: false,
            modal: true,
            autoOpen: false,
            width: 500,
            height: 170,
            buttons: {
                "Yes Continue": function() {
                    $.ajax({
                        url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'change_status')); ?>",
                        data: {'id': user_id},
                        type: 'post',
                        success: function(r) {
                            if (r == 'error') {
                                $(this).dialog("close");
                                alert('Something went wrong. Please try again!');
                            }
                            else {
                                $(this).dialog("close");
                                window.location.reload(true);
                            }
                        }
                    });

                },
                "No": function() {
                    $(this).dialog("close");
                }
            }
        });

        $("#delete_user_div").dialog({
            title: Message,
            resizable: false,
            modal: true,
            autoOpen: false,
            width: 500,
            height: 170,
            buttons: {
                "Yes Continue": function() {
                    $.ajax({
                        url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'delete')); ?>",
                        data: {'id': user_id},
                        type: 'post',
                        success: function(r) {
                            if (r == 'error') {
                                $(this).dialog("close");
                                alert('<?php echo __("Something went wrong. Please try again!"); ?>');
                            }
                            else {
                                $(this).dialog("close");
                                window.location.reload(true);
                            }
                        }
                    });

                },
                "No": function() {
                    $(this).dialog("close");
                }
            }
        });

    });


    function show_message(msg, obj) {
        user_id = $(obj).attr('id').replace("inactive_", "");
        $("#show_message_div").empty().html(msg);
        $("#show_message_div").dialog('open');
        return false;

    }

    function delete_user(msg, obj) {
        user_id = $(obj).attr('id').replace("delete_", "");
        $("#delete_user_div").empty().html(msg);
        $("#delete_user_div").dialog('open');
        return false;

    }
    $(document).ready(function() {
        $('.btn').tooltip();
        $("#single_1").fancybox({
            helpers: {
                title: {
                    type: 'float'
                }
            }
        });
    })
</SCRIPT>
<div id='show_message_div'></div>
<div id='delete_user_div'></div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th  style="background-color: #EEEEEE;">
    <div class="row-fluid">
        <h1><?php echo __($pageHeading, true); ?><div class="pull-right">
                <?php
                echo $this->Html->link('<i class="icon-plus icon-white"></i> ' . __('Add', true), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false));
                ?> 

            </div></h1>
    </div>
</th>
</tr>
<tr>
    <td> 
        <div class=" pull-left"><?php echo $this->element('paging_info'); ?></div>
        <div class=" pull-right">
            <?php
            echo $this->Form->create($model, array('class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
            echo $this->Form->select('status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => __('Search By Status', true), 'class' => 'input-medium')) . '&nbsp;';
            echo $this->Form->select('user_role_id', array(2 => 'company', 5 => 'individual'), array('empty' => __('Search By User', true), 'class' => 'input-medium')) . '&nbsp;';
            echo $this->Form->text('firstname', array('placeholder' => __('Search By Firstname', true), 'class' => 'input-medium')) . '&nbsp;';
            echo $this->Form->text('mobile', array('placeholder' => __('Search By Username', true), 'class' => 'input-medium'));
            ?>&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Form->end(); ?></div>

        <?php echo $this->Form->create($model, array('class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false))); ?>
        <?php echo $this->Form->submit("" . __("Delete All", true), array('class' => 'btn btn-primary', 'escape' => false, 'disabled' => true)); ?>
        <?php echo $this->Session->Flash(); ?>


        <table width="100%"  class="table table-bordered table-striped new" align="center" border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr style="height:30px;">
                    <td><?php echo $this->form->checkbox('id1', array('div' => false, 'label' => false, 'id' => 'selectall')); ?></td>
                    <td  align="left" class="" style="width:90px;"><?php echo $this->Paginator->sort('image', __('User Photo', true), array('char' => true)); ?></td>
                    <td  align="left" class="" style="width:90px;"><?php echo $this->Paginator->sort('firstname', __('First Name', true), array('char' => true)); ?></td>
                    <td  align="left" class="" style="width:90px;"><?php echo $this->Paginator->sort('lastname', __('Last Name', true), array('char' => true)); ?></td>
                    <td  align="left" class="" style="width:90px;"><?php echo $this->Paginator->sort('username', __('User Name', true), array('char' => true)); ?></td>
                    <td  align="left" class="" style="width:90px;"><?php echo $this->Paginator->sort('address', __('Address', true), array('char' => true)); ?></td>
                    <td  align="left" class="" style="width:100px;"><?php echo $this->Paginator->sort('email', __('Email', true), array('char' => true)); ?></td>
                    <td  align="left" class=""><?php echo $this->Paginator->sort('created', __('Created', true), array('char' => true)); ?></td>
                    <td  align="left" class=""><?php echo $this->Paginator->sort('user_role_id', __('User Type', true), array('char' => true)); ?></td>

                    <td  align="left" class=""><?php echo $this->Paginator->sort('status', __('Status', true), array('char' => true)); ?></td>

                    <td align="center" class="" ><?php echo __('Action'); ?></td>
                </tr>
            </thead>
            <tbody >
                <?php
                if (!empty($result)) {

                    $i = 1;
                    // $albums_categories = $this->requestAction(array('plugin'=>'category','controller'=>'categories','action'=>'get_categories','id','categories'));

                    foreach ($result as $records) {
                        ?>
                        <tr style="height:30px;" class="gallerytr">
                            <td>
                                <?php echo $this->form->checkbox('id', array('hiddenField' => false, 'class' => 'case', 'name' => 'data[id][]', 'div' => false, 'label' => false, 'value' => $records[$model]['id'])); ?>
                            </td>
                            <td  align="left" >
                                <?php
                                $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                                $file_name = $records[$model]['image'];
                                $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 100, 100, base64_encode($file_path), $file_name), true);
                                $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);
                                if (is_file($file_path . $file_name)) {

                                    $images = $this->Html->image($image_url, array('alt' => $records[$model]['firstname'], 'title' => $records[$model]['firstname']));
                                    ?>
                                    <a id="single_1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($records[$model]['firstname']); ?>'>
                                        <?php echo $images; ?>
                                    </a>
                                    <?php
                                } else {
                                    echo $this->Html->image('no_image.jpg', array('width' => '100px', 'height' => '100px'));
                                }
                                ?>
                            </td>

                            <td  align="left" >
                                <?php
                                if ($records[$model]['user_role_id'] == 2) {
                                    echo $this->Html->link($records[$model]['firstname'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_company', $records[$model]['id']), array('class' => '', 'escape' => false));
                                } else if ($records[$model]['user_role_id'] == 4) {
                                    echo $this->Html->link($records[$model]['firstname'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_driver', $records[$model]['id']), array('class' => '', 'escape' => false));
                                } else if ($records[$model]['user_role_id'] == 5) {
                                    echo $this->Html->link($records[$model]['firstname'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_individual', $records[$model]['id']), array('class' => '', 'escape' => false));
                                }
                                ?>
                            </td>
                            <td  align="left" >
                                <?php echo $records[$model]['lastname']; ?>
                            </td>
                            <td  align="left" >
                                <?php
                                if ($records[$model]['user_role_id'] == 2) {
                                    echo $this->Html->link($records[$model]['mobile'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_company', $records[$model]['id']), array('class' => '', 'escape' => false));
                                } else if ($records[$model]['user_role_id'] == 4) {
                                    echo $this->Html->link($records[$model]['mobile'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_driver', $records[$model]['id']), array('class' => '', 'escape' => false));
                                } else if ($records[$model]['user_role_id'] == 5) {
                                    echo $this->Html->link($records[$model]['mobile'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_individual', $records[$model]['id']), array('class' => '', 'escape' => false));
                                }
                                ?>
                            </td>
                            <td  align="left" >
                                <?php echo $records[$model]['address']; ?>
                            </td>
                            <td  align="left" ><a href='mailto:<?php echo $records[$model]['email']; ?>'>
                                    <?php echo $records[$model]['email']; ?> </a>
                            </td>
                            <td  align="left">

                                <?php echo date(DATE_FORMAT,strtotime($records[$model]['created'])); ?>
                            </td>
                            <td  align="left" >
                                <?php
                                if ($records[$model]['user_role_id'] == 2) {
                                    echo "Company";
                                } else if ($records[$model]['user_role_id'] == 4) {
                                    echo "Driver";
                                } else if ($records[$model]['user_role_id'] == 5) {
                                    echo "Individual";
                                }
                                ?>
                            </td>
                            <td  align="left">

                                <?php if ($records[$model]['status'] == 1) { ?>
                                    <i class="icon-ok-sign icon-black"></i>

                                <?php } else { ?>
                                    <i class="icon-remove-sign icon-black"></i>


                                <?php } ?>
                            </td>
                            <td  align="center">

                                <div class="dropdown" style='float:left'>
                                    <a class="btn btn-info dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="javascript:void(0)" style='text-decoration:none'>
                                        <?php echo __('Action'); ?> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <li><?php
                                            if ($records[$model]['user_role_id'] == 2) {
                                                echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('Edit', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'edit_company', $records[$model]['id']), array('class' => '', 'escape' => false));
                                            } else if ($records[$model]['user_role_id'] == 4) {
                                                echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('Edit', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'edit_driver', $records[$model]['id']), array('class' => '', 'escape' => false));
                                            } else if ($records[$model]['user_role_id'] == 5) {
                                                echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('Edit', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'edit_individual', $records[$model]['id']), array('class' => '', 'escape' => false));
                                            }
                                            ?></li>
                                        <li><?php
                                            echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('Change Password', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'change_password', $records[$model]['id']), array('class' => '', 'escape' => false));
                                            ?></li>
                                        <li><?php if ($records[$model]['status'] == 1) { ?>
                                                <a href='javascript::void(0)' onclick='return show_message("Are you sure you want to inactivate this employee?", this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to inactivate."><i class="icon-ok-sign icon-black"></i><?php echo __("Inactivate"); ?></a>

                                            <?php } else { ?>
                                                <a href='javascript::void(0)' onclick='return show_message("Are you sure you want to activate this employee?", this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to activate."><i class="icon-ok-sign icon-black"></i><?php echo __("Activate"); ?></a>


                                            <?php } ?>
                                        </li>
                                        <li>
                                            <a href='javascript::void(0)' onclick='return delete_user("Are you sure you want to delete this employee?", this);' id='delete_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to delete."><i class="icon-trash icon-black"></i><?php echo __("Delete"); ?></a>
                                        </li>

                                    </ul>
                                </div>

                            </td>
                        </tr>
                        <?php //if($i=='10'){echo "a";exit;} ?>
                        <?php
                        $i++;
                    }
                    ?><tr><td align="right" colspan="9" >&nbsp;</td></tr>
                </tbody>
            </table>
            <!--paging information-->
            <?php
            echo $this->element('pagination');
        } else {
            ?>
    <tr>
        <td align="center" style="text-align:center;" colspan="9" class=""><?php echo __('No Result Found'); ?></td>
    </tr>
<?php } ?>  
<?php echo $this->Form->end(); ?>        
</td>
</tr>
</thead> 
</table>
