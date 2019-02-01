document.addEventListener("DOMContentLoaded", function () {
    var inputs = document.querySelectorAll('input');

    for (var i = 2; i < inputs.length; i++) {
        var values = inputs[i].value;

        if (values) {

            return;
        } else {

            if (inputs[i].getAttribute('type') === 'file') {
                var fileInput = document.getElementById(inputs[i].getAttribute('id'));
                var fileInputLabel = fileInput.parentElement.previousElementSibling.firstChild;

                if (fileInputLabel.getAttribute('for') === fileInput.getAttribute('id') && fileInputLabel.querySelector('.required')) {
                    fileInput.classList.add('required-entry');
                }

            }
        }
    }
});
