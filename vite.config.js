
import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

import fs from 'fs-extra';
import path from 'path';

const folder = {
    src: "resources/assets", // source files
    src_assets: "resources/assets/", // source assets files
    dist: "resources/", // build files
    dist_assets: "resources/dist/" //build assets files
};

export default defineConfig({
    base: '/vendor/admin',
    build: {
        manifest: true,
        rtl: true,
        outDir: folder.dist_assets,
        cssCodeSplit: true,
        rollupOptions: {
            output: {
                assetFileNames: (css) => {
                    if (css.name.split('.').pop() == 'css') {
                        return 'css/' + `[name]` + '.min.' + 'css';
                    } else {
                        return 'icons/' + css.name;
                    }
                },
                entryFileNames: 'js/' + `[name]` + `.js`,
            },
        },
    },
    plugins: [
        laravel(
            {
                input: [
                    'resources/assets/scss/bootstrap.scss',
                    'resources/assets/scss/icons.scss',
                    'resources/assets/scss/app.scss',
                    'resources/assets/scss/custom.scss',
                ],
                refresh: [
                    ...refreshPaths,
                    'resources/views/**',
                ],
            }
        ),
        {
            name: 'copy-specific-packages',
            async writeBundle() {

                try {
                    // Copy images, json, fonts, and js
                    await Promise.all([
                        fs.copy(folder.src_assets + 'fonts', folder.dist_assets + 'fonts'),
                        fs.copy(folder.src_assets + 'images', folder.dist_assets + 'images'),
                        fs.copy(folder.src_assets + 'js', folder.dist_assets + 'js'),
                        fs.copy(folder.src_assets + 'json', folder.dist_assets + 'json'),
                    ]);
                } catch (error) {
                    console.error('Error copying assets:', error);
                }

                const outputPath = path.resolve(__dirname, folder.dist_assets); // Adjust the destination path
                const configPath = path.resolve(__dirname, 'package-copy-config.json');

                try {
                    const configContent = await fs.readFile(configPath, 'utf-8');
                    const { packagesToCopy } = JSON.parse(configContent);

                    for (const packageName of packagesToCopy) {
                        const destPackagePath = path.join(outputPath, 'libs', packageName);

                        const sourcePath = (fs.existsSync(path.join(__dirname, 'node_modules', packageName + "/dist"))) ?
                            path.join(__dirname, 'node_modules', packageName + "/dist")
                            : path.join(__dirname, 'node_modules', packageName);

                        try {
                            await fs.access(sourcePath, fs.constants.F_OK);
                            await fs.copy(sourcePath, destPackagePath);
                        } catch (error) {
                            console.error(`Package ${packageName} does not exist.`);
                        }
                    }
                } catch (error) {
                    console.error('Error copying and renaming packages:', error);
                }
            },
        },

    ],
});

