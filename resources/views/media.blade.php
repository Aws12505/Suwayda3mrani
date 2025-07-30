{{-- resources/views/media.blade.php --}}
@extends('layouts.app')

@section('title', trans_dynamic('page.media_gallery_title', app()->getLocale()))

@section('content')
<!-- Page Header -->
<section class="page-header position-relative overflow-hidden">
    @php
        $mediaHeaderBg = \App\Models\SiteContent::getContent('page_headers', app()->getLocale())['media_gallery']['background_image'] ?? null;
    @endphp
    
    @if($mediaHeaderBg)
        <div class="page-header-bg" style="background-image: url('{{ $mediaHeaderBg }}')"></div>
        <div class="page-header-overlay"></div>
    @else
        <div class="page-header-gradient"></div>
    @endif
    
    <div class="container position-relative">
        <div class="row min-vh-50 align-items-center text-white">
            <div class="col-12 text-center py-5">
                <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">
                    {{ trans_dynamic('page.media_gallery', app()->getLocale()) }}
                </h1>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">
                    {{ trans_dynamic('page.media_gallery_desc', app()->getLocale()) }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Media Grid -->
<section class="media-grid-section py-5">
    <div class="container">
        <!-- Filter Buttons -->
        <div class="text-center mb-5">
            <div class="btn-group" role="group" data-aos="fade-up">
                <button type="button" class="btn btn-outline-primary active" data-filter="all">
                    {{ trans_dynamic('filter.all', app()->getLocale()) }}
                </button>
                <button type="button" class="btn btn-outline-primary" data-filter="image">
                    {{ trans_dynamic('filter.photos', app()->getLocale()) }}
                </button>
                <button type="button" class="btn btn-outline-primary" data-filter="video">
                    {{ trans_dynamic('filter.videos', app()->getLocale()) }}
                </button>
            </div>
        </div>

        <!-- Media Grid -->
        <div class="row g-4" id="mediaGrid">
            @foreach($mediaItems as $media)
    <div class="col-6 col-md-4 col-lg-3 media-grid-item" data-type="{{ $media->type }}" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 50 }}">
        <div class="media-grid-card position-relative overflow-hidden rounded shadow-sm" 
             style="cursor: pointer;"
             onclick="showMediaPreview('{{ addslashes($media->getTitle(app()->getLocale())) }}', '{{ $media->type }}', '{{ $media->media_url }}', '{{ addslashes($media->getDescription(app()->getLocale()) ?? '') }}')">
             
            @if($media->type === 'video')
                <div class="d-flex align-items-center justify-content-center bg-dark text-white rounded" style="width: 100%; height: 250px;">
                    <i class="fas fa-video fa-lg"></i>
                </div>
                <div class="media-type-badge position-absolute top-0 end-0 m-2">
                    <span class="badge bg-danger">
                        <i class="fas fa-video m-1"></i>{{ trans_dynamic('media.video', app()->getLocale()) }}
                    </span>
                </div>
            @else
                <img src="{{ $media->media_url }}" 
                     alt="{{ $media->getTitle(app()->getLocale()) }}" 
                     class="media-grid-image"
                     loading="lazy"
                     style="width: 100%; height: 250px; object-fit: cover;"
                     onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkltYWdlIE5vdCBGb3VuZDwvdGV4dD48L3N2Zz4=';">
                <div class="media-type-badge position-absolute top-0 end-0 m-2">
                    <span class="badge bg-success">
                        <i class="fas fa-image m-1"></i>{{ trans_dynamic('media.photo', app()->getLocale()) }}
                    </span>
                </div>
            @endif
            
            <div class="media-overlay position-absolute bottom-0 start-0 w-100 p-3">
                <h6 class="text-white mb-1">{{ $media->getTitle(app()->getLocale()) }}</h6>
                @if($media->getDescription(app()->getLocale()))
                    <p class="text-light small mb-0">{{ Str::limit($media->getDescription(app()->getLocale()), 60) }}</p>
                @endif
            </div>
        </div>
    </div>
