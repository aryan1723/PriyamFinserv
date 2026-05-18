@extends('layouts.public')

@section('title', 'Client Login | Priyam Finserv')

@section('content')
    <div class="auth-split">
        <!-- Left: Image Side -->
        <div class="auth-split-image">
            <h2 style="font-family: var(--font-serif); font-size: 2.2rem; margin-bottom: 1rem; line-height: 1.2; color: #fff;">Your Dedicated<br>Client Portal.</h2>
            <p style="font-size: 1rem; color: #a1a1aa; font-weight: 300; max-width: 380px; line-height: 1.7;">Securely manage your corporate files, track advisory progress, and communicate directly with our financial experts.</p>
            <div style="display: flex; gap: 2rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.15);">
                <div>
                    <p style="font-size: 1.4rem; font-weight: 700; color: #fff; font-family: var(--font-sans);">256-bit</p>
                    <p style="font-size: 0.75rem; color: #71717a; text-transform: uppercase; letter-spacing: 1px;">Encryption</p>
                </div>
                <div>
                    <p style="font-size: 1.4rem; font-weight: 700; color: #fff; font-family: var(--font-sans);">24/7</p>
                    <p style="font-size: 0.75rem; color: #71717a; text-transform: uppercase; letter-spacing: 1px;">Secure Access</p>
                </div>
            </div>
        </div>

        <!-- Right: Login Form -->
        <div class="auth-split-form">
            <div style="width: 100%; max-width: 400px;">
                <div style="margin-bottom: 2rem;">
                    <h1 style="font-size: 1.8rem; margin-bottom: 0.3rem;">Welcome Back</h1>
                    <p style="color: var(--text-muted); font-size: 0.92rem;">Sign in to continue to Priyam Finserv.</p>
                </div>

                @if(session('status'))
                    <div style="background: #f0fdf4; color: #166534; padding: 0.6rem 0.8rem; border-radius: var(--radius); margin-bottom: 1.5rem; border: 1px solid #bbf7d0; font-size: 0.85rem;">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 1.2rem;">
                    @csrf
                    
                    <div>
                        <label for="email" style="display: block; font-weight: 500; margin-bottom: 0.35rem; font-size: 0.85rem;">Email Address</label>
                        <div style="position: relative;">
                            <i class="fa-solid fa-envelope" style="position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%); color: #a1a1aa; font-size: 0.85rem;"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control" placeholder="name@company.com" style="padding: 0.7rem 0.85rem 0.7rem 2.5rem;">
                        </div>
                        @error('email')
                            <div style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem;"><i class="fa-solid fa-circle-exclamation" style="margin-right: 3px;"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password" style="display: block; font-weight: 500; margin-bottom: 0.35rem; font-size: 0.85rem;">Password</label>
                        <div style="position: relative;">
                            <i class="fa-solid fa-lock" style="position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%); color: #a1a1aa; font-size: 0.85rem;"></i>
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control" placeholder="••••••••" style="padding: 0.7rem 0.85rem 0.7rem 2.5rem;">
                        </div>
                        @error('password')
                            <div style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem;"><i class="fa-solid fa-circle-exclamation" style="margin-right: 3px;"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <label for="remember_me" style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input id="remember_me" type="checkbox" name="remember" style="cursor: pointer; width: 16px; height: 16px; accent-color: var(--primary-black);">
                        <span style="font-size: 0.85rem; color: var(--text-muted);">Remember me</span>
                    </label>

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-size: 0.85rem; margin-top: 0.5rem;">
                        Sign In <i class="fa-solid fa-arrow-right" style="font-size: 0.7rem;"></i>
                    </button>
                    
                    <p style="text-align: center; font-size: 0.88rem; color: var(--text-muted); margin-top: 0.5rem;">
                        Don't have an account? <a href="{{ route('register') }}" style="font-weight: 600; color: var(--primary-black);">Create one</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
