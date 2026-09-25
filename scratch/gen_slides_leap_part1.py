import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

# SLIDE 03: LEAP 1/4 - IDENTITY
s3 = """
<section class="slide-item theme-leap" id="slide-3" data-index="3" data-section="PRODUCT 01 // LEAP" data-theme="theme-leap">
  <div class="product-watermark-bg">LEAP</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/kne..leap.jpg" alt="LEAP">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // SCHOOL OPERATING SYSTEM</div>
          <h3>KNR-LEAP: Learners &bull; Educators &bull; Administrators &bull; Parents</h3>
        </div>
      </div>
      <div class="product-header-right">
        <div class="product-story-stepper">
          <span class="stepper-step active">&bull; 1. IDENTITY</span>
          <span class="stepper-step">&bull; 2. CAPABILITIES</span>
          <span class="stepper-step">&bull; 3. ECOSYSTEM</span>
          <span class="stepper-step">&bull; 4. IMPACT</span>
        </div>
      </div>
    </div>

    <p class="slide-subtitle">
      LEAP eliminates institutional fragmentation by unifying every school workflow into a single intelligent cloud ecosystem.
      It bridges administration, academic delivery, financial governance, and home-to-school engagement into one seamless experience.
    </p>

    <div class="grid-4" style="margin-top: 0.2rem;">
      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.7rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">🎓</div>
          <div>
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF;">Learners</h4>
            <span style="font-size: 0.68rem; color: var(--theme-accent); font-weight: 600;">Holistic Development</span>
          </div>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.65rem;">
          Empowered through digital diaries, automated homework tracking, competitive mock exams, and transparent progress.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag tech-tag-theme">Student 360°</span>
          <span class="tech-tag">Online Exams</span>
          <span class="tech-tag">Digital Diary</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.7rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">👩‍🏫</div>
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
          <span class="tech-tag">Attendance</span>
          <span class="tech-tag">Report Cards</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.7rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">🏫</div>
          <div>
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF;">Administrators</h4>
            <span style="font-size: 0.68rem; color: var(--theme-accent); font-weight: 600;">Operational Control</span>
          </div>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.65rem;">
          Automating student admissions, multi-installment fee collection, inventory, staff payroll, and campus security.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag tech-tag-theme">Fee Management+</span>
          <span class="tech-tag">HR & Payroll</span>
          <span class="tech-tag">Inventory & Store</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.7rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">👨‍👩‍👧</div>
          <div>
            <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1rem; color: #FFF;">Parents</h4>
            <span style="font-size: 0.68rem; color: var(--theme-accent); font-weight: 600;">Active Partnership</span>
          </div>
        </div>
        <p style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 0.65rem;">
          Connected through dedicated parent apps, circular alerts, online fee payments, and grievance escalation.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
          <span class="tech-tag tech-tag-theme">Parent App</span>
          <span class="tech-tag">Online Fees</span>
          <span class="tech-tag">Concern Desk</span>
        </div>
      </div>
    </div>
  </div>
</section>
"""

