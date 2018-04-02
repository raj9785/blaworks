<div class="col-sm-12 view_logs" style="max-width: 700px">
    <div id="msgbox" style="height: 18px; margin-bottom: 7px; font-weight: bold; font-size: 14px;">Driver History for <?php echo $plate_no; ?></div>
    <div>
        <table class="table table-striped table-bordered  table-full-width">

            <tbody>

                <?php
                if (!empty($get_list)) {
                    $counts = count($get_list);
                    foreach ($get_list as $data) {
                        $log = "<b>".$data['DriverLog']['description']."</b> at ".date("d-m-Y H:i A",  strtotime($data['DriverLog']['created']))." by <b>".$data['DriverLog']['user_name']."</b>";
                        ?>

                        <tr>
                            <td><?php echo $counts; ?></td>
                            <td><?php echo $log; ?></td>
                        </tr>


                        <?php
                        $counts--;
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
</div>
