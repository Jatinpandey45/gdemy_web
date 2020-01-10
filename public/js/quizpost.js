
$(document).ready(function () {
  flatpickr('#published_at', {
    wrap: true,
     enableTime: true,
     defaultDate: new Date(),
     minTime: "09:00",
     maxTime: "23:59",
          altInput: true,
          altFormat: "F j, Y H:i",
          dateFormat: "Y-m-d H:i",
  });

});



$('#slug').slugify('#question_text');


  $('#post_form_id').validate({ // initialize the plugin
    rules: {
      question_text: {
        required: true,
      },
      slug: {
        required: true,
      },
      option1: {
        required: true
      },
      option4: {
        required: true
      },
      option3: {
        required: true
      },
      option2: {
        required: true
      },
      published_at: {
        required: true,
        date: true,
      },
      answer_explanation : {
        required : true
      }

    },

    submitHandler: function (form, event) {

      event.preventDefault();

      var is_checked = false;
      $('input[name="category[]"]').each(function () {
        if (this.checked) {
          is_checked = true;
          return false;
        }
      });

      if (!is_checked) {
        alert('You must check at least one category!');
        return false; // The form will *not* submit
      }

      form.submit();

    }
  });


