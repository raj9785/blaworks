<div class="col-sm-12 view_logs" style="max-width: 700px">
    <div id="msgbox" style="height: 18px; margin-bottom: 7px; font-weight: bold; font-size: 14px;">Special Instructions</div>
    <div>
        <table class="table table-striped table-bordered  table-full-width">

            <tbody>
               
                <?php
                if (!empty($arr_Data)) {
                    $counts=count($arr_Data);
                    foreach ($arr_Data as $index => $log) {
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