# SLIDE 04: LEAP 2/4 - CAPABILITIES
s4 = """
<section class="slide-item theme-leap" id="slide-4" data-index="4" data-section="PRODUCT 01 // LEAP" data-theme="theme-leap">
  <div class="product-watermark-bg">LEAP</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/kne..leap.jpg" alt="LEAP">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ED-TECH // SCHOOL OPERATING SYSTEM</div>
          <h3>KNR-LEAP: Comprehensive 26 Core + 3 Add-on Capabilities</h3>
        </div>
      </div>
      <div class="product-header-right">
        <div class="product-story-stepper">
          <span class="stepper-step">&bull; 1. IDENTITY</span>
          <span class="stepper-step active">&bull; 2. CAPABILITIES</span>
          <span class="stepper-step">&bull; 3. ECOSYSTEM</span>
          <span class="stepper-step">&bull; 4. IMPACT</span>
        </div>
      </div>
    </div>

    <div class="grid-4" style="gap: 0.85rem; margin-bottom: 0.85rem;">
      <div class="glass-card" style="padding: 0.95rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.86rem; color: var(--theme-accent); margin-bottom: 0.45rem; display: flex; align-items: center; gap: 0.35rem;">
          <span>📚</span> ACADEMIC OPERATIONS
        </div>
        <div style="font-size: 0.73rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Attendance:</strong> Daily & monthly marking, leaves<br>
          • <strong>Lesson Planning:</strong> Topics, status & quiz builder<br>
          • <strong>Time Table:</strong> Workload balancing & slots<br>
          • <strong>Master Calendar:</strong> Holidays, pivot events & exams<br>
          • <strong>Student Diary:</strong> Subject-wise digital notes
        </div>
      </div>

      <div class="glass-card" style="padding: 0.95rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.86rem; color: var(--theme-accent); margin-bottom: 0.45rem; display: flex; align-items: center; gap: 0.35rem;">
          <span>💰</span> FINANCIAL & HR SUITE
        </div>
        <div style="font-size: 0.73rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Fee Management+:</strong> Slabs, UPI, installments & discounts<br>
          • <strong>Expense Control:</strong> Multi-level approvals & ledger<br>
          • <strong>HR & Payroll:</strong> Salary configurator, payslips & taxes<br>
          • <strong>Inventory Management:</strong> In/out stock & distribution<br>
          • <strong>School Store:</strong> Item catalog, POs & stock
        </div>
      </div>

      <div class="glass-card" style="padding: 0.95rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.86rem; color: var(--theme-accent); margin-bottom: 0.45rem; display: flex; align-items: center; gap: 0.35rem;">
          <span>🔭</span> STUDENT LIFECYCLE
        </div>
        <div style="font-size: 0.73rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Student 360°:</strong> Consolidated profile & performance<br>
          • <strong>Admission & Enquiry:</strong> Funnel tracking & mass import<br>
          • <strong>Student Allocation:</strong> Sections & roll allotment<br>
          • <strong>Digital Certificates:</strong> Transfer, Study, Bonafide<br>
          • <strong>Parent Concerns:</strong> Multi-tier grievance ticketing
        </div>
      </div>

      <div class="glass-card" style="padding: 0.95rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.86rem; color: var(--theme-accent); margin-bottom: 0.45rem; display: flex; align-items: center; gap: 0.35rem;">
          <span>📊</span> ASSESSMENT & GOVERNANCE
        </div>
        <div style="font-size: 0.73rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Examination:</strong> Grading config, mark sheets & cards<br>
          • <strong>Kindergarten:</strong> Milestones & visual evaluations<br>
          • <strong>Communication:</strong> Circulars, SMS & alert notifications<br>
          • <strong>Data & Analytics:</strong> Demographics & year trends<br>
          • <strong>Visitor Security:</strong> Gatepass security & visitor logs
        </div>
      </div>
    </div>

    <!-- The 3 Add-on Superchargers -->
    <div class="glass-card" style="border-color: var(--theme-accent); background: rgba(56, 189, 248, 0.08); padding: 0.8rem 1.2rem;">
      <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.8rem;">
        <div>
          <span class="tech-tag tech-tag-theme" style="font-weight: 700; margin-bottom: 0.15rem;">ADD-ON ENGINES</span>
          <div style="font-family: var(--font-display); font-size: 0.86rem; font-weight: 700; color: #FFF;">
            High-Impact Specialized Extensions For Modern Institutions
          </div>
        </div>
        <div style="display: flex; gap: 1.2rem; flex-wrap: wrap;">
          <div style="display: flex; align-items: center; gap: 0.45rem;">
            <span style="font-size: 1.15rem;">🏆</span>
            <div>
              <div style="font-size: 0.76rem; font-weight: 700; color: #FFF;">COMPETITIVE EXAMS</div>
              <div style="font-size: 0.65rem; color: var(--theme-accent);">NEET, JEE & CET Rank Engine</div>
            </div>
          </div>
          <div style="display: flex; align-items: center; gap: 0.45rem;">
            <span style="font-size: 1.15rem;">🎓</span>
            <div>
              <div style="font-size: 0.76rem; font-weight: 700; color: #FFF;">CAMPUS LMS</div>
              <div style="font-size: 0.65rem; color: var(--theme-accent);">Video Lessons & Auto-Quizzes</div>
            </div>
          </div>
          <div style="display: flex; align-items: center; gap: 0.45rem;">
            <span style="font-size: 1.15rem;">📰</span>
            <div>
              <div style="font-size: 0.76rem; font-weight: 700; color: #FFF;">DYNAMIC CMS</div>
              <div style="font-size: 0.65rem; color: var(--theme-accent);">Website & Announcement Portal</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
"""

write_slide(3, s3)
write_slide(4, s4)
