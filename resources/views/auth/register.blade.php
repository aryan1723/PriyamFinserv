@extends('layouts.public')

@section('title', 'Client Registration | Priyam Finserv')

@section('content')
    <div class="auth-split">
        <!-- Left: Image Side -->
        <div class="auth-split-image">
            <h2 style="font-family: var(--font-serif); font-size: 2.2rem; margin-bottom: 1rem; line-height: 1.2; color: #fff;">Start Your<br>Financial Journey.</h2>
            <p style="font-size: 1rem; color: #a1a1aa; font-weight: 300; max-width: 380px; line-height: 1.7;">Join our client portal for personalized advisory, secure document sharing, and direct access to our expert financial consultants.</p>
            <div style="display: flex; gap: 2rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.15);">
                <div>
                    <p style="font-size: 1.4rem; font-weight: 700; color: #fff; font-family: var(--font-sans);">500+</p>
                    <p style="font-size: 0.75rem; color: #71717a; text-transform: uppercase; letter-spacing: 1px;">Clients Trust Us</p>
                </div>
                <div>
                    <p style="font-size: 1.4rem; font-weight: 700; color: #fff; font-family: var(--font-sans);">20+</p>
                    <p style="font-size: 0.75rem; color: #71717a; text-transform: uppercase; letter-spacing: 1px;">Years of Service</p>
                </div>
            </div>
        </div>

        <!-- Right: Registration Form -->
        <div class="auth-split-form">
            <div style="width: 100%; max-width: 400px;">
                <div style="margin-bottom: 2rem;">
                    <h1 style="font-size: 1.8rem; margin-bottom: 0.3rem;">Create Account</h1>
                    <p style="color: var(--text-muted); font-size: 0.92rem;">Register for your secure client portal.</p>
                </div>
                
                <form method="POST" action="{{ route('register') }}" style="display: flex; flex-direction: column; gap: 1.2rem;">
                    @csrf

                    <div>
                        <label for="name" style="display: block; font-weight: 500; margin-bottom: 0.35rem; font-size: 0.85rem;">Full Name</label>
                        <div style="position: relative;">
                            <i class="fa-solid fa-user" style="position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%); color: #a1a1aa; font-size: 0.85rem;"></i>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="form-control" placeholder="John Doe" style="padding: 0.7rem 0.85rem 0.7rem 2.5rem;">
                        </div>
                        @error('name')
                            <div style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" style="display: block; font-weight: 500; margin-bottom: 0.35rem; font-size: 0.85rem;">Email Address</label>
                        <div style="position: relative;">
                            <i class="fa-solid fa-envelope" style="position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%); color: #a1a1aa; font-size: 0.85rem;"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="form-control" placeholder="name@company.com" style="padding: 0.7rem 0.85rem 0.7rem 2.5rem;">
                        </div>
                        @error('email')
                            <div style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password" style="display: block; font-weight: 500; margin-bottom: 0.35rem; font-size: 0.85rem;">Password</label>
                        <div style="position: relative;">
                            <i class="fa-solid fa-lock" style="position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%); color: #a1a1aa; font-size: 0.85rem;"></i>
                            <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control" placeholder="••••••••" style="padding: 0.7rem 0.85rem 0.7rem 2.5rem;">
                        </div>
                        @error('password')
                            <div style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" style="display: block; font-weight: 500; margin-bottom: 0.35rem; font-size: 0.85rem;">Confirm Password</label>
                        <div style="position: relative;">
                            <i class="fa-solid fa-shield-halved" style="position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%); color: #a1a1aa; font-size: 0.85rem;"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control" placeholder="••••••••" style="padding: 0.7rem 0.85rem 0.7rem 2.5rem;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-size: 0.85rem; margin-top: 0.5rem;">
                        Create Account <i class="fa-solid fa-arrow-right" style="font-size: 0.7rem;"></i>
                    </button>
                    
                    <p style="text-align: center; font-size: 0.88rem; color: var(--text-muted); margin-top: 0.5rem;">
                        Already have an account? <a href="{{ route('login') }}" style="font-weight: 600; color: var(--primary-black);">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
