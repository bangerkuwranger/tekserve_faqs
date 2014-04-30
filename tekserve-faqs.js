jQuery( document ).ready(function( $ ) {  
  console.log('ready to look for delete links');
    // Check to see if the 'Delete File' link exists on the page...  
    if($('#tekserve-faq-edition-pdf-delete').length == 1) {  
        // Since the link exists, we need to handle the case when the user clicks on it...  
        $('#tekserve-faq-edition-pdf-delete').click(function(evt) {  
          
            // We don't want the link to remove us from the current page  
            // so we're going to stop its normal behavior.  
            evt.preventDefault();  
              
            // Find the text input element that stores the path to the file  
            // and clear its value.  
            $('#tekserve_faq_upload_pdf_url').val('');  
              
            // Hide this link so users can't click on it multiple times  
            $(this).hide();
            $('#tekserve_faq_edition_pdf-file-description').html('<h2 style="color: #f36f37;">Current PDF will be REMOVED on UPDATE.</h2><p><b>Select a new PDF file to upload:</b></p>');
          
        });  
      
    } // end if  
    
    if($('#tekserve-faq-edition-epub-delete').length == 1) {  
        // Since the link exists, we need to handle the case when the user clicks on it...  
        $('#tekserve-faq-edition-epub-delete').click(function(evt) {  
          
            // We don't want the link to remove us from the current page  
            // so we're going to stop its normal behavior.  
            evt.preventDefault();  
              
            // Find the text input element that stores the path to the file  
            // and clear its value.  
            $('#tekserve_faq_upload_epub_url').val('');  
              
            // Hide this link so users can't click on it multiple times  
            $(this).hide();
            $('#tekserve_faq_edition_epub-file-description').html('<h2 style="color: #f36f37;">Current ePub will be REMOVED on UPDATE.</h2><p><b>Select a new ePub file to upload:</b></p>');
          
        });  
      
    } // end if 
    
    if($('#tekserve-faq-edition-mobi-delete').length == 1) {  
        // Since the link exists, we need to handle the case when the user clicks on it...  
        $('#tekserve-faq-edition-mobi-delete').click(function(evt) {  
          
            // We don't want the link to remove us from the current page  
            // so we're going to stop its normal behavior.  
            evt.preventDefault();  
              
            // Find the text input element that stores the path to the file  
            // and clear its value.  
            $('#tekserve_faq_upload_mobi_url').val('');  
              
            // Hide this link so users can't click on it multiple times  
            $(this).hide();
            $('#tekserve_faq_edition_mobi-file-description').html('<h2 style="color: #f36f37;">Current MOBI will be REMOVED on UPDATE.</h2><p><b>Select a new MOBI file to upload:</b></p>');
          
        });  
      
    } // end if 
  
});