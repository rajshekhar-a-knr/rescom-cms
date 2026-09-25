# -*- coding: utf-8 -*-
import sys
import re
sys.path.insert(0, "scratch")
import icons as ic

# SLIDE 18
p18 = 'scratch/slides/slide_18.html'
t18 = open(p18, encoding='utf-8').read()

t18 = re.sub(
    r'<div style="width: 44px; height: 44px;[^>]*font-size: 1\.5rem; margin-bottom: 0\.8rem;">\s*\?\?\s*</div>\s*<h4[^>]*>High-Velocity Storefront PWA</h4>',
    f'<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(52, 211, 153, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">\n          {ic.icon("mobile", 22, "#34D399")}\n        </div>\n        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">High-Velocity Storefront PWA</h4>',
    t18
)
t18 = re.sub(
    r'<div style="width: 44px; height: 44px;[^>]*font-size: 1\.5rem; margin-bottom: 0\.8rem;">\s*\?\?\s*</div>\s*<h4[^>]*>Smart Stock-Lock Cart &amp; Checkout</h4>',
    f'<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(52, 211, 153, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">\n          {ic.icon("cart", 22, "#34D399")}\n        </div>\n        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Smart Stock-Lock Cart &amp; Checkout</h4>',
    t18
)
t18 = re.sub(
    r'<div style="width: 44px; height: 44px;[^>]*font-size: 1\.5rem; margin-bottom: 0\.8rem;">\s*\?\?\s*</div>\s*<h4[^>]*>Multi-Vendor Merchant Portal</h4>',
    f'<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(52, 211, 153, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">\n          {ic.icon("store", 22, "#34D399")}\n        </div>\n        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Multi-Vendor Merchant Portal</h4>',
    t18
)
open(p18, 'w', encoding='utf-8').write(t18)
print('Slide 18 fixed. Remaining ??:', '??' in t18)

# SLIDE 19
p19 = 'scratch/slides/slide_19.html'
t19 = open(p19, encoding='utf-8').read()
t19 = t19.replace('<span>???</span> STOREFRONT &amp; CATALOG', f'{ic.icon("cart", 16, "#34D399")} STOREFRONT &amp; CATALOG')
t19 = t19.replace('<span>?</span> CART, PROMOS &amp; CHECKOUT', f'{ic.icon("zap", 16, "#FBBF24")} CART, PROMOS &amp; CHECKOUT')
t19 = t19.replace('<span>??</span> FINTECH &amp; LOGISTICS', f'{ic.icon("credit_card", 16, "#60A5FA")} FINTECH &amp; LOGISTICS')
t19 = t19.replace('<span>??</span> MULTI-VENDOR GOVERNANCE', f'{ic.icon("building", 16, "#C084FC")} MULTI-VENDOR GOVERNANCE')
open(p19, 'w', encoding='utf-8').write(t19)
print('Slide 19 fixed. Remaining ??:', '??' in t19)

# SLIDE 20
p20 = 'scratch/slides/slide_20.html'
t20 = open(p20, encoding='utf-8').read()
t20 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">01\. Merchant</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("store", 24, "#34D399")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">01. Merchant</div>',
    t20
)
t20 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">02\. Discovery</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("search", 24, "#60A5FA")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Discovery</div>',
    t20
)
t20 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">03\. Smart Cart</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("cart", 24, "#34D399")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">03. Smart Cart</div>',
    t20
)
t20 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">04\. FinTech</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("credit_card", 24, "#FBBF24")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. FinTech</div>',
    t20
)
t20 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">05\. Dispatch</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("rocket", 24, "#C084FC")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Dispatch</div>',
    t20
)
t20 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">06\. Settlement</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("award", 24, "#34D399")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">06. Settlement</div>',
    t20
)
t20 = t20.replace('<span>???</span> Shopper Experience', f'{ic.icon("user", 16, "#34D399")} Shopper Experience')
t20 = t20.replace('<span>??</span> Merchant Operations', f'{ic.icon("store", 16, "#34D399")} Merchant Operations')
t20 = t20.replace('<span>???</span> Platform Governance', f'{ic.icon("shield", 16, "#34D399")} Platform Governance')
open(p20, 'w', encoding='utf-8').write(t20)
print('Slide 20 fixed. Remaining ??:', '??' in t20)

