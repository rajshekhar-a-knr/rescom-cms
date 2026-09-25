const fs = require('fs');

let content = fs.readFileSync('database/kntrint_complete.sql', 'utf8');

content = content.replaceAll('KNR International', 'Rescom');
content = content.replaceAll('KNR tech solutions pvt ltd', 'Rescom');
content = content.replaceAll('KNR Tech Solutions', 'Rescom');
content = content.replaceAll('KNR TECH SOLUTIONS', 'Rescom');
content = content.replaceAll("KNR''s", "Rescom''s");
content = content.replaceAll("KNR's", "Rescom's");
content = content.replaceAll("with KNR", "with Rescom");
content = content.replaceAll("Contact KNR", "Contact Rescom");
content = content.replaceAll("admin@knrint.in", "admin@rescom.in");
content = content.replaceAll("manager@knrint.in", "manager@rescom.in");
content = content.replaceAll("info@knrint.in", "info@rescom.in");
content = content.replaceAll("knrint_cms", "rescom_cms");
content = content.replaceAll("knrint", "rescom");

fs.writeFileSync('database/kntrint_complete.sql', content, 'utf8');
console.log('Updated database/kntrint_complete.sql');
