<?php
//echo $this->Html->script('https://maps.google.com/maps/api/js?key=' . MAP_API_KEY . '&sensor=false&libraries=places');
?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=drawing"></script>
<?php echo $this->Html->script('geofence', array('inline' => false)); ?>
<style>
#map {
        height: 70%;
    }
</style>
<script type="text/javascript">
    runMaps();
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
                <!-- start: PAGE TITLE -->
		
		<section id="page-title">
		    <div class="row">
			<div class="col-sm-10">
                            <h1 class="mainTitle" >MAP</h1>
			</div>
			
		    </div>
		</section>
                
                <!-- end: PAGE TITLE -->
                <!-- Global Messages -->
		<?php echo $this->Session->flash(); ?>
                <!-- Global Messages End -->
                <!-- start: FORM VALIDATION EXAMPLE 1 -->
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">   
			    <div id="map" style="height:800px"></div>
                        </div>
                    </div>
                </div>
                <!-- end: FORM VALIDATION EXAMPLE 1 -->
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>