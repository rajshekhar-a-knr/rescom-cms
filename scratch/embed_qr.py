# -*- coding: utf-8 -*-
import re
import qrcode
import qrcode.image.svg

# Generate SVG QR code with border=2
factory = qrcode.image.svg.SvgPathImage
img = qrcode.make("https://www.knrint.com/", image_factory=factory, border=2)
svg_str = img.to_string(encoding="unicode")

vb_match = re.search(r'viewBox="([^"]+)"', svg_str)
path_match = re.search(r'd="([^"]+)"', svg_str)

vb = vb_match.group(1) if vb_match else "0 0 29 29"
path_d = path_match.group(1) if path_match else ""

print("Generated QR for https://www.knrint.com/")
print("ViewBox:", vb)
print("Path data points length:", len(path_d))

p28 = "scratch/slides/slide_28.html"
with open(p28, "r", encoding="utf-8") as f:
    t28 = f.read()

old_svg_pattern = r'<svg viewBox="0 0 29 29"[^>]*>[\s\S]*?</svg>'
new_svg = f'<svg viewBox="{vb}" width="100%" height="100%" style="shape-rendering: crispEdges;"><path fill="#040714" d="{path_d}"/></svg>'

new_t28, count = re.subn(old_svg_pattern, new_svg, t28)
print(f"Substitutions made in slide_28.html: {count}")
assert count > 0, "Failed to replace QR in slide_28.html"

with open(p28, "w", encoding="utf-8") as f:
    f.write(new_t28)

print("slide_28.html updated successfully with genuine QR code.")
