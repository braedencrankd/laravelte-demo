import { mount } from "svelte";

export default {
    mount: () => {
        // Export svelte for dynamic imports
        window.svelte = { mount };

        // resolve all components in the livewire folder
        const components = import.meta.glob(
            "/resources/js/livewire/**/*.svelte",
            {
                eager: true,
            }
        );

        window.components = components;
    },
};
