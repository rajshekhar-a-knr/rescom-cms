# Generator for Services (26, 27) and Closing (28)

LOGO_KNR = "https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/KNR-WEBSITE_f817360c-0c15-4992-bc1b-4df24f071612_KNR-Logo.png"

def get_services_stepper(active_idx):
    steps = ["1. 10 CORE SERVICES", "2. TRANSFORMATION MATRIX"]
    html = '<div class="product-story-stepper">'
    for i, step in enumerate(steps, 1):
        cls = "stepper-step active" if i == active_idx else "stepper-step"
        html += f'<span class="{cls}">&bull; {step}</span>'
    html += '</div>'
    return html

# Slide 26: 10 Engineering Services
s26 = f"""<section class="slide-item theme-services" id="slide-26" data-index="26" data-section="03 // KNR SERVICES" data-theme="theme-services">
  <div class="product-watermark-bg">SERVICES</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_KNR}" alt="KNR Services">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ENTERPRISE // TECHNOLOGY CONSULTING &amp; ENGINEERING</div>
          <h3>KNR Technology Engineering Services</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_services_stepper(1)}
      </div>
    </div>

    <p class="slide-subtitle">
      Full-spectrum technology engineering delivering bespoke software, mobile apps, enterprise cloud infrastructure, AI intelligence, and cybersecurity.
    </p>

    <!-- 6 Consolidated Technology Domains -->
    <div class="grid-3" style="gap: 0.9rem; margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.4rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA;">?? WEB &amp; DIGITAL PRODUCTS</div>
          <span style="font-size: 1.1rem;">??</span>
        </div>
        <p style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45; margin-bottom: 0.5rem;">
          High-performance custom web applications, multi-tenant enterprise portals, REST APIs, and microservices architecture.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">Laravel</span>
          <span class="tech-tag">React</span>
          <span class="tech-tag">Vue.js</span>
          <span class="tech-tag">Node.js</span>
          <span class="tech-tag">PostgreSQL</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.4rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399;">?? MOBILE APPLICATION DEV</div>
          <span style="font-size: 1.1rem;">??</span>
        </div>
        <p style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45; margin-bottom: 0.5rem;">
          Native and cross-platform mobile apps for iOS and Android with offline synchronization, real-time push notifications, and biometric security.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">iOS / Swift</span>
          <span class="tech-tag">Android / Kotlin</span>
          <span class="tech-tag">Flutter</span>
          <span class="tech-tag">React Native</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.4rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: var(--theme-accent);">?? CLOUD &amp; DEVOPS INFRA</div>
          <span style="font-size: 1.1rem;">?</span>
        </div>
        <p style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45; margin-bottom: 0.5rem;">
          Zero-downtime cloud infrastructure migration, container orchestration, automated CI/CD deployment pipelines, and cloud cost optimization.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">AWS</span>
          <span class="tech-tag">Azure</span>
          <span class="tech-tag">Docker</span>
          <span class="tech-tag">Kubernetes</span>
          <span class="tech-tag">Terraform</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.4rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC;">?? AI, ML &amp; DATA SCIENCE</div>
          <span style="font-size: 1.1rem;">??</span>
        </div>
        <p style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45; margin-bottom: 0.5rem;">
          Custom machine learning models, predictive intelligence, computer vision pipelines, natural language processing, and conversational AI.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">Python</span>
          <span class="tech-tag">TensorFlow</span>
          <span class="tech-tag">PyTorch</span>
          <span class="tech-tag">Vision AI</span>
          <span class="tech-tag">NLP</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.4rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24;">??? CYBERSECURITY &amp; AUDIT</div>
          <span style="font-size: 1.1rem;">??</span>
        </div>
        <p style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45; margin-bottom: 0.5rem;">
          Certified penetration testing, web and mobile security audits, vulnerability assessments, network defense, and ISO compliance reviews.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">OWASP Top 10</span>
          <span class="tech-tag">Penetration Testing</span>
          <span class="tech-tag">ISO 27001</span>
          <span class="tech-tag">Security Audits</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.4rem;">
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FFF;">?? UI/UX DESIGN SYSTEMS</div>
          <span style="font-size: 1.1rem;">?</span>
        </div>
        <p style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45; margin-bottom: 0.5rem;">
          Human-centric user research, high-fidelity wireframes, interactive clickable prototypes, design systems, and WCAG accessibility.
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
</section>"""

