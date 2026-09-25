# Generator for EDXcore Slides (06, 07, 08, 09)

LOGO_EDX = "https://edxcore.knrint.com/images/image.png"

def get_stepper(active_idx):
    steps = ["1. ARCHITECTURE", "2. 22 MODULES", "3. LEARNING JOURNEY", "4. ENTERPRISE SCALE"]
    html = '<div class="product-story-stepper">'
    for i, step in enumerate(steps, 1):
        cls = "stepper-step active" if i == active_idx else "stepper-step"
        html += f'<span class="{cls}">&bull; {step}</span>'
    html += '</div>'
    return html

# Slide 06: EDXcore Architecture & Vision
s6 = f"""<section class="slide-item theme-edx" id="slide-6" data-index="6" data-section="PRODUCT 02 // EDXCORE" data-theme="theme-edx">
  <div class="product-watermark-bg">EDXCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_EDX}" alt="EDXcore" onerror="this.onerror=null;this.src=\x27https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_dea10753-7195-4728-8aee-a7e2d2856435_6.webp\x27;">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // ENTERPRISE LMS &amp; ACADEMIC CLOUD</div>
          <h3>EDXcore: Learning Without Boundaries</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(1)}
      </div>
    </div>

    <p class="slide-subtitle">
      EDXcore is KNR's next-generation cloud Learning Management System. Built for schools, higher education institutions, 
      universities, and enterprise corporate academies, it delivers continuous live and self-paced digital education with verified academic integrity.
    </p>

    <!-- 3 Core Tenets of EDXcore -->
    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(192, 132, 252, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ???
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Multi-Tenant Architecture</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Complete workspace isolation for multi-campus institutions and corporate academies. Independent subdomains, custom logos, localized color themes, and dedicated admin RBAC access.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">Isolated DB</span>
          <span class="tech-tag">White-Label</span>
          <span class="tech-tag">Custom Subdomains</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(192, 132, 252, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Dual-Layer AI Integration</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Featuring an intelligent public visitor chatbot for course discovery alongside an enrolled AI Learning Coach that assists students 24/7 with complex curriculum queries and document-to-quiz generation.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">AI Tutor 24/7</span>
          <span class="tech-tag">Doc-to-Quiz</span>
          <span class="tech-tag">Adaptive Hints</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(192, 132, 252, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ???
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">AI &amp; Live Remote Proctoring</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          High-assurance assessment integrity with automated webcam surveillance, tab-switching alerts, snapshot incident evidence logging, and live room proctor command centers.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">Webcam AI</span>
          <span class="tech-tag">Browser Lock</span>
          <span class="tech-tag">Live Grid Room</span>
        </div>
      </div>
    </div>

    <div class="glass-card" style="margin-top: 0.8rem; padding: 0.8rem 1.25rem; display: flex; align-items: center; justify-content: space-between; background: rgba(192, 132, 252, 0.08); border-color: rgba(192, 132, 252, 0.25);">
      <div style="display: flex; align-items: center; gap: 0.8rem;">
        <span style="font-size: 1.3rem;">?</span>
        <span style="font-size: 0.82rem; color: #FFF; font-weight: 600;">Enterprise Standards: SCORM 1.2/2004, xAPI Experience API, Razorpay Commerce, and SSO.</span>
      </div>
      <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem;">10,000+ Concurrent Scalability</span>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_06.html", "w", encoding="utf-8") as f:
    f.write(s6)

# Slide 07: EDXcore 22 Modules Matrix
s7 = f"""<section class="slide-item theme-edx" id="slide-7" data-index="7" data-section="PRODUCT 02 // EDXCORE" data-theme="theme-edx">
  <div class="product-watermark-bg">EDXCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_EDX}" alt="EDXcore" onerror="this.onerror=null;this.src=\x27https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_dea10753-7195-4728-8aee-a7e2d2856435_6.webp\x27;">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // ENTERPRISE LMS &amp; ACADEMIC CLOUD</div>
          <h3>EDXcore: 22 Core Modules Built for Scale</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(2)}
      </div>
    </div>

    <p class="slide-subtitle">
      A comprehensive learning stack architected to manage the full educational journey from course authoring and AI testing to verifiable certifications and commerce.
    </p>

    <!-- 4 Functional Pillars for EDXcore -->
    <div class="grid-4" style="gap: 0.9rem; margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>??</span> CURRICULUM &amp; DELIVERY
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Curriculum Builder:</strong> Sections, video lessons &amp; asset downloads<br>
          &bull; <strong>Learning Paths:</strong> Structured career &amp; skill tracks with bundles<br>
          &bull; <strong>Live Classrooms:</strong> Interactive video, Q&amp;A, polls &amp; ICS calendar<br>
          &bull; <strong>SCORM &amp; xAPI:</strong> Standard-compliant third-party module sync<br>
          &bull; <strong>Discussions Forum:</strong> Category threads, upvoting &amp; FAQ conversion
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>??</span> ASSESSMENT &amp; PROCTORING
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Question Bank:</strong> MCQ, integer, essay with difficulty tagging<br>
          &bull; <strong>AI Doc-to-Quiz:</strong> Automated question creation from course notes<br>
          &bull; <strong>AI Proctoring:</strong> Real-time webcam breach detection &amp; screen lock<br>
          &bull; <strong>Peer Review:</strong> Double-blind student evaluation &amp; grading rubrics<br>
          &bull; <strong>Weighted Gradebook:</strong> Component weights &amp; official PDF transcripts
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>??</span> CREDENTIALS &amp; COMMERCE
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Digital Certificates:</strong> Dynamic visual designer &amp; instant issuance<br>
          &bull; <strong>Public Verification:</strong> Tamper-proof URLs (/certificates/&#123;uid&#125;)<br>
          &bull; <strong>Cart &amp; Checkout:</strong> Razorpay integration, coupons &amp; wallet<br>
          &bull; <strong>B2B Corporate Seats:</strong> Bulk enterprise licensing &amp; custom invoices<br>
          &bull; <strong>Scholarships &amp; Grants:</strong> Need-based student financial aid queue
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>???</span> GOVERNANCE &amp; SECURITY
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Multi-Factor Auth (MFA):</strong> TOTP QR codes &amp; session protection<br>
          &bull; <strong>RBAC Matrix:</strong> Granular menu permissions &amp; user access rules<br>
          &bull; <strong>Action Center:</strong> Preflight launch health checks &amp; orphan cleanup<br>
          &bull; <strong>Proctor Command:</strong> Live testing rooms &amp; violation escalation<br>
          &bull; <strong>Audit Trail:</strong> System actions, revenue ledgers &amp; IP logs
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_07.html", "w", encoding="utf-8") as f:
    f.write(s7)

# Slide 08: EDXcore Learning Journey
s8 = f"""<section class="slide-item theme-edx" id="slide-8" data-index="8" data-section="PRODUCT 02 // EDXCORE" data-theme="theme-edx">
  <div class="product-watermark-bg">EDXCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_EDX}" alt="EDXcore" onerror="this.onerror=null;this.src=\x27https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_dea10753-7195-4728-8aee-a7e2d2856435_6.webp\x27;">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // ENTERPRISE LMS &amp; ACADEMIC CLOUD</div>
          <h3>EDXcore: The End-to-End Digital Learning Journey</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(3)}
      </div>
    </div>

    <p class="slide-subtitle">
      EDXcore orchestrates a seamless academic pathway from initial institution onboarding to verifiable credential issuance.
    </p>

    <!-- Visual Journey Flow -->
    <div class="flow-container" style="margin: 1.2rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">01. Admin</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Multi-Tenant Branding &amp; RBAC</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">?????</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Instructor</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Curriculum &amp; Live Class</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Learner</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Interactive Video &amp; AI Coach</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">???</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Assessment</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">AI &amp; Live Proctoring Security</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Analytics</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Weighted Gradebook &amp; Scores</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step" style="border-color: var(--theme-accent); background: rgba(192, 132, 252, 0.12);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">06. Certificate</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Tamper-Proof Verification</div>
      </div>
    </div>

    <!-- Multi-Portal Synergy -->
    <div class="grid-4" style="margin-top: 0.6rem;">
      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">?? Student 360&deg; Portal</div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Consecutive daily learning streaks, gamified achievement badges, progress bars, and AI tutor access.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">????? Instructor Hub</div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Course performance telemetry, assignment evaluations, revenue share tracking, and 1-on-1 student chat.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">???????? Parent &amp; Guardian</div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Linked student oversight, real-time academic alerts, monthly PDF reports, and course purchase approval.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">?? Proctor Command</div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Real-time video grid of exam rooms, breach violation reviews, evidence archives, and instant escalation.
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_08.html", "w", encoding="utf-8") as f:
    f.write(s8)

# Slide 09: EDXcore Scale & Outcomes
s9 = f"""<section class="slide-item theme-edx" id="slide-9" data-index="9" data-section="PRODUCT 02 // EDXCORE" data-theme="theme-edx">
  <div class="product-watermark-bg">EDXCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_EDX}" alt="EDXcore" onerror="this.onerror=null;this.src=\x27https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_dea10753-7195-4728-8aee-a7e2d2856435_6.webp\x27;">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // ENTERPRISE LMS &amp; ACADEMIC CLOUD</div>
          <h3>EDXcore: Proven Enterprise Learning Scale &amp; Integrity</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(4)}
      </div>
    </div>

    <p class="slide-subtitle">
      EDXcore is engineered to power digital academies and university programs with guaranteed uptime, academic integrity, and measurable learner outcomes.
    </p>

    <!-- Verified Value Metrics -->
    <div class="grid-4" style="margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: var(--theme-accent);">10,000+</div>
        <div class="stat-label">Concurrent Scale</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Architected for high-density live sessions, zero-buffer video delivery, and synchronized mass testing.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #60A5FA;">100%</div>
        <div class="stat-label">Exam Integrity</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Eliminate assessment fraud via automated browser lockdown, webcam tracking, and proctor evidence review.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #34D399;">Zero</div>
        <div class="stat-label">Manual Grading Burden</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Instant auto-evaluation for objective assessments and weighted formula calculation across terms.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #FBBF24;">1-Click</div>
        <div class="stat-label">Public Verification</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Tamper-proof verifiable credential links and LinkedIn badge integrations for every completed track.
        </p>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card card-theme-glow" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: var(--theme-accent); text-align: center; padding: 1.4rem; margin-top: 1rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: var(--theme-accent); font-weight: 700; text-transform: uppercase; margin-bottom: 0.4rem;">
        THE EDXCORE PHILOSOPHY
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.2rem, 2.2vw, 1.8rem); font-weight: 900; color: #FFF;">
        &ldquo;Learn. Measure. Improve. Grow.&rdquo;
      </h3>
      <p style="font-size: 0.82rem; color: var(--text-muted); margin-top: 0.4rem; max-width: 760px; margin-left: auto; margin-right: auto;">
        From interactive live classes and AI tutoring to B2B corporate seat licensing &mdash; EDXcore delivers learning without boundaries.
      </p>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_09.html", "w", encoding="utf-8") as f:
    f.write(s9)

print("EDXcore Slides 06, 07, 08, 09 generated successfully.")
