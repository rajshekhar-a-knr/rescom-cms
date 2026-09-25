# -*- coding: utf-8 -*-
import sys
import re
sys.path.insert(0, "scratch")
import icons as ic

# SLIDE 18
p18 = 'scratch/slides/slide_18.html'
t18 = open(p18, encoding='utf-8').read()
t18 = re.sub(
    r'<div style="width: 44px; height: 44px;[^>]*font-size: 1\.5rem; margin-bottom: 0\.8rem;">\s*\?\?\s*</div>\s*<h4[^>]*>Multi-Vendor Merchant Ecosystem</h4>',
    f'<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(52, 211, 153, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">\n          {ic.icon("store", 22, "#34D399")}\n        </div>\n        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Multi-Vendor Merchant Ecosystem</h4>',
    t18
)
open(p18, 'w', encoding='utf-8').write(t18)
print('Slide 18 remaining ??:', '??' in t18)

# SLIDE 23
p23 = 'scratch/slides/slide_23.html'
t23 = open(p23, encoding='utf-8').read()
t23 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">04\. Career</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("briefcase", 24, "#FBBF24")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">04. Career</div>',
    t23
)
t23 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">05\. Leadership</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("crown", 24, "#FBBF24")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">05. Leadership</div>',
    t23
)
open(p23, 'w', encoding='utf-8').write(t23)
print('Slide 23 remaining ??:', '??' in t23)

# SLIDE 25
p25 = 'scratch/slides/slide_25.html'
t25 = open(p25, encoding='utf-8').read()
t25 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">03\. Practice</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("code", 24, "#34D399")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Practice</div>',
    t25
)
t25 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?\?</div>\s*<div style="[^"]*">04\. Build</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("bot", 24, "#FBBF24")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">04. Build</div>',
    t25
)
open(p25, 'w', encoding='utf-8').write(t25)
print('Slide 25 remaining ??:', '??' in t25)
