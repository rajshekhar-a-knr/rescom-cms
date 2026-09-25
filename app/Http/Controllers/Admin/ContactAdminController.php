<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactAdminController extends Controller {
    public function index(Request $request) {
        $query = Contact::orderBy('created_at','desc');
        if ($request->status) $query->where('status',$request->status);
        if ($request->search) $query->where(function($q) use($request){ $q->where('name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%'); });
        $contacts = $query->paginate(25);
        $counts = ['all'=>Contact::count(),'new'=>Contact::where('status','new')->count(),'read'=>Contact::where('status','read')->count(),'replied'=>Contact::where('status','replied')->count()];
        return view('admin.pages.contacts.index', compact('contacts','counts'));
    }
    public function show($id) {
        $contact = Contact::findOrFail($id);
        if ($contact->status === 'new') $contact->update(['status'=>'read']);
        return view('admin.pages.contacts.show', compact('contact'));
    }
    public function updateStatus(Request $request, $id) {
        $data = $request->validate([
            'status' => 'required|in:new,read,replied,spam,archived',
            'admin_notes' => 'nullable|string|max:2000',
        ]);
        Contact::findOrFail($id)->update($data);
        return back()->with('success','Status updated!');
    }
    public function destroy($id) {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.contacts.index')->with('success','Inquiry deleted!');
    }
    public function reply(Request $request, $id) {
        $contact = Contact::findOrFail($id);
        $data = $request->validate([
            'reply_message' => 'required|string|min:5|max:5000',
            'admin_notes' => 'nullable|string|max:2000',
        ]);
        try {
            \Mail::to($contact->email)->send(new \App\Mail\ContactReply($contact, $data['reply_message']));
            $contact->update(['status'=>'replied','replied_at'=>now(),'admin_notes'=>$data['admin_notes']]);
            return back()->with('success','Reply sent successfully!');
        } catch(\Exception $e) {
            return back()->with('error','Failed to send reply: '.$e->getMessage());
        }
    }
}
