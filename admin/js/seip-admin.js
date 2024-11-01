(function( $ ) {
    'use strict';

    $(function(){

         // Let's set up some variables for the image upload and removing the image     
         var frame,
             // Color Pickers Inputs
             colorPickerInputs = $( '.seip-color-picker' );

         // WordPress specific plugins - color picker and image upload
         $( '.seip-color-picker' ).wpColorPicker();


    }); // End of DOM Ready

})( jQuery );