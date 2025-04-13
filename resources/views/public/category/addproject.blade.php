@extends('layouts.public')
@section('title', 'DesignHive | Add Project')
@section('content')
<main class="main container py-5" style="background: linear-gradient(135deg,  0%, #e9ecef 100%); min-height: 100vh;">
    <div class="card p-5 shadow-lg rounded-3 border-0" style="max-width: 700px; margin: 0 auto;">
        <h2 class="text-center mb-4 fw-bold display-6" style="background: #420363; -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Add New Project
        </h2>
        <form action="{{ route('store.project') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="form-label fw-bold text-secondary">Project Title</label>
                <input type="text" class="form-control rounded-2 py-2 px-3 border-1 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                    id="title" name="title" required>
            </div>
            <div class="mb-4">
                <label for="description" class="form-label fw-bold text-secondary">Description</label>
                <textarea class="form-control rounded-2 py-2 px-3 border-1 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    id="description" name="description" rows="4" style="min-height: 100px;"></textarea>
            </div>
            <div class="mb-4">
                <label for="category_id" class="form-label fw-bold text-secondary">Category</label>
                <select class="form-select rounded-2 py-2 px-3 border-1 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    id="category_id" name="category_id" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold text-secondary">Tags</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}">
                        <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-4">
                <label for="images" class="form-label fw-bold text-secondary">Upload Images</label>
                <div class="border-2 border-dashed rounded-3 p-4 text-center position-relative"
                    style="border-color: #cbd5e0; background-color: #f8fafc;">
                    <input type="file" class="form-control visually-hidden" id="images" name="images[]" accept="image/png, image/jpeg" multiple required onchange="previewImages(event)">
                    <label for="images" class="btn btn-outline-light px-4 rounded-1 cursor-pointer" style="border-color: #420363 !important; color: #420363;">
                        <i class="bi bi-cloud-upload me-2"></i>Choose Files
                    </label>
                    <p class="text-muted mt-2 mb-0">PNG or JPG up to 5MB each</p>
                    <div id="image-preview-container" class="mt-3">
                        <!-- سيتم عرض معاينات الصور هنا -->
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" name="featured_post" value="0" class="btn btn-lg px-5 py-2 rounded-1 fw-bold shadow-sm"
                    style="background: #420363; color: white; transition: transform 0.2s;">
                    Add Project
                </button>
                @if ($subscriptionType == 'Basic' || $subscriptionType == 'pro_designer')
                <button type="submit" name="featured_post" value="1" class="btn btn-lg px-5 py-2 rounded-1 fw-bold shadow-sm"
                    style="background: #420363; color: white; transition: transform 0.2s;">
                    Add Featured Project
                </button>
                @endif
            </div>
        </form>
    </div>
</main>
<script>
    function previewImages(event) {
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = ''; // إعادة تعيين المعاينات السابقة

        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            const imagePreview = document.createElement('img');
            imagePreview.classList.add('img-fluid', 'rounded-3', 'shadow-sm');
            imagePreview.style.maxHeight = '200px';
            imagePreview.style.objectFit = 'cover';
            imagePreview.classList.add('d-block', 'mb-3');

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            }

            reader.readAsDataURL(files[i]);

            previewContainer.appendChild(imagePreview);
        }
    }

    document.querySelector('button[type="submit"]').addEventListener('mouseover', function() {
        this.style.transform = 'translateY(-2px)';
    });
    document.querySelector('button[type="submit"]').addEventListener('mouseout', function() {
        this.style.transform = 'translateY(0)';
    });
</script>
@endsection