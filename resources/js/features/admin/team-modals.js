export function initTeamModals() {
    const modals = Array.from(document.querySelectorAll('[data-modal]'));

    if (!modals.length) {
        return;
    }

    const openModal = (modal) => {
        if (!modal) {
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        modal.querySelector('[data-autofocus], input, button')?.focus();
    };

    const closeModal = (modal) => {
        if (!modal) {
            return;
        }

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        const stillOpen = modals.some((candidate) => !candidate.classList.contains('hidden'));

        if (!stillOpen) {
            document.body.classList.remove('overflow-hidden');
        }
    };

    document.querySelectorAll('[data-team-create]').forEach((button) => {
        button.addEventListener('click', () => openModal(document.getElementById('team-create-modal')));
    });

    document.querySelectorAll('[data-team-edit]').forEach((button) => {
        button.addEventListener('click', () => {
            const modal = document.getElementById('team-edit-modal');

            if (!modal) {
                return;
            }

            const form = modal.querySelector('form');
            const idField = modal.querySelector('[name="team_member_id"]');
            const nameField = modal.querySelector('[name="name"]');
            const positionField = modal.querySelector('[name="position"]');
            const preview = modal.querySelector('[data-photo-preview]');
            const previewWrap = modal.querySelector('[data-photo-preview-wrap]');

            if (form) {
                form.action = button.dataset.updateUrl;
            }

            if (idField) {
                idField.value = button.dataset.id ?? '';
            }

            if (nameField) {
                nameField.value = button.dataset.name ?? '';
            }

            if (positionField) {
                positionField.value = button.dataset.position ?? '';
            }

            if (preview && button.dataset.photo) {
                preview.src = button.dataset.photo;
                previewWrap?.classList.remove('hidden');
            }

            openModal(modal);
        });
    });

    modals.forEach((modal) => {
        modal.querySelectorAll('[data-modal-close]').forEach((element) => {
            element.addEventListener('click', () => closeModal(modal));
        });

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal(modal);
            }
        });

        if (modal.dataset.autoOpen === 'true') {
            openModal(modal);
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') {
            return;
        }

        modals.forEach((modal) => {
            if (!modal.classList.contains('hidden')) {
                closeModal(modal);
            }
        });
    });
}
