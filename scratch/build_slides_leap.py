import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

# =========================================================================
# SLIDE 02: LEAP INTRODUCTION
# =========================================================================
s2 = """
<section class="slide-item" id="slide-2" data-index="2" data-section="PRODUCT 01 // LEAP">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.4rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--cyan);"></span>
          PRODUCT 01 • UNIFIED SCHOOL OPERATING SYSTEM
        </div>
        <h2 class="slide-title">
          KNR-LEAP <br>
          <span class="slide-title-gradient">Learners • Educators • Administrators • Parents</span>
        </h2>
      </div>
      <div style="text-align: right;">
        <span class="tech-tag tech-tag-cyan" style="font-size: 0.82rem; padding: 0.35rem 0.9rem;">26 Core + 3 Add-on Modules</span>
      </div>
    </div>

    <p class="slide-subtitle">
      LEAP eliminates institutional fragmentation by unifying every school operation into a single intelligent cloud ecosystem.
      It solves the disconnect between classroom learning, administrative tracking, financial governance, and home-to-school communication.
    </p>

    <!-- The 4 Core Stakeholder Pillars -->
    <div class="grid-4" style="margin-top: 0.4rem;">
      <div class="glass-card glass-card-glow-primary">
        <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.8rem;">
          <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(59, 130, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">🎓</div>
          <div>
            <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.05rem; color: #FFF;">Learners</h3>
            <span style="font-size: 0.72rem; color: #60A5FA; font-weight: 600;">Holistic Development</span>
          </div>
        </div>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.75rem;">
          Empowered through digital diaries, automated homework tracking, competitive mock exams, and transparent academic progress.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">Student 360°</span>
          <span class="tech-tag">Online Exams</span>
          <span class="tech-tag">Digital Diary</span>
        </div>
      </div>

      <div class="glass-card glass-card-glow-emerald">
        <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.8rem;">
          <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(16, 185, 129, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">👩‍🏫</div>
          <div>
            <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.05rem; color: #FFF;">Educators</h3>
            <span style="font-size: 0.72rem; color: #34D399; font-weight: 600;">Teaching Acceleration</span>
          </div>
        </div>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.75rem;">
          Streamlining daily attendance marking, curriculum lesson planning, grade entry, term marks calculation, and teacher leave requests.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">Lesson Planner</span>
          <span class="tech-tag">Attendance</span>
          <span class="tech-tag">Report Cards</span>
        </div>
      </div>

      <div class="glass-card glass-card-glow-amber">
        <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.8rem;">
          <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245, 158, 11, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">🏫</div>
          <div>
            <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.05rem; color: #FFF;">Administrators</h3>
            <span style="font-size: 0.72rem; color: #FBBF24; font-weight: 600;">Operational Control</span>
          </div>
        </div>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.75rem;">
          Automating student admissions, multi-installment fee collection, inventory, staff payroll, expense approvals, and campus security.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">Fee Management+</span>
          <span class="tech-tag">HR & Payroll</span>
          <span class="tech-tag">Inventory & Store</span>
        </div>
      </div>

      <div class="glass-card glass-card-glow-purple">
        <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.8rem;">
          <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(139, 92, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">👨‍👩‍👧</div>
          <div>
            <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.05rem; color: #FFF;">Parents</h3>
            <span style="font-size: 0.72rem; color: #C084FC; font-weight: 600;">Active Partnership</span>
          </div>
        </div>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.75rem;">
          Connected through dedicated parent mobile & web apps, instant circular notifications, online fee payment receipts, and grievance escalation.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag">Parent App</span>
          <span class="tech-tag">Online Fees</span>
          <span class="tech-tag">Concern Desk</span>
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 03: LEAP CAPABILITIES
# =========================================================================
s3 = """
<section class="slide-item" id="slide-3" data-index="3" data-section="PRODUCT 01 // LEAP">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.1rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--cyan);"></span>
          ARCHITECTURE • 26 CORE + 3 ADD-ON MODULES
        </div>
        <h2 class="slide-title">
          Comprehensive School Ecosystem Capabilities
        </h2>
      </div>
      <div style="text-align: right;">
        <span style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--cyan); font-weight: 700;">222+ Validated Capabilities</span>
      </div>
    </div>

    <!-- Verified Modules Functional Grid -->
    <div class="grid-4" style="gap: 0.9rem; margin-bottom: 1rem;">
      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>📚</span> ACADEMIC OPERATIONS
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Attendance:</strong> Daily marking, monthly summaries & leaves<br>
          • <strong>Lesson Planning:</strong> Topics, status tracking & quiz builder<br>
          • <strong>Time Table:</strong> Workload balancing & slot allocation<br>
          • <strong>Master Calendar:</strong> Holidays, pivot events & exam dates<br>
          • <strong>Student Diary:</strong> General & subject-wise digital notes
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>💰</span> FINANCIAL & HR SUITE
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Fee Management+:</strong> Slabs, UPI, installments & concessions<br>
          • <strong>Expense Control:</strong> Multi-level approvals & ledgers<br>
          • <strong>HR & Payroll:</strong> Salary configurator, payslips & tax slabs<br>
          • <strong>Inventory Management:</strong> In/out stock & distribution<br>
          • <strong>School Store:</strong> Item catalog, purchase orders & stock
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>🔭</span> STUDENT LIFECYCLE
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Student 360°:</strong> Consolidated profile, academics & fees<br>
          • <strong>Admission & Enquiry:</strong> Pipeline tracking & mass onboarding<br>
          • <strong>Student Allocation:</strong> Sections, roll numbers & promotion<br>
          • <strong>Digital Certificates:</strong> Transfer, Study, Bonafide, Conduct<br>
          • <strong>Parent Concerns:</strong> Multi-tier grievance resolution
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>📊</span> ASSESSMENT & GOVERNANCE
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Examination:</strong> Grading config, mark sheets & report cards<br>
          • <strong>Kindergarten:</strong> Activity milestones & visual evaluations<br>
          • <strong>Communication:</strong> Circulars, SMS & alert notifications<br>
          • <strong>Data & Analytics:</strong> Demographics & multi-year trends<br>
          • <strong>Visitor Management:</strong> Gatepass security & visitor logs
        </div>
      </div>
    </div>

    <!-- The 3 Special Add-On Modules -->
    <div class="glass-card" style="background: rgba(14, 22, 54, 0.85); border-color: rgba(0, 240, 255, 0.3); padding: 0.9rem 1.3rem;">
      <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.8rem;">
        <div>
          <span class="tech-tag tech-tag-cyan" style="font-weight: 700; margin-bottom: 0.15rem;">ADD-ON ENGINES</span>
          <div style="font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; color: #FFF;">
            High-Impact Specialized Extensions For Modern Institutions
          </div>
        </div>
        <div style="display: flex; gap: 1.2rem; flex-wrap: wrap;">
          <div style="display: flex; align-items: center; gap: 0.5rem;">
            <span style="font-size: 1.15rem;">🏆</span>
            <div>
              <div style="font-size: 0.8rem; font-weight: 700; color: #FBBF24;">COMPETITIVE EXAMS</div>
              <div style="font-size: 0.68rem; color: var(--text-dim);">NEET, JEE & CET Rank Engine</div>
            </div>
          </div>
          <div style="display: flex; align-items: center; gap: 0.5rem;">
            <span style="font-size: 1.15rem;">🎓</span>
            <div>
              <div style="font-size: 0.8rem; font-weight: 700; color: #C084FC;">CAMPUS LMS</div>
              <div style="font-size: 0.68rem; color: var(--text-dim);">Video Lessons & Auto-Quizzes</div>
            </div>
          </div>
          <div style="display: flex; align-items: center; gap: 0.5rem;">
            <span style="font-size: 1.15rem;">📰</span>
            <div>
              <div style="font-size: 0.8rem; font-weight: 700; color: var(--cyan);">DYNAMIC CMS</div>
              <div style="font-size: 0.68rem; color: var(--text-dim);">Website & Announcement Portal</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 04: LEAP ECOSYSTEM
