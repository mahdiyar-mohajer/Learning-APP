function copyToClipboard(text) {
    var tempTextArea = document.createElement("textarea");
    document.body.appendChild(tempTextArea);
    tempTextArea.value = text;
    tempTextArea.select();
    document.execCommand('copy');
    document.body.removeChild(tempTextArea);

    showCopySuccessPopup();
}

function showCopySuccessPopup() {
    const popup = document.getElementById('copy-success-popup');
    popup.classList.remove('opacity-0');
    popup.classList.add('opacity-100');
    setTimeout(() => {
        popup.classList.remove('opacity-100');
        popup.classList.add('opacity-0');
    }, 2000);
}

document.addEventListener('DOMContentLoaded', function () {
    function togglePopup(button, popup, className) {
        button.addEventListener('click', function (event) {
            event.stopPropagation();
            closeAllPopups();
            popup.classList.toggle('hidden');
            popup.classList.toggle('opacity-0');
            popup.classList.toggle('opacity-100');
        });
    }

    function closeAllPopups() {
        document.querySelectorAll('.example-popup, .flag-popup').forEach(function (popup) {
            popup.classList.add('hidden');
            popup.classList.remove('opacity-100');
            popup.classList.add('opacity-0');
        });
    }

    function closePopupsOnClickOutside(popup) {
        document.addEventListener('click', function (event) {
            if (!popup.contains(event.target) && !popup.previousElementSibling.contains(event.target)) {
                popup.classList.add('hidden');
                popup.classList.remove('opacity-100');
                popup.classList.add('opacity-0');
            }
        });
    }

    document.querySelectorAll('.example-button').forEach(function (button) {
        const popup = button.nextElementSibling;
        togglePopup(button, popup, 'example-popup');
        closePopupsOnClickOutside(popup);
    });

    document.querySelectorAll('.flag-button').forEach(function (button) {
        const popup = button.nextElementSibling;
        togglePopup(button, popup, 'flag-popup');
        closePopupsOnClickOutside(popup);
    });
});
