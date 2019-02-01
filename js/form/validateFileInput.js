document.addEventListener("DOMContentLoaded", function () {
    var titleInputValue = document.getElementById('title').value;

    //check if form is rendered in 'new' or 'edit' mode with title field which is required one. If mode is 'new', then adds 'required-entry' class to file-input.
    if ('' === titleInputValue) {
        var fileInput = document.querySelector('.input-file');
        var fileInputLabel = fileInput.parentElement.previousElementSibling.firstChild;

        if (fileInputLabel.getAttribute('for') === fileInput.getAttribute('id')) {
            fileInput.classList.add('required-entry');
        }
    }
});
