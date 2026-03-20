{{-- resources/views/admin/services/_form.blade.php --}}
<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Title *</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title',$service?->title) }}" required>
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-2">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$service?->sort_order ?? 0) }}">
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <div class="form-check pb-2">
            <input type="checkbox" name="is_active" class="form-check-input" id="isActive" {{ old('is_active', $service?->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="isActive">Active</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Font Awesome Icon Class</label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon',$service?->icon) }}" placeholder="e.g. fa-plane">
        <small class="text-muted">Use Font Awesome class, e.g. <code>fa-plane</code>, <code>fa-ship</code>, <code>fa-truck</code></small>
    </div>
    <div class="col-md-6">
        <label class="form-label">Upload Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>
    <div class="col-12">
        <label class="form-label">Short Description</label>
        <textarea name="short_description" class="form-control" rows="2">{{ old('short_description',$service?->short_description) }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Full Description (HTML allowed)</label>
        <textarea name="description" class="form-control" rows="6" id="descEditor">{{ old('description',$service?->description) }}</textarea>
    </div>
</div>
