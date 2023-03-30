import fs from 'fs';
import laravel from 'laravel-vite-plugin'
import { defineConfig, loadEnv } from 'vite'
import { homedir } from 'os'
import { resolve } from 'path'

export default defineConfig(({ command, mode }) => {
    // Load current .env-file
    const env = loadEnv(mode, process.cwd(), '')

    // Set the host based on APP_URL
    let host = new URL(env.APP_URL).host

    return {
        plugins: [
            laravel([
                'resources/css/app.css',
                'resources/js/app.js',
            ]),
        ],
        server: detectServerConfig(host),
    }
})

function detectServerConfig(host) {
    let keyPath = resolve(homedir(), `.config/valet/Certificates/${host}.key`)
    let certificatePath = resolve(homedir(), `.config/valet/Certificates/${host}.crt`)

    if (!fs.existsSync(keyPath)) {
        return {}
    }

    if (!fs.existsSync(certificatePath)) {
        return {}
    }

    return {
        hmr: {host},
        host,
        https: {
            key: fs.readFileSync(keyPath),
            cert: fs.readFileSync(certificatePath),
        },
    }
}