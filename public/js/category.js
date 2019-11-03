/**
 *  javascript  code category validation and listing section
 * 
 */


$.validator.addMethod('filesize', function (value, element, param) {
  return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');

$("#category_form_id").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      category_name: "required",
      category_slug: "required",
      category_description: "required",
      category_icon: {
          required : true,
          extension: "gif|jpeg|jpg|png|tiff|wbmp|ico|jng|bmp|svg|svgz|webp|tif",
          filesize: 1048576
      }, 
    },
    // Specify validation error messages
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    messages : {
        category_icon: {
            extension : "Please upload a valid image file.",
            filesize: "File size is too large (max 1MB) is allowed"
        }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });


$(document).ready(function(){

  var table = $('#categor_datatable_id').DataTable({
    processing: true,
    serverSide: true,
    ajax: $("#hidden_route_category_list"),
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'category_name', name: 'Category'},
        {data: 'category_slug', name: 'Slug'},
        {data: 'category_description', name: 'Description'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});


});
    
    
    
  
