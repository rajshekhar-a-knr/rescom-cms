@extends('admin.layouts.app')
@section('title', isset($member) ? 'Edit Intern' : 'Add Intern')
@section('breadcrumb')<span>></span><a href="{{ route('admin.interns.index') }}" style="color:#94a3b8;text-decoration:none">Interns</a><span>></span><span class="current">{{ isset($member) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
@php
    $testimonialDraft = $testimonialDraft ?? null;
@endphp
<div class="page-header"><h1 class="page-title">{{ isset($member) ? 'Edit' : 'Add' }} Intern</h1><a href="{{ route('admin.interns.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<form class="single-card-form" action="{{ isset($member) ? route('admin.interns.update',$member) : route('admin.interns.store') }}" method="POST" enctype="multipart/form-data">
@csrf @if(isset($member)) @method('PUT') @endif
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
<div><div class="card"><div class="card-header"><h3 class="card-title">Intern Details</h3></div><div class="card-body">
<div class="form-row"><div class="form-group"><label class="form-label">Full Name *</label><input type="text" name="name" class="form-control" value="{{ old('name',$member->name??'') }}" required></div><div class="form-group"><label class="form-label">Designation</label><input type="text" name="designation" class="form-control" value="{{ old('designation',$member->designation??'') }}"></div></div>
<div class="form-row"><div class="form-group"><label class="form-label">College Name</label><input type="text" name="college_name" class="form-control" value="{{ old('college_name',$member->college_name??'') }}" placeholder="e.g. ABC College of Engineering"></div><div class="form-group"><label class="form-label">College Guide</label><input type="text" name="college_guide" class="form-control" value="{{ old('college_guide',$member->college_guide??'') }}" placeholder="Faculty guide name"></div></div>
<div class="form-row"><div class="form-group"><label class="form-label">Rescom Guide</label><input type="text" name="knr_guide" class="form-control" value="{{ old('knr_guide',$member->knr_guide??'') }}" placeholder="Rescom mentor / guide name"></div><div class="form-group"><label class="form-label">Intern Type *</label><select name="intern_type" class="form-control" required><option value="current" {{ old('intern_type',$member->intern_type??'current')==='current' ? 'selected' : '' }}>Current Interns</option><option value="alumni" {{ old('intern_type',$member->intern_type??'')==='alumni' ? 'selected' : '' }}>Alumni Interns</option></select></div></div>
<div class="form-row"><div class="form-group"><label class="form-label">Department</label><select name="department_id" class="form-control"><option value="">None</option>@foreach($departments as $d)<option value="{{ $d->id }}" {{ old('department_id',$member->department_id??'')==$d->id?'selected':'' }}>{{ $d->name }}</option>@endforeach</select></div><div class="form-group"><label class="form-label">Experience (years)</label><input type="number" name="experience_years" class="form-control" value="{{ old('experience_years',$member->experience_years??0) }}"></div></div>
<div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email',$member->email??'') }}" placeholder="Registered email for certificate download"></div>
<div class="form-group"><label class="form-label">Bio</label><textarea name="bio" class="form-control" rows="4">{{ old('bio',$member->bio??'') }}</textarea></div>
</div></div></div>
<div><div class="card" style="margin-bottom:16px"><div class="card-header"><h3 class="card-title">Settings</h3></div><div class="card-body">
<div class="form-group" style="display:flex;align-items:center;justify-content:space-between"><label style="margin:0;font-size:13px;font-weight:600">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$member->is_active??true)?'checked':'' }}><span class="toggle-slider"></span></label></div>
<div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-top:12px"><label style="margin:0;font-size:13px;font-weight:600">Featured on Homepage</label><label class="toggle-switch"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$member->is_featured??false)?'checked':'' }}><span class="toggle-slider"></span></label></div>
<div class="form-group" style="margin-top:12px"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$member->sort_order??0) }}"></div>
</div></div>
<div class="card"><div class="card-header"><h3 class="card-title">Photo</h3></div><div class="card-body">@if(isset($member) && $member->photo)<div style="display:flex;justify-content:center"><img id="photoPreview" src="{{ media_url($member->photo) }}" style="width:140px;height:140px;object-fit:cover;border-radius:14px;margin-bottom:12px;border:1px solid rgba(0,0,0,0.08)"></div>@else<div style="display:flex;justify-content:center"><img id="photoPreview" src="" style="display:none;width:140px;height:140px;object-fit:cover;border-radius:14px;margin-bottom:12px;border:1px solid rgba(0,0,0,0.08)"></div>@endif<input type="file" name="photo" class="form-control" accept="image/*" onchange="previewTeamPhoto(event)"></div></div>
<div class="card"><div class="card-header"><h3 class="card-title">Certificate</h3></div><div class="card-body">@if(isset($member) && $member->certificate)<div style="margin-bottom:12px"><a href="{{ route('internship.certificate.download', ['intern' => $member, 'token' => $member->certificate_token]) }}" target="_blank" class="btn btn-secondary btn-sm">Download current certificate</a></div>@endif<input type="file" name="certificate" class="form-control" accept="application/pdf,image/*"></div></div>
<div class="card"><div class="card-header"><h3 class="card-title" style="margin-top:16px">Student / College Testimonial</h3></div><div class="card-body">
    @if(isset($member))
        <input type="hidden" name="testimonial_id" value="{{ old('testimonial_id', optional($testimonialDraft)->id ?? '') }}">
        <p style="font-size:13px;color:#64748b;line-height:1.6;margin-bottom:14px">Add a student or college testimonial here. It will be linked to the Testimonials module and will appear on the website after approval there.</p>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Rating (1-5)</label>
                <select name="testimonial_rating" class="form-control">
                    @for($i=5;$i>=1;$i--)
                        <option value="{{ $i }}" {{ old('testimonial_rating', optional($testimonialDraft)->rating ?? 5) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Project / Program Type</label>
                <input type="text" name="testimonial_project_type" class="form-control" value="{{ old('testimonial_project_type', optional($testimonialDraft)->project_type ?? '') }}" placeholder="e.g. Internship Program">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Testimonial Content</label>
            <textarea name="testimonial_content" class="form-control" rows="4" placeholder="Write the student testimonial here">{{ old('testimonial_content', optional($testimonialDraft)->content ?? '') }}</textarea>
        </div>
        <div style="margin-top:10px;padding:12px 14px;border-radius:14px;background:#f8fafc;border:1px solid rgba(15,23,42,0.08);font-size:13px;line-height:1.6">
            This testimonial will automatically use the intern's above details:
            <strong>{{ isset($member) ? $member->name : 'Student Name' }}</strong>,
            <strong>{{ isset($member) ? ($member->designation ?: 'Student Designation') : 'Student Designation' }}</strong>,
            <strong>{{ isset($member) ? ($member->college_name ?: 'College Name') : 'College Name' }}</strong>,
            and the uploaded intern photo.
        </div>
        <div style="margin-top:12px;padding:12px 14px;border-radius:14px;background:#eff6ff;border:1px solid #dbeafe;color:#0f4c81;font-size:13px;line-height:1.6"><strong>Approval flow:</strong> This testimonial is saved as pending. Open the <a href="{{ route('admin.testimonials.index') }}" style="color:#1d4ed8;font-weight:700">Testimonials module</a> and mark it Active to show it on the website.</div>
        @if($testimonialDraft)
            <div style="margin-top:12px;padding:12px 14px;border-radius:14px;background:#f8fafc;border:1px solid rgba(15,23,42,0.08);font-size:13px;line-height:1.6"><strong>Status:</strong> {{ optional($testimonialDraft)->is_active ? 'Approved' : 'Pending approval' }}</div>
        @endif
    @else
        <div style="padding:14px;border-radius:14px;background:#f8fafc;border:1px dashed rgba(15,23,42,0.14);color:#64748b;font-size:13px;line-height:1.6">Save the intern first to add a linked student or college testimonial.</div>
    @endif
</div></div>
</div></div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($member) ? 'Update' : 'Submit' }}</button>
</div>
</form>
@endsection

@section('scripts')
<script>
function previewTeamPhoto(event){
    const img = document.getElementById('photoPreview');
    if (!img || !event.target.files || !event.target.files[0]) return;
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>
@endsection
