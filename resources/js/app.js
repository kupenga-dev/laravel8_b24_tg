require('./bootstrap');
document.addEventListener('DOMContentLoaded', function () {
    flatpickr('#birthday', {
        locale: 'ru',
        dateFormat: "Y-m-d",
        maxDate: "today",
        enableTime: false
    });
});
