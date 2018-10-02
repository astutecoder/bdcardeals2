/*
Name: 			Tables / Advanced - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.4.1
*/

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		$('#datatable-all-albums').dataTable({
			'autoWidth': false,
            aaSorting: [],
            aoColumns: [
                { "bSortable": false },
                null,
                { "bSortable": false }
            ],
			"columnDefs": [
                { "width": "30%", className: "text-center", "targets": 0 },
                { "width": "60%", "targets": 1 },
            ]
		});

	};

	$(function() {
		datatableInit();
	});

}).apply( this, [ jQuery ]);