# SLIDE 22
p22 = 'scratch/slides/slide_22.html'
t22 = open(p22, encoding='utf-8').read()
t22 = re.sub(
    r'<div style="width: 44px; height: 44px;[^>]*font-size: 1\.5rem; margin-bottom: 0\.8rem;">\s*\?\?\s*</div>\s*<div[^>]*>PILLAR 01</div>',
    f'<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245, 158, 11, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">\n          {ic.icon("briefcase", 22, "#F59E0B")}\n        </div>\n        <div style="font-size: 0.72rem; color: #FBBF24; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.2rem;">PILLAR 01</div>',
    t22
)
t22 = re.sub(
    r'<div style="width: 44px; height: 44px;[^>]*font-size: 1\.5rem; margin-bottom: 0\.8rem;">\s*\?\?\s*</div>\s*<div[^>]*>PILLAR 02</div>',
    f'<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(139, 92, 246, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">\n          {ic.icon("bot", 22, "#C084FC")}\n        </div>\n        <div style="font-size: 0.72rem; color: #C084FC; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.2rem;">PILLAR 02</div>',
    t22
)
t22 = re.sub(
    r'<div style="width: 44px; height: 44px;[^>]*font-size: 1\.5rem; margin-bottom: 0\.8rem;">\s*\?\?\s*</div>\s*<div[^>]*>PILLAR 03</div>',
    f'<div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">\n          {ic.icon("cap", 22, "#00F0FF")}\n        </div>\n        <div style="font-size: 0.72rem; color: var(--cyan); font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.2rem;">PILLAR 03</div>',
    t22
)
t22 = re.sub(r'<span style="font-size: 1\.3rem;">\?\?</span>', ic.icon("award", 20, "#FBBF24"), t22)
open(p22, 'w', encoding='utf-8').write(t22)
print('Slide 22 fixed. Remaining ??:', '??' in t22)

# SLIDE 23
p23 = 'scratch/slides/slide_23.html'
t23 = open(p23, encoding='utf-8').read()
t23 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">01\. Self</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("seedling", 24, "#34D399")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">01. Self</div>',
    t23
)
t23 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">02\. Skills</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("bulb", 24, "#60A5FA")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Skills</div>',
    t23
)
t23 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">03\. Confidence</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("target", 24, "#FBBF24")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">03. Confidence</div>',
    t23
)
t23 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">04\. Leadership</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("crown", 24, "#C084FC")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">04. Leadership</div>',
    t23
)
t23 = t23.replace('?? Emotional Intelligence (EQ)', f'{ic.icon("heart", 16, "#F87171")} Emotional Intelligence (EQ)')
t23 = t23.replace('?? Executive Presentation', f'{ic.icon("mic", 16, "#60A5FA")} Executive Presentation')
t23 = t23.replace('?? Workplace Collaboration', f'{ic.icon("user", 16, "#34D399")} Workplace Collaboration')
t23 = t23.replace('??? Industry Career Roadmaps', f'{ic.icon("map", 16, "#C084FC")} Industry Career Roadmaps')
open(p23, 'w', encoding='utf-8').write(t23)
print('Slide 23 fixed. Remaining ??:', '??' in t23)

# SLIDE 24
p24 = 'scratch/slides/slide_24.html'
t24 = open(p24, encoding='utf-8').read()
t24 = re.sub(
    r'<div style="width: 40px; height: 40px; border-radius: 10px; background: rgba\(139, 92, 246, 0\.2\); display: flex; align-items: center; justify-content: center; font-size: 1\.3rem;">\s*\?\?\s*</div>',
    f'<div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(139, 92, 246, 0.2); display: flex; align-items: center; justify-content: center;">{ic.icon("bot", 20, "#C084FC")}</div>',
    t24
)
t24 = re.sub(
    r'<div style="width: 40px; height: 40px; border-radius: 10px; background: rgba\(0, 240, 255, 0\.2\); display: flex; align-items: center; justify-content: center; font-size: 1\.3rem;">\s*\?\?\s*</div>',
    f'<div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center;">{ic.icon("cap", 20, "#00F0FF")}</div>',
    t24
)
t24 = re.sub(
    r'<div style="width: 40px; height: 40px; border-radius: 10px; background: rgba\(251, 191, 36, 0\.2\); display: flex; align-items: center; justify-content: center; font-size: 1\.3rem;">\s*\?\?\s*</div>',
    f'<div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(251, 191, 36, 0.2); display: flex; align-items: center; justify-content: center;">{ic.icon("cap", 20, "#FBBF24")}</div>',
    t24
)
open(p24, 'w', encoding='utf-8').write(t24)
print('Slide 24 fixed. Remaining ??:', '??' in t24)

# SLIDE 25
p25 = 'scratch/slides/slide_25.html'
t25 = open(p25, encoding='utf-8').read()
t25 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">01\. Discover</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("search", 24, "#00F0FF")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">01. Discover</div>',
    t25
)
t25 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">02\. Learn</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("book", 24, "#60A5FA")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Learn</div>',
    t25
)
t25 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">03\. Build</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("bot", 24, "#34D399")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Build</div>',
    t25
)
t25 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?\?</div>\s*<div style="[^"]*">04\. Test</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("target", 24, "#FBBF24")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Test</div>',
    t25
)
t25 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">05\. Demonstrate</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("mic", 24, "#C084FC")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Demonstrate</div>',
    t25
)
t25 = re.sub(
    r'<div style="font-size: 1\.5rem; margin-bottom: 0\.3rem;">\?\?</div>\s*<div style="[^"]*">06\. Grow</div>',
    f'<div style="margin-bottom: 0.4rem; display: flex; justify-content: center;">{ic.icon("rocket", 24, "#00F0FF")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">06. Grow</div>',
    t25
)
open(p25, 'w', encoding='utf-8').write(t25)
print('Slide 25 fixed. Remaining ??:', '??' in t25)
