// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};

CKEDITOR.replace('editor1');
$(document).ready(function(){

   $("#myForm").validate({
   ignore: [],
  
     rules:{
     		emailsubject:{
        	    required:true
            },
            editor1: {
               ckeditor_required:true
             }
                       
             },
             messages:{
             		emailsubject:{
                	required:"Enter email subject"
             }
        
     }
   });
   
   
jQuery.validator.addMethod("ckeditor_required", function(value, element) {
      var editorId = $(element).attr('id');
      var messageLength = CKEDITOR.instances[editorId].getData().replace(/<[^>]*>/gi, '').length;
      //alert(messageLength.length);
	  return messageLength;
    }, "Enter email content");
});