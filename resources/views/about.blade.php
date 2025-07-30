{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title', trans_dynamic('page.about_us_title', app()->getLocale()))

@section('content')
<!-- Enhanced Page Header -->
<section class="page-header position-relative overflow-hidden">
    @php
        $aboutHeaderBg = \App\Models\SiteContent::getContent('page_headers', app()->getLocale())['about_us']['background_image'] ?? null;
    @endphp
    
    @if($aboutHeaderBg)
        <div class="page-header-bg" style="background-image: url('{{ $aboutHeaderBg }}')"></div>
        <div class="page-header-overlay"></div>
    @else
        <div class="page-header-gradient"></div>
    @endif
    
    <div class="container position-relative">
        <div class="row min-vh-60 align-items-center text-white">
            <div class="col-12 text-center py-5">
                <div class="page-header-content" data-aos="fade-up">
                    <h1 class="display-3 fw-bold mb-4">
                        {{ trans_dynamic('page.about_us', app()->getLocale()) }}
                    </h1>
                    <p class="lead fs-4 mb-0" data-aos="fade-up" data-aos-delay="200">
                        {{ trans_dynamic('page.about_us_desc', app()->getLocale()) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
</section>

<!-- About Us Section -->
<section class="about-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-10 mx-auto">
                @if(isset($data['about']))
                <div class="about-content-card" data-aos="fade-up">
                    <div class="content-header text-center mb-5">
                        <div class="section-badge mb-3">
                            <i class="fas fa-heart me-2"></i>{{ trans_dynamic('labels.our_story', app()->getLocale()) }}
                        </div>
                        <h2 class="display-5 fw-bold mb-4">
                            {{ $data['about']['title'] ?? trans_dynamic('section.about_us', app()->getLocale()) }}
                        </h2>
                    </div>
                    <div class="content-text-enhanced">
                        {!! $data['about']['content'] ?? trans_dynamic('content.about_us_placeholder', app()->getLocale()) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Vision Section -->
<section class="vision-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-10 mx-auto">
                @if(isset($data['vision']))
                <div class="vision-content-card" data-aos="fade-up">
                    <div class="content-header text-center mb-5">
                        <div class="section-badge vision-badge mb-3">
                            <i class="fas fa-eye me-2"></i>{{ trans_dynamic('labels.our_vision', app()->getLocale()) }}
                        </div>
                        <h2 class="display-5 fw-bold mb-4">
                            {{ $data['vision']['title'] ?? trans_dynamic('section.our_vision', app()->getLocale()) }}
                        </h2>
                    </div>
                    <div class="content-text-enhanced">
                        {!! $data['vision']['content'] ?? trans_dynamic('content.our_vision_placeholder', app()->getLocale()) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Contact Section -->
<section class="contact-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="contact-content text-center" data-aos="fade-up">
                    <div class="content-header mb-5">
                        <div class="section-badge contact-badge mb-3">
                            <i class="fas fa-phone-alt me-2"></i>{{ trans_dynamic('labels.get_in_touch', app()->getLocale()) }}
                        </div>
                        <h2 class="display-5 fw-bold mb-4">
                            {{ $data['contact']['title'] ?? trans_dynamic('section.contact_us', app()->getLocale()) }}
                        </h2>
                        <p class="lead text-muted">{{ trans_dynamic('contact.subtitle', app()->getLocale()) }}</p>
                    </div>
                    
                    <div class="row g-4">
                        @if(isset($data['contact']['phone']))
                        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="contact-item-enhanced h-100">
                                <div class="contact-icon-wrapper">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <h5 class="contact-title">{{ trans_dynamic('contact.phone', app()->getLocale()) }}</h5>
                                <p class="contact-description mb-3">{{ trans_dynamic('contact.phone_desc', app()->getLocale()) }}</p>
                                <a href="tel:{{ $data['contact']['phone'] }}" class="contact-link">
                                    {{ $data['contact']['phone'] }}
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        @if(isset($data['contact']['whatsapp']))
                        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="contact-item-enhanced h-100">
                                <div class="contact-icon-wrapper whatsapp">
                                    <div class="contact-icon">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                </div>
                                <h5 class="contact-title">{{ trans_dynamic('contact.whatsapp', app()->getLocale()) }}</h5>
                                <p class="contact-description mb-3">{{ trans_dynamic('contact.whatsapp_desc', app()->getLocale()) }}</p>
                                <a href="https://wa.me/{{ $data['contact']['whatsapp'] }}" class="contact-link" target="_blank">
                                    {{ $data['contact']['whatsapp'] }}
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        @if(isset($data['contact']['email']))
                        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="contact-item-enhanced h-100">
                                <div class="contact-icon-wrapper email">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <h5 class="contact-title">{{ trans_dynamic('contact.email', app()->getLocale()) }}</h5>
                                <p class="contact-description mb-3">{{ trans_dynamic('contact.email_desc', app()->getLocale()) }}</p>
                                <a href="mailto:{{ $data['contact']['email'] }}" class="contact-link">
                                    {{ $data['contact']['email'] }}
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        @if(isset($data['contact']['address']))
                        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="contact-item-enhanced h-100">
                                <div class="contact-icon-wrapper address">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <h5 class="contact-title">{{ trans_dynamic('contact.address', app()->getLocale()) }}</h5>
                                <p class="contact-description mb-3">{{ trans_dynamic('contact.visit_us', app()->getLocale()) }}</p>
                                <div class="contact-text">{{ $data['contact']['address'] }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
