@if(recaptcha_site_key())
<script>
window.renderRescomRecaptchas = window.renderRescomRecaptchas || function () {
    if (!window.grecaptcha) return;
    document.querySelectorAll('.g-recaptcha[data-sitekey]:not([data-rendered])').forEach(function (element) {
        window.grecaptcha.render(element, {
            sitekey: element.getAttribute('data-sitekey')
        });
        element.setAttribute('data-rendered', '1');
    });
};
document.addEventListener('DOMContentLoaded', window.renderRescomRecaptchas);
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=renderRescomRecaptchas&render=explicit" async defer></script>
@endif
