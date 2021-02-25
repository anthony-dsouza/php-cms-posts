$(document).ready(function(){
    
    ///editor ckeditor
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } ); 
    
    
    /// rest of the code
    
    
});


