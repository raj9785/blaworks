<div class="col-sm-12" style="width:600px">
    <div class="col-sm-12" id="msgbox" style="height: 18px;"></div>
    
        <?php echo $this->Form->create("SentMessage", array('url' => array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'push_message'), 'enctype' => 'multipart/form-data')); ?>
        <div class="col-sm-12">
            <textarea id="message_text" rows="5" maxlength="160"  placeholder="Message" class="form-control" name="message_text"></textarea>
            <div id="textarea_feedback" style="margin-bottom: 4px;"></div>
        </div>

        <div class="col-md-12 city_check_box" style="width:500px">
            <div class="form-group">
                <label class="control-label">Select City:</span>
                    <?php
                    echo '&nbsp;&nbsp;' . $this->Html->link('Check All', 'javascript:void(0)', array('escape' => false, 'id' => 'check_all'));
                    echo '&nbsp;&nbsp;' . $this->Html->link('Uncheck All', 'javascript:void(0)', array('escape' => false, 'id' => 'uncheck_all'));
                    ?>
                </label>

                <?php echo $this->Form->input('city_id', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $city_list, 'class' => '', 'id' => 'city_id', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 3)); ?>
                <span id="phone_no-error" class="help-block"></span>
            </div>
        </div>


        <div class="col-sm-12"> 
            <button type="button" class="btn btn-primary send_msg" id="send_msg">Send Message</button>
        </div>
    </form>

</div>
<script language="javascript">
    $(document).ready(function () {
        $("#check_all").on("click", function () {
            $("input[id^=city_id]").each(function () {
                $("#" + $(this).attr('id')).prop('checked', 'checked');
            });
        });
        $("#uncheck_all").on("click", function () {
            $("input[id^=city_id]").each(function () {
                $("#" + $(this).attr('id')).removeAttr('checked');
            });
        });
        var text_max = 160;
        $('#textarea_feedback').html(text_max + ' characters remaining');
        $('#message_text').keyup(function () {
            var text_length = $('#message_text').val().length;
            var text_remaining = text_max - text_length;
            $('#textarea_feedback').html(text_remaining + ' characters remaining');
        });
        $(".send_msg").on("click", function (event) {
            if ($("#message_text").val() != '') {
               // event.preventDefault();
                $("#SentMessageSendMessageVendorsForm").submit();
//                $.ajax({
//                    type: 'POST',
//                    url: '<?php //echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'push_message')) ?>',
//                    data: $("#SentMessageForm").serialize(),
//                    async: false,
//                    cache: false,
//                    //timeout: 3000,
//                    //dataType: 'json',
//                    beforeSend: function () {
//                        $("#send_msg").removeClass('send_msg');
//                        $("#message_text").attr('disabled', 'disabled');
//                        $("#msgbox").html('<div class="progress"><div style="width:100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" class="progress-bar progress-bar-striped active"></div></div>');
//                    },
//                    success: function (data) {
//                        if (data == 1) {
////                            $("#message_text").removeAttr('disabled');
////                            $("#msgbox").html("");
//                            window.location.reload();
//                        } else if (data == 2) {
//                            alert("Please select atleast one city");
//                            $("#message_text").removeAttr('disabled');
//                            $("#msgbox").html("");
//                        } else {
//                            alert("Error!");
//                            $("#message_text").removeAttr('disabled');
//                            $("#msgbox").html("");
//                        }
//                        $("#send_msg").addClass('send_msg');
//                    }
//                });
            } else {
                alert("Message field is required");
            }
        });
    });
</script>