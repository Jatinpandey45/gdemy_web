
$(document).ready(function() {
    var editor_config = {
        path_absolute : "/",
        selector: "textarea.gk_tinymce",
        branding: false,
        plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
          var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
          var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
    
          var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
          if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
          } else {
            cmsURL = cmsURL + "&type=Files";
          }
    
          tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
          });
        }
    };
    tinymce.init(editor_config);
    //     {
    //     selector:'textarea.gk_tinymce',
    //     branding: false,
    //     plugins: [
    //         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
    //         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    //         "save table contextmenu directionality emoticons template paste textcolor autoresize responsivefilemanager"
    //     ]
    // });

    flatpickr('#published_at', {
        enableTime: true
    });
});

$('#tag_name').autocomplete({
  serviceUrl: $("#tag_search_request_route").val(),
  minChars: 3,
  dataType: 'json',
  type : "get",
  onSearchStart  : function(){$("#loader_element_id").show();},
  onSearchComplete    : function(){$("#loader_element_id").hide();},
  onSelect: function (suggestion) {
      alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
  }
});