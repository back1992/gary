 {{HTML::style("//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css")}}
 {{HTML::script("//code.jquery.com/jquery-1.10.2.js")}}
 {{HTML::script("//code.jquery.com/ui/1.10.4/jquery-ui.js")}}
 <style>
 	.ui-menu { width: 150px; }
 </style>

 {{Menu::handler('main')->render()}}

 <script type="text/javascript">
 	// $(function() {
 	// 	$( "#menu" ).menu();
 	// });

 (function ($) {
 	$(function() {
 		// $( "#menu" ).menu();
 		$( ".navmenu" ).menu();
 	});
 }(jQuery));
</script>