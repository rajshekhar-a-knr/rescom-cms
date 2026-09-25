# -*- coding: utf-8 -*-
import sys
import re
sys.path.insert(0, "scratch")
import icons as ic

# SLIDE 26
p26 = 'scratch/slides/slide_26.html'
t26 = open(p26, encoding='utf-8').read()

# Web & Digital Products
t26 = t26.replace(
    '<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA;">?? WEB &amp; DIGITAL PRODUCTS</div>\n          <span style="font-size: 1.1rem;">??</span>',
    f'<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA; display: flex; align-items: center; gap: 0.4rem;">{ic.icon("code", 18, "#60A5FA")} WEB &amp; DIGITAL PRODUCTS</div>\n          <span>{ic.icon("globe", 18, "#60A5FA")}</span>'
)

# Mobile App Dev
t26 = t26.replace(
    '<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399;">?? MOBILE APPLICATION DEV</div>\n          <span style="font-size: 1.1rem;">??</span>',
    f'<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; display: flex; align-items: center; gap: 0.4rem;">{ic.icon("mobile", 18, "#34D399")} MOBILE APPLICATION DEV</div>\n          <span>{ic.icon("sparkles", 18, "#34D399")}</span>'
)

# Cloud & DevOps
t26 = t26.replace(
    '<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: var(--theme-accent);">?? CLOUD &amp; DEVOPS INFRA</div>\n          <span style="font-size: 1.1rem;">?</span>',
    f'<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: var(--theme-accent); display: flex; align-items: center; gap: 0.4rem;">{ic.icon("cloud", 18, "#38BDF8")} CLOUD &amp; DEVOPS INFRA</div>\n          <span>{ic.icon("zap", 18, "#38BDF8")}</span>'
)

# AI, ML & Data Science
t26 = t26.replace(
    '<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC;">?? AI, ML &amp; DATA SCIENCE</div>\n          <span style="font-size: 1.1rem;">??</span>',
    f'<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; display: flex; align-items: center; gap: 0.4rem;">{ic.icon("bot", 18, "#C084FC")} AI, ML &amp; DATA SCIENCE</div>\n          <span>{ic.icon("cpu", 18, "#C084FC")}</span>'
)

# Cybersecurity & Audit
t26 = t26.replace(
    '<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24;">??? CYBERSECURITY &amp; AUDIT</div>\n          <span style="font-size: 1.1rem;">??</span>',
    f'<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; display: flex; align-items: center; gap: 0.4rem;">{ic.icon("shield", 18, "#FBBF24")} CYBERSECURITY &amp; AUDIT</div>\n          <span>{ic.icon("lock", 18, "#FBBF24")}</span>'
)

# UI/UX Design Systems
t26 = t26.replace(
    '<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FFF;">?? UI/UX DESIGN SYSTEMS</div>\n          <span style="font-size: 1.1rem;">?</span>',
    f'<div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FFF; display: flex; align-items: center; gap: 0.4rem;">{ic.icon("pen", 18, "#FFF")} UI/UX DESIGN SYSTEMS</div>\n          <span>{ic.icon("sparkles", 18, "#FFF")}</span>'
)

open(p26, 'w', encoding='utf-8').write(t26)
print('Slide 26 remaining ??:', '??' in t26)

# SLIDE 27
p27 = 'scratch/slides/slide_27.html'
t27 = open(p27, encoding='utf-8').read()

