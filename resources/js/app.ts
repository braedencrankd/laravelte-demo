import { mount } from "svelte";
import "./bootstrap";
import { Counter } from "./livewire/app/counter.svelte";

// Export svelte for dynamic imports
window.svelte = { mount };

// resolve all components in the livewire folder
const components = import.meta.glob("/resources/js/livewire/**/*.svelte", {
    eager: true,
});

window.components = components;

// console.log(components);

// import Counter from "./livewire/app/counter.svelte";

// const counterNode = document.getElementById("counter");

// if (!counterNode) {
//     throw new Error("Counter node not found");
// }

// mount(Counter, {
//     target: counterNode,
// });
