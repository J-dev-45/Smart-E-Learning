// document.addEventListener('DOMContentLoaded', () => {

//     function setupPasswordToggle(inputId, openEyeId, closeEyeId) {
//         const input = document.getElementById(inputId);
//         const openEye = document.getElementById(openEyeId);
//         const closeEye = document.getElementById(closeEyeId);

//         function update() {
//             const isHidden = input.type === "password";

//             openEye.classList.toggle('hidden', !isHidden);
//             openEye.classList.toggle('flex', isHidden);

//             closeEye.classList.toggle('hidden', isHidden);
//             closeEye.classList.toggle('flex', !isHidden);
//         }

//         openEye.addEventListener('click', () => {
//             input.type = "text";
//             input.focus();
//             update();
//         });

//         closeEye.addEventListener('click', () => {
//             input.type = "password";
//             input.focus();
//             update();
//         });

//         update();
//     }

//     // DESKTOP
//     setupPasswordToggle( 'passwordInput_desktop', 'openedEye_desktop', 'closedEye_desktop' );
//     // MOBILE
//     setupPasswordToggle( 'passwordInput_mobile', 'openedEye_mobile', 'closedEye_mobile' );

// });

// LOG OUT PAGE
document.addEventListener('DOMContentLoaded', function () {
    const logoutBtn = document.getElementById('logout');

    if (logoutBtn) {
        logoutBtn.addEventListener('click', function () {
            console.log("Logout clicked");
            document.getElementById('logout-form').submit();
        });
    }
});


// REGISTER PAGE
document.addEventListener('DOMContentLoaded', () => {

    function setupToggle(inputId, openEyeId, closeEyeId) {
        const input    = document.getElementById(inputId);
        const openEye  = document.getElementById(openEyeId);
        const closeEye = document.getElementById(closeEyeId);

        if (!input || !openEye || !closeEye) return;

        openEye.classList.remove('hidden');
        openEye.classList.add('flex');
        closeEye.classList.add('hidden');
        closeEye.classList.remove('flex');

        openEye.addEventListener('click', () => {
            input.type = 'text';
            openEye.classList.add('hidden');
            openEye.classList.remove('flex');
            closeEye.classList.remove('hidden');
            closeEye.classList.add('flex');
            input.focus();
        });

        closeEye.addEventListener('click', () => {
            input.type = 'password';
            closeEye.classList.add('hidden');
            closeEye.classList.remove('flex');
            openEye.classList.remove('hidden');
            openEye.classList.add('flex');
            input.focus();
        });
    }

    // Desktop - Password
    setupToggle('passwordInput_desktop', 'openedEye_desktop', 'closedEye_desktop');
    // Desktop - Confirm Password
    setupToggle('confirm_passwordInput_desktop', 'confirm_openedEye_desktop', 'confirm_closedEye_desktop');
    // Mobile - Password
    setupToggle('passwordInput_mobile', 'openedEye_mobile', 'closedEye_mobile');
    // Mobile - Confirm Password
    setupToggle('confirm_passwordInput_mobile',  'confirm_openedEye_mobile',  'confirm_closedEye_mobile');

});

// OTP VERIFICATION PAGE
document.querySelectorAll('.otp-input').forEach((input, idx, inputs) => {
    input.addEventListener('input', () => {
        input.value = input.value.replace(/\D/g, '').slice(0, 1);
        if (input.value && idx < inputs.length - 1) inputs[idx + 1].focus();
    });
    input.addEventListener('keydown', e => {
        if (e.key === 'Backspace' && !input.value && idx > 0) inputs[idx - 1].focus();
    });
    input.addEventListener('paste', e => {
        e.preventDefault();
        const digits = (e.clipboardData.getData('text').match(/\d/g) || []);
        digits.forEach((d, i) => { if (inputs[idx + i]) inputs[idx + i].value = d; });
        const next = inputs[Math.min(idx + digits.length, inputs.length - 1)];
        next && next.focus();
    });
});