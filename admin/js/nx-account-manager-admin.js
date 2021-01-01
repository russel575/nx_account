(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$("#menu_toggle").on('click', function(e) {
		e.preventDefault();
		$("#nx_wrapper").toggleClass("toggled");
	});

	$(function() {
		$('#nx_entry_list_table').DataTable({
			order:[],
		});
	} );	
	
	$(function() {
		$('#nx_single_page_table').DataTable({
			lengthChange: false,
			dom: 'Bfrtip',
        	buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        	]
		});
	} );

	$( function() {
		$( ".nx-datepicker" ).datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
		});
	  } );

	$( function() {
		$( "#nx_accordion" ).accordion({
			collapsible: true
		});
	} );

	$(function () {
		$("#btnPrint").click(function () {
			var contents = $("#dvContents").html();
			var frame1 = $('<iframe />');
			frame1[0].name = "frame1";
			frame1.css({ "position": "absolute", "top": "-1000000px" });
			$("body").append(frame1);
			var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
			frameDoc.document.open();
			//Create a new HTML document.
			frameDoc.document.write('<html><head><title>DIV Contents</title>');
			frameDoc.document.write('</head><body>');
			//Append the external CSS file.
			frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
			//Append the DIV contents.
			frameDoc.document.write(contents);
			frameDoc.document.write('</body></html>');
			frameDoc.document.close();
			setTimeout(function () {
				window.frames["frame1"].focus();
				window.frames["frame1"].print();
				frame1.remove();
			}, 500);
		});
	});

	$('.loan').on('click', function(){
		$('.dollar, .dollar-input, .loan-member').toggle();
		$('.dollar-input').val(' ');
		$('#Taka').not(':checked').prop("checked", true);
	})



	

})( jQuery );


