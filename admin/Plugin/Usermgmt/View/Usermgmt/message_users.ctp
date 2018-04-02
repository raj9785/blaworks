<div class="col-sm-12">
    <div class="col-sm-12" id="msgbox">
        <h4><?php echo $title ?></h4>
    </div>
    <div class="col-sm-12">
        <table class="table table-striped table-bordered  table-full-width" >
            <thead>

                <tr style="height:30px;">
                    <th class="hidden-xs">S.No.</th>
                    <th class="hidden-xs">Company Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($users_list)) {
                    $page=0;
                    if ($page == 0 || $page == 1) {
                        $i = $count_new_bookings;
                    } else {
                        $i = $count_new_bookings - $limit * ($page - 1);
                    }

                    foreach ($users_list as $records) {
                        //pr($records);
                        ?>
                        <tr class="gallerytr">
                           
                            <td><?php echo $i; ?></td>
                           
                            <td align="left">
                                <?php echo $records["Company"]['name']; ?> 
                            </td>

                        </tr>
       
        <?php
        $i--;
    }
    ?>
                   

                    
    <?php
} else {
    ?>
                    <tr>
                        <td colspan="20">No record found.</td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>


</div>
