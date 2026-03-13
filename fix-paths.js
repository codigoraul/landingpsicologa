import { readFileSync, writeFileSync, readdirSync, statSync } from 'fs';
import path from 'path';

const DIST_DIR = './dist';
const distRoot = path.resolve(DIST_DIR);

const buildRelativePrefix = (filePath) => {
  const fileDir = path.dirname(filePath);
  const relative = path.relative(fileDir, distRoot) || '.';
  const normalized = relative === '' ? '.' : relative.replace(/\\/g, '/');
  return normalized;
};

const makeRelative = (basePrefix, targetPath) => {
  const cleanTarget = targetPath.replace(/^\/+/g, '');

  if (cleanTarget.startsWith('#')) {
    if (basePrefix === '.' || basePrefix === '') {
      return cleanTarget;
    }
    return `${basePrefix}/${cleanTarget}`.replace(/\/+/g, '/');
  }

  if (basePrefix === '.' || basePrefix === '') {
    return `./${cleanTarget}`;
  }

  return `${basePrefix}/${cleanTarget}`.replace(/\/+/g, '/');
};

const buildProcessors = (prefix) => [
  { regex: /href="\/(?!\/|#)([^"]*)"/g, replacer: (_, target) => `href="${makeRelative(prefix, target)}"` },
  { regex: /src="\/(?!\/)([^"]*)"/g, replacer: (_, target) => `src="${makeRelative(prefix, target)}"` },
  { regex: /action="\/(?!\/)([^"]*)"/g, replacer: (_, target) => `action="${makeRelative(prefix, target)}"` },
  { regex: /href="\/(#(?!\/)[^"]*)"/g, replacer: (_, target) => `href="${makeRelative(prefix, target)}"` },
  { regex: /url\('\/(?!\/)([^']*)'\)/g, replacer: (_, target) => `url('${makeRelative(prefix, target)}')` },
  { regex: /url\("\/(?!\/)([^"]*)"\)/g, replacer: (_, target) => `url("${makeRelative(prefix, target)}")` },
  { regex: /url\(\/(?!\/)([^)]*)\)/g, replacer: (_, target) => `url(${makeRelative(prefix, target)})` },
];

const shouldProcess = (filename) => /\.(html|css)$/i.test(filename);

function walk(dir) {
  const entries = readdirSync(dir);
  entries.forEach((entry) => {
    const fullPath = path.join(dir, entry);
    const stats = statSync(fullPath);
    if (stats.isDirectory()) {
      walk(fullPath);
      return;
    }
    if (!shouldProcess(entry)) return;

    let content = readFileSync(fullPath, 'utf-8');
    let updated = content;
    const prefix = buildRelativePrefix(path.resolve(fullPath));
    const processors = buildProcessors(prefix);
    processors.forEach(({ regex, replacer }) => {
      updated = updated.replace(regex, replacer);
    });

    if (updated !== content) {
      writeFileSync(fullPath, updated, 'utf-8');
      console.log(`🔧 Ajustado: ${fullPath}`);
    }
  });
}

walk(DIST_DIR);
console.log('✅ Rutas relativas generadas según profundidad');
