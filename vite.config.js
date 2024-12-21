import { svelte } from "@sveltejs/vite-plugin-svelte";
import laravel from "laravel-vite-plugin";
import { sveltePreprocess } from "svelte-preprocess";
import { defineConfig, loadEnv } from "vite";

export default defineConfig(({ command, mode }) => {
    //Load the env variables that are prefixed with VITE_
    const env = loadEnv(mode, process.cwd(), "VITE_");
    return {
        server: {
            hmr: {
                protocol: "wss",
                host: env.VITE_APP_URL,
            },
        },
        plugins: [
            laravel({
                input: [
                    "resources/css/app.css",
                    "resources/js/app.ts",
                    "resources/js/guest.ts",
                ],
                refresh: false,
            }),
            svelte(),
        ],
        resolve: {
            alias: {
                "@": "/resources/js",
            },
        },
    };
});
