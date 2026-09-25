import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

# =========================================================================
# SLIDE 26: KNR TECHNOLOGY SERVICES
# =========================================================================
s26 = """
<section class="slide-item" id="slide-26" data-index="26" data-section="03 // KNR SERVICES">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.1rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--primary);"></span>
          SECTION 03 • TECHNOLOGY CAPABILITY MAP
        </div>
        <h2 class="slide-title">
          KNR Technology Engineering Services
        </h2>
      </div>
      <div style="text-align: right;">
        <span style="font-family: var(--font-mono); font-size: 0.85rem; color: #60A5FA; font-weight: 700;">Full-Spectrum Digital Capabilities</span>
      </div>
    </div>

    <!-- 6 Consolidated Technology Domains -->
    <div class="grid-3" style="gap: 1rem;">
      <div class="glass-card glass-card-glow-primary">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #60A5FA;">💻 WEB & DIGITAL PRODUCTS</div>
          <span style="font-size: 1.2rem;">🌐</span>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.6rem;">
          High-performance custom web applications, multi-tenant enterprise portals, REST APIs, and microservices architecture.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">Laravel</span>
          <span class="tech-tag">React</span>
          <span class="tech-tag">Vue.js</span>
          <span class="tech-tag">Node.js</span>
          <span class="tech-tag">PostgreSQL</span>
          <span class="tech-tag">Redis</span>
        </div>
      </div>

      <div class="glass-card glass-card-glow-emerald">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #34D399;">📱 MOBILE APPLICATION DEV</div>
          <span style="font-size: 1.2rem;">📲</span>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.6rem;">
          Native and cross-platform mobile apps for iOS and Android with offline synchronization, real-time push notifications, and biometric security.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">iOS / Swift</span>
          <span class="tech-tag">Android / Kotlin</span>
          <span class="tech-tag">Flutter</span>
          <span class="tech-tag">React Native</span>
        </div>
      </div>

      <div class="glass-card glass-card-glow-cyan">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: var(--cyan);">☁️ CLOUD & DEVOPS INFRA</div>
          <span style="font-size: 1.2rem;">⚡</span>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.6rem;">
          Zero-downtime cloud infrastructure migration, container orchestration, automated CI/CD deployment pipelines, and cost optimization.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">AWS</span>
          <span class="tech-tag">Azure</span>
          <span class="tech-tag">GCP</span>
          <span class="tech-tag">Docker</span>
          <span class="tech-tag">Kubernetes</span>
          <span class="tech-tag">Terraform</span>
        </div>
      </div>

      <div class="glass-card glass-card-glow-purple">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #C084FC;">🤖 AI, ML & DATA SCIENCE</div>
          <span style="font-size: 1.2rem;">🧠</span>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.6rem;">
          Custom machine learning models, predictive intelligence, computer vision pipelines, natural language processing, and AI chatbots.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">Python</span>
          <span class="tech-tag">TensorFlow</span>
          <span class="tech-tag">PyTorch</span>
          <span class="tech-tag">Computer Vision</span>
          <span class="tech-tag">NLP</span>
        </div>
      </div>

      <div class="glass-card glass-card-glow-amber">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FBBF24;">🛡️ CYBERSECURITY & AUDIT</div>
          <span style="font-size: 1.2rem;">🔒</span>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.6rem;">
          Certified penetration testing, web and mobile security audits, vulnerability assessments, network defense, and compliance reviews.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">OWASP</span>
          <span class="tech-tag">Penetration Testing</span>
          <span class="tech-tag">ISO 27001</span>
          <span class="tech-tag">Vulnerability Audit</span>
        </div>
      </div>

      <div class="glass-card" style="border-color: rgba(255,255,255,0.2);">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FFF;">🎨 UI/UX DESIGN SYSTEMS</div>
          <span style="font-size: 1.2rem;">✨</span>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.6rem;">
          Human-centric user research, high-fidelity wireframes, interactive clickable prototypes, design systems, and WCAG accessibility standards.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">Figma</span>
          <span class="tech-tag">Design Systems</span>
          <span class="tech-tag">Prototyping</span>
          <span class="tech-tag">WCAG 2.1</span>
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 27: KNR BUSINESS & INNOVATION SERVICES
# =========================================================================
s27 = """
<section class="slide-item" id="slide-27" data-index="27" data-section="03 // KNR SERVICES">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.1rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--primary);"></span>
          SECTION 03 • BUSINESS, DIGITAL & INNOVATION SERVICES
        </div>
        <h2 class="slide-title">
          Strategic Digital Transformation Architecture
        </h2>
      </div>
      <div style="text-align: right;">
        <span style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--cyan); font-weight: 700;">From Inception To Scale</span>
      </div>
    </div>

    <!-- Visual Architecture Flow: IDEA -> STRATEGY -> DESIGN -> DEVELOPMENT -> DEPLOYMENT -> GROWTH -->
    <div class="flow-container" style="margin: 1.3rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">💡</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: var(--cyan);">01. IDEA</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">Discovery & Scoping</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">🧭</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #60A5FA;">02. STRATEGY</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">Roadmap & Architecture</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">🎨</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #34D399;">03. DESIGN</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">UI/UX & Prototyping</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">⚙️</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #FBBF24;">04. BUILD</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">Agile Engineering</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">🚀</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #C084FC;">05. DEPLOY</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">Cloud CI/CD & Launch</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step" style="border-color: var(--cyan); background: rgba(0, 240, 255, 0.08);">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">📈</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: var(--cyan);">06. GROWTH</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">SEO & Managed SLA</div>
      </div>
    </div>

    <!-- 6 Consolidated Strategic Consulting Areas -->
    <div class="grid-3" style="gap: 0.9rem; margin-top: 0.6rem;">
      <div class="glass-card">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #60A5FA; margin-bottom: 0.35rem;">
          🔄 DIGITAL TRANSFORMATION
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Enterprise workflow automation, legacy modernization, paperless transition, and end-to-end operational re-engineering.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #34D399; margin-bottom: 0.35rem;">
          📈 GROWTH & DIGITAL MARKETING
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Data-driven technical SEO audits, high-intent Google Ads management, social campaigns, and performance conversion tracking.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: var(--cyan); margin-bottom: 0.35rem;">
          🔬 R&D, INNOVATION & MVPS
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Emerging technology exploration, fast proof-of-concept (PoC) builds, and corporate venture MVP validation programs.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #FBBF24; margin-bottom: 0.35rem;">
          🎓 INSTITUTIONAL & EDTECH
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Complete school digital ecosystems, CBSE vocational lab setups, robotics maker spaces, and educator training bootcamps.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #C084FC; margin-bottom: 0.35rem;">
          🧭 TECHNOLOGY ADVISORY
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Strategic CTO advisory, technology roadmap planning, vendor selection, software architecture audits, and risk assessment.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.35rem;">
          🛡️ 24/7 MANAGED OPERATIONS
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Proactive infrastructure maintenance, automated backup routines, security vulnerability patching, and strict SLA compliance.
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 28: CLOSING / THANK YOU & CONTACT
# =========================================================================
s28 = """
<section class="slide-item" id="slide-28" data-index="28" data-section="04 // THANK YOU">
  <div class="slide-container" style="text-align: center; align-items: center; justify-content: center;">
    <div class="slide-eyebrow" style="color: var(--cyan);">
      <span class="hud-pulse-dot" style="background: var(--cyan);"></span>
      THE KNR PARTNERSHIP
    </div>
    
    <h1 class="slide-title" style="font-size: clamp(2.6rem, 5.5vw, 4.6rem); margin-bottom: 0.5rem;">
      THANK YOU
    </h1>
    
    <div style="font-family: var(--font-display); font-size: clamp(1.2rem, 2.4vw, 1.8rem); font-weight: 700; color: #FFF; margin-bottom: 1.4rem;">
      Let&rsquo;s build what comes next.
    </div>

    <!-- Final Brand Philosophy Climax Box -->
    <div class="glass-card" style="background: linear-gradient(135deg, rgba(14,22,54,0.9), rgba(22,36,80,0.85)); border-color: var(--cyan); padding: 1.4rem 2rem; max-width: 960px; margin-bottom: 1.8rem; box-shadow: 0 0 35px rgba(0,240,255,0.2);">
      <div style="font-family: var(--font-display); font-size: clamp(0.95rem, 1.6vw, 1.35rem); font-weight: 800; line-height: 1.6; letter-spacing: 0.04em;">
        <span style="color: var(--cyan);">KNOWLEDGE CREATES POSSIBILITY.</span> &nbsp;&bull;&nbsp;
        <span style="color: #60A5FA;">TECHNOLOGY CREATES SCALE.</span><br>
        <span style="color: #FBBF24;">PEOPLE CREATE IMPACT.</span> &nbsp;&bull;&nbsp;
        <span style="color: #FFF; text-shadow: 0 0 10px rgba(255,255,255,0.8);">KNR CONNECTS THEM ALL.</span>
      </div>
    </div>

    <!-- Global Corporate Locations Grid -->
    <div class="grid-3" style="width: 100%; max-width: 1200px; text-align: left; align-items: stretch; margin-bottom: 1.2rem;">
      <!-- INDIA HEADQUARTERS -->
      <div class="glass-card glass-card-glow-cyan" style="display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <div style="display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.7rem;">
            <span style="font-size: 1.5rem;">🇮🇳</span>
            <div>
              <div style="font-size: 0.72rem; color: var(--cyan); font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;">INDIA HEADQUARTERS</div>
              <div style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF;">KNR Tech Solutions Pvt. Ltd.</div>
            </div>
          </div>
          <div style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.55;">
            233, Rahul Building, 6th Main Road,<br>
            Rajajinagar Industrial Town, Rajajinagar,<br>
            Bengaluru, Karnataka – 560044, India
          </div>
        </div>
        <div style="margin-top: 0.9rem; padding-top: 0.8rem; border-top: 1px solid rgba(255,255,255,0.1); font-size: 0.76rem;">
          <div style="color: #FFF; margin-bottom: 0.2rem;">📞 <strong>+91 98459 19158</strong></div>
          <div style="color: var(--cyan);">✉️ <strong>info@knrint.in</strong></div>
        </div>
      </div>

      <!-- AUSTRALIA CORPORATE OFFICE -->
      <div class="glass-card glass-card-glow-primary" style="display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <div style="display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.7rem;">
            <span style="font-size: 1.5rem;">🇦🇺</span>
            <div>
              <div style="font-size: 0.72rem; color: #60A5FA; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;">AUSTRALIA CORPORATE</div>
              <div style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF;">KNR Corporate Office</div>
            </div>
          </div>
          <div style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.55;">
            ACN: 633 276 178<br>
            Suite 319, 1 Queens Road, St Kilda Road Towers,<br>
            Melbourne, VIC 3004, Australia
          </div>
        </div>
        <div style="margin-top: 0.9rem; padding-top: 0.8rem; border-top: 1px solid rgba(255,255,255,0.1); font-size: 0.76rem;">
          <div style="color: #FFF; margin-bottom: 0.2rem;">📞 <strong>+61 499 888 442</strong> &bull; <strong>+61 484 585 999</strong></div>
          <div style="color: #60A5FA;">✉️ <strong>info@knrint.in</strong></div>
        </div>
      </div>

      <!-- DIGITAL HUB & QR CODE -->
      <div class="glass-card glass-card-glow-purple" style="display: flex; align-items: center; justify-content: space-between; gap: 1rem;">
        <div style="flex: 1;">
          <div style="font-size: 0.72rem; color: #C084FC; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.3rem;">DIGITAL PORTAL</div>
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 1.05rem; color: #FFF; margin-bottom: 0.4rem;">www.knrint.com</div>
          <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45; margin-bottom: 0.6rem;">
            Explore interactive live product portals, demos & enterprise case studies.
          </div>
          <a href="https://www.knrint.com" target="_blank" rel="noopener noreferrer" class="tech-tag tech-tag-cyan" style="font-size: 0.74rem; text-decoration: none; padding: 0.35rem 0.8rem;">
            Visit knrint.com ↗
          </a>
        </div>
        <div style="width: 88px; height: 88px; background: #FFF; border-radius: 12px; padding: 6px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 20px rgba(0,240,255,0.3); flex-shrink: 0;">
          <!-- SVG QR Code representing knrint.com -->
          <svg viewBox="0 0 29 29" width="100%" height="100%" style="shape-rendering: crispEdges;">
            <path fill="#000" d="M0 0h7v7H0zM2 2h3v3H2zM22 0h7v7h-7zM24 2h3v3h-3zM0 22h7v7H0zM2 24h3v3H2zM9 1h1v1H9zM12 1h2v1h-2zM16 1h2v2h-1v1h-1zM19 1h1v1h-1zM9 3h2v1H9zM13 3h1v1h-1zM18 3h1v2h-1zM10 5h1v1h-1zM12 5h1v2h-1zM15 5h2v1h-2zM9 7h1v1H9zM14 7h1v2h-1zM17 7h1v1h-1zM1 9h1v1H1zM4 9h2v1H4zM8 9h2v1H8zM11 9h1v1h-1zM16 9h3v1h-3zM21 9h2v1h-2zM25 9h1v1h-1zM28 9h1v1h-1zM1 11h1v2H1zM3 11h3v1H3zM8 11h1v2H8zM11 11h2v1h-2zM15 11h1v2h-1zM18 11h2v1h-2zM22 11h2v1h-2zM26 11h2v1h-2zM4 13h1v1H4zM7 13h1v2H7zM10 13h2v1h-2zM13 13h1v1h-1zM17 13h1v2h-1zM20 13h3v1h-3zM25 13h1v1h-1zM27 13h2v1h-2zM1 15h2v1H1zM5 15h1v1H5zM9 15h1v1H9zM12 15h1v1h-1zM14 15h2v1h-2zM19 15h1v1h-1zM22 15h1v2h-1zM25 15h3v1h-3zM0 17h1v2H0zM3 17h1v1H3zM6 17h2v1H6zM10 17h3v1h-3zM15 17h1v1h-1zM18 17h2v1h-2zM24 17h1v1h-1zM27 17h1v2h-1zM1 19h1v1H1zM4 19h1v1H4zM7 19h1v1H7zM9 19h1v1H9zM12 19h2v1h-2zM16 19h1v2h-1zM20 19h2v1h-2zM25 19h1v1h-1zM28 19h1v1h-1zM9 21h2v1H9zM14 21h1v1h-1zM18 21h1v2h-1zM21 21h2v1h-2zM25 21h3v1h-3zM10 23h1v1h-1zM12 23h2v1h-2zM16 23h1v1h-1zM20 23h1v2h-1zM23 23h1v1h-1zM26 23h2v1h-2zM9 25h1v2H9zM12 25h1v1h-1zM14 25h2v1h-2zM18 25h1v1h-1zM22 25h1v1h-1zM24 25h2v1h-2zM28 25h1v1h-1zM11 27h1v2h-1zM15 27h2v1h-2zM19 27h1v1h-1zM21 27h3v1h-3zM26 27h1v1h-1z"/>
          </svg>
        </div>
      </div>
    </div>
  </div>
</section>
"""

write_slide(26, s26)
write_slide(27, s27)
write_slide(28, s28)
