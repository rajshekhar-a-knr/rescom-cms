-- ============================================================
-- Rescom IT Company - Complete Database Schema
-- Database: rescom_cms
-- ============================================================

CREATE DATABASE IF NOT EXISTS rescom_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE rescom_cms;

-- ============================================================
-- CORE CMS TABLES
-- ============================================================

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('superadmin','admin','editor') DEFAULT 'editor',
    avatar VARCHAR(255) NULL,
    is_active TINYINT(1) DEFAULT 1,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(255) NOT NULL UNIQUE,
    `value` LONGTEXT NULL,
    `group` VARCHAR(100) DEFAULT 'general',
    `type` ENUM('text','textarea','image','boolean','json','color') DEFAULT 'text',
    label VARCHAR(255) NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE menus (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(100) NOT NULL DEFAULT 'header',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE menu_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    menu_id BIGINT UNSIGNED NOT NULL,
    parent_id BIGINT UNSIGNED NULL,
    title VARCHAR(255) NOT NULL,
    url VARCHAR(500) NULL,
    target ENUM('_self','_blank') DEFAULT '_self',
    icon VARCHAR(100) NULL,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES menu_items(id) ON DELETE SET NULL
);

-- ============================================================
-- PAGES & CONTENT
-- ============================================================

CREATE TABLE pages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content LONGTEXT NULL,
    excerpt TEXT NULL,
    featured_image VARCHAR(500) NULL,
    template VARCHAR(100) DEFAULT 'default',
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    meta_keywords TEXT NULL,
    og_image VARCHAR(500) NULL,
    status ENUM('published','draft','archived') DEFAULT 'published',
    show_in_header TINYINT(1) DEFAULT 0,
    show_in_footer TINYINT(1) DEFAULT 0,
    sort_order INT DEFAULT 0,
    author_id BIGINT UNSIGNED NULL,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
);

-- ============================================================
-- LEGAL PAGES
-- ============================================================

CREATE TABLE legal_pages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content LONGTEXT NULL,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- SERVICES
-- ============================================================

CREATE TABLE service_categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    icon VARCHAR(100) NULL,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE services (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    short_description TEXT NULL,
    description LONGTEXT NULL,
    icon VARCHAR(100) NULL,
    featured_image VARCHAR(500) NULL,
    banner_image VARCHAR(500) NULL,
    features JSON NULL,
    technologies JSON NULL,
    sort_order INT DEFAULT 0,
    is_featured TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES service_categories(id) ON DELETE SET NULL
);

-- ============================================================
-- PORTFOLIO / PROJECTS
-- ============================================================

CREATE TABLE portfolio_categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE portfolios (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    client_name VARCHAR(255) NULL,
    client_url VARCHAR(500) NULL,
    short_description TEXT NULL,
    description LONGTEXT NULL,
    challenge TEXT NULL,
    solution TEXT NULL,
    results TEXT NULL,
    featured_image VARCHAR(500) NULL,
    gallery JSON NULL,
    technologies JSON NULL,
    project_url VARCHAR(500) NULL,
    completion_date DATE NULL,
    is_featured TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES portfolio_categories(id) ON DELETE SET NULL
);

-- ============================================================
-- BLOG
-- ============================================================

