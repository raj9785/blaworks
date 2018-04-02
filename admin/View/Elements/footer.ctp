<footer>
    <div class="footer-inner">
        <div class="pull-left">
            &copy; <?php echo COPYWRITE; ?> 
        </div>
        <div class="pull-right">
            <span class="go-top"><i class="ti-angle-up"></i></span>
        </div>
    </div>
</footer>

<script type="text/javascript">
    jQuery(document).ready(function() {
	$("#text_img_sl").on("click",function(){
	    if($("#site_logo").hasClass('show_me')==true){
		$("#site_logo").removeClass('show_me');
	        $("#site_logo").hide();
	       
	    }else{
		$("#site_logo").addClass('show_me');
		$("#site_logo").show();
	       
	    }
	});
	
    });

    
    </script>