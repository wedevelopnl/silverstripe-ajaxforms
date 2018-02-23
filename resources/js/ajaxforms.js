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
      jQuery(':focus').blur();
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
              case 'message':
                var messageElement = jQuery('<div style="display: none;"/>');
                messageElement.addClass('form-message');
                messageElement.html(response.message);
                if(response.prependMessage){
                  form.prepend(messageElement);
                }else{
                  form.append(messageElement);
                }
                messageElement.slideDown();
                if(response.clearform){
                  form[0].reset();
                }
                break;
            }
          }
        }
      });
    }
  });
});