CREATE TABLE blog_categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    featured_image VARCHAR(500) NULL,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE blog_tags (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE blog_posts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NULL,
    author_id BIGINT UNSIGNED NULL,
    title VARCHAR(500) NOT NULL,
    slug VARCHAR(500) NOT NULL UNIQUE,
    excerpt TEXT NULL,
    content LONGTEXT NULL,
    featured_image VARCHAR(500) NULL,
    reading_time INT DEFAULT 5,
    views INT DEFAULT 0,
    is_featured TINYINT(1) DEFAULT 0,
    status ENUM('published','draft','archived') DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    meta_keywords TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES blog_categories(id) ON DELETE SET NULL,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE blog_post_tags (
    post_id BIGINT UNSIGNED NOT NULL,
    tag_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (post_id, tag_id),
    FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES blog_tags(id) ON DELETE CASCADE
);

-- ============================================================
-- TEAM
-- ============================================================

CREATE TABLE team_departments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE team_members (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    department_id BIGINT UNSIGNED NULL,
    name VARCHAR(255) NOT NULL,
    designation VARCHAR(255) NULL,
    bio TEXT NULL,
    photo VARCHAR(500) NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(50) NULL,
    linkedin_url VARCHAR(500) NULL,
    twitter_url VARCHAR(500) NULL,
    github_url VARCHAR(500) NULL,
    skills JSON NULL,
    experience_years INT DEFAULT 0,
    is_featured TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES team_departments(id) ON DELETE SET NULL
);

-- ============================================================
-- TESTIMONIALS
-- ============================================================

CREATE TABLE testimonials (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(255) NOT NULL,
    client_designation VARCHAR(255) NULL,
    client_company VARCHAR(255) NULL,
    client_photo VARCHAR(500) NULL,
    content TEXT NOT NULL,
    rating TINYINT DEFAULT 5,
    project_type VARCHAR(100) NULL,
    is_featured TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- CLIENTS / PARTNERS
-- ============================================================

CREATE TABLE clients (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    logo VARCHAR(500) NULL,
    website_url VARCHAR(500) NULL,
    type ENUM('client','partner','technology') DEFAULT 'client',
    is_featured TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- CAREERS / JOBS
-- ============================================================

CREATE TABLE job_listings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    department VARCHAR(100) NULL,
    location VARCHAR(255) NULL,
    job_type ENUM('full-time','part-time','contract','internship','remote') DEFAULT 'full-time',
    experience VARCHAR(100) NULL,
    salary_range VARCHAR(100) NULL,
    description LONGTEXT NULL,
    requirements TEXT NULL,
    responsibilities TEXT NULL,
    benefits TEXT NULL,
    skills_required JSON NULL,
    vacancies INT DEFAULT 1,
    deadline DATE NULL,
    status ENUM('open','closed','draft') DEFAULT 'open',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE job_applications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    job_id BIGINT UNSIGNED NULL,
    applicant_name VARCHAR(255) NOT NULL,
    applicant_email VARCHAR(255) NOT NULL,
    applicant_phone VARCHAR(50) NULL,
    cover_letter TEXT NULL,
    resume_path VARCHAR(500) NULL,
    portfolio_url VARCHAR(500) NULL,
    linkedin_url VARCHAR(500) NULL,
    current_ctc VARCHAR(100) NULL,
    expected_ctc VARCHAR(100) NULL,
    notice_period VARCHAR(100) NULL,
    status ENUM('pending','reviewing','shortlisted','interviewed','hired','rejected') DEFAULT 'pending',
    admin_notes TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES job_listings(id) ON DELETE SET NULL
);

-- ============================================================
-- CONTACT / INQUIRIES
-- ============================================================

CREATE TABLE contacts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NULL,
    company VARCHAR(255) NULL,
    subject VARCHAR(255) NULL,
    service_interested VARCHAR(255) NULL,
    message TEXT NOT NULL,
    budget_range VARCHAR(100) NULL,
    source VARCHAR(100) NULL,
    ip_address VARCHAR(45) NULL,
    status ENUM('new','read','replied','spam','archived') DEFAULT 'new',
    admin_notes TEXT NULL,
    replied_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- HERO BANNERS / SLIDERS
-- ============================================================

CREATE TABLE hero_banners (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(500) NOT NULL,
    subtitle TEXT NULL,
    description TEXT NULL,
    image VARCHAR(500) NULL,
    mobile_image VARCHAR(500) NULL,
    video_url VARCHAR(500) NULL,
    btn1_text VARCHAR(100) NULL,
    btn1_url VARCHAR(500) NULL,
    btn2_text VARCHAR(100) NULL,
    btn2_url VARCHAR(500) NULL,
    badge_text VARCHAR(100) NULL,
    text_color VARCHAR(20) DEFAULT '#ffffff',
    overlay_opacity DECIMAL(3,2) DEFAULT 0.60,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- STATS / COUNTERS
-- ============================================================

CREATE TABLE stats (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    value VARCHAR(50) NOT NULL,
    suffix VARCHAR(20) NULL,
    icon VARCHAR(100) NULL,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- FAQ
-- ============================================================

CREATE TABLE faqs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer LONGTEXT NOT NULL,
    category VARCHAR(100) DEFAULT 'general',
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- TECHNOLOGIES / SKILLS SHOWCASE
-- ============================================================

CREATE TABLE technologies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    logo VARCHAR(500) NULL,
    category ENUM('frontend','backend','mobile','database','cloud','devops','other') DEFAULT 'other',
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- NEWSLETTER SUBSCRIBERS
-- ============================================================

CREATE TABLE newsletter_subscribers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NULL,
    status ENUM('active','unsubscribed') DEFAULT 'active',
    subscribed_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- MEDIA LIBRARY
-- ============================================================

CREATE TABLE media (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(500) NOT NULL,
    original_name VARCHAR(500) NOT NULL,
    path VARCHAR(500) NOT NULL,
    mime_type VARCHAR(100) NULL,
    size BIGINT NULL,
    width INT NULL,
    height INT NULL,
    alt_text VARCHAR(255) NULL,
    caption TEXT NULL,
    folder VARCHAR(255) DEFAULT 'uploads',
    uploaded_by BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
);

-- ============================================================
-- ACTIVITY LOGS
-- ============================================================

CREATE TABLE activity_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    action VARCHAR(255) NOT NULL,
    model_type VARCHAR(255) NULL,
    model_id BIGINT UNSIGNED NULL,
    old_values JSON NULL,
    new_values JSON NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- ============================================================
-- SEED DATA
-- ============================================================

-- Admin User (password: Admin@123)
INSERT INTO users (name, email, password, role) VALUES 
('Super Admin', 'admin@rescom.in', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin'),
('John Manager', 'manager@rescom.in', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- NOTE: Default password is "password" - CHANGE IMMEDIATELY in production
-- To use Admin@123, run: php artisan tinker then User::find(1)->update(['password' => bcrypt('Admin@123')]);

-- Settings
INSERT INTO settings (`key`, `value`, `group`, `type`, `label`) VALUES
('site_name', 'Rescom', 'general', 'text', 'Site Name'),
('site_tagline', 'Empowering Businesses Through Technology', 'general', 'text', 'Site Tagline'),
('site_description', 'Rescom is a leading IT solutions company providing cutting-edge technology services including web development, mobile apps, cloud solutions, cybersecurity, and digital transformation.', 'general', 'textarea', 'Site Description'),
('site_logo', '/images/logo.png', 'general', 'image', 'Site Logo'),
('site_logo_dark', '/images/logo-dark.png', 'general', 'image', 'Site Logo (Dark)'),
('site_favicon', '/images/favicon.ico', 'general', 'image', 'Favicon'),
('contact_email', 'info@rescom.in', 'contact', 'text', 'Contact Email'),
('contact_phone', '+91 98459 19158', 'contact', 'text', 'Contact Phone'),
('contact_phone2', '+91 98459 19158', 'contact', 'text', 'Contact Phone 2'),
('contact_address', '123, Tech Park, Electronic City, Bengaluru, Karnataka - 560100, India', 'contact', 'textarea', 'Office Address'),
('contact_address2', 'Unit 4B, Innovation Hub, Whitefield, Bengaluru - 560066', 'contact', 'textarea', 'Branch Address'),
('business_hours', 'Mon - Sat: 9:00 AM - 7:00 PM IST', 'contact', 'text', 'Business Hours'),
('social_facebook', 'https://facebook.com/rescom', 'social', 'text', 'Facebook URL'),
('social_twitter', 'https://twitter.com/rescom', 'social', 'text', 'Twitter/X URL'),
('social_linkedin', 'https://linkedin.com/company/rescom', 'social', 'text', 'LinkedIn URL'),
('social_instagram', 'https://instagram.com/rescom', 'social', 'text', 'Instagram URL'),
('social_youtube', 'https://youtube.com/@rescom', 'social', 'text', 'YouTube URL'),
('social_github', 'https://github.com/rescom', 'social', 'text', 'GitHub URL'),
('about_founded', '2021', 'about', 'text', 'Year Founded'),
('about_employees', '150+', 'about', 'text', 'Team Size'),
('about_projects', '500+', 'about', 'text', 'Projects Completed'),
('about_clients', '200+', 'about', 'text', 'Happy Clients'),
('about_countries', '20+', 'about', 'text', 'Countries Served'),
('header_cta_text', 'Get the Demo', 'header', 'text', 'Header CTA Button Text'),
('header_cta_url', '/contact', 'header', 'text', 'Header CTA Button URL'),
('footer_about', 'Rescom is your trusted technology partner for digital transformation. We build innovative solutions that drive business growth.', 'footer', 'textarea', 'Footer About Text'),
('analytics_code', '', 'advanced', 'textarea', 'Google Analytics Code'),
('meta_title_suffix', ' | Rescom - IT Solutions', 'seo', 'text', 'Meta Title Suffix'),
('recaptcha_site_key', '', 'advanced', 'text', 'reCAPTCHA Site Key'),
('recaptcha_secret_key', '', 'advanced', 'text', 'reCAPTCHA Secret Key'),
('maintenance_mode', '0', 'advanced', 'boolean', 'Maintenance Mode'),
('whatsapp_number', '+91 98459 19158', 'contact', 'text', 'WhatsApp Number');

-- Hero Banners
INSERT INTO hero_banners (title, subtitle, description, btn1_text, btn1_url, btn2_text, btn2_url, badge_text, sort_order) VALUES
('Transforming Ideas Into Powerful Digital Solutions', 'Next-Gen IT Services', 'We are a leading technology company specializing in custom software development, cloud solutions, cybersecurity, and digital transformation for businesses worldwide.', 'Get the Demo', '/contact', 'View Our Work', '/portfolio', '🚀 Trusted by 200+ Companies', 1),
('Build Scalable Web & Mobile Applications', 'Full Stack Development', 'From concept to deployment, our expert developers craft high-performance applications using the latest technologies to accelerate your business growth.', 'Start Your Project', '/contact', 'Explore Services', '/services', '⚡ 500+ Projects Delivered', 2),
('Secure Your Business With Enterprise Cybersecurity', 'Advanced Security Solutions', 'Protect your digital assets with our comprehensive cybersecurity services including penetration testing, compliance, and 24/7 threat monitoring.', 'Secure My Business', '/contact', 'Learn More', '/services/cybersecurity', '🔒 ISO 27001 Certified', 3);

-- Service Categories
INSERT INTO service_categories (name, slug, description, icon, sort_order) VALUES
('Web Development', 'web-development', 'Custom web solutions for all business needs', 'fas fa-globe', 1),
('Mobile Development', 'mobile-development', 'iOS and Android app development', 'fas fa-mobile-alt', 2),
('Cloud Solutions', 'cloud-solutions', 'Scalable cloud infrastructure and migration', 'fas fa-cloud', 3),
('Cybersecurity', 'cybersecurity', 'Comprehensive security services', 'fas fa-shield-alt', 4),
('AI & Machine Learning', 'ai-ml', 'Intelligent automation and analytics', 'fas fa-brain', 5),
('Digital Marketing', 'digital-marketing', 'SEO, PPC and growth strategies', 'fas fa-chart-line', 6),
('IT Consulting', 'it-consulting', 'Strategic technology advisory', 'fas fa-lightbulb', 7),
('UI/UX Design', 'ui-ux-design', 'Beautiful and intuitive design', 'fas fa-palette', 8);

-- Services
INSERT INTO services (category_id, title, slug, short_description, description, icon, is_featured, features, technologies) VALUES
(1, 'Custom Web Development', 'custom-web-development', 'High-performance, scalable web applications built with modern technologies tailored to your business needs.', '<h3>Custom Web Development Services</h3><p>We build powerful, scalable web applications that drive business results. Our expert team uses cutting-edge technologies to deliver solutions that are fast, secure, and built to grow with your business.</p><h4>Our Approach</h4><p>We follow an agile development methodology ensuring transparency, quality, and on-time delivery. From startups to enterprise clients, we deliver web solutions that make an impact.</p>', 'fas fa-code', 1, '["Custom CMS Development","E-commerce Solutions","Enterprise Web Apps","Progressive Web Apps","API Development & Integration","Performance Optimization","Responsive Design","Cross-browser Compatibility"]', '["Laravel","React","Vue.js","Node.js","PHP","MySQL","PostgreSQL","Redis"]'),
(1, 'E-Commerce Development', 'ecommerce-development', 'Feature-rich online stores with seamless payment integration, inventory management, and outstanding UX.', '<h3>E-Commerce Development</h3><p>Launch and scale your online business with our robust e-commerce solutions. We build custom shopping experiences that convert visitors into loyal customers.</p>', 'fas fa-shopping-cart', 1, '["Custom Shopping Cart","Payment Gateway Integration","Multi-vendor Marketplace","Inventory Management","Order Tracking","Mobile-first Design","SEO Optimization","Analytics Dashboard"]', '["WooCommerce","Shopify","Magento","Laravel","React","Stripe","PayPal","Razorpay"]'),
(2, 'iOS App Development', 'ios-app-development', 'Premium iOS applications with exceptional user experience, published on the Apple App Store.', '<h3>iOS App Development</h3><p>We create beautiful, high-performance iOS applications that users love. Our Swift and Objective-C experts build apps that leverage the full power of the Apple ecosystem.</p>', 'fab fa-apple', 1, '["Native iOS Development","SwiftUI Applications","AR/VR Apps","Apple Watch Apps","App Store Optimization","Push Notifications","In-App Purchases","Background Processing"]', '["Swift","SwiftUI","Objective-C","Xcode","Firebase","CoreData","ARKit","HealthKit"]'),
(2, 'Android App Development', 'android-app-development', 'Feature-rich Android applications for phones, tablets and wearables, published on Google Play Store.', '<h3>Android App Development</h3><p>Our Android developers create powerful apps that reach billions of users worldwide. We specialize in Kotlin and Java development for optimal performance.</p>', 'fab fa-android', 1, '["Native Android Apps","Kotlin Development","Material Design","Google Play Publishing","Push Notifications","Offline Functionality","Google Maps Integration","Payment Integration"]', '["Kotlin","Java","Android Studio","Firebase","Room","Retrofit","RxJava","Google Maps SDK"]'),
(2, 'Cross-Platform Development', 'cross-platform-development', 'Build once, deploy everywhere with Flutter and React Native for iOS and Android.', '<h3>Cross-Platform Mobile Development</h3><p>Maximize your ROI with a single codebase that works seamlessly on iOS and Android. Our cross-platform experts deliver native-like experiences at reduced cost.</p>', 'fas fa-mobile', 0, '["Single Codebase","Native Performance","Hot Reload","Custom Widgets","Platform-specific UI","Third-party Integrations","Offline Support","App Store Deployment"]', '["Flutter","React Native","Dart","JavaScript","TypeScript","Firebase","SQLite","REST APIs"]'),
(3, 'Cloud Migration', 'cloud-migration', 'Seamless migration of your infrastructure to AWS, Azure, or Google Cloud with zero downtime.', '<h3>Cloud Migration Services</h3><p>Move your business to the cloud with confidence. Our certified cloud architects plan and execute migrations that minimize risk and maximize the benefits of cloud computing.</p>', 'fas fa-cloud-upload-alt', 1, '["AWS Migration","Azure Migration","GCP Migration","Database Migration","Zero-Downtime Strategy","Cost Optimization","Security Compliance","Post-Migration Support"]', '["AWS","Microsoft Azure","Google Cloud","Docker","Kubernetes","Terraform","Ansible","CI/CD"]'),
(3, 'DevOps & CI/CD', 'devops-cicd', 'Streamline your development pipeline with automated testing, deployment, and monitoring.', '<h3>DevOps & CI/CD Services</h3><p>Accelerate your software delivery with our DevOps expertise. We implement robust CI/CD pipelines, infrastructure as code, and monitoring solutions.</p>', 'fas fa-cogs', 0, '["CI/CD Pipeline Setup","Docker Containerization","Kubernetes Orchestration","Infrastructure as Code","Automated Testing","Performance Monitoring","Log Management","Security Scanning"]', '["Jenkins","GitLab CI","GitHub Actions","Docker","Kubernetes","Terraform","Prometheus","Grafana"]'),
(4, 'Penetration Testing', 'penetration-testing', 'Identify and fix security vulnerabilities before hackers do with our comprehensive pen testing.', '<h3>Penetration Testing Services</h3><p>Our certified ethical hackers simulate real-world attacks to identify vulnerabilities in your systems, applications, and networks before malicious actors do.</p>', 'fas fa-user-secret', 1, '["Web App Pen Testing","Network Pen Testing","Mobile App Testing","Social Engineering","API Security Testing","Compliance Testing","Vulnerability Assessment","Security Audit Reports"]', '["OWASP","Burp Suite","Metasploit","Nmap","Wireshark","Kali Linux","SQLMap","Nessus"]'),
(5, 'AI & ML Solutions', 'ai-ml-solutions', 'Intelligent automation, predictive analytics, and NLP solutions to supercharge your business.', '<h3>AI & Machine Learning Solutions</h3><p>Harness the power of artificial intelligence to automate processes, gain insights, and create competitive advantages for your business.</p>', 'fas fa-robot', 1, '["Custom ML Models","Natural Language Processing","Computer Vision","Predictive Analytics","Chatbot Development","Recommendation Systems","Data Pipeline","Model Deployment"]', '["Python","TensorFlow","PyTorch","scikit-learn","OpenAI API","LangChain","FastAPI","Apache Spark"]'),
(6, 'SEO & Digital Marketing', 'seo-digital-marketing', 'Data-driven SEO and digital marketing strategies that increase visibility and drive qualified traffic.', '<h3>SEO & Digital Marketing</h3><p>Grow your online presence with our comprehensive digital marketing services. We combine technical SEO, content marketing, and paid advertising to deliver measurable results.</p>', 'fas fa-search', 0, '["Technical SEO Audit","On-page Optimization","Link Building","Content Strategy","Google Ads Management","Social Media Marketing","Email Marketing","Analytics & Reporting"]', '["Google Analytics","Search Console","SEMrush","Ahrefs","Google Ads","Meta Ads","Mailchimp","HubSpot"]'),
(7, 'IT Strategy Consulting', 'it-strategy-consulting', 'Expert technology advisory to align your IT investments with business objectives.', '<h3>IT Strategy Consulting</h3><p>Make informed technology decisions with guidance from our experienced IT consultants. We help you build a technology roadmap that supports your business goals.</p>', 'fas fa-chess', 0, '["Technology Roadmap","Digital Transformation","IT Governance","Vendor Selection","Cost Optimization","Risk Assessment","Change Management","ROI Analysis"]', '["ITIL","TOGAF","Agile","Scrum","Six Sigma","ISO 27001","GDPR Compliance","NIST Framework"]'),
(8, 'UI/UX Design', 'ui-ux-design', 'User-centered design that creates intuitive, beautiful interfaces driving engagement and conversions.', '<h3>UI/UX Design Services</h3><p>Great design is not just about how things look — it is about how they work. Our design team creates interfaces that are beautiful, intuitive, and drive real business outcomes.</p>', 'fas fa-paint-brush', 1, '["User Research","Wireframing","Prototyping","Visual Design","Design Systems","Usability Testing","Accessibility (WCAG)","Design Handoff"]', '["Figma","Adobe XD","Sketch","InVision","Principle","Zeplin","Adobe Illustrator","Hotjar"]');

-- Portfolio Categories
INSERT INTO portfolio_categories (name, slug, sort_order) VALUES
('Web Application', 'web-application', 1),
('Mobile App', 'mobile-app', 2),
('E-Commerce', 'ecommerce', 3),
('Enterprise Software', 'enterprise-software', 4),
('UI/UX Design', 'ui-ux-design', 5);

-- Portfolio Items
INSERT INTO portfolios (category_id, title, slug, client_name, short_description, description, technologies, is_featured, completion_date) VALUES
(1, 'HealthTrack Pro - Hospital Management System', 'healthtrack-pro', 'Apollo Diagnostics', 'A comprehensive hospital management platform managing 50,000+ patient records across 12 hospital branches.', '<p>HealthTrack Pro is a full-featured hospital management system that digitized operations for a major hospital chain, resulting in 40% improvement in operational efficiency and significant cost savings.</p>', '["Laravel","React","MySQL","Redis","AWS","Docker"]', 1, '2024-03-15'),
(3, 'ShopEasy - Multi-vendor E-Commerce Platform', 'shopeasy-platform', 'RetailNext India', 'A scalable multi-vendor marketplace supporting 500+ sellers with integrated payment and logistics.', '<p>ShopEasy is a feature-rich e-commerce platform that enabled a traditional retailer to go digital, achieving ₹2 Crore+ in GMV within the first 6 months of launch.</p>', '["Laravel","Vue.js","MySQL","Stripe","Razorpay","AWS S3"]', 1, '2024-01-20'),
(2, 'LogiTrack - Fleet Management Mobile App', 'logitrack-app', 'SpeedFreight Logistics', 'Real-time fleet tracking app for 200+ vehicles with driver management and route optimization.', '<p>LogiTrack transformed fleet operations with real-time GPS tracking, automated dispatch, and predictive maintenance alerts, reducing operational costs by 25%.</p>', '["Flutter","Laravel","MySQL","Google Maps","Firebase","AWS"]', 1, '2023-11-10'),
(4, 'FinanceCore - Banking Software Suite', 'financecore-banking', 'Horizon Cooperative Bank', 'Core banking solution handling daily transactions for 100,000+ account holders across 30 branches.', '<p>FinanceCore is an enterprise-grade banking software that modernized operations for a cooperative bank, ensuring RBI compliance and 99.9% uptime.</p>', '["Java Spring","React","PostgreSQL","Redis","Docker","Kubernetes"]', 1, '2023-09-05'),
(1, 'EduLearn - Online Learning Platform', 'edulearn-platform', 'BrightMinds EdTech', 'LMS platform with live classes, recorded content, and assessment tools for 10,000+ students.', '<p>EduLearn democratized quality education with an intuitive platform featuring HD video streaming, interactive quizzes, and AI-powered learning recommendations.</p>', '["Laravel","React","MySQL","WebRTC","AWS CloudFront","Stripe"]', 0, '2024-05-22'),
(2, 'FoodieGo - Food Delivery App', 'foodiego-app', 'TasteKart Pvt Ltd', 'On-demand food delivery app connecting 300+ restaurants with 50,000+ customers.', '<p>FoodieGo is a complete food delivery ecosystem with customer app, restaurant app, and delivery partner app, all connected through a real-time order management system.</p>', '["React Native","Node.js","MongoDB","Socket.io","Google Maps","Razorpay"]', 0, '2023-07-18');

-- Team Departments
INSERT INTO team_departments (name, slug, sort_order) VALUES
('Leadership', 'leadership', 1),
('Development', 'development', 2),
('Design', 'design', 3),
('Marketing', 'marketing', 4),
('Quality Assurance', 'quality-assurance', 5);

-- Team Members
INSERT INTO team_members (department_id, name, designation, bio, experience_years, is_featured, skills) VALUES
(1, 'Rajesh Kumar', 'CEO & Founder', 'Visionary entrepreneur with 15+ years in software industry. Rajesh founded Rescom with a mission to deliver enterprise-grade technology solutions to businesses of all sizes. Previously served as CTO at a Fortune 500 company.', 15, 1, '["Business Strategy","Digital Transformation","Enterprise Architecture","Leadership","Innovation"]'),
(1, 'Priya Sharma', 'CTO & Co-Founder', 'Technology architect with expertise in cloud computing, distributed systems, and AI/ML. Priya leads our technical direction and ensures we always stay ahead of the technology curve.', 12, 1, '["Cloud Architecture","AI/ML","Microservices","System Design","Python","AWS"]'),
(1, 'Anand Verma', 'COO', 'Operations expert who ensures smooth delivery of all projects. With his background in project management and Agile methodologies, Anand keeps our teams focused and clients happy.', 10, 1, '["Project Management","Agile/Scrum","Operations","Client Relations","Risk Management"]'),
(2, 'Suresh Nair', 'Lead Full Stack Developer', 'Expert in React, Laravel, and Node.js with a passion for clean code and scalable architecture. Has led development of 50+ successful projects.', 8, 1, '["React","Laravel","Node.js","MySQL","AWS","Docker"]'),
(2, 'Deepika Reddy', 'Senior Mobile Developer', 'Flutter and React Native specialist who has published 20+ apps on App Store and Play Store. Passionate about creating pixel-perfect mobile experiences.', 6, 1, '["Flutter","React Native","iOS","Android","Firebase","Dart"]'),
(3, 'Arjun Patel', 'UI/UX Design Lead', 'Award-winning designer who combines aesthetics with functionality. Arjun believes great design solves real problems and creates experiences users love.', 7, 1, '["Figma","Adobe XD","User Research","Prototyping","Design Systems","Illustration"]');

-- Testimonials
INSERT INTO testimonials (client_name, client_designation, client_company, content, rating, is_featured) VALUES
('Rajiv Mehta', 'CEO', 'TechVentures India', 'Rescom transformed our business with their exceptional web development services. The team delivered a complex e-commerce platform on time and within budget. The quality of code and attention to detail is outstanding. Highly recommended!', 5, 1),
('Sarah Johnson', 'Product Manager', 'GlobalRetail Corp', 'We worked with Rescom on our mobile app project and the results were phenomenal. The Flutter app they built has a 4.8-star rating on both stores with 50,000+ downloads. Their communication throughout the project was excellent.', 5, 1),
('Amit Bose', 'Director IT', 'Sunrise Hospitals', 'The hospital management system developed by Rescom has significantly improved our operational efficiency. The team understood our complex requirements and delivered a solution that exceeded our expectations.', 5, 1),
('Lisa Chen', 'CTO', 'FinServ Singapore', 'Rescom''s cybersecurity team identified 23 critical vulnerabilities in our banking application during the penetration test. Their detailed reports and remediation guidance helped us achieve ISO 27001 certification.', 5, 1),
('Mohammed Al-Rashid', 'CEO', 'GulfTech Solutions', 'Exceptional AI and ML solutions. The recommendation engine they built for our platform increased user engagement by 45% and revenue by 30%. The team is knowledgeable, professional, and a pleasure to work with.', 5, 1),
('Kavitha Nair', 'Marketing Head', 'BrandBoost Agency', 'Rescom''s digital marketing and SEO services doubled our organic traffic in just 4 months. The team is data-driven and transparent about results. Our lead generation has increased by 150% since we started working with them.', 5, 1);

-- Clients
INSERT INTO clients (name, type, is_featured, sort_order) VALUES
('Apollo Hospitals', 'client', 1, 1),
('TCS', 'client', 1, 2),
('Wipro', 'client', 1, 3),
('HDFC Bank', 'client', 1, 4),
('Infosys', 'client', 1, 5),
('Flipkart', 'client', 1, 6),
('Amazon Web Services', 'technology', 1, 7),
('Microsoft Azure', 'technology', 1, 8),
('Google Cloud', 'technology', 1, 9),
('Meta', 'client', 0, 10),
('Samsung India', 'client', 0, 11),
('ICICI Bank', 'client', 0, 12);

-- Stats
INSERT INTO stats (title, value, suffix, icon, sort_order) VALUES
('Projects Completed', '500', '+', 'fas fa-rocket', 1),
('Happy Clients', '200', '+', 'fas fa-smile', 2),
('Team Members', '150', '+', 'fas fa-users', 3),
('Countries Served', '20', '+', 'fas fa-globe', 4),
('Years of Experience', '9', '+', 'fas fa-award', 5),
('Client Retention Rate', '95', '%', 'fas fa-heart', 6);

-- Technologies
INSERT INTO technologies (name, category, sort_order) VALUES
('React', 'frontend', 1),
('Vue.js', 'frontend', 2),
('Next.js', 'frontend', 3),
('Angular', 'frontend', 4),
('Laravel', 'backend', 1),
('Node.js', 'backend', 2),
('Python', 'backend', 3),
('Django', 'backend', 4),
('Flutter', 'mobile', 1),
('React Native', 'mobile', 2),
('Swift', 'mobile', 3),
('Kotlin', 'mobile', 4),
('MySQL', 'database', 1),
('PostgreSQL', 'database', 2),
('MongoDB', 'database', 3),
('Redis', 'database', 4),
('AWS', 'cloud', 1),
('Microsoft Azure', 'cloud', 2),
('Google Cloud', 'cloud', 3),
('DigitalOcean', 'cloud', 4),
('Docker', 'devops', 1),
('Kubernetes', 'devops', 2),
('Jenkins', 'devops', 3),
('Terraform', 'devops', 4);

-- FAQs
INSERT INTO faqs (question, answer, category, sort_order) VALUES
('How do you ensure the security of my application?', 'Security is our top priority. We follow OWASP guidelines, conduct regular security audits, implement HTTPS/SSL, use parameterized queries, and perform penetration testing. All our projects include security best practices from the ground up.', 'security', 1),
('What is your development process?', 'We follow an Agile Scrum methodology with 2-week sprints. The process includes: Discovery & Planning → UI/UX Design → Development → Testing → UAT → Deployment → Maintenance. We provide weekly updates and demos at the end of each sprint.', 'process', 2),
('How long does a typical project take?', 'Project timelines vary based on complexity. A simple website takes 2-4 weeks, a medium web application 2-3 months, and complex enterprise solutions 6-12 months. We provide detailed timelines during our discovery phase.', 'process', 3),
('Do you provide post-launch support?', 'Yes! We offer comprehensive post-launch support packages. Our standard warranty covers bug fixes for 3 months after launch. We also offer Annual Maintenance Contracts (AMC) for ongoing support, updates, and enhancements.', 'support', 4),
('What technologies do you specialize in?', 'We specialize in Laravel, React, Vue.js, Flutter, React Native, Node.js, Python, AWS, Azure, and Google Cloud. Our team stays updated with the latest technologies to always deliver the best solutions.', 'technology', 5),
('Do you sign NDAs?', 'Absolutely. We sign Non-Disclosure Agreements (NDA) before discussing any project details. Your business ideas and intellectual property are safe with us.', 'legal', 6),
('What is your pricing model?', 'We offer flexible pricing: Fixed Price (for well-defined projects), Time & Material (for evolving requirements), and Dedicated Team (for long-term projects). We provide detailed cost estimates after understanding your requirements.', 'pricing', 7),
('Can you work with our existing team?', 'Yes! We offer staff augmentation services where our developers can work alongside your existing team. We are experienced in integrating with different team cultures and work processes.', 'process', 8);

-- Blog Categories
INSERT INTO blog_categories (name, slug, sort_order) VALUES
('Technology Insights', 'technology-insights', 1),
('Web Development', 'web-development', 2),
('Mobile Development', 'mobile-development', 3),
('Cybersecurity', 'cybersecurity', 4),
('Cloud Computing', 'cloud-computing', 5),
('Digital Marketing', 'digital-marketing', 6),
('Company News', 'company-news', 7);

-- Blog Tags
INSERT INTO blog_tags (name, slug) VALUES
('Laravel', 'laravel'),
('React', 'react'),
('Flutter', 'flutter'),
('AWS', 'aws'),
('AI', 'ai'),
('Machine Learning', 'machine-learning'),
('Cybersecurity', 'cybersecurity'),
('SEO', 'seo'),
('Node.js', 'nodejs'),
('Python', 'python');

-- Blog Posts
INSERT INTO blog_posts (category_id, author_id, title, slug, excerpt, content, status, published_at, is_featured, reading_time) VALUES
(1, 1, 'Top 10 Technology Trends Shaping Business in 2025', 'top-10-tech-trends-2025', 'Explore the most transformative technology trends of 2025 that every business leader should know about, from AI-powered automation to edge computing.', '<h2>Introduction</h2><p>Technology is evolving at an unprecedented pace. Businesses that embrace innovation are thriving while those that resist change are being left behind. Here are the top 10 technology trends reshaping industries in 2025.</p><h2>1. Generative AI Goes Enterprise</h2><p>Generative AI has moved beyond novelty to become a core business tool. Companies are integrating LLMs into their workflows for content creation, code generation, customer support, and decision-making.</p><h2>2. Edge Computing Expansion</h2><p>With IoT devices proliferating, processing data at the edge reduces latency and bandwidth costs. Industries like manufacturing, healthcare, and retail are early adopters.</p><h2>3. Quantum Computing Breakthroughs</h2><p>While still emerging, quantum computing is reaching practical applications in drug discovery, financial modeling, and cryptography.</p><h2>Conclusion</h2><p>Staying ahead of technology trends is crucial for competitive advantage. Contact Rescom to discuss how these trends apply to your business.</p>', 'published', '2025-01-15 10:00:00', 1, 8),
(4, 1, 'Why Every Business Needs a Cybersecurity Strategy in 2025', 'cybersecurity-strategy-2025', 'Cyber attacks cost businesses $8 trillion globally in 2024. Discover why cybersecurity is no longer optional and how to build a robust security strategy.', '<h2>The Growing Threat Landscape</h2><p>Cybercrime is the fastest growing crime in the world. In 2024, ransomware attacks increased by 73% and the average cost of a data breach reached $4.45 million. No business is too small to be a target.</p><h2>Key Components of a Cybersecurity Strategy</h2><p>A robust cybersecurity strategy includes: risk assessment, employee training, access control, data encryption, incident response planning, and regular security audits.</p><h2>How We Can Help</h2><p>Rescom''s cybersecurity team offers comprehensive protection tailored to your business needs and budget.</p>', 'published', '2025-02-10 10:00:00', 1, 6),
(5, 1, 'AWS vs Azure vs GCP: Which Cloud Platform is Right for Your Business?', 'aws-vs-azure-vs-gcp-2025', 'Choosing the right cloud platform is a critical business decision. We break down the strengths, weaknesses, and ideal use cases for AWS, Azure, and Google Cloud.', '<h2>The Big Three Cloud Platforms</h2><p>Amazon Web Services (AWS), Microsoft Azure, and Google Cloud Platform (GCP) dominate the cloud market with a combined 65% market share. Each has unique strengths.</p><h2>AWS: The Market Leader</h2><p>AWS offers the broadest range of services and the most mature ecosystem. Best for: startups, companies needing maximum service choice, and those not tied to Microsoft or Google.</p><h2>Azure: The Enterprise Choice</h2><p>Azure integrates seamlessly with Microsoft products. Best for: enterprises using Office 365, Windows Server, and .NET applications.</p><h2>GCP: The Data & AI Platform</h2><p>Google Cloud excels in big data, machine learning, and Kubernetes. Best for: data-intensive applications and companies using Google Workspace.</p>', 'published', '2025-03-05 10:00:00', 0, 10);

-- Job Listings
INSERT INTO job_listings (title, slug, department, location, job_type, experience, salary_range, description, requirements, responsibilities, skills_required, vacancies, status) VALUES
('Senior Laravel Developer', 'senior-laravel-developer', 'Engineering', 'Bengaluru, Karnataka (Hybrid)', 'full-time', '3-6 years', '₹8 LPA - ₹15 LPA', 'We are looking for an experienced Laravel developer to join our growing engineering team. You will work on exciting projects for clients across India and internationally.', '3+ years of Laravel experience\nStrong understanding of PHP 8.x\nExperience with MySQL and Redis\nKnowledge of REST API design\nFamiliarity with Vue.js or React\nExperience with Git and CI/CD', 'Design and develop scalable Laravel applications\nWork with cross-functional teams\nCode review and mentoring junior developers\nOptimize application performance\nWrite unit and integration tests\nCollaborate with UI/UX team', '["Laravel","PHP","MySQL","Redis","REST APIs","Git","Docker","Vue.js or React"]', 2, 'open'),
('Flutter Mobile Developer', 'flutter-mobile-developer', 'Engineering', 'Bengaluru, Karnataka (On-site)', 'full-time', '2-5 years', '₹6 LPA - ₹12 LPA', 'Join our mobile team to build beautiful cross-platform applications used by millions of users. You will work on challenging projects across healthcare, fintech, and e-commerce domains.', '2+ years Flutter development\nPublished apps on App Store or Play Store\nStrong Dart programming skills\nExperience with state management (Bloc, Provider, Riverpod)\nKnowledge of native iOS/Android is a plus', 'Develop cross-platform mobile applications\nImplement UI/UX designs\nIntegrate REST APIs and Firebase\nOptimize app performance\nHandle app deployment and releases', '["Flutter","Dart","Firebase","REST APIs","Bloc/Provider","Git"]', 3, 'open'),
('UI/UX Designer', 'ui-ux-designer', 'Design', 'Bengaluru, Karnataka (Hybrid)', 'full-time', '2-4 years', '₹5 LPA - ₹10 LPA', 'We are seeking a creative and analytical UI/UX Designer to create exceptional digital experiences for our clients. You will be responsible for the entire design process from research to handoff.', '2+ years UI/UX design experience\nProficiency in Figma\nStrong portfolio demonstrating mobile and web design\nUnderstanding of user-centered design principles\nExperience with design systems', 'Conduct user research and competitive analysis\nCreate wireframes, prototypes, and high-fidelity designs\nBuild and maintain design systems\nCollaborate with developers for accurate implementation\nConduct usability testing', '["Figma","Adobe XD","Prototyping","User Research","Design Systems","CSS Basics"]', 1, 'open'),
('DevOps Engineer', 'devops-engineer', 'Infrastructure', 'Remote', 'full-time', '3-5 years', '₹10 LPA - ₹18 LPA', 'We are looking for a DevOps engineer to build and maintain our CI/CD infrastructure and help our clients with cloud deployments and automation.', '3+ years DevOps experience\nStrong AWS or Azure knowledge\nDocker and Kubernetes expertise\nExperience with Terraform or Ansible\nLinux system administration', 'Design and implement CI/CD pipelines\nManage cloud infrastructure on AWS/Azure\nContainer orchestration with Kubernetes\nInfrastructure as code with Terraform\nMonitoring and incident response', '["AWS","Docker","Kubernetes","Terraform","Jenkins","GitHub Actions","Linux","Python/Bash"]', 1, 'open');

-- Menus
INSERT INTO menus (name, location, is_active) VALUES
('Main Navigation', 'header', 1),
('Footer Menu', 'footer', 1);

INSERT INTO menu_items (menu_id, title, url, sort_order) VALUES
(1, 'Home', '/', 1),
(1, 'About', '/about', 2),
(1, 'Services', '/services', 3),
(1, 'Portfolio', '/portfolio', 4),
(1, 'Blog', '/blog', 5),
(1, 'Careers', '/careers', 6),
(1, 'Contact', '/contact', 7);

INSERT INTO menu_items (menu_id, parent_id, title, url, sort_order) VALUES
(1, 3, 'Web Development', '/services/custom-web-development', 1),
(1, 3, 'Mobile Apps', '/services/ios-app-development', 2),
(1, 3, 'Cloud Solutions', '/services/cloud-migration', 3),
(1, 3, 'Cybersecurity', '/services/penetration-testing', 4),
(1, 3, 'AI & ML', '/services/ai-ml-solutions', 5),
(1, 3, 'UI/UX Design', '/services/ui-ux-design', 6);

-- ============================================================
-- INDEXES FOR PERFORMANCE
-- ============================================================
CREATE INDEX idx_blog_posts_status ON blog_posts(status, published_at);
CREATE INDEX idx_blog_posts_category ON blog_posts(category_id);
CREATE INDEX idx_services_featured ON services(is_featured, is_active);
CREATE INDEX idx_portfolio_featured ON portfolios(is_featured, is_active);
CREATE INDEX idx_contacts_status ON contacts(status, created_at);
CREATE INDEX idx_job_listings_status ON job_listings(status);

SELECT 'Database setup complete! Default admin: admin@rescom.in / Change password via artisan tinker.' AS message;