# Flow step icons
t27 = re.sub(
    r'<div style="font-size: 1\.4rem; margin-bottom: 0\.2rem;">\?\?</div>\s*<div style="[^"]*">01\. IDEA</div>',
    f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("bulb", 22, "#38BDF8")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: var(--theme-accent);">01. IDEA</div>',
    t27
)
t27 = re.sub(
    r'<div style="font-size: 1\.4rem; margin-bottom: 0\.2rem;">\?\?</div>\s*<div style="[^"]*">02\. STRATEGY</div>',
    f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("compass", 22, "#60A5FA")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #60A5FA;">02. STRATEGY</div>',
    t27
)
t27 = re.sub(
    r'<div style="font-size: 1\.4rem; margin-bottom: 0\.2rem;">\?\?</div>\s*<div style="[^"]*">03\. DESIGN</div>',
    f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("pen", 22, "#34D399")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #34D399;">03. DESIGN</div>',
    t27
)
t27 = re.sub(
    r'<div style="font-size: 1\.4rem; margin-bottom: 0\.2rem;">\?\?</div>\s*<div style="[^"]*">04\. BUILD</div>',
    f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("code", 22, "#FBBF24")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #FBBF24;">04. BUILD</div>',
    t27
)
t27 = re.sub(
    r'<div style="font-size: 1\.4rem; margin-bottom: 0\.2rem;">\?\?</div>\s*<div style="[^"]*">05\. DEPLOY</div>',
    f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("rocket", 22, "#C084FC")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #C084FC;">05. DEPLOY</div>',
    t27
)
t27 = re.sub(
    r'<div style="font-size: 1\.4rem; margin-bottom: 0\.2rem;">\?\?</div>\s*<div style="[^"]*">06\. GROWTH</div>',
    f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("chart", 22, "#38BDF8")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: var(--theme-accent);">06. GROWTH</div>',
    t27
)

# Strategic consulting cards
t27 = t27.replace('?? DIGITAL TRANSFORMATION', f'{ic.icon("refresh", 16, "#60A5FA")} DIGITAL TRANSFORMATION')
t27 = t27.replace('?? GROWTH &amp; DIGITAL MARKETING', f'{ic.icon("megaphone", 16, "#34D399")} GROWTH &amp; DIGITAL MARKETING')
t27 = t27.replace('?? R&amp;D, INNOVATION &amp; MVPS', f'{ic.icon("bulb", 16, "#38BDF8")} R&amp;D, INNOVATION &amp; MVPS')
t27 = t27.replace('?? INSTITUTIONAL &amp; EDTECH', f'{ic.icon("cap", 16, "#FBBF24")} INSTITUTIONAL &amp; EDTECH')
t27 = t27.replace('?? TECHNOLOGY ADVISORY', f'{ic.icon("compass", 16, "#C084FC")} TECHNOLOGY ADVISORY')
t27 = t27.replace('??? 24/7 MANAGED OPERATIONS', f'{ic.icon("shield", 16, "#FFFFFF")} 24/7 MANAGED OPERATIONS')

open(p27, 'w', encoding='utf-8').write(t27)
print('Slide 27 remaining ??:', '??' in t27)

# SLIDE 28
p28 = 'scratch/slides/slide_28.html'
t28 = open(p28, encoding='utf-8').read()

# Country badges & flags
t28 = t28.replace('<span style="font-size: 1.5rem;">????</span>', ic.icon("flag_in", 24))
# Wait, let's make sure it replaces the Australia one too
# Notice Slide 28 has both flags as ????
t28 = re.sub(
    r'<span style="font-size: 1\.5rem;">\?\?\?\?</span>\s*<div>\s*<div style="[^"]*">INDIA HEADQUARTERS</div>',
    f'{ic.icon("flag_in", 28)}\n            <div>\n              <div style="font-size: 0.7rem; color: #38BDF8; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;">INDIA HEADQUARTERS</div>',
    t28
)
t28 = re.sub(
    r'<span style="font-size: 1\.5rem;">\?\?\?\?</span>\s*<div>\s*<div style="[^"]*">AUSTRALIA CORPORATE</div>',
    f'{ic.icon("flag_au", 28)}\n            <div>\n              <div style="font-size: 0.7rem; color: #818CF8; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;">AUSTRALIA CORPORATE</div>',
    t28
)

# Phone and email icons
t28 = t28.replace('?? <strong>+91 98459 19158</strong>', f'{ic.icon("phone", 14, "#FFF")} <strong>+91 98459 19158</strong>')
t28 = t28.replace('?? <strong>+61 499 888 442</strong>', f'{ic.icon("phone", 14, "#FFF")} <strong>+61 499 888 442</strong>')
t28 = t28.replace('?? <strong>info@knrint.in</strong>', f'{ic.icon("mail", 14, "#38BDF8")} <strong>info@knrint.in</strong>')

open(p28, 'w', encoding='utf-8').write(t28)
print('Slide 28 remaining ??:', '??' in t28)
