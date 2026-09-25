# -*- coding: utf-8 -*-
import sys
import re
sys.path.insert(0, "scratch")
import icons as ic

# SLIDE 1
p1 = "scratch/slides/slide_01.html"
t1 = open(p1, encoding="utf-8").read()

# Replace emojis in slide 1
# Knowledge
t1 = re.sub(r'<div style="font-size: 1\.4rem; margin-bottom: 0\.25rem;">[^<]+</div>\s*<div style="font-family: var\(--font-display\); font-weight: 800; font-size: 0\.88rem; color: var\(--theme-accent\); letter-spacing: 0\.05em;">KNOWLEDGE</div>',
            f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("bulb", 24, "#00F0FF")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent); letter-spacing: 0.05em;">KNOWLEDGE</div>', t1)

# Network
t1 = re.sub(r'<div style="font-size: 1\.4rem; margin-bottom: 0\.25rem;">[^<]+</div>\s*<div style="font-family: var\(--font-display\); font-weight: 800; font-size: 0\.88rem; color: #60A5FA; letter-spacing: 0\.05em;">NETWORK</div>',
            f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("globe", 24, "#60A5FA")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA; letter-spacing: 0.05em;">NETWORK</div>', t1)

# Research
t1 = re.sub(r'<div style="font-size: 1\.4rem; margin-bottom: 0\.25rem;">[^<]+</div>\s*<div style="font-family: var\(--font-display\); font-weight: 800; font-size: 0\.88rem; color: #C084FC; letter-spacing: 0\.05em;">RESEARCH</div>',
            f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("compass", 24, "#C084FC")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC; letter-spacing: 0.05em;">RESEARCH</div>', t1)

# Technology
t1 = re.sub(r'<div style="font-size: 1\.4rem; margin-bottom: 0\.25rem;">[^<]+</div>\s*<div style="font-family: var\(--font-display\); font-weight: 800; font-size: 0\.88rem; color: #34D399; letter-spacing: 0\.05em;">TECHNOLOGY</div>',
            f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("cpu", 24, "#34D399")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399; letter-spacing: 0.05em;">TECHNOLOGY</div>', t1)

# People
t1 = re.sub(r'<div style="font-size: 1\.4rem; margin-bottom: 0\.25rem;">[^<]+</div>\s*<div style="font-family: var\(--font-display\); font-weight: 800; font-size: 0\.88rem; color: #FBBF24; letter-spacing: 0\.05em;">PEOPLE</div>',
            f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("user", 24, "#FBBF24")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24; letter-spacing: 0.05em;">PEOPLE</div>', t1)

# KNR Unified
t1 = re.sub(r'<div style="font-size: 1\.4rem; margin-bottom: 0\.25rem;">[^<]+</div>\s*<div style="font-family: var\(--font-display\); font-weight: 800; font-size: 0\.88rem; color: #FFF; letter-spacing: 0\.05em;">KNR UNIFIED</div>',
            f'<div style="margin-bottom: 0.35rem; display: flex; justify-content: center;">{ic.icon("rocket", 24, "#00F0FF")}</div>\n        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FFF; letter-spacing: 0.05em;">KNR UNIFIED</div>', t1)

# Flags in slide 1
t1 = re.sub(r'<div style="width: 40px; height: 40px; border-radius: 10px; background: rgba\(0, 240, 255, 0\.15\); display: flex; align-items: center; justify-content: center; font-size: 1\.25rem;">[^<]+</div>',
            f'<div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(0, 240, 255, 0.15); display: flex; align-items: center; justify-content: center;">{ic.icon("flag_in", 26)}</div>', t1)

t1 = re.sub(r'<div style="width: 40px; height: 40px; border-radius: 10px; background: rgba\(59, 130, 246, 0\.15\); display: flex; align-items: center; justify-content: center; font-size: 1\.25rem;">[^<]+</div>',
            f'<div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(59, 130, 246, 0.15); display: flex; align-items: center; justify-content: center;">{ic.icon("flag_au", 26)}</div>', t1)

open(p1, "w", encoding="utf-8").write(t1)
print("Slide 01 updated.")

# SLIDE 2
p2 = "scratch/slides/slide_02.html"
t2 = open(p2, encoding="utf-8").read()

# Replace emojis in services grid
t2 = re.sub(r'<span>[^<]+</span> Web Development', f'{ic.icon("code", 16, "#60A5FA")} Web Development', t2)
t2 = re.sub(r'<span>[^<]+</span> Mobile App Dev', f'{ic.icon("mobile", 16, "#34D399")} Mobile App Dev', t2)
t2 = re.sub(r'<span>[^<]+</span> Cloud & DevOps', f'{ic.icon("cloud", 16, "#00F0FF")} Cloud & DevOps', t2)
t2 = re.sub(r'<span>[^<]+</span> AI & Data Science', f'{ic.icon("bot", 16, "#C084FC")} AI & Data Science', t2)
t2 = re.sub(r'<span>[^<]+</span> Cybersecurity', f'{ic.icon("shield", 16, "#FBBF24")} Cybersecurity', t2)
t2 = re.sub(r'<span>[^<]+</span> UI/UX Design', f'{ic.icon("pen", 16, "#FFF")} UI/UX Design', t2)
t2 = re.sub(r'<span>[^<]+</span> Digital Transformation', f'{ic.icon("refresh", 16, "#60A5FA")} Digital Transformation', t2)
t2 = re.sub(r'<span>[^<]+</span> Growth & SEO', f'{ic.icon("megaphone", 16, "#34D399")} Growth & SEO', t2)
t2 = re.sub(r'<span>[^<]+</span> R&D & Innovation', f'{ic.icon("bulb", 16, "#00F0FF")} R&D & Innovation', t2)
t2 = re.sub(r'<span>[^<]+</span> 24/7 Managed SLA', f'{ic.icon("shield", 16, "#FBBF24")} 24/7 Managed SLA', t2)

open(p2, "w", encoding="utf-8").write(t2)
print("Slide 02 updated.")
