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

// 1. layouts/app.blade.php
updateFile('resources/views/layouts/app.blade.php', [
  { from: "setting('site_name', 'KNR ')", to: "setting('site_name', 'Rescom')" },
  { from: "setting('site_description', 'KNR - Leading IT Solutions Company')", to: "setting('site_description', 'Rescom - Leading IT Solutions Company')" },
  { from: '<meta name="author" content="KNR ">', to: '<meta name="author" content="Rescom">' },
  { from: "$siteName = setting('site_name', 'KNR ');", to: "$siteName = setting('site_name', 'Rescom');" },
  { from: "setting('site_name', 'KNR')", to: "setting('site_name', 'Rescom')" },
  { from: "setting('footer_about', 'KNR is your trusted technology partner for digital transformation. We build innovative solutions that drive business growth.')", to: "setting('footer_about', 'Rescom is your trusted technology partner for digital transformation. We build innovative solutions that drive business growth.')" },
  { from: "setting('contact_aus_address', 'KNR International, Melbourne, Australia')", to: "setting('contact_aus_address', 'Rescom, Melbourne, Australia')" },
  { from: 'aria-label="Open KNR"', to: 'aria-label="Open Rescom"' },
  { from: '<span class="knr-chatbot-tooltip">Hi, I\'m KNR</span>', to: '<span class="knr-chatbot-tooltip">Hi, I\'m Rescom</span>' },
  { from: '<div class="knr-chatbot-title">KNR</div>', to: '<div class="knr-chatbot-title">Rescom</div>' },
  { from: "Hi! I'm KNR. Ask me anything!", to: "Hi! I'm Rescom. Ask me anything!" },
  { from: 'title="KNR Corporate Presentation"', to: 'title="Rescom Corporate Presentation"' },
  { from: '.footer-knr-logo', to: '.footer-rescom-logo' },
  { from: 'class="footer-credit-logo footer-knr-logo"', to: 'class="footer-credit-logo footer-rescom-logo"' },
  { from: 'route(\'presentation.show\', \'knr-presentation\')', to: 'route(\'presentation.show\', \'rescom-presentation\')' }
]);

// 2. pages/about.blade.php
updateFile('resources/views/pages/about.blade.php', [
  { from: "@section('title', 'About KNR - Enterprise IT Pioneers, Leadership & Core Values')", to: "@section('title', 'About Rescom - Enterprise IT Pioneers, Leadership & Core Values')" },
  { from: "@section('meta_description', 'Learn about KNR International - founded in 2021, 150+ team members, 500+ projects delivered across 20+ countries. We engineer mission-critical digital systems.')", to: "@section('meta_description', 'Learn about Rescom - founded in 2021, 150+ team members, 500+ projects delivered across 20+ countries. We engineer mission-critical digital systems.')" },
  { from: "SECTION 5: HIGHLIGHTED KNR CORPORATE PRESENTATION SHOWCASE (FUTURISTIC THEME)", to: "SECTION 5: HIGHLIGHTED RESCOM CORPORATE PRESENTATION SHOWCASE (FUTURISTIC THEME)" },
  { from: "<!-- =============== SECTION 5: HIGHLIGHTED KNR CORPORATE PRESENTATION DECK =============== -->", to: "<!-- =============== SECTION 5: HIGHLIGHTED RESCOM CORPORATE PRESENTATION DECK =============== -->" },
  { from: "Founded in 2021, KNR International started with a clear vision", to: "Founded in 2021, Rescom started with a clear vision" },
  { from: "Experience KNR in Full Motion", to: "Experience Rescom in Full Motion" },
  { from: '<h3 class="f-pres-stage-title">KNR TECH SOLUTIONS</h3>', to: '<h3 class="f-pres-stage-title">RESCOM</h3>' },
  { from: '<span>KNR Tech Solutions — Corporate Interactive Presentation</span>', to: '<span>Rescom — Corporate Interactive Presentation</span>' },
  { from: 'title="KNR Corporate Presentation"', to: 'title="Rescom Corporate Presentation"' },
  { from: 'Why Leading Enterprises Partner With KNR', to: 'Why Leading Enterprises Partner With Rescom' },
  { from: 'route(\'presentation.show\', \'knr-presentation\')', to: 'route(\'presentation.show\', \'rescom-presentation\')' },
  { from: 'KNR Tech Solutions', to: 'Rescom' }
]);

