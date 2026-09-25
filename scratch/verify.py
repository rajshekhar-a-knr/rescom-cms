with open(r"C:\xampp\htdocs\knr-website\KNR-Presentation.html", "r", encoding="utf-8") as f:
    content = f.read()

import re
slide_matches = re.findall(r'id="slide-(\d+)"', content)
print(f"Total slide IDs found: {len(slide_matches)}")
print(f"Slide numbers: {slide_matches}")

assert len(slide_matches) == 28, "Should have exactly 28 slides"
for i in range(1, 29):
    assert str(i) in slide_matches, f"Missing slide {i}"
print("Slide ID test PASSED: Exactly 28 slides from slide-1 to slide-28.")

# Check for key sections
sections = [
    "KNR INTRODUCTION",
    "LEAP",
    "EDXCORE",
    "RELCORE",
    "WEBCORE",
    "MKTCORE",
    "SKILL DEVELOPMENT",
    "SERVICES",
    "THANK YOU"
]

for sec in sections:
    assert sec in content, f"Missing section keyword: {sec}"
print("All major sections verified in content.")

# Verify authentic addresses & contact
assert "233, Rahul Building, 6th Main Road" in content
assert "Melbourne, VIC 3004" in content
assert "+91 98459 19158" in content
assert "info@knrint.in" in content
assert "www.knrint.com" in content
print("All official contact details verified.")
