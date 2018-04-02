<?php

echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {


    });
</script>
<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar'); ?>

    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
        <?php echo $this->element('header'); ?>
        <!-- end: TOP NAVBAR -->
        <div class="main-content" >
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle"><?php echo isset($title_for_page)?$title_for_page:'Nearby Destinations for '.$city.' City';?></h1>
                        </div>  
                        <div class="col-sm-4 text-align-right">	
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Cities List', true) . "", array('plugin' => false,'controller' => 'city',"action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>	
                           <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New Destination', true) . "", array('plugin' => "city", 'controller' => 'city', "action" => "add_nearby_destination",$city_id), array("class" => "btn btn-green add-row", "escape" => false));?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <!--<div class="row">
                        <div class="col-md-12 space20">
                            
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($destination_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs" width="5%">S.No.</th>
                                        <th class="hidden-xs">Destination</th>
                                        <th class="hidden-xs">Description</th> 
                                        <th class="hidden-xs">Image</th> 
                                        <th class="hidden-xs">Status</th>
                                        <th class="hidden-xs" >Created On</th>
                                        <th class="hidden-xs" >Created By</th>
                                        <th class="hidden-xs" >Last Modified On</th>
                                        <th class="hidden-xs" >Last Modified By</th>
                                        <th class="hidden-xs">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($destination_list)) { ?>
                                        <?php
                                        if ($page == 0 || $page == 1) {
                                            $i = $count_new_destination;
                                        } else {
                                            $i = $count_new_destination - $limit * ($page - 1);
                                        }
                                        ?>
                                        <?php foreach ($destination_list as $val) { ?>
                                    <tr>
                                        <td width="10%"><?php echo $i; ?></td>
                                        <td><?php echo $val['CityNearbyDestination']['destination_name']; ?></td>
                                        <td><?php echo $val['CityNearbyDestination']['description']; ?></td>
                                        <td><?php echo $this->Html->image(WEBSITE_URL.'uploads/nearby_destination/'.$val['CityNearbyDestination']['image'], array('border' => 0,'width'=>'50', 'alt' => $val['City']['name'], 'title' => $val['City']['name'])); ?></td>

                                            <?php if ($val['CityNearbyDestination']['status'] == 1) {
                                                $status_img = 'active.png';
                                                $chang = "Active";
                                                $title = "Inactive";
                                            } else if ($val['CityNearbyDestination']['status'] == 0) {
                                                $status_img = 'inactive.png';
                                                $chang = "Inactivate";
                                                $title = "Active";
                                            } else {
                                                $status_img = 'inactive.png';
                                                $chang = "Inactive";
                                                $title = "Active";
                                            }
                                          
                                            ?>
                                        <td><img title="Click here for <?php echo $title; ?>" style="cursor:pointer;" id="ajatt_<?php echo $val['CityNearbyDestination']['id']; ?>" class="status_change" onclick="return change_active_inactive_status(<?php echo $val['CityNearbyDestination']['id']; ?>,<?php echo $val['CityNearbyDestination']['status']; ?>, 'CityNearbyDestination', 'city_nearby_destinations')" src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20" /></td>
                                        <td><?php echo !empty($val['CreatedLog'])?date("d-m-y H:i A", strtotime($val['CreatedLog']['created'])):'N.A'; ?></td>
                                        <td><?php echo !empty($val['CreatedLog'])?$val['CreatedLog']['action_taken_by_name']:'N.A';?></td>
                                        <td><?php echo !empty($val['UpdatedLog'])?date("d-m-y H:i A", strtotime($val['UpdatedLog']['created'])):'N.A'; ?></td>
                                        <td><?php echo !empty($val['UpdatedLog'])?$val['UpdatedLog']['action_taken_by_name']:'N.A'; ?></td>
                                        <td>
                                            <div class="dropdown" style='float:left'>
                                                <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                                   data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                                   style='text-decoration:none'>
                                                            <?php echo __('Action'); ?> <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">

                                                    <li>
                                                                <?php
                                                                echo $this->Html->link('Edit', array('plugin' => 'city', 'controller' => 'city', 'action' => 'edit_nearby_destination', $val['CityNearbyDestination']['id']), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
                                                                ?>
                                                    </li>


                                                </ul>
                                            </div>

                                        </td>
                                    </tr>
                                            <?php
                                            $i--;
                                        }
                                        ?>
                                    <tr>
                                        <td colspan="20"><?php echo $this->element('pagination'); ?></td>
                                    </tr>
                                    <?php } else {
                                        ?>
                                    <tr>
                                        <td colspan="9" style="text-align:center;">No destination exists.</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>
