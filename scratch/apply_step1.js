const fs = require('fs');
const path = require('path');

const rootDir = 'c:\\xampp\\htdocs\\rescom-cms';

function updateFile(relPath, transforms) {
  const fullPath = path.join(rootDir, relPath);
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
  } else {
    console.log(`No changes needed for: ${relPath}`);
  }
}

// 1. composer.json
updateFile('composer.json', [
  { from: '"name": "knrint/cms"', to: '"name": "rescom/cms"' },
  { from: '"description": "KNR International IT Company CMS"', to: '"description": "Rescom CMS"' }
]);

// 2. config/app.php
updateFile('config/app.php', [
  { from: "'name' => env('APP_NAME', 'KNR International')", to: "'name' => env('APP_NAME', 'Rescom')" }
]);

// 3. config/database.php
updateFile('config/database.php', [
  { from: "'database' => env('DB_DATABASE', 'knrint_cms')", to: "'database' => env('DB_DATABASE', 'rescom-cms')" }
]);

// 4. config/mail.php
updateFile('config/mail.php', [
  { from: "'address' => env('MAIL_FROM_ADDRESS', 'info@knrint.com')", to: "'address' => env('MAIL_FROM_ADDRESS', 'info@rescom.in')" },
  { from: "'name' => env('MAIL_FROM_NAME', 'KNR')", to: "'name' => env('MAIL_FROM_NAME', 'Rescom')" }
]);

// 5. Controllers
updateFile('app/Http/Controllers/CareersController.php', [
  { from: "setting('site_name', 'KNR International')", to: "setting('site_name', 'Rescom')" }
]);

updateFile('app/Http/Controllers/ContactController.php', [
  { from: "setting('site_name', 'KNR International')", to: "setting('site_name', 'Rescom')" }
]);

updateFile('app/Http/Controllers/DemoProductController.php', [
  { from: "setting('site_name', 'KNR International')", to: "setting('site_name', 'Rescom')" }
]);

updateFile('app/Http/Controllers/DigitalCardController.php', [
  { from: "setting('site_name', 'KNR')", to: "setting('site_name', 'Rescom')" }
]);

updateFile('app/Http/Controllers/HomeController.php', [
  { from: "setting('site_name', 'KNR International')", to: "setting('site_name', 'Rescom')" }
]);

updateFile('app/Http/Controllers/InternshipController.php', [
  { from: 'registered with KNR.', to: 'registered with Rescom.' }
]);

updateFile('app/Mail/ContactReply.php', [
  { from: "subject: 'Re: Your Inquiry - KNR International'", to: "subject: 'Re: Your Inquiry - Rescom'" }
]);

// 6. PresentationController & routes/web.php
updateFile('app/Http/Controllers/PresentationController.php', [
  { from: "'knr'                          => 'knr-presentation.html',", to: "'rescom'                       => 'knr-presentation.html',\n        'rescom-presentation'          => 'knr-presentation.html',\n        'rescom-tech'                  => 'knr-presentation.html',\n        'knr'                          => 'knr-presentation.html'," },
  { from: "public function show(string $slug = 'knr-presentation')", to: "public function show(string $slug = 'rescom-presentation')" }
]);

updateFile('routes/web.php', [
  { from: "Route::get('/knr-presentation', fn() => app(PresentationController::class)->show('knr-presentation'))->name('knr.presentation');", to: "Route::get('/rescom-presentation', fn() => app(PresentationController::class)->show('rescom-presentation'))->name('rescom.presentation');\nRoute::get('/knr-presentation', fn() => app(PresentationController::class)->show('rescom-presentation'))->name('knr.presentation');" },
  { from: "Route::get('/corporate-presentation', fn() => app(PresentationController::class)->show('knr-presentation'))->name('corporate.presentation');", to: "Route::get('/corporate-presentation', fn() => app(PresentationController::class)->show('rescom-presentation'))->name('corporate.presentation');" }
]);

console.log('Step 1 applied successfully.');