// 3. pages/blog.blade.php
updateFile('resources/views/pages/blog.blade.php', [
  { from: "@section('title', 'Knowledge Hub & Tech Insights - Expert Articles | KNR')", to: "@section('title', 'Knowledge Hub & Tech Insights - Expert Articles | Rescom')" },
  { from: "@section('meta_description', 'Stay ahead with KNR Knowledge Hub. Expert technical insights, architectural blueprints, cloud strategies, cybersecurity best practices, and enterprise engineering.')", to: "@section('meta_description', 'Stay ahead with Rescom Knowledge Hub. Expert technical insights, architectural blueprints, cloud strategies, cybersecurity best practices, and enterprise engineering.')" },
  { from: "'KNR Editorial'", to: "'Rescom Editorial'" }
]);

// 4. pages/blog-detail.blade.php
updateFile('resources/views/pages/blog-detail.blade.php', [
  { from: "| KNR Knowledge Hub", to: "| Rescom Knowledge Hub" },
  { from: "on KNR Knowledge Hub", to: "on Rescom Knowledge Hub" },
  { from: "'KNR Editorial'", to: "'Rescom Editorial'" },
  { from: "Read more on KNR", to: "Read more on Rescom" }
]);

// 5. pages/blog-category.blade.php
updateFile('resources/views/pages/blog-category.blade.php', [
  { from: "- Tech Articles | KNR", to: "- Tech Articles | Rescom" },
  { from: "by KNR International.", to: "by Rescom." }
]);

// 6. pages/blog-tag.blade.php
updateFile('resources/views/pages/blog-tag.blade.php', [
  { from: "- Tech Insights | KNR", to: "- Tech Insights | Rescom" },
  { from: "on KNR International.", to: "on Rescom." }
]);

// 7. pages/careers.blade.php
updateFile('resources/views/pages/careers.blade.php', [
  { from: "@section('title', 'Careers at KNR - Join Our Engineering Squads')", to: "@section('title', 'Careers at Rescom - Join Our Engineering Squads')" },
  { from: "@section('meta_description', 'Build your career at KNR International. We offer high-impact engineering opportunities in web development, mobile platforms, cloud architecture, AI/ML, and system design.')", to: "@section('meta_description', 'Build your career at Rescom. We offer high-impact engineering opportunities in web development, mobile platforms, cloud architecture, AI/ML, and system design.')" },
  { from: "Life At KNR", to: "Life At Rescom" },
  { from: "careers@knrint.in", to: "careers@rescom.in" }
]);

// 8. pages/career-detail.blade.php
updateFile('resources/views/pages/career-detail.blade.php', [
  { from: "- Careers | KNR", to: "- Careers | Rescom" }
]);

// 9. pages/contact.blade.php
updateFile('resources/views/pages/contact.blade.php', [
  { from: "Contact Us - Get Free IT Consultation | KNR", to: "Contact Us - Get Free Consultation | Rescom" },
  { from: "Contact KNR International", to: "Contact Rescom" },
  { from: "contact@knrint.in", to: "contact@rescom.in" }
]);

// 10. pages/demo-products.blade.php
updateFile('resources/views/pages/demo-products.blade.php', [
  { from: "Request Product Demo - Live Enterprise Sandboxes | KNR", to: "Request Product Demo - Live Enterprise Sandboxes | Rescom" },
  { from: "Experience KNR products in live sandbox environments.", to: "Experience Rescom products in live sandbox environments." }
]);

// 11. pages/home.blade.php
updateFile('resources/views/pages/home.blade.php', [
  { from: "setting('home_meta_title', 'KNR - IT Solutions Company in India')", to: "setting('home_meta_title', 'Rescom - Solutions Company in India')" },
  { from: "setting('home_meta_description', 'KNR delivers world-class web development, mobile apps, cloud solutions, cybersecurity, and AI/ML services. 500+ Products delivered, 200+ happy clients.')", to: "setting('home_meta_description', 'Rescom delivers world-class web development, mobile apps, cloud solutions, cybersecurity, and AI/ML services. 500+ Products delivered, 200+ happy clients.')" },
  { from: "<span>knr://</span>", to: "<span>rescom://</span>" },
  { from: "setting('home_why_badge', 'WHY KNR')", to: "setting('home_why_badge', 'WHY RESCOM')" },
  { from: 'setting(\'home_why_body\', "KNR plays a pivotal role by advancing innovation by fostering interdisciplinary collaboration and optimizing the management of digital information across platforms. Leveraging advanced mapping, analytics, and stakeholder integration, we drive productivity and create sustainable, tangible outcomes.")', to: 'setting(\'home_why_body\', "Rescom plays a pivotal role by advancing innovation by fostering interdisciplinary collaboration and optimizing the management of digital information across platforms. Leveraging advanced mapping, analytics, and stakeholder integration, we drive productivity and create sustainable, tangible outcomes.")' },
  { from: 'KNR plays a pivotal role', to: 'Rescom plays a pivotal role' }
]);