with open("scratch/slides/slide_26.html", "w", encoding="utf-8") as f:
    f.write(s26)

# Slide 27: Transformation Matrix
s27 = f"""<section class="slide-item theme-services" id="slide-27" data-index="27" data-section="03 // KNR SERVICES" data-theme="theme-services">
  <div class="product-watermark-bg">SERVICES</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_KNR}" alt="KNR Services">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ENTERPRISE // TECHNOLOGY CONSULTING &amp; ENGINEERING</div>
          <h3>Strategic Digital Transformation Architecture</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_services_stepper(2)}
      </div>
    </div>

    <p class="slide-subtitle">
      A structured transformation methodology taking enterprises from initial strategic discovery through agile engineering, deployment, and 24/7 managed SLA operations.
    </p>

    <!-- Visual Architecture Flow: IDEA -> STRATEGY -> DESIGN -> DEVELOPMENT -> DEPLOYMENT -> GROWTH -->
    <div class="flow-container" style="margin: 1.2rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: var(--theme-accent);">01. IDEA</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">Discovery &amp; Scoping</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #60A5FA;">02. STRATEGY</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">Architecture Roadmap</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #34D399;">03. DESIGN</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">UI/UX &amp; Prototype</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #FBBF24;">04. BUILD</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">Agile Engineering</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: #C084FC;">05. DEPLOY</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">CI/CD &amp; Launch</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step" style="border-color: var(--theme-accent); background: rgba(96, 165, 250, 0.12);">
        <div style="font-size: 1.4rem; margin-bottom: 0.2rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.82rem; color: var(--theme-accent);">06. GROWTH</div>
        <div style="font-size: 0.65rem; color: var(--text-muted);">Managed 24/7 SLA</div>
      </div>
    </div>

    <!-- 6 Consolidated Strategic Consulting Areas -->
    <div class="grid-3" style="gap: 0.8rem; margin-top: 0.6rem;">
      <div class="glass-card card-theme-glow">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA; margin-bottom: 0.3rem;">
          ?? DIGITAL TRANSFORMATION
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Enterprise workflow automation, legacy modernization, paperless transition, and operational re-engineering.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399; margin-bottom: 0.3rem;">
          ?? GROWTH &amp; DIGITAL MARKETING
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Data-driven technical SEO audits, high-intent Google Ads management, social campaigns, and analytics tracking.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent); margin-bottom: 0.3rem;">
          ?? R&amp;D, INNOVATION &amp; MVPS
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Emerging technology exploration, rapid proof-of-concept (PoC) builds, and corporate venture MVP validation.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24; margin-bottom: 0.3rem;">
          ?? INSTITUTIONAL &amp; EDTECH
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Complete school digital ecosystems, CBSE vocational lab setups, robotics maker spaces, and teacher bootcamps.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC; margin-bottom: 0.3rem;">
          ?? TECHNOLOGY ADVISORY
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Strategic CTO advisory, technology roadmap planning, vendor selection, software audits, and cyber risk assessment.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">
          ??? 24/7 MANAGED OPERATIONS
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Proactive infrastructure maintenance, automated backup routines, security vulnerability patching, and SLA compliance.
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_27.html", "w", encoding="utf-8") as f:
    f.write(s27)

# Slide 28: Closing & Contact
s28 = f"""<section class="slide-item theme-contact" id="slide-28" data-index="28" data-section="04 // THANK YOU" data-theme="theme-contact">
  <div class="product-watermark-bg">CONNECT</div>
  <div class="slide-container" style="text-align: center; align-items: center; justify-content: center;">
    
    <!-- Central Brand Logo Avatar & Identity -->
    <div style="display: flex; flex-direction: column; align-items: center; gap: 0.6rem; margin-bottom: 0.6rem;">
      <div style="width: 80px; height: 80px; border-radius: 20px; background: #FFFFFF; padding: 8px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 30px rgba(251, 191, 36, 0.4);">
        <img src="{LOGO_KNR}" alt="KNR Tech Solutions" style="max-width: 100%; max-height: 100%; object-fit: contain;">
      </div>
      <div class="slide-eyebrow" style="color: var(--theme-accent); margin-bottom: 0;">
        <span class="hud-pulse-dot" style="background: var(--theme-accent);"></span>
        THE KNR PARTNERSHIP
      </div>
    </div>
    
    <h1 class="slide-title" style="font-size: clamp(2.4rem, 4.5vw, 4rem); margin-bottom: 0.3rem;">
      THANK YOU
    </h1>
    
    <div style="font-family: var(--font-display); font-size: clamp(1.1rem, 2vw, 1.5rem); font-weight: 700; color: #FFF; margin-bottom: 1.1rem;">
      Let&rsquo;s build what comes next.
    </div>

    <!-- Final Brand Philosophy Climax Box -->
    <div class="glass-card card-theme-glow" style="background: linear-gradient(135deg, rgba(14,22,54,0.9), rgba(22,36,80,0.85)); border-color: var(--theme-accent); padding: 1.1rem 1.8rem; max-width: 960px; margin-bottom: 1.2rem; box-shadow: 0 0 30px rgba(251, 191, 36, 0.25);">
      <div style="font-family: var(--font-display); font-size: clamp(0.9rem, 1.4vw, 1.2rem); font-weight: 800; line-height: 1.5; letter-spacing: 0.03em;">
        <span style="color: #38BDF8;">KNOWLEDGE CREATES POSSIBILITY.</span> &nbsp;&bull;&nbsp;
        <span style="color: #818CF8;">TECHNOLOGY CREATES SCALE.</span><br>
        <span style="color: var(--theme-accent);">PEOPLE CREATE IMPACT.</span> &nbsp;&bull;&nbsp;
        <span style="color: #FFF; text-shadow: 0 0 10px rgba(255,255,255,0.8);">KNR CONNECTS THEM ALL.</span>
      </div>
    </div>

    <!-- Global Corporate Locations Grid -->
    <div class="grid-3" style="width: 100%; max-width: 1200px; text-align: left; align-items: stretch; margin-bottom: 0.5rem;">
      <!-- INDIA HEADQUARTERS -->
      <div class="glass-card card-theme-glow" style="display: flex; flex-direction: column; justify-content: space-between; border-color: rgba(56, 189, 248, 0.3);">
        <div>
          <div style="display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.6rem;">
            <span style="font-size: 1.5rem;">????</span>
            <div>
              <div style="font-size: 0.7rem; color: #38BDF8; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;">INDIA HEADQUARTERS</div>
              <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FFF;">KNR Tech Solutions Pvt. Ltd.</div>
            </div>
          </div>
          <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
            233, Rahul Building, 6th Main Road,<br>
            Rajajinagar Industrial Town, Rajajinagar,<br>
            Bengaluru, Karnataka &ndash; 560044, India
          </div>
        </div>
        <div style="margin-top: 0.8rem; padding-top: 0.7rem; border-top: 1px solid rgba(255,255,255,0.1); font-size: 0.74rem;">
          <div style="color: #FFF; margin-bottom: 0.15rem;">?? <strong>+91 98459 19158</strong></div>
          <div style="color: #38BDF8;">?? <strong>info@knrint.in</strong></div>
        </div>
      </div>

      <!-- AUSTRALIA CORPORATE OFFICE -->
      <div class="glass-card card-theme-glow" style="display: flex; flex-direction: column; justify-content: space-between; border-color: rgba(129, 140, 248, 0.3);">
        <div>
          <div style="display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.6rem;">
            <span style="font-size: 1.5rem;">????</span>
            <div>
              <div style="font-size: 0.7rem; color: #818CF8; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;">AUSTRALIA CORPORATE</div>
              <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FFF;">KNR Corporate Office</div>
            </div>
          </div>
          <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
            ACN: 633 276 178<br>
            Suite 319, 1 Queens Road, St Kilda Road Towers,<br>
            Melbourne, VIC 3004, Australia
          </div>
        </div>
        <div style="margin-top: 0.8rem; padding-top: 0.7rem; border-top: 1px solid rgba(255,255,255,0.1); font-size: 0.74rem;">
          <div style="color: #FFF; margin-bottom: 0.15rem;">?? <strong>+61 499 888 442</strong> &bull; <strong>+61 484 585 999</strong></div>
          <div style="color: #818CF8;">?? <strong>info@knrint.in</strong></div>
        </div>
      </div>

      <!-- DIGITAL HUB & QR CODE -->
      <div class="glass-card card-theme-glow" style="display: flex; align-items: center; justify-content: space-between; gap: 0.8rem; border-color: rgba(251, 191, 36, 0.3);">
        <div style="flex: 1;">
          <div style="font-size: 0.7rem; color: var(--theme-accent); font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.2rem;">DIGITAL PORTAL</div>
          <div style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF; margin-bottom: 0.3rem;">www.knrint.com</div>
          <div style="font-size: 0.72rem; color: var(--text-muted); line-height: 1.4; margin-bottom: 0.5rem;">
            Explore live product ecosystems, demos &amp; enterprise client case studies.
          </div>
          <a href="https://www.knrint.com" target="_blank" rel="noopener noreferrer" class="tech-tag tech-tag-theme" style="font-size: 0.74rem; text-decoration: none; padding: 0.35rem 0.8rem; display: inline-block;">
            Visit knrint.com &rarr;
          </a>
        </div>
        <div style="width: 84px; height: 84px; background: #FFF; border-radius: 12px; padding: 6px; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 20px rgba(251, 191, 36, 0.35); flex-shrink: 0;">
          <!-- SVG QR Code representing knrint.com -->
          <svg viewBox="0 0 29 29" width="100%" height="100%" style="shape-rendering: crispEdges;">
            <path fill="#000" d="M0 0h7v7H0zM2 2h3v3H2zM22 0h7v7h-7zM24 2h3v3h-3zM0 22h7v7H0zM2 24h3v3H2zM9 1h1v1H9zM12 1h2v1h-2zM16 1h2v2h-1v1h-1zM19 1h1v1h-1zM9 3h2v1H9zM13 3h1v1h-1zM18 3h1v2h-1zM10 5h1v1h-1zM12 5h1v2h-1zM15 5h2v1h-2zM9 7h1v1H9zM14 7h1v2h-1zM17 7h1v1h-1zM1 9h1v1H1zM4 9h2v1H4zM8 9h2v1H8zM11 9h1v1h-1zM16 9h3v1h-3zM21 9h2v1h-2zM25 9h1v1h-1zM28 9h1v1h-1zM1 11h1v2H1zM3 11h3v1H3zM8 11h1v2H8zM11 11h2v1h-2zM15 11h1v2h-1zM18 11h2v1h-2zM22 11h2v1h-2zM26 11h2v1h-2zM4 13h1v1H4zM7 13h1v2H7zM10 13h2v1h-2zM13 13h1v1h-1zM17 13h1v2h-1zM20 13h3v1h-3zM25 13h1v1h-1zM27 13h2v1h-2zM1 15h2v1H1zM5 15h1v1H5zM9 15h1v1H9zM12 15h1v1h-1zM14 15h2v1h-2zM19 15h1v1h-1zM22 15h1v2h-1zM25 15h3v1h-3zM0 17h1v2H0zM3 17h1v1H3zM6 17h2v1H6zM10 17h3v1h-3zM15 17h1v1h-1zM18 17h2v1h-2zM24 17h1v1h-1zM27 17h1v2h-1zM1 19h1v1H1zM4 19h1v1H4zM7 19h1v1H7zM9 19h1v1H9zM12 19h2v1h-2zM16 19h1v2h-1zM20 19h2v1h-2zM25 19h1v1h-1zM28 19h1v1h-1zM9 21h2v1H9zM14 21h1v1h-1zM18 21h1v2h-1zM21 21h2v1h-2zM25 21h3v1h-3zM10 23h1v1h-1zM12 23h2v1h-2zM16 23h1v1h-1zM20 23h1v2h-1zM23 23h1v1h-1zM26 23h2v1h-2zM9 25h1v2H9zM12 25h1v1h-1zM14 25h2v1h-2zM18 25h1v1h-1zM22 25h1v1h-1zM24 25h2v1h-2zM28 25h1v1h-1zM11 27h1v2h-1zM15 27h2v1h-2zM19 27h1v1h-1zM21 27h3v1h-3zM26 27h1v1h-1z"/>
          </svg>
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_28.html", "w", encoding="utf-8") as f:
    f.write(s28)

print("Services Slides 26, 27 and Closing Slide 28 generated successfully.")
