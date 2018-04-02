<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'));
?>
<script type="text/javascript">
    $(function() {
        var Message = 'Confirmation';
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
                        url: "<?php echo $this->Html->url(array('plugin' => 'category', 'controller' => 'categories', 'action' => 'admin_delete')); ?>",
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

    })
    jQuery(document).ready(function() {
        $('.btn').tooltip();
        $("#single_1").fancybox({
            helpers: {
                title: {
                    type: 'float'
                }
            }
        });
    });

    function delete_category(msg, obj) {
        user_id = $(obj).attr('id').replace("delete_", "");
        $("#delete_user_div").empty().html(msg);
        $("#delete_user_div").dialog('open');
        return false;

    }
</script>
<div id='delete_user_div'></div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th  style="background-color: #EEEEEE;">
    <div class="row-fluid"><h1><?php echo __($pageHeading, true); ?><div class="pull-right">
                <?php
                echo $this->Html->link('<i class="icon-plus icon-white"></i> ' . __('Add', true), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false));
                ?> 
                <?php
                echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back To Categories', true) . "", array("action" => "index"), array("class" => "btn btn-primary", "escape" => false));
                ?>
            </div></h1></div>
</th>
</tr>
<tr>
    <td>
        <div class="row" style="padding:7px 33px;">
            <div class="clearfx control-group">
                <?php
                echo $this->Form->label($model . '.name', __('Category Name', true) . ' :', array('style' => "float:left;width:180px;"));
                ?>
                <div class="input" style="margin-left:150px;" >
                    <?php echo $category_result[$model]['name']; ?>
                </div>
            </div>
        </div>
        <div class="row" style="padding:7px 33px;">
            <div class="clearfx control-group">
                <?php
                echo $this->Form->label($model . '.page_url', __('Page URL', true) . ' :', array('style' => "float:left;width:180px;"));
                ?>
                <div class="input" style="margin-left:150px;" >
                    <?php echo $category_result['Page']['name']; ?>
                </div>
            </div>
        </div>

        <div class="row" style="padding:7px 33px;">
            <div class="clearfx control-group">
                <?php
                echo $this->Form->label($model . '.created', __('Category Created', true) . ' :', array('style' => "float:left;width:180px;"));
                ?>
                <div class="input" style="margin-left:150px;" >
                    <?php echo date("m/d/Y", $category_result[$model]['created']); ?>
                </div>
            </div>
        </div>
        <div class="row" style="padding:7px 33px;">
            <div class="clearfx control-group">
                <?php
                echo $this->Form->label($model . '.modified', __('Category Modified', true) . ' :', array('style' => "float:left;width:180px;"));
                ?>
                <div class="input" style="margin-left:150px;" >
                    <?php echo date("m/d/Y", $category_result[$model]['modified']); ?>
                </div>
            </div>
        </div>
    </td>
</tr>

</thead> 
</table>