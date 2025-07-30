{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', trans_dynamic('page.home_title', app()->getLocale()))

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden">
        @if (isset($data['hero']['background_image']))
            <div class="hero-bg" style="background-image: url('{{ $data['hero']['background_image'] }}')"></div>
        @endif
        <div class="hero-overlay"></div>
        <div class="container position-relative">
            <div class="row min-vh-100 align-items-center">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-3 fw-bold mb-4" data-aos="fade-up">
                        {{ $data['hero']['title'] ?? trans_dynamic('hero.default_title', app()->getLocale()) }}
                    </h1>
                    <p class="lead mb-5" data-aos="fade-up" data-aos-delay="200">
                        {{ $data['hero']['subtitle'] ?? trans_dynamic('hero.default_subtitle', app()->getLocale()) }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Counters Section -->
    <section class="counters-section py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach ($data['counters'] as $counter)
                    <div class="col-6 col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="counter-item text-center">
                            <div class="counter-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                                @if ($counter->type === 'image' && $counter->image_url)
                                    <img src="{{ $counter->image_url }}" alt="{{ $counter->getTitle(app()->getLocale()) }}"
                                        class="counter-image">
                                @elseif($counter->type === 'icon' && $counter->icon)
                                    <i class="{{ $counter->icon }} fa-2x text-brand"></i>
                                @else
                                    <!-- Fallback: show icon placeholder -->
                                    <i class="fas fa-chart-line fa-2x text-brand"></i>
                                @endif
                            </div>
                            <h5 class="counter-title">{{ $counter->getTitle(app()->getLocale()) }}</h5>
                            <div class="counter-number display-6 fw-bold text-brand" data-target="{{ $counter->count }}">0
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Take Action Section -->
    @if (isset($data['takeAction']))
        <section class="take-action-section py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                        <img src="{{ $data['takeAction']['image'] }}"
                            alt="{{ trans_dynamic('labels.take_action', app()->getLocale()) }}"
                            class="img-fluid rounded shadow">
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="ps-lg-4">
                            <h2 class="display-5 fw-bold mb-4">{{ $data['takeAction']['title'] }}</h2>
                            <p class="lead mb-4">{{ $data['takeAction']['subtitle'] }}</p>
                            @if (isset($data['takeAction']['button_url']))
                                <a href="{{ $data['takeAction']['button_url'] }}" class="btn btn-primary btn-lg">
                                    {{ $data['takeAction']['button_text'] ?? trans_dynamic('button.learn_more', app()->getLocale()) }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Media Gallery Section -->
    <section class="media-gallery-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold" data-aos="fade-up">
                    {{ trans_dynamic('section.media_gallery', app()->getLocale()) }}</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="200">
                    {{ trans_dynamic('section.media_gallery_desc', app()->getLocale()) }}</p>
            </div>

            <div class="media-scroll-container" data-aos="fade-up" data-aos-delay="400">
                <div class="media-scroll d-flex">
                    @foreach ($data['mediaItems'] as $media)
                        <div class="media-item flex-shrink-0 m-3">
                            <div class="media-card position-relative overflow-hidden rounded" style="cursor: pointer;"
                                onclick="showHomePreview('{{ addslashes($media->getTitle(app()->getLocale())) }}', '{{ $media->type }}', '{{ $media->media_url }}', '{{ addslashes($media->getDescription(app()->getLocale()) ?? '') }}')">

                                @if ($media->type === 'video')
                                    <div class="d-flex align-items-center justify-content-center bg-dark text-white rounded"
                                        style="width: 100%; height: 100%;">
                                        <i class="fas fa-video fa-lg"></i>
                                    </div>
                                @else
                                    <img src="{{ $media->media_url }}" alt="{{ $media->getTitle(app()->getLocale()) }}"
                                        class="w-100 h-100 object-cover" loading="lazy"
                                        onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkltYWdlIE5vdCBGb3VuZDwvdGV4dD48L3N2Zz4=';">
                                @endif

                                <div class="media-overlay position-absolute bottom-0 start-0 w-100 p-3">
                                    <h6 class="text-white mb-1">{{ $media->getTitle(app()->getLocale()) }}</h6>
                                    @if ($media->getDescription(app()->getLocale()))
                                        <p class="text-white-50 small mb-0">
                                            {{ Str::limit($media->getDescription(app()->getLocale()), 50) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('media') }}"
                    class="btn btn-outline-primary">{{ trans_dynamic('button.view_all_media', app()->getLocale()) }}</a>
            </div>
        </div>
    </section>

    <!-- Stories Section -->
    <section id="stories" class="stories-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold" data-aos="fade-up">
                    {{ trans_dynamic('section.stories_of_hope', app()->getLocale()) }}</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="200">
                    {{ trans_dynamic('section.stories_desc', app()->getLocale()) }}</p>
            </div>

            <!-- Desktop: Horizontal Scroll -->
            <div class="stories-scroll-container d-none d-md-block" data-aos="fade-up" data-aos-delay="400">
                <div class="stories-scroll d-flex">
                    @foreach ($data['stories'] as $story)
                        <div class="story-item flex-shrink-0 m-3">
                            <div class="story-card h-100">
                                <div class="story-image-container">
                                    <img src="{{ $story->image_url }}" alt="{{ $story->getTitle(app()->getLocale()) }}"
                                        class="story-image" loading="lazy"
                                        onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pjwvc3ZnPg==';">
                                    <div class="story-overlay">
                                        <div class="story-date">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            {{ $story->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="story-content p-2">
                                    <h5 class="story-title text-gray-900 mb-3">{{ $story->getTitle(app()->getLocale()) }}
                                    </h5>
                                    <p class="story-excerpt text-muted mb-4">
                                        {{ $story->getExcerpt(app()->getLocale(), 120) }}</p>
                                    <div class="story-actions d-flex gap-2 justify-content-between align-items-center">
                                        <a href="{{ route('story.show', $story->id) }}" class="story-btn-custom"
                                            style="
                                            display: inline-flex;
                                            align-items: center;
                                            gap: 0.5rem;
                                            font-size: 0.875rem;
                                            font-weight: 600;
                                            padding: 0.5rem 1rem;
                                            border: 2px solid #2f9319;
                                            border-radius: 8px;
                                            background-color: #2f9319;
                                            color: white;
                                            text-decoration: none;
                                            transition: all 0.3s ease;
                                        "
                                            onmouseover="this.style.backgroundColor='#2f9319'; this.style.color='white';"
                                            onmouseout="this.style.backgroundColor='#2f9319'; this.style.color='white';">
                                            <i class="fas fa-book-open"></i>
                                            {{ trans_dynamic('button.read_story', app()->getLocale()) }}
                                        </a>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ ceil(str_word_count(strip_tags($story->getContent(app()->getLocale()))) / 200) }}
                                            min read
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Mobile: Grid Layout -->
            <div class="stories-grid-container d-md-none" data-aos="fade-up" data-aos-delay="400">
                <div class="row mx-0"> <!-- Added mx-0 to remove horizontal margins -->
                    @foreach ($data['stories']->take(3) as $story)
                        <div class="col-12 px-0"> <!-- Added px-0 to remove horizontal padding -->
                            <div class="story-card-mobile">
                                <div class="story-image-mobile">
                                    <img src="{{ $story->image_url }}" class="story-image-mobile-img"
                                        alt="{{ $story->getTitle(app()->getLocale()) }}" loading="lazy">
                                </div>
                                <div class="story-content-mobile">
                                    <h6 class="story-title-mobile">
                                        {{ Str::limit($story->getTitle(app()->getLocale()), 50) }}</h6>
                                    <p class="story-excerpt-mobile">{{ $story->getExcerpt(app()->getLocale(), 80) }}</p>
                                    <div class="story-meta-mobile">
                                        <a href="{{ route('story.show', $story->id) }}" class="story-btn-custom"
                                            style="
                                    display: inline-flex;
                                    align-items: center;
                                    gap: 0.5rem;
                                    font-size: 0.875rem;
                                    font-weight: 600;
                                    padding: 0.5rem 1rem;
                                    border: 2px solid #2f9319;
                                    border-radius: 8px;
                                    background-color: #2f9319;
                                    color: white;
                                    text-decoration: none;
                                    transition: all 0.3s ease;
                                "
                                            onmouseover="this.style.backgroundColor='#2f9319'; this.style.color='white';"
                                            onmouseout="this.style.backgroundColor='#2f9319'; this.style.color='white';">
                                            <i class="fas fa-book-open"></i>
                                            {{ trans_dynamic('button.read_story', app()->getLocale()) }}
                                        </a>
                                        <small class="text-muted">
                                            {{ $story->created_at->format('M d') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- View All Stories Button -->
            @if ($data['stories']->count() > 3)
                {{-- <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="600">
                    <a href="{{ route('stories.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-book me-2"></i>
                        {{ trans_dynamic('button.view_all_stories', app()->getLocale()) }}
                    </a>
                </div> --}}
                <div class="text-center mt-4">
                <a href="{{ route('stories.index') }}"
                    class="btn btn-outline-primary">{{ trans_dynamic('button.view_all_stories', app()->getLocale()) }}</a>
            </div>
            @endif
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold" data-aos="fade-up">
                    {{ trans_dynamic('section.our_partners', app()->getLocale()) }}</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="200">
                    {{ trans_dynamic('section.partners_desc', app()->getLocale()) }}</p>
            </div>

            <div class="row justify-content-center">
                @foreach ($data['partners'] as $partner)
                    <div class="col-6 col-md-4 col-lg-3 mb-4" data-aos="zoom-in"
                        data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="partner-item text-center">
                            @if ($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank"
                                    class="text-decoration-none partner-link">
                                    <div class="partner-logo-circle mx-auto m-3">
                                        <img src="{{ $partner->logo_url }}"
                                            alt="{{ $partner->getName(app()->getLocale()) }}" class="partner-logo">
                                    </div>
                                    <h6 class="partner-name">{{ $partner->getName(app()->getLocale()) }}</h6>
                                </a>
                            @else
                                <div class="partner-logo-circle mx-auto mb-3">
                                    <img src="{{ $partner->logo_url }}"
                                        alt="{{ $partner->getName(app()->getLocale()) }}" class="partner-logo">
                                </div>
                                <h6 class="partner-name">{{ $partner->getName(app()->getLocale()) }}</h6>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Home Media Preview Modal with White Background -->
    <div class="modal fade" id="homePreviewModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-white">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Media Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0 bg-white" id="homePreviewContent">
                    <!-- Preview content will be loaded here -->
                </div>
                <div class="modal-footer border-top bg-light" id="homePreviewFooter" style="display: none;">
                    <div class="w-100">
                        <h6 class="mb-2 text-dark" id="homePreviewDescTitle"></h6>
                        <div class="description-content bg-white border rounded p-3" id="homePreviewDescription"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Counter Animation (existing code)
            function animateCounters() {
                const counters = document.querySelectorAll('.counter-number');

                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                            entry.target.classList.add('animated');
                            animateCounter(entry.target);
                        }
                    });
                }, observerOptions);

                counters.forEach(counter => {
                    observer.observe(counter);
                });
            }

            function animateCounter(element) {
                const target = parseInt(element.getAttribute('data-target'));
                const duration = 2000;
                const startTime = performance.now();

                function updateCounter(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const easeOut = 1 - Math.pow(1 - progress, 3);
                    const current = Math.floor(easeOut * target);

                    element.textContent = current.toLocaleString();

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        element.textContent = target.toLocaleString();
                    }
                }

                requestAnimationFrame(updateCounter);
            }

            animateCounters();

            // CLEAN PREVIEW FUNCTION WITHOUT EXTRA BUTTONS
            window.showHomePreview = function(title, type, url, description = '') {
                const modal = new bootstrap.Modal(document.getElementById('homePreviewModal'));
                const modalTitle = document.querySelector('#homePreviewModal .modal-title');
                const previewContent = document.getElementById('homePreviewContent');
                const previewFooter = document.getElementById('homePreviewFooter');
                const previewDescTitle = document.getElementById('homePreviewDescTitle');
                const previewDescription = document.getElementById('homePreviewDescription');

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
                            <p class="text-danger">Your browser doesn't support video playbook.</p>
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
    </script>
@endpush
