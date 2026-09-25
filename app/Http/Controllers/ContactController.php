<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Portfolio;
use App\Services\EmailService;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    protected EmailService $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }
    public function index(Request $request)
    {
        $services = Service::where('is_active', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        $products = Portfolio::where('is_active', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();

        $selectedService = $request->get('service');
        $selectedProduct = $request->get('product');

        $selectedServiceTitle = null;
        if ($selectedService) {
            $svc = Service::where('slug', $selectedService)->orWhere('title', $selectedService)->first();
            $selectedServiceTitle = $svc?->title ?? $selectedService;
        }

        $selectedProductTitle = null;
        if ($selectedProduct) {
            $prod = Portfolio::where('slug', $selectedProduct)->orWhere('title', $selectedProduct)->first();
            $selectedProductTitle = $prod?->title ?? $selectedProduct;
        }

        $officeCards = [
            [
                'title' => setting('contact_aus_title') ?: 'Australia Office',
                'city' => setting('contact_aus_city') ?: 'Melbourne, Australia',
                'address' => setting('contact_aus_address') ?: '1 Queens Rd, St. Kilda Road Towers, Melbourne VIC 3004, Australia',
                'phone' => setting('contact_phone2') ?: setting('contact_phone'),
                'image' => setting('contact_aus_image'),
                'directions' => setting('contact_aus_directions_url') ?: 'https://maps.google.com',
            ],
            [
                'title' => setting('contact_india_title') ?: 'India Office',
                'city' => setting('contact_india_city') ?: 'Bengaluru, Karnataka',
                'address' => setting('contact_india_address') ?: (setting('contact_address') ?: '#233, Rahul Building, 6th Main Road, Rajajinagar Industrial Town, Rajajinagar, Bengaluru, Karnataka 560044'),
                'phone' => setting('contact_phone'),
                'image' => setting('contact_india_image'),
                'directions' => setting('contact_india_directions_url') ?: 'https://maps.google.com',
            ],
        ];

        $directionsText = setting('contact_directions_text', 'Get Directions');

        return view('pages.contact', compact('services','products','selectedServiceTitle','selectedProductTitle','officeCards','directionsText'));
    }

    public function submit(Request $request)
    {
        if (!verify_recaptcha_response($request)) {
            return back()
                ->withInput()
                ->withErrors(['contact_captcha' => 'Please complete the reCAPTCHA verification.']);
        }

        $data = $request->validate([
            'name'               => ['required','string','max:255','regex:/^[a-zA-Z\\s\\.' . "'" . '\\-]+$/'],
            'email'              => 'required|email|max:255',
            'country_code'       => 'nullable|in:+91,+1,+44,+61,+971',
            'phone'              => ['nullable','string','max:25','regex:/^[0-9\\s\\+\\-\\(\\)]+$/'],
            'company'            => 'nullable|string|max:255',
            'subject'            => 'nullable|string|max:500',
            'message'            => 'required|string|min:20|max:4000',
            'service_interested' => 'nullable|string|max:255',
            'product_interested' => 'nullable|string|max:255',
        ]);

        $countryDigits = [
            '+91' => 10,
            '+1' => 10,
            '+44' => 10,
            '+61' => 9,
            '+971' => 9,
        ];
        if ($request->filled('phone')) {
            if (!$request->filled('country_code')) {
                return back()->withErrors(['country_code' => 'Please select a country code.'])->withInput();
            }
            $digits = preg_replace('/\\D+/', '', $request->phone);
            $expected = $countryDigits[$request->country_code] ?? null;
            if ($expected && strlen($digits) !== $expected) {
                return back()->withErrors(['phone' => "Phone number must be {$expected} digits for {$request->country_code}."])->withInput();
            }
        }

        $data['ip_address'] = $request->ip();
        $data['user_agent'] = $request->userAgent();
        $data['source']     = 'website';
        $data['status']     = 'new';

        $contact = Contact::create($data);

        // Try to send email notification
        if ($contact) {
            $siteName = setting('site_name', 'Rescom');
            $siteLogo = setting('site_logo');
            $subject = "Thank you for contacting {$siteName}";

            $rows = [
                ['Full Name', $contact->name],
                ['Email', $contact->email],
                ['Phone', trim(($contact->country_code ?? '') . ' ' . ($contact->phone ?? ''))],
                ['Company', $contact->company],
                ['Subject', $contact->subject],
                ['Service Interested', $contact->service_interested],
                ['Product Interested', $contact->product_interested],
                ['Message', $contact->message],
            ];

            $html = view('emails.contact-thankyou', [
                'rows' => $rows,
                'siteName' => $siteName,
                'siteLogo' => $siteLogo,
            ])->render();

            $sent = $this->emailService->sendRawHtml($contact->email, $subject, $html);
            log::info('Contact form submission email ' . ($sent ? 'sent' : 'failed') . ' to ' . $contact->email, ['contact_id' => $contact->id]);
            if ($request->boolean('debug_email')) {
                log::info('Debug Email Result: ' . ($sent ? 'SENT' : 'FAILED'), ['to' => $contact->email, 'subject' => $subject]);
                return response('Email send called. Result: ' . ($sent ? 'SENT' : 'FAILED'), 200);
            }
        }

        return back()->with('success', 'Thank you for reaching out! We will get back to you shortly.');
    }
}
