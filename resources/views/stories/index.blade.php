{{-- resources/views/stories/index.blade.php --}}
@extends('layouts.app')

@section('title', trans_dynamic('page.stories_title', app()->getLocale()))

@section('content')
    <!-- Stories Header -->


    <section class="page-header position-relative overflow-hidden">
        @php
            $mediaHeaderBg =
                \App\Models\SiteContent::getContent('page_headers', app()->getLocale())['media_gallery'][
                    'background_image'
                ] ?? null;
        @endphp

        @if ($mediaHeaderBg)
            <div class="page-header-bg" style="background-image: url('{{ $mediaHeaderBg }}')"></div>
            <div class="page-header-overlay"></div>
        @else
            <div class="page-header-gradient"></div>
        @endif

        <div class="container position-relative">
            <div class="row min-vh-50 align-items-center text-white">
                <div class="col-12 text-center py-5">
                    <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">
                        {{ trans_dynamic('page.stories', app()->getLocale()) }}
                    </h1>
                    <p class="lead" data-aos="fade-up" data-aos-delay="200">
                        {{ trans_dynamic('page.stories_desc', app()->getLocale()) }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stories Content -->
    <section class="stories-content py-5">
        <div class="container">


            <div class="row">
                @forelse($stories as $story)
                    <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
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
                            <div class="story-content p-3">
                                <h5 class="story-title text-gray-900 mb-3">{{ $story->getTitle(app()->getLocale()) }}</h5>
                                <p class="story-excerpt text-muted mb-4">{{ $story->getExcerpt(app()->getLocale(), 120) }}
                                </p>
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
                                        onmouseover="this.style.backgroundColor='#267b15'; this.style.color='white';"
                                        onmouseout="this.style.backgroundColor='#2f9319'; this.style.color='white';">
                                        <i class="fas fa-book-open"></i>
                                        {{ trans_dynamic('button.read_story', app()->getLocale()) }}
                                    </a>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ ceil(str_word_count(strip_tags($story->getContent(app()->getLocale()))) / 200) }}
                                        {{ app()->getLocale() === 'en' ? 'min read' : 'دقيقة للقراءة' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-book fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">{{ trans_dynamic('messages.no_stories', app()->getLocale()) }}</h4>
                            <p class="text-muted">{{ trans_dynamic('messages.check_back_later', app()->getLocale()) }}</p>
                            <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                                <i
                                    class="fas fa-home me-2"></i>{{ trans_dynamic('button.back_to_home', app()->getLocale()) }}
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $stories->links() }}
            </div>
        </div>
    </section>
@endsection