# =========================================================================
s4 = """
<section class="slide-item" id="slide-4" data-index="4" data-section="PRODUCT 01 // LEAP">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--cyan);"></span>
      DATA & WORKFLOW ORCHESTRATION
    </div>
    <h2 class="slide-title">
      How LEAP Orchestrates The Connected School
    </h2>
    <p class="slide-subtitle">
      Information is never trapped in departmental silos. Every event in the classroom instantly synchronizes with administrative ledgers, 
      parent notifications, and executive decision dashboards.
    </p>

    <!-- Interactive Stakeholder Connection Diagram -->
    <div class="flow-container" style="margin: 1.6rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.7rem; margin-bottom: 0.3rem;">👨‍🎓</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #60A5FA;">Learner</div>
        <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 0.25rem;">
          Homework • Attendance • Exam Scores • Activity Record
        </div>
      </div>

      <div class="flow-connector">⇄</div>

      <div class="flow-step">
        <div style="font-size: 1.7rem; margin-bottom: 0.3rem;">👩‍🏫</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #34D399;">Educator</div>
        <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 0.25rem;">
          Lesson Plans • Mark Entries • Digital Diary • Leave Tracking
        </div>
      </div>

      <div class="flow-connector">⇄</div>

      <div class="flow-step" style="border-color: var(--cyan); background: rgba(0, 240, 255, 0.08); box-shadow: 0 0 20px rgba(0,240,255,0.15);">
        <div style="font-size: 1.7rem; margin-bottom: 0.3rem;">⚙️</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: var(--cyan);">LEAP CORE</div>
        <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 0.25rem;">
          Automated Rules • Role RBAC • Approvals • Data Hub
        </div>
      </div>

      <div class="flow-connector">⇄</div>

      <div class="flow-step">
        <div style="font-size: 1.7rem; margin-bottom: 0.3rem;">🏫</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #FBBF24;">Administration</div>
        <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 0.25rem;">
          Fee Ledger • Payroll • Stock • Expense Sign-off
        </div>
      </div>

      <div class="flow-connector">⇄</div>

      <div class="flow-step">
        <div style="font-size: 1.7rem; margin-bottom: 0.3rem;">👨‍👩‍👧</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.95rem; color: #C084FC;">Parent</div>
        <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 0.25rem;">
          Fee Payments • Progress Reports • Alerts • Concerns
        </div>
      </div>
    </div>

    <!-- Multi-Interface Experience -->
    <div class="grid-3" style="margin-top: 0.8rem;">
      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.92rem; color: #FFF; margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>📱</span> Dedicated Mobile Apps
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Native iOS and Android apps for Parents and Teachers providing biometric security, push notifications, fee receipts, and digital diaries.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.92rem; color: #FFF; margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>💻</span> Web Command Console
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          High-velocity responsive web portal for School Administrators and Principals featuring approval workflows, fee collection, and student 360 dashboards.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.92rem; color: #FFF; margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>🔒</span> Enterprise Security & Roles
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Granular role-based work groups, dynamic permission matrices, encrypted student data storage, and audit logging across financial and academic actions.
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 05: LEAP VALUE
# =========================================================================
s5 = """
<section class="slide-item" id="slide-5" data-index="5" data-section="PRODUCT 01 // LEAP">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--cyan);"></span>
      INSTITUTIONAL VALUE CREATION
    </div>
    <h2 class="slide-title">
      Measurable Institutional Outcomes
    </h2>
    <p class="slide-subtitle">
      LEAP transforms schools from manual paper-dependent entities into agile, data-driven educational powerhouses.
    </p>

    <!-- Value Metric Cards -->
    <div class="grid-4" style="margin-bottom: 1.5rem;">
      <div class="glass-card glass-card-glow-cyan" style="text-align: center;">
        <div class="stat-huge" style="color: var(--cyan);">100%</div>
        <div class="stat-label">Centralized Oversight</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Zero disjointed spreadsheets. Single consolidated source of truth for academics, finance, and operations.
        </p>
      </div>

      <div class="glass-card glass-card-glow-emerald" style="text-align: center;">
        <div class="stat-huge" style="color: #34D399;">360°</div>
        <div class="stat-label">Student Visibility</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Holistic tracking of attendance, exams over years, fee collection, conduct, and co-scholastic milestones.
        </p>
      </div>

      <div class="glass-card glass-card-glow-amber" style="text-align: center;">
        <div class="stat-huge" style="color: #FBBF24;">4-Way</div>
        <div class="stat-label">Stakeholder Sync</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Instant transparency between parents, educators, campus administration, and trust management.
        </p>
      </div>

      <div class="glass-card glass-card-glow-purple" style="text-align: center;">
        <div class="stat-huge" style="color: #C084FC;">Zero</div>
        <div class="stat-label">Fee Leakage</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Automated installment schedules, online UPI reconciliation, and multi-tier fee concession approval controls.
        </p>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: var(--cyan); text-align: center; padding: 1.8rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: var(--cyan); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
        THE LEAP COMMITMENT
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.3rem, 2.4vw, 2.2rem); font-weight: 900; color: #FFF;">
        “One ecosystem. Every stakeholder. One connected school.”
      </h3>
      <p style="font-size: 0.84rem; color: var(--text-muted); margin-top: 0.5rem; max-width: 720px; margin-left: auto; margin-right: auto;">
        From early childhood kindergarten development tracking to competitive NEET & JEE entrance rank engine generation — LEAP powers modern education.
      </p>
    </div>
  </div>
</section>
"""

write_slide(2, s2)
write_slide(3, s3)
write_slide(4, s4)
write_slide(5, s5)
