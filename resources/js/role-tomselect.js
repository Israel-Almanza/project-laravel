import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.css';

let livewireBound = false;

function unwrapEventPayload(payload) {
    if (payload == null) {
        return {};
    }
    if (Array.isArray(payload) && payload.length > 0 && typeof payload[0] === 'object') {
        return payload[0];
    }
    if (typeof payload === 'object' && 'detail' in payload && payload.detail) {
        return typeof payload.detail === 'object' ? payload.detail : {};
    }
    return typeof payload === 'object' ? payload : {};
}

function getRoleWrap() {
    return document.querySelector('[data-role-ts-wrap]');
}

function resolveLivewireComponent(lwId) {
    if (!lwId || !window.Livewire) {
        return null;
    }
    if (typeof window.Livewire.find === 'function') {
        return window.Livewire.find(lwId);
    }
    if (typeof window.Livewire.getById === 'function') {
        return window.Livewire.getById(lwId);
    }
    return null;
}

function initOrSync(administrador, representante) {
    const wrap = getRoleWrap();
    if (!wrap?.dataset?.lwId) {
        return;
    }

    const lwId = wrap.dataset.lwId;
    const adminEl = wrap.querySelector('#administrador');
    const repEl = wrap.querySelector('#representante');
    if (!adminEl || !repEl) {
        return;
    }

    const component = resolveLivewireComponent(lwId);
    if (!component) {
        return;
    }

    const adm = Array.isArray(administrador) ? administrador : [];
    const rep = Array.isArray(representante) ? representante : [];

    if (!adminEl.tomselect) {
        new TomSelect(adminEl, {
            plugins: ['remove_button'],
            persist: false,
            hideSelected: true,
            maxItems: null,
            onChange(value) {
                component.set('administrador', value);
            },
        });
    }

    if (!repEl.tomselect) {
        new TomSelect(repEl, {
            plugins: ['remove_button'],
            persist: false,
            hideSelected: true,
            maxItems: null,
            onChange(value) {
                component.set('representante', value);
            },
        });
    }

    adminEl.tomselect.setValue(adm, true);
    repEl.tomselect.setValue(rep, true);
}

function bindLivewire() {
    if (livewireBound || !window.Livewire?.on) {
        return;
    }
    livewireBound = true;

    window.Livewire.on('role-ts-sync', (payload) => {
        const data = unwrapEventPayload(payload);
        initOrSync(data.administrador ?? [], data.representante ?? []);
    });
}

document.addEventListener('livewire:init', bindLivewire);

if (window.Livewire?.on) {
    bindLivewire();
}
