/**
 *  javascript  code category validation and listing section
 * 
 */

  $("#tags_form_id").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        tags_name: "required",
        tags_slug: "required",
        tags_desc: "required"
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  