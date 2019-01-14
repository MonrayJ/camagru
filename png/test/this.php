<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>    
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
	<style>

			.draggable
		{
		    position: relative; 
		    display: -moz-inline-stack;
		    display: inline-block;
		    vertical-align: top;
		    zoom: 1;
		    *display: inline;   
		
		    cursor: hand; 
		    cursor: pointer;       
		}

		.resizable
		{
		    width: 100px;   
		    border: 1px solid #bb0000;   
		}
		.resizable img
		{
		    width: 100%;   
		}

		.ui-resizable-handle 
		{
		    background: #f5dc58;
		    border: 1px solid #FFF;
		    width: 9px;
		    height: 9px;
		
		    z-index: 2;
		}
		.ui-resizable-se
		{
		    right: -5px;
		    bottom: -5px;
		}

		.ui-rotatable-handle 
		{
		    background: #f5dc58;
		    border: 1px solid #FFF;
		    border-radius: 5px;
		    -moz-border-radius: 5px;
		    -o-border-radius: 5px;
		    -webkit-border-radius: 5px;
		    cursor: pointer;
		
		    height:        10px;
		    left:          50%;
		    margin:        0 0 0 -5px;
		    position:      absolute;
		    top:           -5px;
		    width:         10px;
		}
		.ui-rotatable-handle.ui-draggable-dragging
		{
		    visibility:  hidden;
		}
	</style>
</head>
<body>
	<div class="draggable">
	    <div class="rotatable">
	        <div class="resizable">
	            <img src="" alt="" />
	        </div>
	    </div>
	</div>

	<script>

		$('.draggable').draggable();

		$('.resizable').resizable({
		    aspectRatio: true,
			handles: 'se'
		});
	</script>

</body>
</html>