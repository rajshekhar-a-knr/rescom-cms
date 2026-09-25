<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller {
    public function index() {
        $clients = Client::orderBy('sort_order')->paginate(30);
        return view('admin.pages.clients.index', compact('clients'));
    }
    public function create() { return view('admin.pages.clients.form'); }
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|in:client,partner,technology',
            'website_url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('logo')) {
            $data['logo'] = upload_to_storage($request->file('logo'), 'clients');
        }
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        Client::create($data);
        return redirect()->route('admin.clients.index')->with('success','Client added!');
    }
    public function edit(Client $client) { return view('admin.pages.clients.form', compact('client')); }
    public function update(Request $request, Client $client) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|in:client,partner,technology',
            'website_url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('logo')) {
            $data['logo'] = upload_to_storage($request->file('logo'), 'clients');
        }
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $client->update($data);
        return redirect()->route('admin.clients.index')->with('success','Client updated!');
    }
    public function destroy(Client $client) {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success','Deleted!');
    }
}
