
<div class="row">
    <div class="col-md-12 space20">                           
        <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($inclusions_list)) ? 'id="sample_1"' : '' ?>">
            <thead>
                <tr>
                    <th class="hidden-xs" >Driver Id</th>
                    <th class="hidden-xs" >Driver Name</th>
                    <th>Action</th> 
            </thead>
            <tbody>
				    <?php
                                     $i = count($result);
				    if (!empty($result)) {
					?>
					<?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['User']['uniqid']; ?></td>
                    <td><?php echo $row['User']['firstname'].' '.$row['User']['lastname']; ?></td>
                    <td>
                        <?php
                        echo $this->Html->link('Assign Driver', array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'assign_driver',$taxi_id,$row['User']['id']), array('class' => 'btn btn-primary', 'tooltip-placement' => 'top', 'tooltip' => 'Assign Driver', 'escape' => false,'style'=>'text-decoration:none'));
                        ?>							

                    </td>

                </tr>
	<?php $i--;
    }
    ?>                                
				    <?php } else {
					?>
                <tr>
                    <td colspan="15" style="text-align:center;">No Record Found</td>
                </tr>
<?php } ?>
            </tbody>
        </table>

    </div>
</div>

<div class="col-sm-12">
    <?php if ($pages != 1) { ?>         
    <div class="paging booking-pagination">
        <nav>
            <ul class="pagination">
                    <?php if ($page != 1) { ?>
                <li><a href="javascript:void(0);"  id="pageno_1">First</a></li>
                    <?php } ?>
                    <?php
                   // echo $start;
                    for ($pi = $start; $pi <= $pages && $pi < ($start + 7); $pi++) {
                        $chkr_id = "pageno_";
                        ?> 
                <li><a href="javascript:void(0);"  <?php
                            if ($pi == $page) {
                                echo "class='active'";
                            }
                            ?> id="<?php echo $chkr_id . $pi; ?>"><?php echo $pi; ?>
                    </a>
                </li>
                    <?php } ?>
                    <?php if ($page != $pages) { ?>
                <li><a href="javascript:void(0);" id="pageno_<?php echo $page + 1; ?>"><span aria-hidden="true">&gt;</span><span class="sr-only">Next</span></a></li>
                <li><a href="javascript:void(0);"  id="pageno_<?php echo $pages; ?>">Last</a></li>	
                    <?php } ?>


            </ul>
        </nav>

    </div>
    <?php } ?>         
    <a href="javascript:void(0);"  id="pageno_1"></a>     
</div>