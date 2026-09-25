const fs = require('fs');

function updateFile(relPath, transforms) {
  let content = fs.readFileSync(relPath, 'utf8');
  for (const t of transforms) {
    content = content.replaceAll(t.from, t.to);
  }
  fs.writeFileSync(relPath, content, 'utf8');
  console.log('Updated ' + relPath);
}

updateFile('resources/views/pages/blog-detail.blade.php', [
  { from: "- Tech Insights | KNR", to: "- Tech Insights | Rescom" },
  { from: "?? 'KNR'", to: "?? 'Rescom'" },
  { from: "'KNR Engineering Team'", to: "'Rescom Engineering Team'" },
  { from: "<span>KNR Publications</span>", to: "<span>Rescom Publications</span>" },
  { from: "'KNR Specialist'", to: "'Rescom Specialist'" },
  { from: "'KNR Engineering & Editorial Team'", to: "'Rescom Engineering & Editorial Team'" },
  { from: "Author at KNR specializing", to: "Author at Rescom specializing" },
  { from: "'Stay Ahead With KNR'", to: "'Stay Ahead With Rescom'" }
]);

updateFile('resources/views/pages/blog-category.blade.php', [
  { from: "- Tech Insights | KNR", to: "- Tech Insights | Rescom" },
  { from: "from KNR International.", to: "from Rescom." }
]);
