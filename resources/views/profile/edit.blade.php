@extends('layouts.public')

@section('title', 'Account Settings | Priyam Finserv')

@section('content')
    <div class="dash-container">
        <div class="dash-header">
            <div class="dash-greeting">
                <h1 style="font-size: 1.5rem;">Account Settings</h1>
                <p>Manage your profile and security preferences.</p>
            </div>
            <div class="dash-actions">
                <a href="{{ url('/dashboard') }}" class="btn btn-outline" style="font-size: 0.75rem; padding: 0.6rem 1.2rem;">
                    <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>

        @if(session('status') === 'profile-updated')
            <div style="background: #f0fdf4; color: #166534; padding: 0.75rem 1rem; border-radius: var(--radius); margin-bottom: 1.5rem; border: 1px solid #bbf7d0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-circle-check"></i> Profile updated successfully.
            </div>
        @endif

        @if(session('status') === 'password-updated')
            <div style="background: #f0fdf4; color: #166534; padding: 0.75rem 1rem; border-radius: var(--radius); margin-bottom: 1.5rem; border: 1px solid #bbf7d0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-circle-check"></i> Password updated successfully.
            </div>
        @endif

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <!-- Profile Information -->
            <div class="dash-card" style="padding: 2rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.3rem;">Profile Information</h3>
                <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 1.5rem;">Update your name and email address.</p>

                <form method="post" action="{{ route('profile.update') }}" style="display: flex; flex-direction: column; gap: 1rem;">
                    @csrf
                    @method('patch')

                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required style="padding: 0.7rem 0.85rem;">
                        @error('name')
                            <div style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required style="padding: 0.7rem 0.85rem;">
                        @error('email')
                            <div style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" style="align-self: flex-start; font-size: 0.75rem; padding: 0.55rem 1.2rem;">
                        <i class="fa-solid fa-save"></i> Save Changes
                    </button>
                </form>
            </div>

            <!-- Update Password -->
            <div class="dash-card" style="padding: 2rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.3rem;">Update Password</h3>
                <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 1.5rem;">Use a strong, unique password to protect your account.</p>

                <form method="post" action="{{ route('password.update') }}" style="display: flex; flex-direction: column; gap: 1rem;">
                    @csrf
                    @method('put')

                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Current Password</label>
                        <input type="password" name="current_password" class="form-control" autocomplete="current-password" style="padding: 0.7rem 0.85rem;">
                        @error('current_password', 'updatePassword')
                            <div style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">New Password</label>
                        <input type="password" name="password" class="form-control" autocomplete="new-password" style="padding: 0.7rem 0.85rem;">
                        @error('password', 'updatePassword')
                            <div style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password" style="padding: 0.7rem 0.85rem;">
                        @error('password_confirmation', 'updatePassword')
                            <div style="color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" style="align-self: flex-start; font-size: 0.75rem; padding: 0.55rem 1.2rem;">
                        <i class="fa-solid fa-lock"></i> Update Password
                    </button>
                </form>
            </div>
        </div>

        <div style="height: 3rem;"></div>
    </div>
@endsection
