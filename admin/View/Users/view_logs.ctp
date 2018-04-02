<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar');?>

    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
	<?php echo $this->element('header'); ?>
        <!-- end: TOP NAVBAR -->
        <div class="main-content" >
            <div class="wrap-content container" id="container">

                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 class="mainTitle">Customers Logs Details</h1>
                        </div>

                    </div>
                </section>

                <div class="container-fluid container-fullw bg-white">
		
              
                    <div class="row">
							<div class="col-md-12 space20">
							   
							</div>
					</div>
		
		    <div class="clear"></div>

                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs" width="5%">S.No.</th>                                 
                                       
										 <th class="hidden-xs">Action</th> 
                                        <th class="hidden-xs">Created</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									if (!empty($result))   {
									$i = 1;
									?>

					<?php foreach ($result as $user) { ?>  
					    <tr>
						<td> <?php echo $i; ?></td>
						
						<td> <?php echo $user['CustomerLog']['text']; ?></td>
						<td> <?php echo $user['CustomerLog']['created']; ?></td>

						
					    </tr>
					    <?php
					          $i++;
					}
					?>
    				    <tr>
    					<td  colspan="10"><?php echo $this->element('pagination'); ?></td>
    				    </tr> 
					<?php
				    } else {
					?>
    				    <tr>
    					<td colspan="9">No Record Found.</td>
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
