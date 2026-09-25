const fs = require('fs');
const path = require('path');

const rootDir = 'c:\\xampp\\htdocs\\rescom-cms';

function replaceInText(content) {
  let c = content;

  // Exact company phrases first (longest match first)
  c = c.replaceAll('KNR TECH SOLUTIONS PVT. LTD.', 'RESCOM TECH SOLUTIONS PVT. LTD.');
  c = c.replaceAll('KNR Tech Solutions Pvt. Ltd.', 'Rescom Tech Solutions Pvt. Ltd.');
  c = c.replaceAll('KNR Tech Solutions Pvt Ltd', 'Rescom Tech Solutions Pvt Ltd');
  c = c.replaceAll('KNR tech solutions pvt ltd', 'Rescom Tech Solutions Pvt Ltd');
  c = c.replaceAll('KNR TECH SOLUTIONS', 'RESCOM');
  c = c.replaceAll('KNR Tech Solutions', 'Rescom');
  c = c.replaceAll('Knr Tech Solutions', 'Rescom');
  c = c.replaceAll('KNR Tech Solution', 'Rescom');
  c = c.replaceAll('Knr Tech Solution', 'Rescom');
  c = c.replaceAll('ABOUT KNR TECH SOLUTIONS', 'ABOUT RESCOM');
  c = c.replaceAll('About KNR:', 'About Rescom:');
  c = c.replaceAll('ABOUT KNR', 'ABOUT RESCOM');

  // Presentation headers / titles
  c = c.replaceAll('01 // KNR INTRODUCTION', '01 // RESCOM INTRODUCTION');
  c = c.replaceAll('01 // KNR PORTFOLIO', '01 // RESCOM PORTFOLIO');
  c = c.replaceAll('03 // KNR SERVICES', '03 // RESCOM SERVICES');
  c = c.replaceAll('FUTURISTIC KNR MULTI-PRODUCT', 'FUTURISTIC RESCOM MULTI-PRODUCT');
  c = c.replaceAll('KNR DEEP-DIVE PRESENTATIONS', 'RESCOM DEEP-DIVE PRESENTATIONS');
  c = c.replaceAll('THE KNR PARTNERSHIP', 'THE RESCOM PARTNERSHIP');
  c = c.replaceAll('KNR CONNECTS THEM ALL.', 'RESCOM CONNECTS THEM ALL.');
  c = c.replaceAll('KNR Corporate Office', 'Rescom Corporate Office');
  c = c.replaceAll('KNR UNIFIED', 'RESCOM UNIFIED');
  c = c.replaceAll('KNR INTRODUCTION', 'RESCOM INTRODUCTION');
  c = c.replaceAll('KNR PORTFOLIO', 'RESCOM PORTFOLIO');
  c = c.replaceAll('KNR SERVICES', 'RESCOM SERVICES');

  // Products & services
  c = c.replaceAll('KNR Technology Engineering Services', 'Rescom Technology Engineering Services');
  c = c.replaceAll('KNR Skill Development', 'Rescom Skill Development');
  c = c.replaceAll('KNR-LEAP', 'RESCOM-LEAP');
  c = c.replaceAll('KNR LEAP', 'Rescom LEAP');
  c = c.replaceAll('KNR Pay', 'Rescom Pay');
  c = c.replaceAll('KNR Live Fleet', 'Rescom Live Fleet');
  c = c.replaceAll('KNR Smart Attendance', 'Rescom Smart Attendance');
  c = c.replaceAll('KNR Campus Commerce', 'Rescom Campus Commerce');
  c = c.replaceAll('KNR Unified Communication', 'Rescom Unified Communication');
  c = c.replaceAll('KNR Holistic Student', 'Rescom Holistic Student');
  c = c.replaceAll('KNR Smart Examination', 'Rescom Smart Examination');
  c = c.replaceAll('KNR AI Predictive', 'Rescom AI Predictive');

  // App titles
  c = c.replaceAll('KNR Teacher Web Workstation', 'Rescom Teacher Web Workstation');
  c = c.replaceAll('KNR Teacher Mobile App', 'Rescom Teacher Mobile App');
  c = c.replaceAll('KNR Parent Web Portal', 'Rescom Parent Web Portal');
  c = c.replaceAll('KNR Parent Mobile App', 'Rescom Parent Mobile App');

  // Text references
  c = c.replaceAll("KNR's", "Rescom's");
  c = c.replaceAll("KNR’s", "Rescom’s");
  c = c.replaceAll('is KNR\'s', 'is Rescom\'s');
  c = c.replaceAll('it is KNR\'s', 'it is Rescom\'s');
  c = c.replaceAll('KNR empowers', 'Rescom empowers');
  c = c.replaceAll('KNR delivers', 'Rescom delivers');
  c = c.replaceAll('KNR bridges', 'Rescom bridges');
  c = c.replaceAll('KNR nurtures', 'Rescom nurtures');
  c = c.replaceAll('partner with KNR', 'partner with Rescom');
  c = c.replaceAll('Partner With KNR', 'Partner With Rescom');

  // Contact / URLs / Alts
  c = c.replaceAll('info@knrint.in', 'info@rescom.in');
  c = c.replaceAll('info@knrint.com', 'info@rescom.in');
  c = c.replaceAll('www.knrint.com', 'www.rescom.in');
  c = c.replaceAll('Visit knrint.com', 'Visit rescom.in');
  c = c.replaceAll('https://www.knrint.com', 'https://rescom.in');
  c = c.replaceAll('knrint.com', 'rescom.in');
  c = c.replaceAll('alt="KNR Logo"', 'alt="Rescom Logo"');
  c = c.replaceAll('alt="KNR Services"', 'alt="Rescom Services"');
  c = c.replaceAll('alt="KNR Tech Solutions"', 'alt="Rescom"');
  c = c.replaceAll('Official KNR Logo', 'Official Rescom Logo');
  c = c.replaceAll('>KNR</div>', '>RESCOM</div>');
  c = c.replaceAll('name: \'KNR-LEAP\'', 'name: \'RESCOM-LEAP\'');

  return c;
}

