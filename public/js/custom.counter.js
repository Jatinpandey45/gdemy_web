$('.enable-counter').textcounter({

    // "character" or "word"
    'type'                      : "character",              
  
    // minimum number of characters/words
    'min'                       : 0,      
  
    // maximum number of characters/words
    // -1 for unlimited, 'auto' to use maxlength attribute                  
    'max'                       : 200,           
  
    // custom attribute name with the counter limit if the max is 'autocustom'
    'autoCustomAttr'              : "counterlimit",                  
  
    // HTML element to wrap the text count in
    'countContainerElement'     : "div",                    
  
    // class applied to the countContainerElement
    'countContainerClass'       : "text-count-wrapper",    
  
    // class applied to the counter message 
    'textCountMessageClass'       : "text-count-message help-block",            
  
    // class applied to the counter length
    'textCountClass'            : "text-count",             
  
    // error class appended to the input element if error occurs
    'inputErrorClass'           : "error",                  
  
    // error class appended to the countContainerElement if error occurs
    'counterErrorClass'         : "error",                  
  
    // counter text
    'counterText'               : "Total Count: %d",        
  
    // error text element
    'errorTextElement'          : "div",                    
  
    // error message for minimum not met,
    'minimumErrorText'          : "Minimum not met",        
  
    // error message for maximum range exceeded,
    'maximumErrorText'          : "Maximum exceeded",       
  
    // error class appended to the input element if error occurs
    'inputErrorClass'             : "error",                         
  
    // error class appended to the countContainerElement if error occurs
    'counterErrorClass'           : "error",                         
  
    // counter text
    'counterText'                 : "character count: %d",               
  
    // error text element
    'errorTextElement'            : "div",                           
  
    // error message for minimum not met,
    'minimumErrorText'            : "Minimum not met",               
  
    // error message for maximum range exceeded,
    'maximumErrorText'            : "Maximum exceeded",              
  
    // display error text messages for minimum/maximum values
    'displayErrorText'          : true,                     
  
    // stop further text input if maximum reached
    'stopInputAtMaximum'        : true,          
  
    // count spaces as character (only for "character" type)           
    'countSpaces'               : false,                    
  
    // count from maximum characters/words
    'countDown'                 : false,               
  
    // count down text
    'countDownText'             : "Remaining: %d",    
  
    // count extended UTF-8 characters as 2 bytes (such as Chinese characters)      
    'countExtendedCharacters'   : false,                 
  
    // count carriage returns/newlines as 2 characters
    'twoCharCarriageReturn'     : false,
  
  
    // display text overflow element
    'countOverflow'               : false,                           
  
    // count overflow text
    'countOverflowText'           : "Maximum %type exceeded by %d",  
  
    // class applied to the count overflow wrapper
    'countOverflowContainerClass' : "text-count-overflow-wrapper",   
  
    // maximum number of characters/words above the minimum to display a count
    'minDisplayCutoff'            : -1,           
  
    // maximum number of characters/words below the maximum to display a count                   
    'maxDisplayCutoff'            : -1,                              
                   
  });