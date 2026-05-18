@extends('layouts.public')

@section('title', 'Book Appointment | Priyam Finserv')

@section('content')
    <section class="section page-top" style="padding-bottom: 0; background: var(--secondary-gray); min-height: calc(100vh - 60px);">
        <div class="container">
            <div style="max-width: 900px; margin: 0 auto;">
                
                <div style="text-align: center; margin-bottom: 3rem;">
                    <h1 style="font-size: 2.4rem; margin-bottom: 0.5rem;">Get in Touch</h1>
                    <p style="color: var(--text-muted); font-size: 1rem;">Experience personalized financial advisory. Connect with our experts today.</p>
                </div>

                @if(session('success'))
                    <div style="background: #f0fdf4; color: #166534; padding: 0.8rem 1.2rem; border-radius: var(--radius); margin-bottom: 2rem; border: 1px solid #bbf7d0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.6rem;">
                        <i class="fa-solid fa-circle-check" style="font-size: 1rem;"></i> 
                        <span style="font-weight: 500;">{{ session('success') }}</span>
                    </div>
                @endif

                <div style="display: grid; grid-template-columns: 5fr 3fr; gap: 1.5rem;">
                    <!-- Form -->
                    <div style="background: var(--bg-color); padding: 2.5rem; border-radius: var(--radius); border: 1px solid var(--border-color);">
                        <h2 style="font-size: 1.3rem; margin-bottom: 0.3rem;">Schedule an Appointment</h2>
                        <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 2rem;">Fill out the form below. Our team will get back to you within 24 hours.</p>

                        <form method="POST" action="{{ url('/contact') }}" style="display: flex; flex-direction: column; gap: 1.2rem;">
                            @csrf
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem;">
                                <div>
                                    <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Full Name *</label>
                                    <input type="text" name="name" class="form-control" placeholder="John Doe" required style="padding: 0.7rem 0.85rem;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Company <span style="color: var(--text-muted); font-weight: 400;">(Optional)</span></label>
                                    <input type="text" name="company_name" class="form-control" placeholder="Acme Corp" style="padding: 0.7rem 0.85rem;">
                                </div>
                            </div>

                            <div>
                                <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Email Address *</label>
                                <input type="email" name="email" class="form-control" placeholder="john@example.com" required style="padding: 0.7rem 0.85rem;">
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem;">
                                <div>
                                    <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Phone Number *</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required style="padding: 0.7rem 0.85rem;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">WhatsApp <span style="color: var(--text-muted); font-weight: 400;">(Optional)</span></label>
                                    <input type="tel" name="whatsapp" class="form-control" placeholder="+91 98765 43210" style="padding: 0.7rem 0.85rem;">
                                </div>
                            </div>

                            <div>
                                <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Your Requirement *</label>
                                <textarea name="requirement" rows="4" class="form-control" placeholder="Describe your financial advisory needs..." required style="resize: vertical; padding: 0.7rem 0.85rem;"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-size: 0.85rem; margin-top: 0.5rem;">
                                <i class="fa-solid fa-calendar-check" style="margin-right: 0.3rem;"></i> Submit Request
                            </button>
                        </form>
                    </div>

                    <!-- Contact Info Sidebar -->
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div style="background: var(--primary-black); color: #fff; padding: 2rem; border-radius: var(--radius);">
                            <h3 style="color: #fff; font-size: 1.15rem; margin-bottom: 1.5rem;">Contact Information</h3>
                            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                                <div style="display: flex; gap: 0.8rem; align-items: flex-start;">
                                    <div style="width: 32px; height: 32px; background: #27272a; border-radius: 6px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fa-solid fa-location-dot" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <div>
                                        <p style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.15rem;">Corporate Office</p>
                                        <p style="color: #a1a1aa; font-size: 0.82rem; line-height: 1.5;">H31/TF, Shivaji Park, West Punjabi Bagh, Delhi 110026</p>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 0.8rem; align-items: flex-start;">
                                    <div style="width: 32px; height: 32px; background: #27272a; border-radius: 6px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fa-solid fa-envelope" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <div>
                                        <p style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.15rem;">Email</p>
                                        <a href="mailto:priyamfinserve@gmail.com" style="color: #a1a1aa; font-size: 0.82rem;">priyamfinserve@gmail.com</a>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 0.8rem; align-items: flex-start;">
                                    <div style="width: 32px; height: 32px; background: #27272a; border-radius: 6px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fa-solid fa-phone" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <div>
                                        <p style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.15rem;">Direct Line</p>
                                        <a href="tel:+919811073444" style="color: #a1a1aa; font-size: 0.82rem;">+91 98110 73444</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="background: var(--bg-color); padding: 1.5rem; border-radius: var(--radius); border: 1px solid var(--border-color);">
                            <h4 style="font-size: 0.95rem; margin-bottom: 0.5rem; font-family: var(--font-sans); font-weight: 600;">Business Hours</h4>
                            <div style="display: flex; flex-direction: column; gap: 0.4rem; font-size: 0.85rem; color: var(--text-muted);">
                                <div style="display: flex; justify-content: space-between;">
                                    <span>Monday – Friday</span>
                                    <span style="font-weight: 500; color: var(--primary-black);">9:00 AM – 6:00 PM</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span>Saturday</span>
                                    <span style="font-weight: 500; color: var(--primary-black);">10:00 AM – 2:00 PM</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span>Sunday</span>
                                    <span style="font-weight: 500; color: var(--text-muted);">Closed</span>
                                </div>
                            </div>
                        </div>

                        <div style="background: var(--bg-color); padding: 1.5rem; border-radius: var(--radius); border: 1px solid var(--border-color); text-align: center;">
                            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.75rem;">Already a client?</p>
                            <a href="{{ route('login') }}" class="btn btn-outline" style="width: 100%; font-size: 0.75rem; padding: 0.5rem;">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Login to Dashboard
                            </a>
                        </div>
                    </div>
                </div>

                <div style="height: 3rem;"></div>
            </div>
        </div>
    </section>
@endsection
