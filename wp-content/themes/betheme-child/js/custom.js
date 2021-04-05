// Play/pause button on revolution sliders
jQuery( document ).ready(function($) {
    console.log("xin chao");
    var playButton  = '.play-button';
    var pauseButton = '.pause-button';
    var current     = '.current';
    var sliderDiv   = '#rev_slider_1_1_wrapper';
   
    // $(pauseButton).hide();
    $(playButton).hide();
 
        jQuery(pauseButton).click(function() {
            jQuery(this).hide().removeClass( "current" );
            jQuery(playButton).show().addClass( "current" );
            
        });
        jQuery(playButton).click(function() {
            jQuery(this).hide().removeClass( "current" );
            jQuery(pauseButton).show().addClass( "current" );
        });

});