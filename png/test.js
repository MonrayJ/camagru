//Make the DIV element draggagle:
	dragElement(document.getElementById("mydiv"));

	
	function dragElement(elmnt)
	{
		var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
		if (document.getElementById(elmnt.id + "header"))
		{
		/* if present, the header is where you move the DIV from:*/
			document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
		}
		else
		{
		/* otherwise, move the DIV from anywhere inside the DIV:*/
			elmnt.onmousedown = dragMouseDown;
		}

		function dragMouseDown(e) {
			e = e || window.event;
			e.preventDefault();
		// get the mouse cursor position at startup:
			pos3 = e.clientX;
			pos4 = e.clientY;
			document.onmouseup = closeDragElement;
		// call a function whenever the cursor moves:
			document.onmousemove = elementDrag;
		}

		function elementDrag(e)
		{
			e = e || window.event;
			e.preventDefault();
		// calculate the new cursor position:
			pos1 = pos3 - e.clientX;
			pos2 = pos4 - e.clientY;
			pos3 = e.clientX;
			pos4 = e.clientY;
		// set the element's new position:
			elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
			elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
		}

		function closeDragElement()
		{
		/* stop moving when mouse button is released:*/
			document.onmouseup = null;
			document.onmousemove = null;
		}
	}

	var img_t, img_l, png_t, png_l;
	var img_h, img_w, png_h, png_w;

	getOffsetSum(document.getElementById("photo"), img_t, img_l, img_h, img_w);
	getOffsetSum(document.getElementById("photo"), png_t, png_l, img_h, img_w);
	
	function getOffsetSum(elem, img_t, img_l, height, width)
	{
		img_t = 0, img_l = 0, height = 0, width = 0;
		while(elem)
		{
			img_t = img_t + parseInt(elem.offsetTop);
			img_l = img_l + parseInt(elem.offsetLeft);
			width = elem.clientWidth;
			height = elem.clientHeight;
			elem = elem.offsetParent;
		}
		alert('top_space: ' + img_t + ', left_space: ' + img_l + ', width: ' + width + ', height: ' + height);
	}
	