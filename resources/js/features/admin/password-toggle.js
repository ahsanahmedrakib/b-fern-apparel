export function initPasswordToggles() {
    const toggles = Array.from(document.querySelectorAll('[data-password-toggle]'));

    toggles.forEach((toggle) => {
        const target = document.getElementById(toggle.dataset.passwordToggle);

        if (!target) {
            return;
        }

        const showIcon = toggle.querySelector('[data-password-icon="show"]');
        const hideIcon = toggle.querySelector('[data-password-icon="hide"]');

        const setVisible = (visible) => {
            target.type = visible ? 'text' : 'password';
            toggle.setAttribute('aria-pressed', String(visible));
            toggle.setAttribute('aria-label', visible ? 'Hide password' : 'Show password');
            showIcon?.classList.toggle('hidden', visible);
            hideIcon?.classList.toggle('hidden', !visible);
        };

        toggle.addEventListener('click', () => {
            setVisible(target.type === 'password');
        });
    });
}
