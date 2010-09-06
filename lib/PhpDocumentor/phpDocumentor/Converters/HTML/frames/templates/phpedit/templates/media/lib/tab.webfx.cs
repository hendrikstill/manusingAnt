/*

bright: rgb(234,242,255);
normal: rgb(120,172,255);
dark:	rgb(0,66,174);

*/




.dynamic-tab-pane-control.tab-pane {
	position:	relative;
	width:		100%;
}

.dynamic-tab-pane-control .tab-row .tab {
	font-family:	Verdana, Helvetica, Arial;
	font-size:		12px;
	cursor:			Default;
	display:		inline;
	margin:			1px -5px 1px 5px;
	float:			left;
	padding:		3px 6px 3px 6px;
	background:		rgb(234,242,255);
	border:			1px solid;
	border-color:	rgb(120,172,255);
	border-left:	0;
	border-bottom:	0;
	border-top:		0;
	
	cursor:			hand;
	cursor:			pointer;
	
	z-index:		1;
	position:		relative;
	top:			0;
}

.dynamic-tab-pane-control .tab-row .tab.selected {
	border:			1px solid rgb(120,172,255);
	border-bottom:	0;
	z-index:		3;
	padding:		2px 6px 5px 6px;
	margin:			1px -6px -2px 0px;
	top:			-2px;
	background:		white;
}

.dynamic-tab-pane-control .tab-row .tab a {
	font-family:		Verdana, Helvetica, Arial;
	font-size:			13px;
	color:				rgb(0,66,174);
	text-decoration:	none;
	cursor:			hand;
	cursor:			pointer;	
}

.dynamic-tab-pane-control .tab-row .hover a {
	color:	rgb(0,66,174);
}

.dynamic-tab-pane-control .tab-row .tab.selected a {
	font-weight:	bold;
}

.dynamic-tab-pane-control .tab-page {
	clear:			both;
	border:			1px solid rgb(120,172,255);
	background:		White;
	z-index:		2;
	position:		relative;
	top:			-2px;
	color:			Black;
	font-family:	Verdana, Helvetica, Arial;
	font-size:		13px;
	padding:		10px;
}

.dynamic-tab-pane-control .tab-row {
	z-index:		1;
	white-space:	nowrap;
	background:		rgb(234,242,255);
	height:			1.85em;
	width:			100%;
}
