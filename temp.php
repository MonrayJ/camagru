<?php

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
    if(!isset($pct)){ 
        return false; 
    } 
    $pct /= 100; 
    // Get image width and height 
    $w = imagesx( $src_im ); 
    $h = imagesy( $src_im ); 
    // Turn alpha blending off 
    imagealphablending( $src_im, false ); 
    // Find the most opaque pixel in the image (the one with the smallest alpha value) 
    $minalpha = 127; 
    for( $x = 0; $x < $w; $x++ ) 
    for( $y = 0; $y < $h; $y++ ){ 
        $alpha = ( imagecolorat( $src_im, $x, $y ) >> 24 ) & 0xFF; 
        if( $alpha < $minalpha ){ 
            $minalpha = $alpha; 
        } 
    } 
    //loop through image pixels and modify alpha for each 
    for( $x = 0; $x < $w; $x++ ){ 
        for( $y = 0; $y < $h; $y++ ){ 
            //get current alpha value (represents the TANSPARENCY!) 
            $colorxy = imagecolorat( $src_im, $x, $y ); 
            $alpha = ( $colorxy >> 24 ) & 0xFF; 
            //calculate new alpha 
            if( $minalpha !== 127 ){ 
                $alpha = 127 + 127 * $pct * ( $alpha - 127 ) / ( 127 - $minalpha ); 
            } else { 
                $alpha += 127 * $pct; 
            } 
            //get the color index with new alpha 
            $alphacolorxy = imagecolorallocatealpha( $src_im, ( $colorxy >> 16 ) & 0xFF, ( $colorxy >> 8 ) & 0xFF, $colorxy & 0xFF, $alpha ); 
            //set pixel with the new color + opacity 
            if( !imagesetpixel( $src_im, $x, $y, $alphacolorxy ) ){ 
                return false; 
            } 
        } 
    } 
    // The image copy 
    imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h); 
} 

// USAGE EXAMPLE: 
$img_a = imagecreatefrompng('image1.png'); 
$img_b = imagecreatefrompng('wm2.png'); 

// SAME COMMANDS: 
imagecopymerge_alpha($img_a, $img_b, 10, 10, 0, 0, imagesx($img_b), imagesy($img_b),50); 

// OUTPUT IMAGE: 
header("Content-Type: image/png"); 
imagesavealpha($img_a, true); 
imagepng($img_a, NULL); 


// workspace stuff

{
	"editor.fontWeight": "400",
	"workbench.colorCustomizations": {
		"activityBarBadge.background": "#ff0000",
		"activityBarBadge.foreground": "#000000",
		"activityBar.border": "#ff0000",
		"activityBar.background": "#0a0f16",

		"list.activeSelectionForeground": "#ff0000",
		"list.inactiveSelectionForeground": "#01243b",
		"list.highlightForeground": "#01243b",
		"list.activeSelectionBackground": "#01243b",
		"list.hoverBackground": "#3d2106",
		
		"scrollbarSlider.activeBackground": "#ff0000",
		"scrollbarSlider.background":  "#01243b",
		"scrollbar.shadow": "#ff0000",

		"editorSuggestWidget.highlightForeground": "#FF0000",
		"editorSuggestWidget.background": "#01243b",
		"editorSuggestWidget.selectedBackground": "#010914",
		"editorWidget.border": "#ff0000",
		"editorWidget.resizeBorder": "#010914",

		"editor.background": "#010914",
		"editor.lineHighlightBackground": "#01243b",

		"textLink.foreground": "#2979FF",
		"progressBar.background": "#041025",
		"pickerGroup.foreground": "#2979FF",
		"notificationLink.foreground": "#2979FF",
		"settings.modifiedItemIndicator": "#2979FF",
		"settings.headerForeground": "#2979FF",
		"panelTitle.activeBorder": "#2979FF",
		"breadcrumb.activeSelectionForeground": "#2979FF",
		"menu.selectionForeground": "#2979FF",
		"menubar.selectionForeground": "#0a0f16",
		
		"sideBar.background": "#010914",
		"sideBar.border": "#ff0000",
		"sideBarSectionHeader.foreground": "#df5210",
		
		"statusBar.border": "#ff0000",
		"statusBar.background": "#01243b",
		
		"editorGroup.dropBackground": "#df5210",

		"tab.activeBorder": "#FF0000",
		"tab.activeBackground":  "#010914",
		"tab.unfocusedActiveForeground": "#ff0000",
		"tab.inactiveBackground":  "#01243b",
		"tab.hoverBorder": "#ff0000",
		"tab.unfocusedActiveBorder": "#000000",
	},
}