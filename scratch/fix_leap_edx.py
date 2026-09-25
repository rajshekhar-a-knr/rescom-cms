import sys
sys.path.insert(0, "scratch")
import icons as ic

LOGO_LEAP = "https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/kne..leap.jpg"
LOGO_EDX = "https://edxcore.knrint.com/images/image.png"

def leap_stepper(active_idx):
    steps = ["1. STAKEHOLDERS", "2. 29 CAPABILITIES", "3. INSTITUTIONAL ROI"]
    html = '<div class="product-story-stepper">'
    for i, step in enumerate(steps, 1):
        cls = "stepper-step active" if i == active_idx else "stepper-step"
        html += f'<span class="{cls}">&bull; {step}</span>'
    html += '</div>'
    return html

def standard_stepper(steps, active_idx):
    html = '<div class="product-story-stepper">'
    for i, step in enumerate(steps, 1):
        cls = "stepper-step active" if i == active_idx else "stepper-step"
        html += f'<span class="{cls}">&bull; {step}</span>'
    html += '</div>'
    return html

# SLIDE 03
s3 = f"""<section class="slide-item theme-leap" id="slide-3" data-index="3" data-section="PRODUCT 01 // LEAP" data-theme="theme-leap">
  <div class="product-watermark-bg">LEAP</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_LEAP}" alt="LEAP">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // SCHOOL OPERATING SYSTEM</div>
          <h3>KNR-LEAP: Learners &bull; Educators &bull; Administrators &bull; Parents</h3>
        </div>
      </div>
      <div class="product-header-right">
        {leap_stepper(1)}
      </div>
    </div>

    <p class="slide-subtitle">
      LEAP eliminates institutional fragmentation by unifying every school workflow into a single intelligent cloud ecosystem.
      It bridges administration, academic delivery, financial governance, and home-to-school engagement into one seamless experience.
    </p>

    <div class="grid-4" style="margin-top: 0.2rem;">
      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.7rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center;">
            {ic.icon('cap', 22, '#38BDF8')}
          </div>
          <div>
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF;">Learners</h4>
            <span style="font-size: 0.68rem; color: var(--theme-accent); font-weight: 600;">Holistic Development</span>
          </div>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.65rem;">
          Empowered through digital diaries, automated homework tracking, competitive mock exams, and transparent progress.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag tech-tag-theme">Student 360&deg;</span>
          <span class="tech-tag">Online Exams</span>
          <span class="tech-tag">Digital Diary</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.7rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center;">
            {ic.icon('teacher', 22, '#38BDF8')}
          </div>
          <div>
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF;">Educators</h4>
            <span style="font-size: 0.68rem; color: var(--theme-accent); font-weight: 600;">Teaching Acceleration</span>
          </div>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.65rem;">
          Streamlining daily attendance marking, curriculum lesson planning, grade entry, term marks, and leave requests.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag tech-tag-theme">Lesson Planner</span>
          <span class="tech-tag">Auto Grading</span>
          <span class="tech-tag">Biometric Sync</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.7rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center;">
            {ic.icon('admin', 22, '#38BDF8')}
          </div>
          <div>
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF;">Administrators</h4>
            <span style="font-size: 0.68rem; color: var(--theme-accent); font-weight: 600;">Financial &amp; Governance Control</span>
          </div>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.65rem;">
          Institutional oversight over automated fee collection, staff payroll, transport routes, and multi-branch rollups.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag tech-tag-theme">Fee Gateway</span>
          <span class="tech-tag">Live GPS</span>
          <span class="tech-tag">Payroll HRMS</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.7rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center;">
            {ic.icon('parents', 22, '#38BDF8')}
          </div>
          <div>
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF;">Parents</h4>
            <span style="font-size: 0.68rem; color: var(--theme-accent); font-weight: 600;">Real-Time Visibility</span>
          </div>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.65rem;">
          Real-time mobile bus tracking, instant push fee reminders, one-click online payments, and teacher messaging.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag tech-tag-theme">Parent Mobile App</span>
          <span class="tech-tag">1-Click UPI</span>
          <span class="tech-tag">Bus Alerts</span>
        </div>
      </div>
    </div>

    <div class="glass-card" style="margin-top: 1rem; padding: 0.9rem 1.4rem; display: flex; align-items: center; justify-content: space-between; background: rgba(56, 189, 248, 0.08); border-color: rgba(56, 189, 248, 0.25);">
      <div style="display: flex; align-items: center; gap: 0.8rem;">
        {ic.icon('bulb', 22, '#38BDF8')}
        <span style="font-size: 0.85rem; color: #FFF; font-weight: 600;">Unified Educational Operating System Architecture: Eliminates 6+ fragmented vendor software tools.</span>
      </div>
      <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem;">99.98% System Uptime</span>
    </div>
  </div>
</section>"""
with open("scratch/slides/slide_03.html", "w", encoding="utf-8") as f: f.write(s3)

