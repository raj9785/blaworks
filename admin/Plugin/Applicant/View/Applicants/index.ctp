<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>

<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<script type='text/javascript'>
    $(document).ready(function () {
        $(".super-raj-pop").fancybox({
            type: 'ajax',
            helpers: {
                overlay: {closeClick: false, locked: false}
            },
        });

        
    

        

      
		
		$('#InvoiceFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,            
            maxDate: '<?php echo MAX_DATE_RANGE; ?>',
            onSelect: function (selectedDate) {
                var nyd = new Date(selectedDate);
                nyd.setDate(nyd.getDate() + <?php echo MAX_TO_DATE_RANGE; ?>);
                $('#InvoiceToDate').datepicker("option", {
                    minDate: new Date(selectedDate),
                    maxDate: nyd
                });
              
                //$("#InvoiceToDate").datepicker("option", "minDate", selectedDate);
            },
        });
		$('#InvoiceToDate').datepicker({
            dateFormat: "yy-mm-dd",
            //dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
			minDate: '<?php echo MIN_TO_DATE_RANGE; ?>',
            onClose: function (selectedDate) {
                $("#InvoiceFromDate").datepicker("option", "maxDate", selectedDate);
            }

        });
		
		
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
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white" style="padding: 20px 30px 30px;">

                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 search_bar">
                                <?php
                               
                                echo $this->Form->create($model, array('type' => 'get', 'class' => 'form-inline filterform', 'inputDefaults' => array('label' => false, 'div' => false)));
                                echo $this->Form->select('Applicant.state_id', $state_list, array('class' => 'textbox form-control input-sm auto_srch', 'value' => @$state_id, 'empty' => __('State', true))) . '&nbsp;';
                                echo $this->Form->text('Applicant.registered_mobile', array('placeholder' => __('Mobile Number', true), 'value' => @$registered_mobile, 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                //echo $this->Form->text('Applicant.from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;';
                                //echo $this->Form->text('Applicant.to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary', 'escape' => false, 'name' => 'button', 'value' => 'Search'));
                                ?>&nbsp;&nbsp;<a class="btn btn-green add-row" href="<?php echo $this->Html->url(array('plugin' => 'applicant', 'controller' => 'applicants', 'action' => 'index')); ?>">Reset</a>
                               
                                <?php
                                //$val_url = json_encode($this->params->query);
                                //$search_val_url = base64_encode(base64_encode($val_url));
                                //echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => 'invoice', 'controller' => 'invoices', 'action' => 'getpdf', $search_val_url, 'page' => $page_no, '?' => array('farecategory_id' => @$farecategory_id, 'invoice_type' => @$invoice_type, 'trip_id' => @$trip_id, 'customer_name' => @$customer_name, 'customer_mobile' => @$customer_mobile, 'invoice_number' => @$invoice_number, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl', 'style' => 'margin: 0 0 0 4px;', 'escape' => false));

                                //echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => 'invoice', 'controller' => 'invoices', 'action' => 'getcsv', $search_val_url, 'page' => $page_no, '?' => array('farecategory_id' => @$farecategory_id, 'invoice_type' => @$invoice_type, 'trip_id' => @$trip_id, 'customer_name' => @$customer_name, 'customer_mobile' => @$customer_mobile, 'invoice_number' => @$invoice_number, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl', 'style' => 'margin: 0 0 0 9px;', 'escape' => false));
                                ?>
                                <?php echo $this->Form->end(); ?>

                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <?php
                    //echo $this->element('paging');
                    //echo $this->Paginator->counter(array('format' => '%count%'));
                    ?>

                    <div style="width:100% !important;overflow-y:auto">

                        <table class="table table-striped table-bordered  table-full-width">
                            <thead>
                                <tr style="height:30px;">
                                    <th class="hidden-xs">S.No.</th>
                                    <th class="hidden-xs">Mobile Number</th>
                                    <th class="hidden-xs">First Name</th>
                                    <th class="hidden-xs">Middle Name</th>
                                    <th class="hidden-xs">Last Name</th>
                                    
                                    <th class="hidden-xs">State</th>
                                    <th class="hidden-xs">Registered On</th>  
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($result)) {
                                    $count_new_bookings = $this->Paginator->counter(array('format' => '%count%'));
                                    if ($page == 0 || $page == 1) {
                                        $i = $count_new_bookings;
                                    } else {
                                        //echo $count_new_bookings;
                                        $i = $count_new_bookings - $limit * ($page - 1);
                                    }
                                    foreach ($result as $records) {
                                        //pr($records);
                                        ?>
                                        <tr class="gallerytr">
                                            <td>						
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo $records['Applicant']['registered_mobile']; ?>
                                            </td>
                                            <td>
                                                <?php echo $records['Applicant']['first_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $records['Applicant']['middle_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $records['Applicant']['last_name']; ?>
                                            </td>
                                            
                                             <td>
                                                <?php echo $records['State']['name']; ?>
                                            </td>
                                             <td>
                                                <?php echo $records['Applicant']['created_on']?date("d-m-y h:i A",strtotime($records['Applicant']['created_on'])):""; ?>
                                            </td>
                                            
                                         
      

                                           

                                          
                                        </tr>                                        
                                        <?php
                                        $i--;
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="20"><?php echo $this->element('pagination'); ?></td>
                                    </tr>
                                    <?php
                                } else {
                                    ?>
                                    <tr>
                                        <td align="center" style="text-align:center;" colspan="18" class=""><?php echo __('No Result Found'); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
</div>
