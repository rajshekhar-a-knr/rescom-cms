const fs = require('fs');
const path = require('path');

const rootDir = 'c:\\xampp\\htdocs\\rescom-cms';

const targetViews = [
  'resources/views/admin/pages/settings/general.blade.php',
  'resources/views/admin/pages/settings/seo.blade.php',
  'resources/views/admin/pages/settings/social.blade.php',
  'resources/views/admin/pages/settings/email.blade.php',
  'resources/views/admin/pages/settings/content.blade.php',
  'resources/views/admin/pages/settings/topscroller/index.blade.php',
  'resources/views/admin/pages/settings/topscroller/create.blade.php',
  'resources/views/admin/pages/settings/topscroller/edit.blade.php'
];

const newTabsCode = `@foreach([
        route('admin.settings.index') => 'General',
        route('admin.settings.header') => 'Header',
        route('admin.settings.footer') => 'Footer',
        route('admin.settings.seo') => 'SEO',
        route('admin.settings.social') => 'Social',
        route('admin.settings.topscroller') => 'Top Scroller',
        route('admin.settings.email') => 'Email',
        route('admin.settings.content') => 'Content'
    ] as $url => $label)
    <a href="{{ $url }}" style="padding:10px 20px;text-decoration:none;font-size:14px;font-weight:600;border-bottom:3px solid {{ request()->url()===$url ? 'var(--primary)' : 'transparent' }};color:{{ request()->url()===$url ? 'var(--primary)' : 'var(--text-muted)' }};margin-bottom:-2px;white-space:nowrap">{{ $label }}</a>
    @endforeach`;

targetViews.forEach(rel => {
  const p = path.join(rootDir, rel);
  if (!fs.existsSync(p)) return;
  let content = fs.readFileSync(p, 'utf8');

  // Match @foreach([route('admin.settings.index')=>...as $url=>$label)...@endforeach
  const regex = /@foreach\(\[route\('admin\.settings\.index'\)[\s\S]*?@endforeach/g;
  if (regex.test(content)) {
    content = content.replace(regex, newTabsCode);
    fs.writeFileSync(p, content, 'utf8');
    console.log(`Updated tabs in: ${rel}`);
  } else {
    console.log(`Pattern not matched in: ${rel}`);
  }
});
