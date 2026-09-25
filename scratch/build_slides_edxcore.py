import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

# =========================================================================
# SLIDE 06: EDXCORE INTRODUCTION
# =========================================================================
s6 = """
<section class="slide-item" id="slide-6" data-index="6" data-section="PRODUCT 02 // EDXCORE">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.4rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--purple);"></span>
          PRODUCT 02 • ENTERPRISE LEARNING MANAGEMENT SYSTEM (LMS)
        </div>
        <h2 class="slide-title">
          EDXcore <br>
          <span class="slide-title-gradient">Learning Without Boundaries</span>
        </h2>
      </div>
      <div style="text-align: right;">
        <span class="tech-tag tech-tag-purple" style="font-size: 0.82rem; padding: 0.35rem 0.9rem;">10,000+ Concurrent Scale</span>
      </div>
    </div>

    <p class="slide-subtitle">
      EDXcore is KNR's next-generation cloud Learning Management System. Built for schools, higher education institutions, 
      universities, and enterprise corporate academies, it delivers continuous live and self-paced digital education with verified academic integrity.
    </p>

    <!-- 3 Core Tenets of EDXcore -->
    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card glass-card-glow-purple">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(139, 92, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          🏛️
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Multi-Tenant Architecture</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Complete workspace isolation for multi-campus institutions and corporate academies. Independent subdomains, custom logos, localized color themes, and dedicated admin access.
        </p>
      </div>

      <div class="glass-card glass-card-glow-cyan">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          🤖
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Dual-Layer AI Integration</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Featuring an intelligent public visitor chatbot for course discovery alongside an enrolled AI Learning Coach that assists students 24/7 with complex curriculum queries.
        </p>
      </div>

      <div class="glass-card glass-card-glow-emerald">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(16, 185, 129, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          👁️
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">AI & Live Remote Proctoring</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          High-assurance assessment integrity with automated webcam surveillance, tab-switching alerts, snapshot incident evidence logging, and live room proctor command centers.
        </p>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 07: EDXCORE CAPABILITIES
# =========================================================================
s7 = """
<section class="slide-item" id="slide-7" data-index="7" data-section="PRODUCT 02 // EDXCORE">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.1rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--purple);"></span>
          ENTERPRISE LMS CAPABILITIES
        </div>
        <h2 class="slide-title">
          22 Core Modules Built for Scale
        </h2>
      </div>
      <div style="text-align: right;">
        <span style="font-family: var(--font-mono); font-size: 0.85rem; color: #C084FC; font-weight: 700;">Standards: SCORM 1.2/2004 • xAPI • Razorpay</span>
      </div>
    </div>

    <!-- 4 Functional Pillars for EDXcore -->
    <div class="grid-4" style="gap: 0.9rem;">
      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>📚</span> CURRICULUM & DELIVERY
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Curriculum Builder:</strong> Sections, video lessons & asset downloads<br>
          • <strong>Learning Paths:</strong> Structured career & skill tracks with bundles<br>
          • <strong>Live Classrooms:</strong> Interactive video, Q&A, polls & ICS calendar<br>
          • <strong>SCORM & xAPI:</strong> Standard-compliant third-party module sync<br>
          • <strong>Discussions Forum:</strong> Category threads, upvoting & FAQ conversion
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>📝</span> ASSESSMENT & PROCTORING
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Question Bank:</strong> MCQ, integer, essay with difficulty tagging<br>
          • <strong>AI Doc-to-Quiz:</strong> Automated question creation from course notes<br>
          • <strong>AI Proctoring:</strong> Real-time webcam breach detection & screen lock<br>
          • <strong>Peer Review:</strong> Double-blind student evaluation & grading rubrics<br>
          • <strong>Weighted Gradebook:</strong> Component weights & official PDF transcripts
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>🏅</span> CREDENTIALS & COMMERCE
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Digital Certificates:</strong> Dynamic visual designer & instant issuance<br>
          • <strong>Public Verification:</strong> Tamper-proof URLs (/certificates/{uid})<br>
          • <strong>Cart & Checkout:</strong> Razorpay integration, coupons & wallet<br>
          • <strong>B2B Corporate Seats:</strong> Bulk enterprise licensing & custom invoices<br>
          • <strong>Scholarships & Grants:</strong> Need-based student financial aid queue
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>🛡️</span> GOVERNANCE & SECURITY
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Multi-Factor Auth (MFA):</strong> TOTP QR codes & session protection<br>
          • <strong>RBAC Matrix:</strong> Granular menu permissions & user access rules<br>
          • <strong>Action Center:</strong> Preflight launch health checks & orphan cleanup<br>
          • <strong>Proctor Command:</strong> Live testing rooms & violation escalation<br>
          • <strong>Audit Trail:</strong> System actions, revenue ledgers & IP logs
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 08: EDXCORE LEARNING ECOSYSTEM
# =========================================================================
s8 = """
<section class="slide-item" id="slide-8" data-index="8" data-section="PRODUCT 02 // EDXCORE">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--purple);"></span>
      LIFECYCLE ARCHITECTURE
    </div>
    <h2 class="slide-title">
      The End-to-End Digital Learning Journey
    </h2>
    <p class="slide-subtitle">
      EDXcore orchestrates a seamless academic pathway from initial institution onboarding to verifiable credential issuance.
    </p>

    <!-- Visual Journey Flow -->
    <div class="flow-container" style="margin: 1.6rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🏢</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">01. Admin</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Multi-Tenant Branding & RBAC</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">👩‍🏫</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Instructor</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Curriculum & Live Class</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🎓</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Learner</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Interactive Video & AI Coach</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">👁️</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Assessment</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">AI & Live Proctoring Security</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">📊</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Analytics</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Weighted Gradebook & Scores</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step" style="border-color: var(--cyan); background: rgba(0, 240, 255, 0.08);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🏅</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">06. Certificate</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Tamper-Proof Verification</div>
      </div>
    </div>

    <!-- Multi-Portal Synergy -->
    <div class="grid-4" style="margin-top: 0.8rem;">
      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">🔭 Student 360° Portal</div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Consecutive daily learning streaks, gamified achievement badges, progress bars, and AI tutor access.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">👩‍🏫 Instructor Hub</div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Course performance telemetry, assignment evaluations, revenue share tracking, and 1-on-1 student chat.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">👨‍👩‍👧 Parent & Guardian</div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Linked student oversight, real-time academic alerts, monthly PDF reports, and course purchase approval.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.88rem; color: #FFF; margin-bottom: 0.3rem;">🔒 Proctor Command</div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.45;">
          Real-time video grid of exam rooms, breach violation reviews, evidence archives, and instant escalation.
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 09: EDXCORE VALUE
# =========================================================================
s9 = """
<section class="slide-item" id="slide-9" data-index="9" data-section="PRODUCT 02 // EDXCORE">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--purple);"></span>
      ACADEMIC SCALE & BUSINESS OUTCOMES
    </div>
    <h2 class="slide-title">
      Proven Enterprise Learning Scale
    </h2>
    <p class="slide-subtitle">
      EDXcore is engineered to power digital academies and university programs with guaranteed uptime, academic integrity, and measurable learner outcomes.
    </p>

    <!-- Verified Value Metrics -->
    <div class="grid-4" style="margin-bottom: 1.5rem;">
      <div class="glass-card glass-card-glow-purple" style="text-align: center;">
        <div class="stat-huge" style="color: #C084FC;">10,000+</div>
        <div class="stat-label">Concurrent Scale</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Architected for high-density live sessions, zero-buffer video delivery, and synchronized mass testing.
        </p>
      </div>

      <div class="glass-card glass-card-glow-cyan" style="text-align: center;">
        <div class="stat-huge" style="color: var(--cyan);">100%</div>
        <div class="stat-label">Exam Integrity</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Eliminate assessment fraud via automated browser lockdown, webcam tracking, and proctor evidence review.
        </p>
      </div>

      <div class="glass-card glass-card-glow-emerald" style="text-align: center;">
        <div class="stat-huge" style="color: #34D399;">Zero</div>
        <div class="stat-label">Manual Grading Burden</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Instant auto-evaluation for objective assessments and weighted formula calculation across terms.
        </p>
      </div>

      <div class="glass-card glass-card-glow-amber" style="text-align: center;">
        <div class="stat-huge" style="color: #FBBF24;">1-Click</div>
        <div class="stat-label">Public Verification</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Tamper-proof verifiable credential links and LinkedIn badge integrations for every completed track.
        </p>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: #C084FC; text-align: center; padding: 1.8rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: #C084FC; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
        THE EDXCORE PHILOSOPHY
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.3rem, 2.4vw, 2.2rem); font-weight: 900; color: #FFF;">
        “Learn. Measure. Improve. Grow.”
      </h3>
      <p style="font-size: 0.84rem; color: var(--text-muted); margin-top: 0.5rem; max-width: 720px; margin-left: auto; margin-right: auto;">
        From interactive live classes and AI tutoring to B2B corporate seat licensing — EDXcore delivers learning without boundaries.
      </p>
    </div>
  </div>
</section>
"""

write_slide(6, s6)
write_slide(7, s7)
write_slide(8, s8)
write_slide(9, s9)
