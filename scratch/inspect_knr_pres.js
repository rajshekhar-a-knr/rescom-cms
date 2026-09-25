const fs = require('fs');

const content = fs.readFileSync('resources/views/presentations/knr-presentation.html', 'utf8');
const lines = content.split('\n');

const knrLines = [];
lines.forEach((l, i) => {
  if (l.toLowerCase().includes('knr')) {
    knrLines.push({ num: i + 1, text: l });
  }
});

console.log(`Total knr lines in knr-presentation.html: ${knrLines.length}`);
knrLines.forEach(k => console.log(`L${k.num}: ${k.text}`));
