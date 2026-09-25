<?php

namespace App\Http\Controllers;

use App\Models\DemoProduct;
use App\Models\DemoProductRequest;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class DemoProductController extends Controller
{
    public function __construct(private EmailService $emailService)
    {
    }

    public function index()
    {
        $products = DemoProduct::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.demo-products', compact('products'));
    }

    public function requestAccess(Request $request, DemoProduct $demoProduct)
    {
        abort_unless($demoProduct->is_active, 404);

        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:40',
            'organization' => 'required|string|max:255',
        ]);

        $requestLog = DemoProductRequest::create([
            'demo_product_id' => $demoProduct->id,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'organization' => $data['organization'],
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
        ]);

        $subject = "{$demoProduct->title} Demo Credentials | " . setting('site_name', 'Rescom');
        $html = view('emails.demo-product-credentials', [
            'product' => $demoProduct,
            'siteName' => setting('site_name', 'Rescom'),
            'siteLogo' => setting('site_logo'),
        ])->render();

        if (Config::get('mail.default') === 'log') {
            Log::warning('Demo product credential email blocked because mailer is set to log', [
                'demo_product_id' => $demoProduct->id,
                'email' => $data['email'],
            ]);

            return back()->withErrors([
                'email' => 'Email delivery is not enabled right now. Please contact our team for demo credentials.',
            ])->withInput();
        }

        $sent = $this->emailService->sendRawHtml($data['email'], $subject, $html);

        if ($sent) {
            $requestLog->update(['sent_at' => now()]);
            return back()->with('demo_success', "Demo credentials for {$demoProduct->title} have been sent to {$data['email']}.");
        }

        Log::warning('Demo product credential email failed', [
            'demo_product_id' => $demoProduct->id,
            'email' => $data['email'],
        ]);

        return back()->withErrors([
            'email' => 'We could not send the credentials right now. Please try again in a few minutes.',
        ])->withInput();
    }
}
