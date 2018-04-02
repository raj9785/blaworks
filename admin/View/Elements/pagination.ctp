<script type="text/javascript">
// <![CDATA[
    /*$(function() {
     
     $( ".first_disabled, #p_first" ).button({
     text: false,
     icons: {
     primary: "ui-icon-seek-start"
     }
     }).click(function(){
     if(typeof(this.href) !='undefined'){
     return loadContent(this.href);
     }
     });
     
     $( "#p_prev, .prev_disabled" ).button({
     text: false,
     icons: {
     primary: "ui-icon-seek-prev"
     }
     }).click(function(){
     if(typeof(this.href) !='undefined'){
     return loadContent(this.href);
     }
     });
     
     $( "#p_next, .next_disabled" ).button({
     text: false,
     icons: {
     primary: "ui-icon-seek-next"
     }
     }).click(function(){
     if(typeof(this.href) !='undefined'){
     return loadContent(this.href);
     }
     });
     
     $( "#p_last" ).button({
     text: false,
     icons: {
     primary: "ui-icon-seek-end"
     }
     }).click(function(){
     if(typeof(this.href) !='undefined'){
     return loadContent(this.href);
     }
     });
     
     $(".p_numbers").button().click(function(){
     if(typeof(this.href) !='undefined'){
     return loadContent(this.href);
     }
     });
     
     
     $("span.current").button().click(function(){
     if(typeof(this.href) !='undefined'){
     return loadContent(this.href);
     }
     });
     $("span.current").addClass("ui-state-active").click(function(){
     if(typeof(this.href) !='undefined'){
     return loadContent(this.href);
     }
     }); 
     
     
     });
     */

//]]>	
</script>
<div >
    <ul class="pagination">
        <?php
        echo $this->Paginator->first(__('First', true), array('id' => 'p_first', 'tag' => 'li'), null, array('class' => ''));
        echo $this->Paginator->prev(__("&larr; Previous", true), array('id' => 'p_prev', 'tag' => 'li', 'escape' => false), null, array('class' => 'previous p_numbers', 'escape' => false, 'tag' => 'li'));
        echo $this->Paginator->numbers(array('tag' => 'li','separator' => ''));
        echo $this->Paginator->next(__("Next &rarr;", true), array('id' => 'p_next', 'tag' => 'li', 'escape' => false), null, array('class' => 'nex', 'escape' => false, 'tag' => 'li'));
        echo $this->Paginator->last(__('Last', true), array('id' => 'p_last', 'tag' => 'li'), null, array('class' => ''));
        ?>
    </ul>
</div>