// 1. Update resources/views/presentations/knr-presentation.html
const mainKnrPath = path.join(rootDir, 'resources/views/presentations/knr-presentation.html');
let mainKnr = fs.readFileSync(mainKnrPath, 'utf8');
mainKnr = replaceInText(mainKnr);
fs.writeFileSync(mainKnrPath, mainKnr, 'utf8');
console.log('Updated resources/views/presentations/knr-presentation.html');

// Create rescom-presentation.html as a copy in resources/views/presentations/
const rescomPresPath = path.join(rootDir, 'resources/views/presentations/rescom-presentation.html');
fs.writeFileSync(rescomPresPath, mainKnr, 'utf8');
console.log('Created resources/views/presentations/rescom-presentation.html');

// Sync copies
const copies = [
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

copies.forEach(rel => {
  const p = path.join(rootDir, rel);
  fs.writeFileSync(p, mainKnr, 'utf8');
  console.log(`Synced: ${rel}`);
});

// Update all other presentation files in resources/views/presentations and public/presentations
const presentationFiles = [
  'leap-presentation.html',
  'mktcore-presentation.html',
  'parent-mobile-app-presentation.html',
  'parent-web-app-presentation.html',
  'relcore-presentation.html',
  'teacher-mobile-app-presentation.html',
  'teacher-web-app-presentation.html',
  'webcore-presentation.html',
  'edxcore-presentation.html',
  'isaakshi-presentation.html'
];

presentationFiles.forEach(pf => {
  const rPath = path.join(rootDir, 'resources/views/presentations', pf);
  if (fs.existsSync(rPath)) {
    let content = fs.readFileSync(rPath, 'utf8');
    content = replaceInText(content);
    fs.writeFileSync(rPath, content, 'utf8');
    console.log(`Updated resources/views/presentations/${pf}`);

    // Sync to public/presentations/
    const base = pf.replace('.html', '');
    const pFiles = [
      path.join(rootDir, 'public/presentations', pf),
      path.join(rootDir, 'public/presentations', base),
      path.join(rootDir, 'public/presentations', base.replace('-presentation', ''))
    ];
    pFiles.forEach(target => {
      fs.writeFileSync(target, content, 'utf8');
      console.log(`Synced to: ${path.relative(rootDir, target)}`);
    });
  }
});

console.log('All presentations updated and synced!');
