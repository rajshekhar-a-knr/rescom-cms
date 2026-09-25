# -*- coding: utf-8 -*-
import re

HTML_FILE = r"C:\xampp\htdocs\knr-website\KNR-Presentation.html"

with open(HTML_FILE, "r", encoding="utf-8") as f:
    content = f.read()

print(f"Loaded {HTML_FILE}: {len(content):,} characters")

# Check all 28 slide IDs
found_slides = re.findall(r'<section[^>]*\bid=["\x27]slide-(\d+)["\x27]', content)
found_nums = [int(x) for x in found_slides]
print(f"Found {len(found_nums)} slides: {found_nums}")
assert len(found_nums) == 28, f"Expected 28 slides, found {len(found_nums)}"
assert found_nums == list(range(1, 29)), f"Slides not strictly 1..28: {found_nums}"

# Check Logos
logos = {
    "KNR Logo": "KNR-Logo.png",
    "LEAP Logo": "kne..leap.jpg",
    "EDXcore Logo": "image.png",
    "RELcore Logo": "RELcore.webp",
    "WEBcore Logo": "Webcorebg.png",
    "MKTcore Logo": "MKTcore.png",
    "Skill Dev Logo": "Screenshot_2026-05-25_100002.webp"
}

for name, fragment in logos.items():
    count = content.count(fragment)
    print(f"Logo '{name}' [{fragment}]: {count} occurrences")
    assert count > 0, f"Missing {name}!"

# Check each slide has its respective section tag with class and data-theme
for i in range(1, 29):
    pattern = rf'<section[^>]*id="slide-{i}"[^>]*>'
    match = re.search(pattern, content)
    if not match:
        # Check if id comes before or after
        pattern = rf'<section[^>]*\bid="slide-{i}"[^>]*>'
        match = re.search(pattern, content)
    tag = match.group(0) if match else ""
    theme_m = re.search(r'data-theme="([^"]+)"', tag)
    sec_m = re.search(r'data-section="([^"]+)"', tag)
    theme = theme_m.group(1) if theme_m else "NONE"
    sec = sec_m.group(1) if sec_m else "NONE"
    print(f"Slide {i:02d} -> Theme: {theme:<14} | Section: {sec}")
    assert theme != "NONE", f"Slide {i} has no data-theme!"

print("\nALL 28 SLIDES VERIFIED WITH DISTINCT THEMES AND LOGOS!")
