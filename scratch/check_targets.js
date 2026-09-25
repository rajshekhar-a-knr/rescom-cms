const fs = require('fs');
const path = require('path');

const rootDir = 'c:\\xampp\\htdocs\\rescom-cms';

// We want to process:
// 1. Blade views: resources/views/**/*.blade.php
// 2. Presentations: resources/views/presentations/*, public/presentations/*, KNR-Presentation.html, public/KNR-Presentation.html
// 3. Controllers, Models, Mail: app/**/*.php
// 4. Config: config/*.php
// 5. Migrations & Seeders & SQL: database/**/*.php, database/*.sql
// 6. Routes: routes/web.php
// 7. Docs: read this file.md, composer.json
// 8. Public CSS: public/css/*.css

const filesToProcess = [
  // Env & composer
  '.env',
  'composer.json',
  'config/app.php',
  'config/database.php',
  'config/mail.php',
  'routes/web.php',
  'read this file.md',

  // App
  'app/Http/Controllers/CareersController.php',
  'app/Http/Controllers/ContactController.php',
  'app/Http/Controllers/DemoProductController.php',
  'app/Http/Controllers/DigitalCardController.php',
  'app/Http/Controllers/HomeController.php',
  'app/Http/Controllers/InternshipController.php',
  'app/Http/Controllers/PresentationController.php',
  'app/Http/Controllers/Admin/InternController.php',
  'app/Mail/ContactReply.php',

  // Database
  'database/seeders/ChatbotFaqSeeder.php',
  'database/migrations/2024_01_02_000001_add_address_columns_to_team_members.php',
  'database/migrations/2026_03_26_000007_create_legal_pages_table.php',
  'database/kntrint_complete.sql',

  // Views
  'resources/views/layouts/app.blade.php',
  'resources/views/pages/about.blade.php',
  'resources/views/pages/blog.blade.php',
  'resources/views/pages/blog-detail.blade.php',
  'resources/views/pages/blog-category.blade.php',
  'resources/views/pages/blog-tag.blade.php',
  'resources/views/pages/careers.blade.php',
  'resources/views/pages/career-detail.blade.php',
  'resources/views/pages/contact.blade.php',
  'resources/views/pages/demo-products.blade.php',
  'resources/views/pages/home.blade.php',
  'resources/views/pages/intern-detail.blade.php',
  'resources/views/pages/internship.blade.php',
  'resources/views/pages/portfolio.blade.php',
  'resources/views/pages/portfolio-detail.blade.php',
  'resources/views/pages/privacy.blade.php',
  'resources/views/pages/search.blade.php',
  'resources/views/pages/service-detail.blade.php',
  'resources/views/pages/services.blade.php',
  'resources/views/pages/terms.blade.php',
  'resources/views/partials/intern-testimonial-modal.blade.php',
  'resources/views/partials/recaptcha-script.blade.php',
  'resources/views/admin/auth/login.blade.php',
  'resources/views/admin/layouts/app.blade.php',
  'resources/views/admin/pages/about/form.blade.php',
  'resources/views/admin/pages/interns/form.blade.php',
  'resources/views/admin/pages/settings/seo.blade.php',
  'resources/views/admin/pages/team/form.blade.php',
  'resources/views/digital-card/pdf.blade.php',
  'resources/views/emails/contact-reply.blade.php',
  'resources/views/emails/new-contact.blade.php',

  // Presentations
  'resources/views/presentations/knr-presentation.html',
  'resources/views/presentations/leap-presentation.html',
  'resources/views/presentations/relcore-presentation.html',
  'resources/views/presentations/webcore-presentation.html',
  'resources/views/presentations/mktcore-presentation.html',
  'resources/views/presentations/teacher-web-app-presentation.html',
  'resources/views/presentations/teacher-mobile-app-presentation.html',
  'resources/views/presentations/parent-web-app-presentation.html',
  'resources/views/presentations/parent-mobile-app-presentation.html',
  'resources/views/presentations/edxcore-presentation.html',
  'resources/views/presentations/isaakshi-presentation.html',
  'public/presentations/knr-presentation.html',
  'public/presentations/knr-presentation',
  'public/presentations/knr',
  'public/presentations/leap-presentation.html',
  'public/presentations/leap-presentation',
  'public/presentations/leap',
  'public/presentations/relcore-presentation.html',
  'public/presentations/relcore-presentation',
  'public/presentations/relcore',
  'public/presentations/webcore-presentation.html',
  'public/presentations/webcore-presentation',
  'public/presentations/webcore',
  'public/presentations/mktcore-presentation.html',
  'public/presentations/mktcore-presentation',
  'public/presentations/mktcore',
  'public/presentations/teacher-web-app-presentation.html',
  'public/presentations/teacher-web-app-presentation',
  'public/presentations/teacher-web-app',
  'public/presentations/teacher-mobile-app-presentation.html',
  'public/presentations/teacher-mobile-app-presentation',
  'public/presentations/teacher-mobile-app',
  'public/presentations/parent-web-app-presentation.html',
  'public/presentations/parent-web-app-presentation',
  'public/presentations/parent-web-app',
  'public/presentations/parent-mobile-app-presentation.html',
  'public/presentations/parent-mobile-app-presentation',
  'public/presentations/parent-mobile-app',
  'public/presentations/edxcore-presentation.html',
  'public/presentations/edxcore-presentation',
  'public/presentations/edxcore',
  'public/presentations/isaakshi-presentation.html',
  'public/presentations/isaakshi-presentation',
  'public/presentations/isaakshi',
  'KNR-Presentation.html',
  'public/KNR-Presentation.html',

  // CSS
  'public/css/site.css',
  'public/css/admin.css'
];

console.log(`Total target files to check: ${filesToProcess.length}`);

// Check which files exist
const existingFiles = filesToProcess.filter(f => fs.existsSync(path.join(rootDir, f)));
console.log(`Existing target files: ${existingFiles.length}`);

const missing = filesToProcess.filter(f => !fs.existsSync(path.join(rootDir, f)));
if (missing.length > 0) {
  console.log('Missing target files:', missing);
}
