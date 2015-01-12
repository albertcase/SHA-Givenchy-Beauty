<script>
    var day1,day2 ;
    jQuery(function() {	
        jQuery( "#from" ).datepicker({
        	changeMonth: true,
        	numberOfMonths: 1,
        	onSelect: function( selectedDate ) {
        		jQuery( "#to" ).datepicker( "option", "minDate", selectedDate );
        		day1 = $("#from").datepicker('getDate').getTime()/1000; 
        		//console.log(day1);            
        	}
        });
        jQuery( "#to" ).datepicker({
        	changeMonth: true,
        	numberOfMonths: 1,
        	onSelect: function( selectedDate ) {
        		jQuery( "#from" ).datepicker( "option", "maxDate", selectedDate );
        		day2 = $("#to").datepicker('getDate').getTime()/1000+86399; 
        		//console.log(day2); 
        	}
        });
    
    });
    jQuery(function(){
    	jQuery("#export").click(function(){
    	   var nw=window.open("about:blank","");
           nw.location = 'user-admin/?action=export&stime='+day1+'&etime='+day2;
		});
	})
</script>
<p class="data-piker">开始时间: <input type="text" id="from"></p>
<p class="data-piker2">结束时间: <input type="text" id="to"></p>
<button id="export">导出</button>