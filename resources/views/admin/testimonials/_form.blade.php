{{-- resources/views/admin/testimonials/_form.blade.php --}}
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="{{ old('name',$testimonial?->name) }}" required></div>
    <div class="col-md-6"><label class="form-label">Position</label><input type="text" name="position" class="form-control" value="{{ old('position',$testimonial?->position) }}" placeholder="e.g. CEO"></div>
    <div class="col-md-6"><label class="form-label">Company</label><input type="text" name="company" class="form-control" value="{{ old('company',$testimonial?->company) }}"></div>
    <div class="col-md-4">
        <label class="form-label">Rating *</label>
        <select name="rating" class="form-select" required>
            @for($i=5;$i>=1;$i--)<option value="{{ $i }}" {{ old('rating',$testimonial?->rating ?? 5)==$i ? 'selected':'' }}>{{ $i }} Stars</option>@endfor
        </select>
    </div>
    <div class="col-md-2 d-flex align-items-end pb-2">
        <div class="form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="ia" {{ old('is_active',$testimonial?->is_active ?? true) ? 'checked':'' }}>
            <label class="form-check-label" for="ia">Active</label>
        </div>
    </div>
    <div class="col-12"><label class="form-label">Testimonial Content *</label><textarea name="content" class="form-control" rows="4" required>{{ old('content',$testimonial?->content) }}</textarea></div>
    <div class="col-md-6"><label class="form-label">Avatar Photo</label><input type="file" name="avatar" class="form-control" accept="image/*"></div>
</div>
