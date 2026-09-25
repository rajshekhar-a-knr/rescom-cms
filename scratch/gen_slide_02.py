import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

# SLIDE 02: PRODUCTS & SERVICES UNIFIED ECOSYSTEM OVERVIEW (WITH ALL LOGOS)
s2 = """
<section class="slide-item theme-knr" id="slide-2" data-index="2" data-section="01 // KNR PORTFOLIO" data-theme="theme-knr">
  <div class="product-watermark-bg" style="opacity: 0.025;">PORTFOLIO</div>
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 0.8rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot"></span>
          EXECUTIVE PORTFOLIO &bull; UNIFIED ENTERPRISE OFFERINGS
        </div>
        <h2 class="slide-title" style="margin-bottom: 0.15rem; font-size: clamp(1.6rem, 2.8vw, 2.6rem);">
          Flagship Products & Full-Spectrum Technology Services
        </h2>
      </div>
      <div style="text-align: right;">
        <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem; padding: 0.25rem 0.85rem;">6 Products &bull; 10 Service Domains</span>
      </div>
    </div>

    <p style="font-size: 0.84rem; color: var(--text-muted); margin-bottom: 0.85rem; line-height: 1.4;">
      KNR delivers a synchronized matrix of proprietary enterprise platforms alongside end-to-end digital transformation, cloud engineering, and cybersecurity services.
    </p>

    <!-- SECTION A: THE 6 FLAGSHIP PRODUCTS WITH LOGOS -->
    <div style="font-family: var(--font-mono); font-size: 0.7rem; font-weight: 800; color: var(--theme-accent); text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 0.4rem;">
      01. PROPRIETARY ENTERPRISE PLATFORMS
    </div>
    
    <div class="grid-6" style="gap: 0.75rem; margin-bottom: 1rem;">
      <!-- LEAP -->
      <div class="glass-card" style="padding: 0.8rem; text-align: center; border-color: rgba(56,189,248,0.4); cursor: pointer;" onclick="goToSlide(3)">
        <div style="width: 44px; height: 44px; border-radius: 10px; background: #FFFFFF; margin: 0 auto 0.4rem; padding: 3px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 12px rgba(56,189,248,0.35);">
          <img src="https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/kne..leap.jpg" alt="LEAP" style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.86rem; color: #38BDF8;">KNR-LEAP</div>
        <div style="font-size: 0.65rem; color: var(--text-muted); margin-top: 0.15rem;">School Operating System</div>
        <div style="margin-top: 0.35rem;"><span class="tech-tag" style="font-size: 0.6rem; padding: 0.1rem 0.45rem; color: #38BDF8; border-color: rgba(56,189,248,0.4);">26+3 Modules</span></div>
      </div>

      <!-- EDXCORE -->
      <div class="glass-card" style="padding: 0.8rem; text-align: center; border-color: rgba(192,132,252,0.4); cursor: pointer;" onclick="goToSlide(7)">
        <div style="width: 44px; height: 44px; border-radius: 10px; background: #FFFFFF; margin: 0 auto 0.4rem; padding: 3px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 12px rgba(192,132,252,0.35);">
          <img src="https://edxcore.knrint.com/images/image.png" alt="EDXcore" style="max-width: 100%; max-height: 100%; object-fit: contain;" onerror="this.src='https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_dea10753-7195-4728-8aee-a7e2d2856435_6.webp'">
        </div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.86rem; color: #C084FC;">EDXcore</div>
        <div style="font-size: 0.65rem; color: var(--text-muted); margin-top: 0.15rem;">Enterprise Cloud LMS</div>
        <div style="margin-top: 0.35rem;"><span class="tech-tag" style="font-size: 0.6rem; padding: 0.1rem 0.45rem; color: #C084FC; border-color: rgba(192,132,252,0.4);">10,000+ Scale</span></div>
      </div>

      <!-- RELCORE -->
      <div class="glass-card" style="padding: 0.8rem; text-align: center; border-color: rgba(129,140,248,0.4); cursor: pointer;" onclick="goToSlide(11)">
        <div style="width: 44px; height: 44px; border-radius: 10px; background: #FFFFFF; margin: 0 auto 0.4rem; padding: 3px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 12px rgba(129,140,248,0.35);">
          <img src="https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_5ca81605-0654-4ee7-ac04-412e675862e5_RELcore.webp" alt="RELcore" style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.86rem; color: #818CF8;">RELcore</div>
        <div style="font-size: 0.65rem; color: var(--text-muted); margin-top: 0.15rem;">CRM & Revenue Engine</div>
        <div style="margin-top: 0.35rem;"><span class="tech-tag" style="font-size: 0.6rem; padding: 0.1rem 0.45rem; color: #818CF8; border-color: rgba(129,140,248,0.4);">19 Modules</span></div>
      </div>

      <!-- WEBCORE -->
      <div class="glass-card" style="padding: 0.8rem; text-align: center; border-color: rgba(0,240,255,0.4); cursor: pointer;" onclick="goToSlide(15)">
        <div style="width: 44px; height: 44px; border-radius: 10px; background: #FFFFFF; margin: 0 auto 0.4rem; padding: 3px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 12px rgba(0,240,255,0.35);">
          <img src="https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/product_logos/Webcorebg.png" alt="WEBcore" style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.86rem; color: #00F0FF;">WEBcore</div>
        <div style="font-size: 0.65rem; color: var(--text-muted); margin-top: 0.15rem;">Modern Dynamic CMS</div>
        <div style="margin-top: 0.35rem;"><span class="tech-tag" style="font-size: 0.6rem; padding: 0.1rem 0.45rem; color: #00F0FF; border-color: rgba(0,240,255,0.4);">13 Modules</span></div>
      </div>

      <!-- MKTCORE -->
      <div class="glass-card" style="padding: 0.8rem; text-align: center; border-color: rgba(52,211,153,0.4); cursor: pointer;" onclick="goToSlide(19)">
        <div style="width: 44px; height: 44px; border-radius: 10px; background: #FFFFFF; margin: 0 auto 0.4rem; padding: 3px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 12px rgba(52,211,153,0.35);">
          <img src="https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/product_logos/MKTcore.png" alt="MKTcore" style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.86rem; color: #34D399;">MKTcore</div>
        <div style="font-size: 0.65rem; color: var(--text-muted); margin-top: 0.15rem;">Multi-Vendor Commerce</div>
        <div style="margin-top: 0.35rem;"><span class="tech-tag" style="font-size: 0.6rem; padding: 0.1rem 0.45rem; color: #34D399; border-color: rgba(52,211,153,0.4);">500+ Sellers</span></div>
      </div>

      <!-- SKILL DEVELOPMENT -->
      <div class="glass-card" style="padding: 0.8rem; text-align: center; border-color: rgba(251,191,36,0.4); cursor: pointer;" onclick="goToSlide(23)">
        <div style="width: 44px; height: 44px; border-radius: 10px; background: #FFFFFF; margin: 0 auto 0.4rem; padding: 3px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 12px rgba(251,191,36,0.35);">
          <img src="https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_581aabf1-8244-49b1-bcad-1b6dbdfb26a9_Screenshot_2026-05-25_100002.webp" alt="Skill Dev" style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.86rem; color: #FBBF24;">SKILL DEV</div>
        <div style="font-size: 0.65rem; color: var(--text-muted); margin-top: 0.15rem;">Robotics & CBSE Voc.</div>
        <div style="margin-top: 0.35rem;"><span class="tech-tag" style="font-size: 0.6rem; padding: 0.1rem 0.45rem; color: #FBBF24; border-color: rgba(251,191,36,0.4);">3 Pillars</span></div>
      </div>
    </div>

    <!-- SECTION B: ALL SERVICES IN THE WEBSITE GIVEN -->
    <div style="font-family: var(--font-mono); font-size: 0.7rem; font-weight: 800; color: #60A5FA; text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 0.4rem;">
      02. FULL-SPECTRUM TECHNOLOGY & INNOVATION SERVICES
    </div>

    <div class="grid-5" style="gap: 0.6rem;">
      <div class="glass-card" style="padding: 0.7rem 0.8rem;">
        <div style="font-weight: 800; font-size: 0.76rem; color: #FFF; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem;">
          <span>💻</span> Web Development
        </div>
        <div style="font-size: 0.66rem; color: var(--text-muted);">Custom enterprise web apps, Laravel, React, APIs.</div>
      </div>

      <div class="glass-card" style="padding: 0.7rem 0.8rem;">
        <div style="font-weight: 800; font-size: 0.76rem; color: #FFF; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem;">
          <span>📱</span> Mobile App Dev
        </div>
        <div style="font-size: 0.66rem; color: var(--text-muted);">Native iOS, Android, Flutter & React Native.</div>
      </div>

      <div class="glass-card" style="padding: 0.7rem 0.8rem;">
        <div style="font-weight: 800; font-size: 0.76rem; color: #FFF; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem;">
          <span>☁️</span> Cloud & DevOps
        </div>
        <div style="font-size: 0.66rem; color: var(--text-muted);">AWS, Azure, GCP, Docker, Kubernetes & CI/CD.</div>
      </div>

      <div class="glass-card" style="padding: 0.7rem 0.8rem;">
        <div style="font-weight: 800; font-size: 0.76rem; color: #FFF; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem;">
          <span>🤖</span> AI & Data Science
        </div>
        <div style="font-size: 0.66rem; color: var(--text-muted);">Custom ML models, Computer Vision, NLP & LLMs.</div>
      </div>

      <div class="glass-card" style="padding: 0.7rem 0.8rem;">
        <div style="font-weight: 800; font-size: 0.76rem; color: #FFF; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem;">
          <span>🛡️</span> Cybersecurity
        </div>
        <div style="font-size: 0.66rem; color: var(--text-muted);">Penetration testing, vulnerability audits, ISO 27001.</div>
      </div>

      <div class="glass-card" style="padding: 0.7rem 0.8rem;">
        <div style="font-weight: 800; font-size: 0.76rem; color: #FFF; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem;">
          <span>🎨</span> UI/UX Design
        </div>
        <div style="font-size: 0.66rem; color: var(--text-muted);">User research, wireframing, design systems & WCAG.</div>
      </div>

      <div class="glass-card" style="padding: 0.7rem 0.8rem;">
        <div style="font-weight: 800; font-size: 0.76rem; color: #FFF; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem;">
          <span>🔄</span> Digital Transformation
        </div>
        <div style="font-size: 0.66rem; color: var(--text-muted);">Workflow automation & enterprise legacy upgrade.</div>
      </div>

      <div class="glass-card" style="padding: 0.7rem 0.8rem;">
        <div style="font-weight: 800; font-size: 0.76rem; color: #FFF; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem;">
          <span>📈</span> Growth & SEO
        </div>
        <div style="font-size: 0.66rem; color: var(--text-muted);">Technical SEO, content strategy, Google/Meta Ads.</div>
      </div>

      <div class="glass-card" style="padding: 0.7rem 0.8rem;">
        <div style="font-weight: 800; font-size: 0.76rem; color: #FFF; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem;">
          <span>🔬</span> R&D & Innovation
        </div>
        <div style="font-size: 0.66rem; color: var(--text-muted);">Emerging tech R&D, rapid MVPs & corporate labs.</div>
      </div>

      <div class="glass-card" style="padding: 0.7rem 0.8rem;">
        <div style="font-weight: 800; font-size: 0.76rem; color: #FFF; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem;">
          <span>⚡</span> 24/7 Managed SLA
        </div>
        <div style="font-size: 0.66rem; color: var(--text-muted);">Proactive monitoring, patching & cloud operations.</div>
      </div>
    </div>
  </div>
</section>
"""

write_slide(2, s2)