# SLIDE 04
s4 = f"""<section class="slide-item theme-leap" id="slide-4" data-index="4" data-section="PRODUCT 01 // LEAP" data-theme="theme-leap">
  <div class="product-watermark-bg">LEAP</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_LEAP}" alt="LEAP">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // SCHOOL OPERATING SYSTEM</div>
          <h3>KNR-LEAP: Comprehensive 26 Core + 3 Add-on Capabilities</h3>
        </div>
      </div>
      <div class="product-header-right">
        {leap_stepper(2)}
      </div>
    </div>

    <p class="slide-subtitle">
      Built from the ground up to replace fragmented legacy school software. Each functional cluster is purpose-engineered to automate institutional operations.
    </p>

    <div class="grid-3" style="margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.6rem;">
          <div style="display: flex; align-items: center; gap: 0.5rem;">
            {ic.icon('book', 18, '#38BDF8')}
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FFF;">Academic Delivery Core</h4>
          </div>
          <span class="tech-tag tech-tag-theme">10 Modules</span>
        </div>
        <p style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.4; margin-bottom: 0.6rem;">
          Full lifecycle management from student admission to alumni graduation with dynamic syllabi tracking.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
          <span class="tech-tag">Student Information</span>
          <span class="tech-tag">Digital Admissions</span>
          <span class="tech-tag">Class Scheduling</span>
          <span class="tech-tag">Lesson Planners</span>
          <span class="tech-tag">Subject Coverage</span>
          <span class="tech-tag">Digital Homework</span>
          <span class="tech-tag">Conduct Registers</span>
          <span class="tech-tag">Report Cards</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.6rem;">
          <div style="display: flex; align-items: center; gap: 0.5rem;">
            {ic.icon('credit_card', 18, '#34D399')}
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FFF;">Finance &amp; Operations</h4>
          </div>
          <span class="tech-tag tech-tag-theme">9 Modules</span>
        </div>
        <p style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.4; margin-bottom: 0.6rem;">
          Zero financial leakage with automated ledger sync, biometric timeclocks, and live transport tracking.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
          <span class="tech-tag">Fees Collection Engine</span>
          <span class="tech-tag">UPI / Gateway Reconciliation</span>
          <span class="tech-tag">Transport Fleet GPS</span>
          <span class="tech-tag">Biometric Staff Clock</span>
          <span class="tech-tag">Inventory &amp; Assets</span>
          <span class="tech-tag">Hostel Bed Allocator</span>
          <span class="tech-tag">Automated Payroll</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.6rem;">
          <div style="display: flex; align-items: center; gap: 0.5rem;">
            {ic.icon('message', 18, '#FBBF24')}
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FFF;">Engagement &amp; Exams</h4>
          </div>
          <span class="tech-tag tech-tag-theme">10 Modules</span>
        </div>
        <p style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.4; margin-bottom: 0.6rem;">
          Multi-channel parent communications and high-security computerized examination grading suites.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
          <span class="tech-tag">Online CBT Engine</span>
          <span class="tech-tag">NEET / JEE Mock Tests</span>
          <span class="tech-tag">Multi-Board Grading</span>
          <span class="tech-tag">Parent Portal &amp; App</span>
          <span class="tech-tag">SMS &amp; WhatsApp Alerts</span>
          <span class="tech-tag">Staff Leave Workflows</span>
          <span class="tech-tag">Digital Library (RFID)</span>
          <span class="tech-tag">Trust Multi-Branch</span>
        </div>
      </div>
    </div>

    <div class="grid-3" style="margin-top: 0.8rem;">
      <div class="glass-card" style="padding: 0.75rem 1rem; border-color: rgba(56, 189, 248, 0.3);">
        <div style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--theme-accent); font-weight: 700;">ADD-ON EXTENSION 01</div>
        <div style="font-size: 0.82rem; font-weight: 700; color: #FFF; margin-top: 0.2rem;">KNR Pay &amp; Instant Fee Gateway</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.15rem;">Automated zero-reconciliation payment gateway with instant SMS receipt generation.</div>
      </div>
      <div class="glass-card" style="padding: 0.75rem 1rem; border-color: rgba(56, 189, 248, 0.3);">
        <div style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--theme-accent); font-weight: 700;">ADD-ON EXTENSION 02</div>
        <div style="font-size: 0.82rem; font-weight: 700; color: #FFF; margin-top: 0.2rem;">KNR Live Fleet GPS Telematics</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.15rem;">Real-time bus tracking, geofence radius alerts, speed limiters &amp; parent notifications.</div>
      </div>
      <div class="glass-card" style="padding: 0.75rem 1rem; border-color: rgba(56, 189, 248, 0.3);">
        <div style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--theme-accent); font-weight: 700;">ADD-ON EXTENSION 03</div>
        <div style="font-size: 0.82rem; font-weight: 700; color: #FFF; margin-top: 0.2rem;">Biometric &amp; RFID Access Guard</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.15rem;">Seamless hardware integration for turnstiles, attendance clocks &amp; library loans.</div>
      </div>
    </div>
  </div>
</section>"""
with open("scratch/slides/slide_04.html", "w", encoding="utf-8") as f: f.write(s4)

