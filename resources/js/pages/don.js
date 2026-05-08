export function initDonationForm() {
    const form = document.querySelector('[data-don-form]');
    if (!form) {
        return;
    }

    const customInput = form.querySelector('[data-custom-amount]');
    const hiddenInput = form.querySelector('[data-hidden-custom-amount]');
    const radios = form.querySelectorAll('.btn-check');
    const radioName = 'montant';

    const useCustomAmount = () => {
        radios.forEach((radio) => {
            radio.checked = false;
            radio.removeAttribute('name');
        });

        hiddenInput.setAttribute('name', radioName);
        hiddenInput.value = customInput.value.trim();
    };

    const usePresetAmount = () => {
        hiddenInput.removeAttribute('name');
        hiddenInput.value = '';

        radios.forEach((radio) => {
            radio.setAttribute('name', radioName);
        });
    };

    customInput.addEventListener('focus', () => {
        if (customInput.value.trim() !== '') {
            useCustomAmount();
            return;
        }

        radios.forEach((radio) => {
            radio.checked = false;
        });
    });

    customInput.addEventListener('input', () => {
        if (customInput.value.trim() === '') {
            usePresetAmount();
            return;
        }

        useCustomAmount();
    });

    radios.forEach((radio) => {
        radio.addEventListener('change', () => {
            if (!radio.checked) {
                return;
            }

            customInput.value = '';
            usePresetAmount();
        });
    });

    form.addEventListener('submit', () => {
        if (customInput.value.trim() === '') {
            usePresetAmount();
            return;
        }

        useCustomAmount();
    });
}
