<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('legal_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('legal_pages')->insert([
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'sort_order' => 1,
                'is_active' => 1,
                'content' => $this->privacyHtml(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Website Terms and Conditions',
                'slug' => 'terms-and-conditions',
                'sort_order' => 2,
                'is_active' => 1,
                'content' => $this->termsHtml(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Anti-SPAM Policy',
                'slug' => 'anti-spam-policy',
                'sort_order' => 3,
                'is_active' => 1,
                'content' => $this->antiSpamHtml(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'License Agreement',
                'slug' => 'license-agreement',
                'sort_order' => 4,
                'is_active' => 1,
                'content' => $this->licenseHtml(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cookies Policy',
                'slug' => 'cookies-policy',
                'sort_order' => 5,
                'is_active' => 1,
                'content' => $this->cookiesHtml(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('legal_pages');
    }

    private function privacyHtml(): string
    {
        return '<p>We are committed to safeguarding the privacy of our website visitors; this policy sets out how we will treat your personal information. Our website uses cookies. By using our website and agreeing to this policy, you consent to our use of cookies in accordance with the terms of this policy.</p>'
            . '<h3>1. What information do we collect?</h3>'
            . '<ul>'
            . '<li>Information about your computer and visits to our site including IP, location, browser type, OS, etc.</li>'
            . '<li>Transaction and order information.</li>'
            . '<li>Registration, subscription, or contact form details.</li>'
            . '<li>Email notification preferences or newsletter info.</li>'
            . '<li>Any other data you provide voluntarily.</li>'
            . '</ul>'
            . '<h3>2. Cookies (as per Rescom Cookies Policy)</h3>'
            . '<p>We use session and persistent cookies for navigation and recognition. We also use Google Analytics. Learn more from the Google Privacy Policy. You can update your ad preferences at Google Ads Preferences.</p>'
            . '<h3>3. Using your personal information</h3>'
            . '<ul>'
            . '<li>Administer and personalize our website.</li>'
            . '<li>Deliver services or process orders.</li>'
            . '<li>Send notifications, updates, or newsletters.</li>'
            . '<li>Provide support or respond to enquiries.</li>'
            . '<li>Share anonymous statistical info with third parties.</li>'
            . '<li>We use Paytm for payments. Data is shared only for that purpose.</li>'
            . '</ul>'
            . '<h3>4. Disclosures</h3>'
            . '<p>We may disclose your personal information when legally required or necessary for staff, legal, or protective reasons. We never sell or misuse your data.</p>'
            . '<h3>5. International data transfers</h3>'
            . '<p>Your data may be processed outside your country. By using our site, you agree to these transfers.</p>'
            . '<h3>6. Security of your personal information</h3>'
            . '<p>We use secure servers and take reasonable precautions, but cannot fully guarantee the security of internet transmissions. Always keep your credentials safe.</p>'
            . '<h3>7. Policy amendments</h3>'
            . '<p>This policy may change over time. Check this page regularly. We will notify you via email if required.</p>'
            . '<h3>8. Your rights</h3>'
            . '<p>You can request access to your data or ask for corrections. You may opt-out of marketing by contacting us anytime.</p>'
            . '<h3>9. Third-party websites</h3>'
            . '<p>We are not responsible for the privacy practices of linked external websites.</p>'
            . '<h3>10. Updating information</h3>'
            . '<p>Let us know if your personal data with us needs to be updated or corrected.</p>'
            . '<h3>11. Contact</h3>'
            . '<p>Email: info@rescom.in<br>Address: Rescom<br>233, Rahul Building, 6th Main Road, Rajajinagar Industrial Town, Rajajinagar, Bengaluru, Karnataka 560044.</p>';
    }

    private function termsHtml(): string
    {
        return '<h3>1. Introduction</h3>'
            . '<p>These terms and conditions govern the use of our website. By using our website, you accept these terms in full. If you disagree with these terms, you must not use our website.</p>'
            . '<p>Our Rescom website uses cookies. By continuing, you consent to their use per our Privacy and Cookies Policies.</p>'
            . '<h3>2. License to use website</h3>'
            . '<p>Unless stated otherwise, we own the intellectual property rights. You may:</p>'
            . '<ul><li>View, download, and print pages for personal use only.</li></ul>'
            . '<p>You MUST NOT:</p>'
            . '<ul>'
            . '<li>Republish or redistribute material (unless permitted).</li>'
            . '<li>Sell, rent, or sublicense website material.</li>'
            . '<li>Edit or modify any website material.</li>'
            . '<li>Redistribution for education partners requires permission: info@rescom.in</li>'
            . '</ul>'
            . '<h3>3. Acceptable use</h3>'
            . '<p>You must not use the website for illegal, fraudulent, or harmful purposes or activities, including uploading malware or spamming.</p>'
            . '<h3>4. Restricted access</h3>'
            . '<p>We may restrict areas of the website. Keep login credentials confidential. We may disable access without notice.</p>'
            . '<h3>5. User generated content</h3>'
            . '<p>By submitting content, you grant us a global, royalty-free license to use and distribute it in any form. You confirm ownership of content rights.</p>'
            . '<h3>6. Limited warranties</h3>'
            . '<p>We do not guarantee the accuracy or completeness of information and reserve the right to modify or discontinue website content at any time.</p>'
            . '<h3>7. Limitations and exclusions of liability</h3>'
            . '<p>Nothing in these terms limits liability for death or injury caused by negligence or fraud. We are not liable for indirect, special, or consequential losses.</p>'
            . '<h3>8. Indemnity</h3>'
            . '<p>You agree to indemnify us against any losses or legal actions resulting from your breach of these terms.</p>'
            . '<h3>9. Breaches of these terms and conditions</h3>'
            . '<p>We may suspend or block your access and take legal action for violations of these terms.</p>'
            . '<h3>10. Variation</h3>'
            . '<p>We may revise these terms at any time. Please review them regularly.</p>'
            . '<h3>11. Assignment</h3>'
            . '<p>We may transfer our rights under these terms without notice. You may not transfer your rights without consent.</p>'
            . '<h3>12. Severability</h3>'
            . '<p>If a provision is found unlawful or unenforceable, the rest of the agreement remains valid.</p>'
            . '<h3>13. Exclusion of third-party rights</h3>'
            . '<p>These terms are for the benefit of Rescom and its users only, not third parties.</p>'
            . '<h3>14. Entire agreement</h3>'
            . '<p>These terms, along with our Privacy Policy, constitute the full agreement between you and us.</p>'
            . '<h3>15. Law and jurisdiction</h3>'
            . '<p>These terms are governed by Australian law. Disputes will be handled in Australian courts.</p>'
            . '<h3>16. Legal disclosures</h3>'
            . '<p>Legal notices will be provided as required by law or regulation and will be posted on our website or sent via email.</p>'
            . '<h3>17. Contact us</h3>'
            . '<p>Email: info@rescom.in<br>Address: Rescom<br>233, Rahul Building, 6th Main Road, Rajajinagar Industrial Town, Rajajinagar, Bengaluru, Karnataka 560044.</p>';
    }

    private function antiSpamHtml(): string
    {
        return '<h3>1. What is spam?</h3>'
            . '<p>In the context of electronic messaging, spam refers to unsolicited, bulk, or indiscriminate messages, typically sent for a commercial purpose. We at Rescom have a zero-tolerance spam policy.</p>'
            . '<h3>2. Automated spam filtering</h3>'
            . '<p>Rescom\'s messaging systems automatically scan all incoming email and web-generated messages, and filter out messages that appear to be spam.</p>'
            . '<h3>3. Problems with spam filtering</h3>'
            . '<p>No filtering system is 100% accurate, and from time to time, legitimate messages may be filtered out by Rescom\'s systems. If you believe this has happened, please notify the recipient by another method. Reduce risks by sending plain text (no HTML), avoiding attachments, and scanning messages for malware.</p>'
            . '<h3>4. User spam</h3>'
            . '<p>Rescom provides systems for users to send messages. These must not be used to send unsolicited, bulk, or indiscriminate messages, regardless of commercial intent.</p>'
            . '<h3>5. Receipt of unwanted messages from Rescom</h3>'
            . '<p>If you receive any message from Rescom that may be considered spam, please contact us at info@rescom.in and we will investigate immediately.</p>'
            . '<h3>6. Changes to this anti-spam policy</h3>'
            . '<p>Rescom may revise this policy at any time by publishing an updated version on this website.</p>'
            . '<h3>7. Contact us</h3>'
            . '<p>Email: info@rescom.in<br>Address: Rescom<br>233, Rahul Building, 6th Main Road, Rajajinagar Industrial Town, Rajajinagar, Bengaluru, Karnataka 560044.</p>';
    }

    private function licenseHtml(): string
    {
        return '<p>Please read this license agreement carefully before using these training materials. By proceeding to use the materials provided by Rescom (the “Supplier”), you agree to be bound by the terms and conditions of this license agreement (the “Agreement”).</p>'
            . '<h3>1. LICENSE</h3>'
            . '<p>The Supplier grants you a revocable, non-exclusive license to use the training materials, including electronic documents, software, and updates, including any Derivative Works (collectively the “Licensed Materials”).</p>'
            . '<h3>2. OWNERSHIP</h3>'
            . '<p>You acknowledge that all rights in the Licensed Materials belong to the Supplier, and you are only granted usage rights under this Agreement.</p>'
            . '<h3>3. USAGE</h3>'
            . '<p>The license is restricted to use for training purposes only.</p>'
            . '<h3>4. ACCESS</h3>'
            . '<p>You may not make Licensed Materials publicly accessible online without secure login (username and password).</p>'
            . '<h3>5. DERIVATIVE WORKS</h3>'
            . '<p>You may customize the Licensed Materials for training (e.g., translation, virtual webinars). However, it may not be used to create new learning materials.</p>'
            . '<h3>6. RESALE</h3>'
            . '<p>Redistribution or resale of any Licensed Materials is prohibited. Trainers may only charge for printing and their own services.</p>'
            . '<h3>7. TERM</h3>'
            . '<p>The license continues indefinitely unless terminated due to breach of Agreement. Unauthorized copying violates intellectual property laws.</p>'
            . '<h3>8. LIABILITY</h3>'
            . '<p>The Supplier is not liable for any damages from use or misuse of the Licensed Materials. You agree to indemnify and hold harmless the Supplier against any claims.</p>'
            . '<h3>9. CONTROVERSY</h3>'
            . '<p>This Agreement is governed by the laws of Victoria, Australia. Any conflicts will defer to the terms stated herein.</p>'
            . '<h3>10. ELEARNING / VIDEO CONTENT</h3>'
            . '<p>“ELEARNING / VIDEO CONTENT” includes all digital media licensed by the Supplier. Licensee may not:</p>'
            . '<ul>'
            . '<li>Make materials publicly available without authorization.</li>'
            . '<li>Invite third parties to download or extract content as standalone files.</li>'
            . '<li>Licensee may store content in a digital library for access by authorized individuals only (employees, students, management).</li>'
            . '</ul>'
            . '<h3>11. SOCIAL FORUMS</h3>'
            . '<p>Rights are revoked if third-party platforms misuse the Licensed Material. Upon request, you must remove Licensed Materials from such platforms.</p>'
            . '<h3>12. Contact Us</h3>'
            . '<p>Email: info@rescom.in<br>Address: Rescom<br>233, Rahul Building, 6th Main Road, Rajajinagar Industrial Town, Rajajinagar, Bengaluru, Karnataka 560044.</p>';
    }

    private function cookiesHtml(): string
    {
        return '<h3>1. About cookies</h3>'
            . '<p>This website uses cookies. By using this website and agreeing to this policy, you consent to Rescom\'s use of cookies in accordance with this policy. Cookies are files sent by web servers to browsers and stored by browsers. They help track and identify returning visitors.</p>'
            . '<p>There are two types of cookies: Session cookies (deleted when you close the browser) and Persistent cookies (remain until manually deleted or expired).</p>'
            . '<h3>2. Cookies on our website</h3>'
            . '<p>Rescom uses the following types of cookies:</p>'
            . '<ul>'
            . '<li>To enhance user experience by remembering preferences during and across sessions.</li>'
            . '<li>To enable efficient navigation, preference storage, and overall improved site usability.</li>'
            . '</ul>'
            . '<h3>3. Google cookies</h3>'
            . '<p>We use Google Analytics to analyze usage data. Google uses cookies to collect statistical information. This is used to generate usage reports for internal review.</p>'
            . '<p>Read Google’s privacy policy at google.com/privacypolicy.html</p>'
            . '<p>We may also use Google AdSense to show interest-based ads. Google tracks your behavior using cookies. You can manage your preferences via:</p>'
            . '<ul>'
            . '<li>Google Ads Preferences Manager</li>'
            . '<li>Ads opt-out page</li>'
            . '<li>Browser plugin for opt-out</li>'
            . '</ul>'
            . '<h3>4. Third-party cookies</h3>'
            . '<p>When using this site, you may encounter third-party cookies, for example, from YouTube, Facebook, or Twitter for embedded content or social sharing buttons. These services may store cookies independently.</p>'
            . '<h3>5. Refusing cookies</h3>'
            . '<p>You can refuse or block cookies using your browser settings:</p>'
            . '<ul>'
            . '<li>In Internet Explorer: Tools → Internet Options → Privacy → Block all cookies.</li>'
            . '<li>In Firefox: Tools → Options → Privacy → Manage cookies settings.</li>'
            . '</ul>'
            . '<p>Blocking cookies may negatively impact your website experience.</p>'
            . '<h3>6. Changes to this Cookies Policy</h3>'
            . '<p>Rescom may update this Cookies Policy by posting a new version on the website.</p>'
            . '<h3>7. Contact Us</h3>'
            . '<p>Email: info@rescom.in<br>Address: Rescom<br>233, Rahul Building, 6th Main Road, Rajajinagar Industrial Town, Rajajinagar, Bengaluru, Karnataka 560044.</p>';
    }
};