# SLIDE 06
edx_steps = ["1. ARCHITECTURE", "2. 22 MODULES", "3. LEARNING JOURNEY", "4. ENTERPRISE SCALE"]
s6 = f"""<section class="slide-item theme-edx" id="slide-6" data-index="6" data-section="PRODUCT 02 // EDXCORE" data-theme="theme-edx">
  <div class="product-watermark-bg">EDXCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_EDX}" alt="EDXcore" onerror="this.onerror=null;this.src='https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_dea10753-7195-4728-8aee-a7e2d2856435_6.webp';">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // ENTERPRISE LMS &amp; ACADEMIC CLOUD</div>
          <h3>EDXcore: Learning Without Boundaries</h3>
        </div>
      </div>
      <div class="product-header-right">
        {standard_stepper(edx_steps, 1)}
      </div>
    </div>

    <p class="slide-subtitle">
      EDXcore is KNR's next-generation cloud Learning Management System. Built for schools, higher education institutions, 
      universities, and enterprise corporate academies, it delivers continuous live and self-paced digital education with verified academic integrity.
    </p>

    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(192, 132, 252, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
          {ic.icon('building', 24, '#C084FC')}
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
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(192, 132, 252, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
          {ic.icon('bot', 24, '#C084FC')}
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
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(192, 132, 252, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
          {ic.icon('eye', 24, '#C084FC')}
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
        {ic.icon('zap', 20, '#C084FC')}
        <span style="font-size: 0.82rem; color: #FFF; font-weight: 600;">Enterprise Standards: SCORM 1.2/2004, xAPI Experience API, Razorpay Commerce, and SSO.</span>
      </div>
      <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem;">10,000+ Concurrent Scalability</span>
    </div>
  </div>
</section>"""
with open("scratch/slides/slide_06.html", "w", encoding="utf-8") as f: f.write(s6)