@endforeach
        </div>

        <!-- No Media Found -->
        @if($mediaItems->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-images fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">{{ trans_dynamic('media.no_media_found', app()->getLocale()) }}</h4>
                <p class="text-muted">{{ trans_dynamic('media.no_media_desc', app()->getLocale()) }}</p>
            </div>
        @endif

        <!-- Pagination -->
        @if($mediaItems->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $mediaItems->links() }}
            </div>
        @endif
    </div>
</section>

<!-- Media Preview Modal with White Background -->
<div class="modal fade" id="mediaPreviewModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-white">
            <div class="modal-header border-bottom">
                @if(app()->getLocale() === 'ar')
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h5 class="modal-title text-dark">Media Preview</h5>
                @else
                    <h5 class="modal-title text-dark">Media Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                @endif
            </div>
            <div class="modal-body p-0 bg-white" id="mediaPreviewContent">
                <!-- Preview content will be loaded here -->
            </div>
            <div class="modal-footer border-top bg-light" id="mediaPreviewFooter" style="display: none;">
                <div class="w-100">
                    <h6 class="mb-2 text-dark" id="mediaPreviewDescTitle"></h6>
                    <div class="description-content bg-white border rounded p-3" id="mediaPreviewDescription"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality (existing code)
    const filterButtons = document.querySelectorAll('[data-filter]');
    const mediaItems = document.querySelectorAll('.media-grid-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            mediaItems.forEach((item, index) => {
                if (filter === 'all' || item.dataset.type === filter) {
                    item.style.display = 'block';
                    item.style.animation = `fadeInUp 0.6s ease ${index * 0.1}s both`;
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // CLEAN PREVIEW FUNCTION WITHOUT EXTRA BUTTONS
    window.showMediaPreview = function(title, type, url, description = '') {
        const modal = new bootstrap.Modal(document.getElementById('mediaPreviewModal'));
        const modalTitle = document.querySelector('#mediaPreviewModal .modal-title');
        const previewContent = document.getElementById('mediaPreviewContent');
        const previewFooter = document.getElementById('mediaPreviewFooter');
        const previewDescTitle = document.getElementById('mediaPreviewDescTitle');
        const previewDescription = document.getElementById('mediaPreviewDescription');
        
        modalTitle.textContent = title;
        
        // Show/hide footer based on description
        if (description && description.trim() !== '') {
            previewFooter.style.display = 'block';
            previewDescTitle.textContent = title;
            previewDescription.innerHTML = description;
        } else {
            previewFooter.style.display = 'none';
        }
        
        if (type === 'image') {
            previewContent.innerHTML = `
                <div class="text-center p-3">
                    <img src="${url}" class="img-fluid rounded" style="max-height: 70vh; max-width: 100%; object-fit: contain;" 
                         onerror="this.onerror=null; this.outerHTML='<div class=\\'alert alert-danger\\'>Failed to load image</div>';">
                </div>
            `;
        } else {
            // Check if URL is a Google Drive ID or a regular video URL
            if (isGoogleDriveId(url)) {
                // It's a Google Drive ID, create iframe
                previewContent.innerHTML = `
                    <div class="text-center p-3">
                        <iframe 
                            src="https://drive.google.com/file/d/${url}/preview"
                            width="100%"
                            height="500"
                            style="border: none; border-radius: 8px;"
                            allow="autoplay; fullscreen"
                            allowfullscreen>
                        </iframe>
                    </div>
                `;
            } else {
                // It's a regular video URL, use video element
                previewContent.innerHTML = `
                    <div class="text-center p-3">
                        <video controls class="rounded" style="max-height: 70vh; max-width: 100%; object-fit: contain;" preload="metadata">
                            <source src="${url}" type="video/mp4">
                            <source src="${url}" type="video/webm">
                            <source src="${url}" type="video/ogg">
                            <p class="text-danger">Your browser doesn't support video playback.</p>
                        </video>
                    </div>
                `;
            }
        }
        
        modal.show();
    };
    
    // Helper function to detect Google Drive ID
    function isGoogleDriveId(url) {
        const driveIdPattern = /^[a-zA-Z0-9_-]{25,44}$/;
        return driveIdPattern.test(url) && !url.includes('/') && !url.includes('.');
    }
});

// Add fadeInUp animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);
</script>
@endpush



