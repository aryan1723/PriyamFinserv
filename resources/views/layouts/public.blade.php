<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Priyam Finserv Private Limited - Premier financial consultancy and corporate advisory services.">
    <title>@yield('title', 'Priyam Finserv | Financial Consultancy')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header>
        @php
            $global_announcement = \App\Models\Announcement::where('is_active', true)->latest()->first();
        @endphp
        @if($global_announcement)
            <div class="announcement-bar">
                <i class="fa-solid fa-bullhorn" style="margin-right: 6px;"></i> {{ $global_announcement->message }}
            </div>
        @endif
        <div class="container">
            <nav class="navbar">
                <a href="{{ url('/') }}" class="brand">
                    <i class="fa-solid fa-gem"></i> Priyam Finserv
                </a>
                
                @if(Request::is('dashboard'))
                    <ul class="nav-links">
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline" style="padding: 0.45rem 1rem; font-size: 0.75rem;"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <ul class="nav-links">
                        <li><a href="{{ url('/') }}#services">Services</a></li>
                        <li><a href="{{ url('/') }}#about">About</a></li>
                        <li><a href="{{ url('/blog') }}">Insights</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <li><a href="{{ url('/admin') }}" class="btn btn-outline"><i class="fa-solid fa-shield-halved"></i> Admin</a></li>
                            @else
                                <li><a href="{{ url('/dashboard') }}" class="btn btn-outline"><i class="fa-solid fa-user"></i> Dashboard</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('login') }}" class="btn btn-primary" style="color: #ffffff;"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a></li>
                        @endauth
                    </ul>
                @endif
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3 style="font-family: var(--font-sans); font-size: 1rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 1.2rem;"><i class="fa-solid fa-gem" style="margin-right: 6px;"></i> Priyam Finserv</h3>
                    <p style="color: #a1a1aa; line-height: 1.8; font-size: 0.9rem;">Premier financial consultancy firm delivering strategic financial solutions and comprehensive corporate advisory services since 2020.</p>
                </div>
                <div>
                    <h4 style="margin-bottom: 1.2rem; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-family: var(--font-sans);">Navigate</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem;">
                        <li><a href="{{ url('/') }}#services" style="font-size: 0.9rem;">Our Services</a></li>
                        <li><a href="{{ url('/contact') }}" style="font-size: 0.9rem;">Book Appointment</a></li>
                        <li><a href="{{ url('/blog') }}" style="font-size: 0.9rem;">Financial Insights</a></li>
                        <li><a href="{{ route('login') }}" style="font-size: 0.9rem;">Client Portal</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="margin-bottom: 1.2rem; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-family: var(--font-sans);">Contact</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.8rem; color: #a1a1aa; font-size: 0.9rem;">
                        <li><i class="fa-solid fa-location-dot" style="margin-right: 8px; width: 14px; color: #52525b;"></i> H31/TF, Shivaji Park<br><span style="margin-left: 26px;">West Punjabi Bagh, Delhi 110026</span></li>
                        <li><a href="tel:9811073444"><i class="fa-solid fa-phone" style="margin-right: 8px; width: 14px; color: #52525b;"></i> 9811073444</a></li>
                        <li><a href="mailto:priyamfinserve@gmail.com"><i class="fa-solid fa-envelope" style="margin-right: 8px; width: 14px; color: #52525b;"></i> priyamfinserve@gmail.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Priyam Finserv Private Limited. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