// 12. pages/intern-detail.blade.php
updateFile('resources/views/pages/intern-detail.blade.php', [
  { from: "<span>KNR Guide</span>", to: "<span>Rescom Guide</span>" },
  { from: "Verify your KNR email", to: "Verify your Rescom email" },
  { from: "registered with KNR to download", to: "registered with Rescom to download" },
  { from: 'placeholder="Enter your KNR registered email"', to: 'placeholder="Enter your Rescom registered email"' }
]);

// 13. pages/internship.blade.php
updateFile('resources/views/pages/internship.blade.php', [
  { from: "'title' => 'Connect with KNR'", to: "'title' => 'Connect with Rescom'" },
  { from: "KNR Internship Program", to: "Rescom Internship Program" },
  { from: "setting('site_name', 'KNR')", to: "setting('site_name', 'Rescom')" },
  { from: "meaningful work at KNR.", to: "meaningful work at Rescom." },
  { from: "Talk to KNR", to: "Talk to Rescom" },
  { from: "Why KNR internships stand out", to: "Why Rescom internships stand out" },
  { from: "representing KNR's internship culture.", to: "representing Rescom's internship culture." },
  { from: "contact KNR for internship updates.", to: "contact Rescom for internship updates." },
  { from: "Contact KNR", to: "Contact Rescom" },
  { from: "KNR will review your application", to: "Rescom will review your application" },
  { from: "interest in KNR.", to: "interest in Rescom." },
  { from: "What Interns say about KNR", to: "What Interns say about Rescom" },
  { from: "KNR’s internship program", to: "Rescom’s internship program" }
]);

// 14. pages/portfolio.blade.php & portfolio-detail.blade.php
updateFile('resources/views/pages/portfolio.blade.php', [
  { from: "Products - Enterprise IT Solutions & Products | KNR", to: "Products - Enterprise Solutions & Products | Rescom" }
]);

updateFile('resources/views/pages/portfolio-detail.blade.php', [
  { from: "Products & Platforms | KNR", to: "Products & Platforms | Rescom" }
]);

// 15. pages/privacy.blade.php
updateFile('resources/views/pages/privacy.blade.php', [
  { from: 'KNR International ("Company", "we", "us", or "our")', to: 'Rescom ("Company", "we", "us", or "our")' }
]);

// 16. pages/search.blade.php
updateFile('resources/views/pages/search.blade.php', [
  { from: "across KNR.", to: "across Rescom." }
]);

// 17. pages/service-detail.blade.php & services.blade.php
updateFile('resources/views/pages/service-detail.blade.php', [
  { from: "Enterprise IT Services | KNR", to: "Enterprise Services | Rescom" }
]);

updateFile('resources/views/pages/services.blade.php', [
  { from: "setting('services_meta_title', 'IT Services - Enterprise Solutions & Digital Engineering | KNR')", to: "setting('services_meta_title', 'Services - Enterprise Solutions & Digital Engineering | Rescom')" }
]);

// 18. pages/terms.blade.php
updateFile('resources/views/pages/terms.blade.php', [
  { from: "using the KNR International website", to: "using the Rescom website" },
  { from: "KNR International provides IT services", to: "Rescom provides IT services" },
  { from: "property of KNR International", to: "property of Rescom" },
  { from: "KNR International shall not be liable", to: "Rescom shall not be liable" }
]);

// 19. partials
updateFile('resources/views/partials/intern-testimonial-modal.blade.php', [
  { from: "Share your KNR internship experience", to: "Share your Rescom internship experience" },
  { from: "and KNR experience.", to: "and Rescom experience." }
]);

// 20. admin views
updateFile('resources/views/admin/auth/login.blade.php', [
  { from: "setting('site_name', 'KNR International')", to: "setting('site_name', 'Rescom')" },
  { from: '<span class="f-orbit-logo-fallback">KNR</span>', to: '<span class="f-orbit-logo-fallback">Rescom</span>' },
  { from: 'placeholder="admin@knrint.in"', to: 'placeholder="admin@rescom.in"' }
]);

