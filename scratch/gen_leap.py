# Generator for LEAP Slides (03, 04, 05)

LOGO_LEAP = "https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/kne..leap.jpg"

def get_stepper(active_idx):
    steps = ["1. STAKEHOLDERS", "2. 29 CAPABILITIES", "3. INSTITUTIONAL ROI"]
    html = '<div class="product-story-stepper">'
    for i, step in enumerate(steps, 1):
        cls = "stepper-step active" if i == active_idx else "stepper-step"
        html += f'<span class="{cls}">&bull; {step}</span>'
    html += '</div>'
    return html

# Slide 03
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
        {get_stepper(1)}
      </div>
    </div>

    <p class="slide-subtitle">
      LEAP eliminates institutional fragmentation by unifying every school workflow into a single intelligent cloud ecosystem.
      It bridges administration, academic delivery, financial governance, and home-to-school engagement into one seamless experience.
    </p>

    <div class="grid-4" style="margin-top: 0.2rem;">
      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.7rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">??</div>
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
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">?????</div>
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
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">???</div>
          <div>
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF;">Administrators</h4>
            <span style="font-size: 0.68rem; color: var(--theme-accent); font-weight: 600;">Financial & Governance Control</span>
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
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">????????</div>
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
      <div style="display: flex; align-items: center; gap: 1rem;">
        <span style="font-size: 1.4rem;">??</span>
        <span style="font-size: 0.85rem; color: #FFF; font-weight: 600;">Unified Educational Operating System Architecture: Eliminates 6+ fragmented vendor software tools.</span>
      </div>
      <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem;">99.98% System Uptime</span>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_03.html", "w", encoding="utf-8") as f:
    f.write(s3)

# Slide 04
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
        {get_stepper(2)}
      </div>
    </div>

    <p class="slide-subtitle">
      Built from the ground up to replace fragmented legacy school software. Each functional cluster is purpose-engineered to automate institutional operations.
    </p>

    <div class="grid-3" style="margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.6rem;">
          <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FFF;">?? Academic Delivery Core</h4>
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
          <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FFF;">?? Finance & Operations</h4>
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
          <span class="tech-tag">Inventory & Assets</span>
          <span class="tech-tag">Hostel Bed Allocator</span>
          <span class="tech-tag">Automated Payroll</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.6rem;">
          <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FFF;">?? Engagement & Exams</h4>
          <span class="tech-tag tech-tag-theme">10 Modules</span>
        </div>
        <p style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.4; margin-bottom: 0.6rem;">
          Multi-channel parent communications and high-security computerized examination grading suites.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
          <span class="tech-tag">Online CBT Engine</span>
          <span class="tech-tag">NEET / JEE Mock Tests</span>
          <span class="tech-tag">Multi-Board Grading</span>
          <span class="tech-tag">Parent Portal & App</span>
          <span class="tech-tag">SMS & WhatsApp Alerts</span>
          <span class="tech-tag">Staff Leave Workflows</span>
          <span class="tech-tag">Digital Library (RFID)</span>
          <span class="tech-tag">Trust Multi-Branch</span>
        </div>
      </div>
    </div>

    <div class="grid-3" style="margin-top: 0.8rem;">
      <div class="glass-card" style="padding: 0.75rem 1rem; border-color: rgba(56, 189, 248, 0.3);">
        <div style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--theme-accent); font-weight: 700;">ADD-ON EXTENSION 01</div>
        <div style="font-size: 0.82rem; font-weight: 700; color: #FFF; margin-top: 0.2rem;">KNR Pay & Instant Fee Gateway</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.15rem;">Automated zero-reconciliation payment gateway with instant SMS receipt generation.</div>
      </div>
      <div class="glass-card" style="padding: 0.75rem 1rem; border-color: rgba(56, 189, 248, 0.3);">
        <div style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--theme-accent); font-weight: 700;">ADD-ON EXTENSION 02</div>
        <div style="font-size: 0.82rem; font-weight: 700; color: #FFF; margin-top: 0.2rem;">KNR Live Fleet GPS Telematics</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.15rem;">Real-time bus tracking, geofence radius alerts, speed limiters & parent notifications.</div>
      </div>
      <div class="glass-card" style="padding: 0.75rem 1rem; border-color: rgba(56, 189, 248, 0.3);">
        <div style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--theme-accent); font-weight: 700;">ADD-ON EXTENSION 03</div>
        <div style="font-size: 0.82rem; font-weight: 700; color: #FFF; margin-top: 0.2rem;">Biometric & RFID Access Guard</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.15rem;">Seamless hardware integration for turnstiles, attendance clocks & library loans.</div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_04.html", "w", encoding="utf-8") as f:
    f.write(s4)

# Slide 05
s5 = f"""<section class="slide-item theme-leap" id="slide-5" data-index="5" data-section="PRODUCT 01 // LEAP" data-theme="theme-leap">
  <div class="product-watermark-bg">LEAP</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_LEAP}" alt="LEAP">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // SCHOOL OPERATING SYSTEM</div>
          <h3>KNR-LEAP: Measurable Institutional Outcomes & Proven ROI</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(3)}
      </div>
    </div>

    <p class="slide-subtitle">
      LEAP transforms educational institutions from manual paper-dependent entities into agile, data-driven powerhouses with instant operational ROI.
    </p>

    <!-- Value Metric Cards -->
    <div class="grid-4" style="margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: var(--theme-accent);">100%</div>
        <div class="stat-label">Centralized Oversight</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Zero disjointed spreadsheets. Single consolidated source of truth for academics, finance, and multi-campus operations.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #34D399;">360&deg;</div>
        <div class="stat-label">Student Visibility</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Holistic tracking of attendance, exams over years, fee collection history, conduct notes, and co-scholastic milestones.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #FBBF24;">4-Way</div>
        <div class="stat-label">Stakeholder Sync</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Instant transparency and automated communication between parents, educators, campus administration, and trust board.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #C084FC;">Zero</div>
        <div class="stat-label">Fee Leakage</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Automated installment schedules, online UPI reconciliation, SMS receipts, and multi-tier fee concession approval controls.
        </p>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card card-theme-glow" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: var(--theme-accent); text-align: center; padding: 1.4rem; margin-top: 1rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: var(--theme-accent); font-weight: 700; text-transform: uppercase; margin-bottom: 0.4rem;">
        THE LEAP PROPOSITION
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.2rem, 2.2vw, 1.8rem); font-weight: 900; color: #FFF;">
        &ldquo;One ecosystem. Every stakeholder. One connected school.&rdquo;
      </h3>
      <p style="font-size: 0.82rem; color: var(--text-muted); margin-top: 0.4rem; max-width: 760px; margin-left: auto; margin-right: auto;">
        From early childhood kindergarten development tracking to competitive NEET &amp; JEE entrance rank engine generation &mdash; LEAP powers modern progressive education.
      </p>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_05.html", "w", encoding="utf-8") as f:
    f.write(s5)

print("LEAP Slides 03, 04, 05 written successfully.")
