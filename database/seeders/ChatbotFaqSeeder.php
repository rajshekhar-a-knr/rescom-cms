<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatbotFaq;

class ChatbotFaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // Company (10)
            ['Company','What does Rescom do?','Rescom is an IT solutions company providing web, mobile, cloud, cybersecurity, AI/ML, and digital transformation services.','company,about,services'],
            ['Company','Where is Rescom located?','Our office locations and contact details are listed on the Contact page.','location,address,contact'],
            ['Company','How can I contact Rescom?','You can contact us via the Contact page, email, or phone listed on the website.','contact,email,phone'],
            ['Company','What industries do you serve?','We serve education, healthcare, fintech, retail, manufacturing, and more.','industries,clients'],
            ['Company','Do you work with startups and enterprises?','Yes, we collaborate with startups, SMEs, and large enterprises.','startups,enterprise'],
            ['Company','Do you sign NDAs?','Yes, we can sign an NDA before project discussions.','nda,confidential'],
            ['Company','How soon do you respond?','We typically respond within 1-2 business days.','response,time'],
            ['Company','Do you provide a free consultation?','Yes, we offer an initial consultation to understand your requirements.','consultation,free'],
            ['Company','How can I request a demo?','Use the Request Demo button or contact us through the Contact page.','demo,request'],
            ['Company','Is Rescom ISO certified?','If ISO certifications are listed on the website, those apply. Please refer to the homepage badges.','iso,certification'],

            // Services (10)
            ['Services','What services do you offer?','We provide web development, mobile apps, cloud solutions, cybersecurity, AI/ML, and UI/UX.','services,offerings'],
            ['Services','Do you build custom software?','Yes, we build custom software tailored to your business needs.','custom software'],
            ['Services','Do you provide IT consulting?','Yes, we offer strategy, architecture, and technology consulting.','consulting,it'],
            ['Services','Can you modernize legacy systems?','Yes, we modernize legacy systems and migrate to modern stacks.','legacy,modernization'],
            ['Services','Do you offer system integration?','Yes, we integrate third-party APIs, CRMs, ERPs, and payment gateways.','integration,api'],
            ['Services','Do you provide QA and testing?','Yes, QA and automated testing are part of our delivery process.','qa,testing'],
            ['Services','Do you provide product design?','Yes, we offer UI/UX research, wireframes, and design systems.','design,ui,ux'],
            ['Services','Do you offer DevOps services?','Yes, we provide CI/CD, automation, and cloud infrastructure management.','devops,ci/cd'],
            ['Services','Can you build internal tools?','Yes, we build dashboards, admin panels, and internal workflows.','internal tools,dashboard'],
            ['Services','Do you provide ongoing support?','Yes, we offer maintenance and support plans.','support,maintenance'],

            // Web Development (10)
            ['Web Development','Do you build responsive websites?','Yes, all websites are built to be mobile-first and responsive.','responsive,website'],
            ['Web Development','Do you use Laravel for web projects?','Yes, Laravel is one of our core frameworks.','laravel,backend'],
            ['Web Development','Can you build e-commerce websites?','Yes, we build scalable e-commerce solutions.','ecommerce,shop'],
            ['Web Development','Do you optimize website performance?','Yes, we optimize for speed, SEO, and best practices.','performance,seo'],
            ['Web Development','Can you integrate payment gateways?','Yes, we integrate Razorpay, Stripe, PayPal, and others.','payment gateway'],
            ['Web Development','Do you offer CMS development?','Yes, we develop custom and headless CMS solutions.','cms,content'],
            ['Web Development','Do you provide website maintenance?','Yes, we offer monthly maintenance and security updates.','maintenance,updates'],
            ['Web Development','Can you redesign an existing site?','Yes, we can redesign and modernize existing websites.','redesign,revamp'],
            ['Web Development','Do you support multilingual sites?','Yes, we can build multilingual websites.','multilingual,i18n'],
            ['Web Development','Do you provide SEO services?','We can implement technical SEO and recommend content SEO strategy.','seo,search'],

            // Mobile Apps (10)
            ['Mobile Apps','Do you build iOS and Android apps?','Yes, we build native and cross-platform apps.','ios,android'],
            ['Mobile Apps','Which tech do you use for mobile apps?','We use Flutter, React Native, and native stacks based on needs.','flutter,react native'],
            ['Mobile Apps','Can you publish apps to stores?','Yes, we assist with App Store and Play Store publishing.','publishing,app store'],
            ['Mobile Apps','Do you provide app maintenance?','Yes, we provide updates, bug fixes, and enhancements.','app maintenance'],
            ['Mobile Apps','Can you build MVP apps?','Yes, we can deliver an MVP quickly with core features.','mvp,prototype'],
            ['Mobile Apps','Do you provide push notifications?','Yes, we implement push notifications and in-app messaging.','push notifications'],
            ['Mobile Apps','Do you integrate analytics?','Yes, we integrate Firebase, GA, or custom analytics.','analytics,tracking'],
            ['Mobile Apps','Can you add offline mode?','Yes, offline caching can be implemented where required.','offline mode'],
            ['Mobile Apps','Do you build enterprise mobile apps?','Yes, we build secure enterprise-grade mobile solutions.','enterprise,secure'],
            ['Mobile Apps','Can you migrate an old app?','Yes, we can migrate and upgrade older apps.','migration,upgrade'],

            // Cloud & DevOps (10)
            ['Cloud','Do you provide cloud migration?','Yes, we migrate workloads to AWS, Azure, or GCP.','cloud migration'],
            ['Cloud','Which cloud platforms do you support?','We support AWS, Azure, and Google Cloud.','aws,azure,gcp'],
            ['Cloud','Do you set up CI/CD pipelines?','Yes, we implement CI/CD for faster releases.','ci/cd,pipeline'],
            ['Cloud','Do you provide cloud cost optimization?','Yes, we help optimize cloud usage and costs.','cloud cost,optimization'],
            ['Cloud','Can you set up Kubernetes?','Yes, we design and manage Kubernetes clusters.','kubernetes,k8s'],
            ['Cloud','Do you offer infrastructure as code?','Yes, we use Terraform/CloudFormation.','iac,terraform'],
            ['Cloud','Do you provide server monitoring?','Yes, we set up monitoring and alerting.','monitoring,alerts'],
            ['Cloud','Can you set up secure backups?','Yes, we configure automated backups and disaster recovery.','backup,dr'],
            ['Cloud','Do you support hybrid cloud?','Yes, we can implement hybrid and multi-cloud setups.','hybrid,multi-cloud'],
            ['Cloud','Do you provide CDN setup?','Yes, we configure CDNs for faster delivery.','cdn,performance'],

            // Cybersecurity (10)
            ['Cybersecurity','Do you provide security audits?','Yes, we perform security assessments and audits.','security audit'],
            ['Cybersecurity','Do you offer penetration testing?','Yes, we provide penetration testing services.','pentest,penetration'],
            ['Cybersecurity','Do you implement SSL and HTTPS?','Yes, we configure SSL and security headers.','ssl,https'],
            ['Cybersecurity','Do you follow OWASP guidelines?','Yes, our apps follow OWASP best practices.','owasp,security'],
            ['Cybersecurity','Do you secure APIs?','Yes, we implement authentication, rate limiting, and monitoring.','api security'],
            ['Cybersecurity','Can you add MFA?','Yes, multi-factor authentication can be implemented.','mfa,2fa'],
            ['Cybersecurity','Do you provide vulnerability scanning?','Yes, we scan and remediate vulnerabilities.','vulnerability,scan'],
            ['Cybersecurity','Do you handle compliance?','We support compliance needs such as GDPR and ISO practices.','compliance,gdpr'],
            ['Cybersecurity','How do you protect data?','We encrypt data in transit and at rest with secure practices.','data protection'],
            ['Cybersecurity','Do you provide security monitoring?','Yes, we can set up security monitoring and alerts.','security monitoring'],

            // AI/ML & Data (10)
            ['AI/ML','Do you build AI solutions?','Yes, we build AI/ML models for automation and insights.','ai,ml'],
            ['AI/ML','Can you build chatbots?','Yes, we build rule-based and AI-powered chatbots.','chatbot,ai'],
            ['AI/ML','Do you offer data analytics?','Yes, we provide analytics dashboards and BI solutions.','analytics,bi'],
            ['AI/ML','Can you implement recommendation systems?','Yes, recommendation engines can be built for your product.','recommendations'],
            ['AI/ML','Do you offer NLP solutions?','Yes, we can build NLP features like sentiment and classification.','nlp,language'],
            ['AI/ML','Can you integrate AI APIs?','Yes, we integrate third-party AI services when needed.','ai api'],
            ['AI/ML','Do you handle data pipelines?','Yes, we build ETL and data pipelines for analytics.','etl,data pipeline'],
            ['AI/ML','Do you provide model monitoring?','Yes, we track model performance and drift.','model monitoring'],
            ['AI/ML','Can you use customer data securely?','Yes, we follow secure data handling practices.','data security'],
            ['AI/ML','Do you build predictive analytics?','Yes, we build predictive models for business insights.','predictive'],

            // UI/UX & Design (10)
            ['Design','Do you provide UI/UX design?','Yes, we deliver user research, wireframes, and UI design.','ui,ux'],
            ['Design','Do you create design systems?','Yes, we build scalable design systems and components.','design system'],
            ['Design','Can you redesign existing products?','Yes, we modernize and improve usability.','redesign,ux'],
            ['Design','Do you provide prototyping?','Yes, we create interactive prototypes for validation.','prototype,wireframe'],
            ['Design','Do you conduct user research?','Yes, we perform user research and testing.','research,testing'],
            ['Design','Do you ensure accessibility?','Yes, we follow accessibility best practices.','accessibility,a11y'],
            ['Design','Do you support branding?','Yes, we can align UI with your brand guidelines.','branding'],
            ['Design','Can you design for mobile-first?','Yes, mobile-first design is our default approach.','mobile-first'],
            ['Design','Do you deliver design files?','Yes, we provide Figma and other source files.','figma,design files'],
            ['Design','Do you provide illustrations?','We can create custom visuals or source professional assets.','illustrations'],

            // Process & Delivery (10)
            ['Process','What is your development process?','We follow a structured discovery ? design ? development ? QA ? launch process.','process,delivery'],
            ['Process','Do you follow Agile?','Yes, we deliver in sprints with regular demos.','agile,sprints'],
            ['Process','How do you gather requirements?','We conduct workshops and discovery sessions.','requirements,discovery'],
            ['Process','Do you provide project management?','Yes, a dedicated PM tracks scope, timeline, and delivery.','project management'],
            ['Process','How do you handle changes?','We manage changes via scope updates and approvals.','change request'],
            ['Process','Do you provide weekly updates?','Yes, we share progress updates and demos.','updates,demo'],
            ['Process','How do you ensure quality?','We use QA, code reviews, and automated tests.','quality,testing'],
            ['Process','Can you work with our team?','Yes, we can collaborate with your internal team.','collaboration'],
            ['Process','Do you provide documentation?','Yes, we deliver technical and user documentation.','documentation'],
            ['Process','What is the typical timeline?','Timelines depend on scope; most projects run 4�12 weeks.','timeline'],

            // Pricing & Engagement (10)
            ['Pricing','What pricing models do you offer?','We offer fixed-price and time-and-materials models.','pricing,model'],
            ['Pricing','Do you provide estimates?','Yes, we provide estimates after a discovery call.','estimate,quote'],
            ['Pricing','Is there a minimum project size?','Project size depends on complexity; contact us for details.','minimum project'],
            ['Pricing','Can I start with an MVP?','Yes, we can build an MVP to validate quickly.','mvp'],
            ['Pricing','Do you offer retainers?','Yes, retainer plans are available for ongoing work.','retainer'],
            ['Pricing','Do you provide invoices?','Yes, invoices are provided for all payments.','invoice'],
            ['Pricing','What payment terms do you offer?','Payment terms are agreed during contract finalization.','payment terms'],
            ['Pricing','Can you work with milestones?','Yes, we can structure payments by milestones.','milestones'],
            ['Pricing','Do you offer discounts?','Discounts may be available for long-term engagements.','discounts'],
            ['Pricing','Can you sign a contract?','Yes, we sign formal contracts and SLAs.','contract,sla'],
        ];

        foreach ($faqs as $f) {
            ChatbotFaq::updateOrCreate(
                ['question' => $f[1]],
                [
                    'category' => $f[0],
                    'answer' => $f[2],
                    'keywords' => $f[3],
                    'is_active' => true,
                ]
            );
        }
    }
}
