{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', trans_dynamic('site.title', app()->getLocale()))</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    @if(app()->getLocale() === 'ar')
        <link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
    @endif

    <!-- Language Switcher Styles -->
    <style>
        .language-switcher {
            background: linear-gradient(135deg, rgba(var(--primary-color-rgb), 0.1), rgba(var(--primary-color-rgb), 0.1));
            border: 2px solid rgba(var(--primary-color-rgb), 0.2);
            border-radius: 25px;
            padding: 0.5rem 1rem;
            margin: 0.3rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }
        
        .language-switcher:hover {
            background: linear-gradient(135deg, rgba(var(--primary-color-rgb), 0.15), rgba(var(--primary-color-rgb), 0.15));
        border-color: rgba(var(--primary-color-rgb), 0.4);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(var(--primary-color-rgb), 0.2);
            text-decoration: none;
        }
        
        .language-switcher:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(var(--bs-primary-rgb), 0.25);
        }
        
        .current-lang {
             color: #2f9319;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .lang-separator {
            width: 1px;
            height: 20px;
            background: linear-gradient(to bottom, transparent, rgba(var(--bs-primary-rgb), 0.3), transparent);
            opacity: 0.6;
        }
        
        .other-lang {
            color: #6c757d;
            font-weight: 400;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .language-switcher:hover .other-lang {
            color: var(--primary-color);
        }
        
        .lang-flag {
            font-size: 1.1rem;
            filter: grayscale(0);
            transition: all 0.3s ease;
        }
        
        .other-lang .lang-flag {
            filter: grayscale(0.5);
            opacity: 0.7;
        }
        
        .language-switcher:hover .other-lang .lang-flag {
            filter: grayscale(0);
            opacity: 1;
        }
        
        .switch-arrow {
            color: var(--primary-color);
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }
        
        .language-switcher:hover .switch-arrow {
            transform: translateX(2px);
        }
        
        /* Mobile responsive */
        @media (max-width: 991.98px) {
            .language-switcher {
                width: 100%;
                justify-content: center;
                margin-top: 0.5rem;
                padding: 0.2rem 0.5rem;
            }
        }
        
        /* RTL support */
        [dir="rtl"] .language-switcher:hover .switch-arrow {
            transform: translateX(-2px);
        }
        
        /* Animation for language switch */
        .lang-switch-animation {
            position: relative;
        }
        
        .lang-switch-animation::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }
        
        .language-switcher:hover.lang-switch-animation::before {
            left: 100%;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header fixed-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <!-- Dynamic Logo -->
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    @php
                        $logoData = \App\Models\SiteContent::getContent('site_logo', app()->getLocale());
                    @endphp
                    
                    @if($logoData && !empty($logoData['logo_url']))
                        <img src="{{ $logoData['logo_url'] }}" alt="{{ $logoData['alt_text'] ?? 'Logo' }}" height="40" class="me-2 site-logo">
                    @else
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="me-2 site-logo">
                    @endif
                    <span class="site-name text-brand">{{ trans_dynamic('site.name', app()->getLocale()) }}</span>
                </a>

                <!-- Mobile Toggle -->
                
                <button class="navbar-toggler p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">   
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                {{ trans_dynamic('nav.home', app()->getLocale()) }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('media') ? 'active' : '' }}" href="{{ route('media') }}">
                                {{ trans_dynamic('nav.media_gallery', app()->getLocale()) }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('stories.index') ? 'active' : '' }}" href="{{ route('stories.index') }}">
                                {{ trans_dynamic('nav.stories', app()->getLocale()) }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                                {{ trans_dynamic('nav.about_us', app()->getLocale()) }}
                            </a>
                        </li>
                        
                        <!-- Language Switcher Toggle -->
                        <li class="nav-item ">
                            @php
                                $currentLang = app()->getLocale();
                                $otherLang = $currentLang === 'ar' ? 'en' : 'ar';
                                $currentLangName = $currentLang === 'ar' ? 'العربية' : 'English';
                                $otherLangName = $otherLang === 'ar' ? 'العربية' : 'English';
                            @endphp
                            
                            <a href="{{ route('lang.switch', $otherLang) }}" 
                               class="language-switcher lang-switch-animation"
                               title="{{ app()->getLocale() === 'en' ? 'Switch To' : 'غير إلى' }} {{ $otherLangName }}">
                                <!-- Current Language -->
                                <div class="current-lang">
                                    <span>{{ $currentLangName }}</span>
                                </div>
                                
                                <!-- Separator -->
                                <div class="lang-separator"></div>
                                
                                <!-- Switch Arrow -->
                                <i class="fas fa-exchange-alt switch-arrow"></i>
                                
                                <!-- Other Language -->
                                <div class="other-lang">
                                    <span>{{ $otherLangName }}</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>{{ trans_dynamic('site.name', app()->getLocale()) }}</h5>
                    <p class="text-muted">{{ trans_dynamic('site.description', app()->getLocale()) }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links">
                        @foreach(\App\Models\SocialIcon::getActive() as $social)
                            <a href="{{ $social->url }}" class="text-white me-3" target="_blank" 
                               style="color: {{ $social->color }} !important;">
                                <i class="{{ $social->icon_class }}" title="{{ $social->name }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr class="my-1">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} {{ trans_dynamic('footer.rights', app()->getLocale()) }}</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // Add smooth transition effect on language switch
        document.addEventListener('DOMContentLoaded', function() {
            const languageSwitcher = document.querySelector('.language-switcher');
            
            if (languageSwitcher) {
                languageSwitcher.addEventListener('click', function(e) {
                    // Add loading state
                    this.style.opacity = '0.7';
                    this.style.transform = 'scale(0.98)';
                    
                    // Optional: Add a small delay for visual feedback
                    setTimeout(() => {
                        // Navigation will proceed automatically
                    }, 150);
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
