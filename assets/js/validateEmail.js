(function ($) {
  $.fn.validateEmail = function (options) {
    var settings = $.extend(
      {
        validate: "",
        id_button: "",
      },
      options
    );
    this.filter('input[type="email"]').each(function () {
      // this.onchange = function() {
      //     alert(1)
      // }
      this.onkeyup = function () {
        if (this.value === "") {
          $("#" + settings.validate).text("");
          $("#" + settings.validate).css("display", "none");
          return;
        }
        if (!validate_Email(this.value)) {
          if (settings.validate !== "") {
            $("#" + settings.validate).text("รูปแบบ E-mail ไม่ถูกต้อง");
            $("#" + settings.validate).css("display", "block");
          }
          if (settings.id_button !== "") {
            $("#" + settings.id_button).attr("disabled", "disabled");
          }
        } else {
          if (settings.validate !== "") {
            $("#" + settings.validate).text("รูปแบบ E-mail ไม่ถูกต้อง");
            $("#" + settings.validate).css("display", "none");
          }
          if (settings.id_button !== "") {
            $("#" + settings.id_button).removeAttr("disabled");
            //             const subscribeInput = document.getElementById('subscribeInput');
            // const disableBtn = document.getElementById('disableBtn');
            // const enableBtn = document.getElementById('enableBtn');

            // disableBtn.addEventListener('click', () =>
            //   subscribeInput.setAttribute('disabled', 'disabled')
            // );

            // enableBtn.addEventListener('click', () =>
            //   subscribeInput.removeAttribute('disabled')
            // );
          }
        }
      };
    });
  };
})(jQuery);

function validate_Email(input) {
  // var validRegex =
  // /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  var validRegex =
    /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.+[a-zA-Z0-9-]+$/;

  return input.match(validRegex);
  if (input.match(validRegex)) {
    return true;
  } else {
    return false;
  }
}
