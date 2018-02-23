jQuery(document).ready(function () {
  jQuery('body').on('submit', '.ajaxform', function (e) {
    e.preventDefault();
    var form = jQuery(this);
    if (form.hasClass('is-posting')) {
      return false;
    }
    var validator = form.data('validator');
    if (!validator) {
      validator = form.validate();
    }
    if (form.valid()) {
      form.addClass('is-posting');
      jQuery.ajax({
        headers: {
          Accept: 'application/json'
        },
        type: 'POST',
        dataType: 'json',
        url: form.attr('action'),
        data: form.serialize(),
        success: function (response) {
          form.removeClass('is-posting');
          if (!response.success) {
            var validationErrors = {};
            response.map(function (message) {
              validationErrors[message.fieldName] = message.message;
            });
            validator.showErrors(validationErrors);
          } else {
            switch (response.action) {
              case 'redirect':
                window.location = response.url;
                break;
            }
          }
        }
      });
    }
  });
});