# SLIDE 07
s7 = f"""<section class="slide-item theme-edx" id="slide-7" data-index="7" data-section="PRODUCT 02 // EDXCORE" data-theme="theme-edx">
  <div class="product-watermark-bg">EDXCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_EDX}" alt="EDXcore" onerror="this.onerror=null;this.src='https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_dea10753-7195-4728-8aee-a7e2d2856435_6.webp';">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // ENTERPRISE LMS &amp; ACADEMIC CLOUD</div>
          <h3>EDXcore: 22 Core Modules Built for Scale</h3>
        </div>
      </div>
      <div class="product-header-right">
        {standard_stepper(edx_steps, 2)}
      </div>
    </div>

    <p class="slide-subtitle">
      A comprehensive learning stack architected to manage the full educational journey from course authoring and AI testing to verifiable certifications and commerce.
    </p>

    <div class="grid-4" style="gap: 0.9rem; margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          {ic.icon('book', 18, '#60A5FA')} CURRICULUM &amp; DELIVERY
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
          {ic.icon('pen', 18, '#FBBF24')} ASSESSMENT &amp; PROCTORING
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
          {ic.icon('award', 18, '#34D399')} CREDENTIALS &amp; COMMERCE
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
          {ic.icon('shield', 18, '#C084FC')} GOVERNANCE &amp; SECURITY
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
with open("scratch/slides/slide_07.html", "w", encoding="utf-8") as f: f.write(s7)

# SLIDE 08
s8 = f"""<section class="slide-item theme-edx" id="slide-8" data-index="8" data-section="PRODUCT 02 // EDXCORE" data-theme="theme-edx">
  <div class="product-watermark-bg">EDXCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_EDX}" alt="EDXcore" onerror="this.onerror=null;this.src='https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_dea10753-7195-4728-8aee-a7e2d2856435_6.webp';">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // ENTERPRISE LMS &amp; ACADEMIC CLOUD</div>
          <h3>EDXcore: The End-to-End Digital Learning Journey</h3>
        </div>
      </div>
      <div class="product-header-right">
        {standard_stepper(edx_steps, 3)}
      </div>
    </div>

    <p class="slide-subtitle">
      EDXcore orchestrates a seamless academic pathway from initial institution onboarding to verifiable credential issuance.
    </p>

    <div class="flow-container" style="margin: 1.2rem 0;">
      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('building', 24, '#C084FC')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">01. Admin</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Multi-Tenant &amp; RBAC</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('teacher', 24, '#60A5FA')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Instructor</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Curriculum &amp; Live</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('cap', 24, '#34D399')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Learner</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Video &amp; AI Coach</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('eye', 24, '#FBBF24')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Assessment</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">AI Proctoring Security</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('chart', 24, '#C084FC')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Analytics</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Weighted Gradebook</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step" style="border-color: var(--theme-accent); background: rgba(192, 132, 252, 0.12);">
        <div style="margin-bottom: 0.3rem;">{ic.icon('award', 24, '#C084FC')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">06. Certificate</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Tamper-Proof Verify</div>
      </div>
    </div>

    <div class="grid-4" style="margin-top: 0.6rem;">
      <div class="glass-card card-theme-glow">
        <div style="display:flex; align-items:center; gap:0.4rem; font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">
          {ic.icon('compass', 16, '#C084FC')} Student 360&deg; Portal
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Consecutive daily learning streaks, gamified achievement badges, progress bars, and AI tutor access.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display:flex; align-items:center; gap:0.4rem; font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">
          {ic.icon('teacher', 16, '#60A5FA')} Instructor Hub
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Course performance telemetry, assignment evaluations, revenue share tracking, and 1-on-1 student chat.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display:flex; align-items:center; gap:0.4rem; font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">
          {ic.icon('parents', 16, '#FBBF24')} Parent &amp; Guardian
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Linked student oversight, real-time academic alerts, monthly PDF reports, and course purchase approval.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display:flex; align-items:center; gap:0.4rem; font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">
          {ic.icon('lock', 16, '#34D399')} Proctor Command
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Real-time video grid of exam rooms, breach violation reviews, evidence archives, and instant escalation.
        </div>
      </div>
    </div>
  </div>
</section>"""
with open("scratch/slides/slide_08.html", "w", encoding="utf-8") as f: f.write(s8)

print("LEAP and EDXcore slides updated with SVG icons successfully.")
