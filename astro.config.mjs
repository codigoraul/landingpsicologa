// @ts-check
import { defineConfig } from 'astro/config';

const basePath = process.env.ASTRO_BASE_PATH || '/';
const siteUrl = process.env.ASTRO_SITE_URL || 'https://ckdelap.cl';

// https://astro.build/config
export default defineConfig({
  output: 'static',
  site: siteUrl,
  base: basePath.endsWith('/') ? basePath : `${basePath}/`,
  build: {
    format: 'directory'
  }
});
