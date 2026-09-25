const fs = require('fs');
const path = require('path');

const rootDir = 'c:\\xampp\\htdocs\\rescom-cms';

function updateFile(relPath, transforms) {
  const fullPath = path.join(rootDir, relPath);
  if (!fs.existsSync(fullPath)) return;
  let content = fs.readFileSync(fullPath, 'utf8');
  const original = content;
  for (const t of transforms) {
    if (typeof t.from === 'string') {
      content = content.replaceAll(t.from, t.to);
    } else if (t.from instanceof RegExp) {
      content = content.replace(t.from, t.to);
    }
  }
  if (content !== original) {
    fs.writeFileSync(fullPath, content, 'utf8');
    console.log(`Updated: ${relPath}`);
  }
}

// 1. recaptcha-script.blade.php
updateFile('resources/views/partials/recaptcha-script.blade.php', [
  { from: 'renderKnrRecaptchas', to: 'renderRescomRecaptchas' }
]);

// 2. layouts/app.blade.php
updateFile('resources/views/layouts/app.blade.php', [
  { from: '<!-- <span class="knr-chatbot-toggle-text">KNR</span> -->', to: '<!-- <span class="knr-chatbot-toggle-text">Rescom</span> -->' },
  { from: "request()->is('knr-presentation')", to: "request()->is('rescom-presentation') || request()->is('knr-presentation')" }
]);

// 3. pages/about.blade.php
updateFile('resources/views/pages/about.blade.php', [
  { from: '<!-- Central Illuminated Official KNR Logo -->', to: '<!-- Central Illuminated Official Rescom Logo -->' },
  { from: '<!-- =============== SECTION 7: WHY CHOOSE KNR (FULL WIDTH) =============== -->', to: '<!-- =============== SECTION 7: WHY CHOOSE RESCOM (FULL WIDTH) =============== -->' }
]);

// 4. pages/internship.blade.php
updateFile('resources/views/pages/internship.blade.php', [
  { from: 'Students can still contact KNR for upcoming batches.', to: 'Students can still contact Rescom for upcoming batches.' }
]);

// 5. database/migrations/2026_03_26_000007_create_legal_pages_table.php
updateFile('database/migrations/2026_03_26_000007_create_legal_pages_table.php', [
  { from: "KNR\\'s", to: "Rescom\\'s" },
  { from: "KNR's", to: "Rescom's" }
]);

// 6. Presentation files fallback link
const presFiles = [
  'resources/views/presentations/knr-presentation.html',
  'resources/views/presentations/rescom-presentation.html',
  'public/presentations/knr-presentation.html',
  'public/presentations/knr-presentation',
  'public/presentations/knr',
  'public/presentations/rescom-presentation.html',
  'public/presentations/rescom-presentation',
  'public/presentations/rescom',
  'KNR-Presentation.html',
  'public/KNR-Presentation.html',
  'Rescom-Presentation.html',
  'public/Rescom-Presentation.html'
];

presFiles.forEach(rel => {
  updateFile(rel, [
    { from: "if (!targetFile) return '/presentations/knr-presentation';", to: "if (!targetFile) return '/presentations/rescom-presentation';" }
  ]);
});

console.log('Finishing touches completed.');
