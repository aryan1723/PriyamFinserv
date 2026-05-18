@extends('layouts.public')

@section('title', 'Priyam Finserv | Financial Excellence & Precision')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <p style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 3px; color: #71717a; margin-bottom: 1.5rem; font-weight: 500;">Financial Advisory & Consultancy</p>
                <h1>Precision in<br>Every Decision.</h1>
                <p>Empowering businesses with sustainable growth and regulatory clarity through decades of institutional expertise.</p>
                <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    <a href="{{ url('/contact') }}" class="btn btn-primary">Book Appointment <i class="fa-solid fa-arrow-right" style="font-size: 0.7rem;"></i></a>
                    <a href="#services" class="btn btn-outline">Our Services</a>
                </div>

                <div class="stats-bar">
                    <div class="stat-item">
                        <h3>20+</h3>
                        <p>Years Experience</p>
                    </div>
                    <div class="stat-item">
                        <h3>500+</h3>
                        <p>Clients Served</p>
                    </div>
                    <div class="stat-item">
                        <h3>₹100Cr+</h3>
                        <p>Loans Processed</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section">
        <div class="container">
            <h2 class="section-title">Core Services</h2>
            <p class="section-subtitle">Comprehensive financial solutions tailored for emerging startups and established corporate houses.</p>
            <div class="grid">
                <div class="card">
                    <div class="card-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <h3>Financial Consultancy</h3>
                    <p>Strategic planning, capital budgeting, and financial health assessments tailored to your corporate needs.</p>
                </div>
                <div class="card">
                    <div class="card-icon"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                    <h3>Corporate Due Diligence</h3>
                    <p>In-depth analysis and investigation to support mergers, acquisitions, and critical investment decisions.</p>
                </div>
                <div class="card">
                    <div class="card-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <h3>Risk Advisory</h3>
                    <p>Identifying and mitigating financial risks to ensure long-term business stability and regulatory compliance.</p>
                </div>
            </div>
            
            <div style="margin-top: 4rem;">
                <h3 style="text-align: center; margin-bottom: 2rem; font-size: 1.4rem;">Comprehensive Solutions</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; justify-content: center;">
                    @php
                        $services = [
                            ['icon' => 'fa-building', 'label' => 'Loan Against Property'],
                            ['icon' => 'fa-house', 'label' => 'Home Loans'],
                            ['icon' => 'fa-tags', 'label' => 'Rental Discounting'],
                            ['icon' => 'fa-credit-card', 'label' => 'Commercial Credit Limits'],
                            ['icon' => 'fa-coins', 'label' => 'Working Capitals'],
                            ['icon' => 'fa-money-bill-trend-up', 'label' => 'Project Funding'],
                            ['icon' => 'fa-handshake', 'label' => 'ECB & Liaisoning'],
                        ];
                    @endphp
                    @foreach($services as $s)
                        <a href="{{ url('/contact') }}" style="padding: 0.6rem 1.2rem; border: 1px solid var(--border-color); border-radius: 100px; font-weight: 500; font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem; color: var(--text-muted); transition: var(--transition); text-decoration: none;">
                            <i class="fa-solid {{ $s['icon'] }}" style="font-size: 0.8rem;"></i> {{ $s['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section" style="background-color: var(--secondary-gray);">
        <div class="container">
            <div style="max-width: 900px; margin: 0 auto;">
                <h2 class="section-title">About Priyam Finserv</h2>
                <p class="section-subtitle">Established in November 2020, founded on the principles of integrity, precision, and financial excellence.</p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
                    <div style="background: var(--bg-color); padding: 2rem; border: 1px solid var(--border-color); border-radius: var(--radius);">
                        <div style="width: 40px; height: 40px; background: var(--primary-black); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
                            <i class="fa-solid fa-user-tie" style="color: #fff; font-size: 0.9rem;"></i>
                        </div>
                        <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem;">Leadership</h3>
                        <p style="color: var(--primary-black); margin-bottom: 0.5rem; font-weight: 600; font-size: 0.95rem;">Priyam Sahil Chowdhary</p>
                        <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6;">Over 20 years of high-level expertise in finance and corporate due diligence, ensuring every client benefits from decades of institutional knowledge.</p>
                    </div>
                    <div style="background: var(--bg-color); padding: 2rem; border: 1px solid var(--border-color); border-radius: var(--radius);">
                        <div style="width: 40px; height: 40px; background: var(--primary-black); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
                            <i class="fa-solid fa-scale-balanced" style="color: #fff; font-size: 0.9rem;"></i>
                        </div>
                        <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem;">Our Philosophy</h3>
                        <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; margin-top: 0.5rem;">Financial clarity is the bedrock of corporate success. We blend experience with a forward-looking perspective to deliver tailored solutions for modern enterprises.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section section-gap" style="background-color: var(--primary-black); text-align: center;">
        <div class="container">
            <h2 style="font-family: var(--font-serif); font-size: 2.2rem; margin-bottom: 1rem; color: #fff;">Ready to Secure Your Financial Future?</h2>
            <p style="margin-bottom: 2rem; color: #a1a1aa; font-size: 1rem; max-width: 500px; margin-left: auto; margin-right: auto;">Schedule a consultation with our experts today and discover how we can help your business thrive.</p>
            <a href="{{ url('/contact') }}" class="btn" style="background: #fff; color: var(--primary-black); border-color: #fff;">Book a Consultation <i class="fa-solid fa-arrow-right" style="font-size: 0.7rem;"></i></a>
        </div>
    </section>
@endsection
