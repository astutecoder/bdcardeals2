/*
Name: 			Tables / Advanced - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.4.1
*/

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		$('#datatable-default').dataTable({
            aaSorting: [],
            aoColumns: [
                null,
                null,
                null,
                null,
                null,
                { "bSortable": false },
                { "bSortable": false },
            ]
		});

	};

	$(function() {
		datatableInit();
	});

}).apply( this, [ jQuery ]);