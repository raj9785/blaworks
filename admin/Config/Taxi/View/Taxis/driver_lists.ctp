<?php

echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<script>
    $(document).ready(function () {
        //$('.load_more').hide();
        //page = 1;
        get_driver_list(1);
        $(document).on('click', 'a[id^="pageno_"]', function () {
            var page_new = $(this).attr('id').replace("pageno_", "");
            get_driver_list(page_new);

        });
        $("#driver_id").keyup(function () {
            var page_new = 1;
            get_driver_list(page_new);
        });
        $("#driver_name").keyup(function () {
            var page_new = 1;
            get_driver_list(page_new);
        });

    });


    function get_driver_list(page) {
        $.ajax({
            type: 'POST',
            url: "<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'drivers')); ?>",
            data: {
                search_input: $("#driver_id").val(), driver_name: $("#driver_name").val(), taxi_id: $("#taxi_id").val(),vendor_id:$("#vendor_id").val(),
                page: page
            },
            beforeSend: function () {
                //$(".modal_loader").show();  
            },
            success: function (data) {
                $("#driver_list").html(data);
                //$(".modal_loader").hide(); 
            }
        });
    }
</script>
<div class="view_log" style="width: 600px">
    <div class="container-fluid container-fullw bg-white"> 
        <div class="row">
            <div class="col-md-8 space20">
                <?php echo $this->Form->create($model, array('url' => array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'driver_lists')));?>
                <div class="pull-left1 driver_index1">
                    <div class="col-md-4">
                        <?php
                        echo $this->Form->text('driver_name', array('value' => isset($driver_name) && $driver_name ? $driver_name : '', 'placeholder' => __('Driver Name', true),'id'=>'driver_name', 'class' => 'form-control')) . '&nbsp;&nbsp;';
                       ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        echo $this->Form->text('driver_id', array('value' => isset($driver_id) && $driver_id ? $driver_id : '', 'placeholder' => __('Driver Id', true),'id'=>'driver_id', 'class' => 'form-control')) . '&nbsp;&nbsp;';
                        ?>
                    </div>
                    <input type="hidden" name="taxi_id" id="taxi_id" value="<?php echo $taxi_id; ?>">
                    <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo $vendor_id; ?>">
                    <?php echo $this->Form->end();
                                ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    <?php echo $this->Session->flash(); ?>
        <div id="driver_list"></div>
    </div>
</div>


