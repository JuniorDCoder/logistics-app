{{-- _form.blade.php --}}
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Full Name *</label><input type="text" name="name" class="form-control" value="{{ old('name',$team?->name) }}" required></div>
    <div class="col-md-6"><label class="form-label">Position *</label><input type="text" name="position" class="form-control" value="{{ old('position',$team?->position) }}" required></div>
    <div class="col-md-4"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email',$team?->email) }}"></div>
    <div class="col-md-4"><label class="form-label">LinkedIn URL</label><input type="text" name="linkedin" class="form-control" value="{{ old('linkedin',$team?->linkedin) }}"></div>
    <div class="col-md-4"><label class="form-label">Twitter URL</label><input type="text" name="twitter" class="form-control" value="{{ old('twitter',$team?->twitter) }}"></div>
    <div class="col-12"><label class="form-label">Bio</label><textarea name="bio" class="form-control" rows="3">{{ old('bio',$team?->bio) }}</textarea></div>
    <div class="col-md-6"><label class="form-label">Photo</label><input type="file" name="photo" class="form-control" accept="image/*"></div>
    <div class="col-md-4"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$team?->sort_order ?? 0) }}"></div>
    <div class="col-md-2 d-flex align-items-end pb-2">
        <div class="form-check"><input type="checkbox" name="is_active" class="form-check-input" id="ia" {{ old('is_active',$team?->is_active ?? true) ? 'checked':'' }}><label class="form-check-label" for="ia">Active</label></div>
    </div>
</div>
