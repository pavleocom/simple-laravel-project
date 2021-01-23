require('./bootstrap');

let requireConfirmation = function (event) {
    let confirmationResult = confirm('Are you sure you want to proceed with this action?');

    if (confirmationResult !== true) {
        event.preventDefault();
    }
};

let actionTriggers = document.querySelectorAll('[data-confirm]');
actionTriggers && actionTriggers.forEach((actionTrigger) => {
    actionTrigger.addEventListener('submit', requireConfirmation);
});