updateFile('resources/views/admin/layouts/app.blade.php', [
  { from: "setting('site_name', 'KNR International')", to: "setting('site_name', 'Rescom')" },
  { from: '.admin-footer .footer-knr-logo', to: '.admin-footer .footer-rescom-logo' },
  { from: 'class="footer-credit-logo footer-knr-logo"', to: 'class="footer-credit-logo footer-rescom-logo"' },
  { from: 'why knr', to: 'why rescom' },
  { from: 'knr bot', to: 'rescom bot' }
]);

updateFile('resources/views/admin/pages/about/form.blade.php', [
  { from: "KNR International started as a 5-person", to: "Rescom started as a 5-person" }
]);

updateFile('resources/views/admin/pages/interns/form.blade.php', [
  { from: '<label class="form-label">KNR Guide</label>', to: '<label class="form-label">Rescom Guide</label>' },
  { from: 'placeholder="KNR mentor / guide name"', to: 'placeholder="Rescom mentor / guide name"' }
]);

updateFile('resources/views/admin/pages/settings/seo.blade.php', [
  { from: 'placeholder=" | KNR International"', to: 'placeholder=" | Rescom"' }
]);

updateFile('resources/views/admin/pages/team/form.blade.php', [
  { from: "setting('site_name','KNR International')", to: "setting('site_name','Rescom')" }
]);

// 21. digital card & emails
updateFile('resources/views/digital-card/pdf.blade.php', [
  { from: "www.knrint.com", to: "www.rescom.in" },
  { from: "info@knrint.com", to: "info@rescom.in" },
  { from: "www.knrint.in", to: "www.rescom.in" },
  { from: "info@knrint.in", to: "info@rescom.in" }
]);

updateFile('resources/views/emails/contact-reply.blade.php', [
  { from: "KNR International Team", to: "Rescom Team" }
]);

updateFile('resources/views/emails/new-contact.blade.php', [
  { from: "KNR International Admin Notification System", to: "Rescom Admin Notification System" }
]);

// 22. CSS
updateFile('public/css/site.css', [
  { from: '.footer-knr-logo', to: '.footer-rescom-logo' }
]);

updateFile('public/css/admin.css', [
  { from: '.admin-footer .footer-knr-logo', to: '.admin-footer .footer-rescom-logo' }
]);

// 23. Seeders & Migrations
updateFile('database/seeders/ChatbotFaqSeeder.php', [
  { from: 'What does KNR do?', to: 'What does Rescom do?' },
  { from: 'KNR is an IT solutions company', to: 'Rescom is an IT solutions company' },
  { from: 'Where is KNR located?', to: 'Where is Rescom located?' },
  { from: 'How can I contact KNR?', to: 'How can I contact Rescom?' },
  { from: 'Is KNR ISO certified?', to: 'Is Rescom ISO certified?' }
]);

updateFile('database/migrations/2026_03_26_000007_create_legal_pages_table.php', [
  { from: 'KNR Cookies Policy', to: 'Rescom Cookies Policy' },
  { from: 'KNR tech solutions pvt ltd', to: 'Rescom' },
  { from: 'Our KNR website', to: 'Our Rescom website' },
  { from: 'info@knrint.in', to: 'info@rescom.in' },
  { from: 'benefit of KNR', to: 'benefit of Rescom' },
  { from: 'We at KNR have', to: 'We at Rescom have' },
  { from: "KNR's messaging systems", to: "Rescom's messaging systems" },
  { from: "KNR's systems", to: "Rescom's systems" },
  { from: 'KNR provides systems', to: 'Rescom provides systems' },
  { from: 'unwanted messages from KNR', to: 'unwanted messages from Rescom' },
  { from: 'message from KNR', to: 'message from Rescom' },
  { from: 'KNR may revise', to: 'Rescom may revise' },
  { from: 'provided by KNR', to: 'provided by Rescom' },
  { from: "KNR's use of cookies", to: "Rescom's use of cookies" },
  { from: 'KNR uses the following', to: 'Rescom uses the following' },
  { from: 'KNR may update this', to: 'Rescom may update this' }
]);

updateFile('read this file.md', [
  { from: 'KNR International', to: 'Rescom' },
  { from: 'knrint_cms', to: 'rescom-cms' },
  { from: 'www.knrint.in', to: 'www.rescom.in' },
  { from: 'info@knrint.in', to: 'info@rescom.in' },
  { from: 'admin@knrint.in', to: 'admin@rescom.in' },
  { from: 'cd knrint', to: 'cd rescom-cms' },
  { from: 'knrint/', to: 'rescom-cms/' },
  { from: '/var/www/knrint', to: '/var/www/rescom-cms' }
]);

console.log('Step 2 completed!');
