document.addEventListener("DOMContentLoaded", function () {
    var inputs = document.querySelectorAll('input');

    for (var i = 2; i < inputs.length; i++) {
        var inputValue = inputs[i].value;

        if ('' !== inputValue) {

            return;
        } else {

            if ('file' === inputs[i].getAttribute('type')) {
                var fileInput = document.getElementById(inputs[i].getAttribute('id'));
                var fileInputLabel = fileInput.parentElement.previousElementSibling.firstChild;

                if (fileInputLabel.getAttribute('for') === fileInput.getAttribute('id') && fileInputLabel.querySelector('.required')) {
                    fileInput.classList.add('required-entry');
                }
            }
        }
    }
});
