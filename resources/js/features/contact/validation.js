/**
 * Contact form validation with a react-hook-form style experience:
 * - validates on blur, then re-validates live on input (onTouched mode)
 * - inline, per-field error messages
 * - blocks submission and focuses the first invalid field
 * - keeps server-rendered errors working (progressive enhancement)
 *
 * Rules are declared in markup via data-rules, e.g. data-rules="required|min:20".
 */

const RULES = {
    required: {
        validate: (value) => value.trim() !== '',
        message: (label) => `${label} is required.`,
    },
    email: {
        validate: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim()),
        message: () => 'Enter a valid email address.',
    },
    min: {
        validate: (value, arg) => value.trim().length >= Number(arg),
        message: (label, arg) => `${label} must be at least ${arg} characters.`,
    },
    max: {
        validate: (value, arg) => value.trim().length <= Number(arg),
        message: (label, arg) => `${label} must be no more than ${arg} characters.`,
    },
};

function parseRules(attribute) {
    return (attribute || '')
        .split('|')
        .map((part) => {
            const [name, arg] = part.split(':');
            return { name, arg };
        })
        .filter((rule) => Object.hasOwn(RULES, rule.name));
}

function labelFor(field) {
    if (field.dataset.label) {
        return field.dataset.label;
    }

    const label = field.id ? document.querySelector(`label[for="${field.id}"]`) : null;

    return label ? label.textContent.replace('*', '').trim() : field.name;
}

function validateField(field) {
    const rules = parseRules(field.dataset.rules);
    const value = field.value;
    const label = labelFor(field);
    const isEmpty = value.trim() === '';

    for (const rule of rules) {
        if (rule.name === 'required' && isEmpty) {
            return RULES.required.message(label);
        }
    }

    if (isEmpty) {
        return null;
    }

    for (const rule of rules) {
        if (rule.name === 'required') {
            continue;
        }

        if (!RULES[rule.name].validate(value, rule.arg)) {
            return RULES[rule.name].message(label, rule.arg);
        }
    }

    return null;
}

export function initContactValidation() {
    const validationRoot = document.querySelector('[data-contact-form]');

    if (!validationRoot) {
        return;
    }

    const fields = Array.from(validationRoot.querySelectorAll('[data-rules]'));
    const touched = new Set();

    const errorBox = (field) => validationRoot.querySelector(`[data-error-for="${field.name}"]`);
    const validMark = (field) => validationRoot.querySelector(`[data-valid-for="${field.name}"]`);

    function render(field, message) {
        const box = errorBox(field);
        const mark = validMark(field);
        const isValid = !message && field.value.trim() !== '';

        field.classList.toggle('field-error', Boolean(message));
        field.setAttribute('aria-invalid', message ? 'true' : 'false');

        if (box) {
            box.textContent = message || '';
            box.classList.toggle('hidden', !message);
        }

        if (mark) {
            mark.classList.toggle('hidden', !isValid);
        }
    }

    function validateAndRender(field) {
        const message = validateField(field);
        render(field, message);

        return !message;
    }

    fields.forEach((field) => {
        // Treat server-rendered errors as already touched so live validation continues.
        if (field.classList.contains('field-error')) {
            touched.add(field.name);
        }

        field.addEventListener('blur', () => {
            touched.add(field.name);
            validateAndRender(field);
        });

        field.addEventListener('input', () => {
            if (touched.has(field.name)) {
                validateAndRender(field);
            }
        });
    });

    validationRoot.addEventListener('submit', (event) => {
        let firstInvalid = null;

        fields.forEach((field) => {
            touched.add(field.name);

            if (!validateAndRender(field) && !firstInvalid) {
                firstInvalid = field;
            }
        });

        if (firstInvalid) {
            event.preventDefault();
            firstInvalid.focus();
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
}
