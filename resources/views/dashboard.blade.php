@extends('layouts.public')

@section('title', 'Dashboard | Priyam Finserv')

@section('content')
    <div class="dash-container">
        <div class="dash-header">
            <div class="dash-greeting">
                <h1>Good {{ date('H') < 12 ? 'Morning' : (date('H') < 17 ? 'Afternoon' : 'Evening') }}, {{ Auth::user()->name }}</h1>
                <p>{{ date('l, F j, Y') }}</p>
            </div>
            <div class="dash-actions">
                <button class="btn btn-primary" onclick="document.getElementById('queryModal').style.display='flex'" style="font-size: 0.75rem; padding: 0.6rem 1.2rem;">
                    <i class="fa-solid fa-plus"></i> New Request
                </button>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline" style="font-size: 0.75rem; padding: 0.6rem 1.2rem;">
                    <i class="fa-solid fa-gear"></i> Settings
                </a>
            </div>
        </div>

        @if(session('success'))
            <div style="background: #f0fdf4; color: #166534; padding: 0.75rem 1rem; border-radius: var(--radius); margin-bottom: 1.5rem; border: 1px solid #bbf7d0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Tabs -->
        <div class="dash-tabs">
            <button class="dash-tab active" onclick="showTab('queries')"><i class="fa-solid fa-clipboard-list" style="margin-right: 0.4rem; font-size: 0.8rem;"></i> Queries & Appointments</button>
            <button class="dash-tab" onclick="showTab('files')"><i class="fa-solid fa-file-shield" style="margin-right: 0.4rem; font-size: 0.8rem;"></i> Documents</button>
        </div>

        <!-- Queries Tab -->
        <div id="tab-queries">
            @if($queries->count() > 0)
                @foreach($queries as $query)
                    <div class="dash-card">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                            <div style="flex: 1;">
                                <p style="font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem; color: var(--primary-black);">{{ $query->requirement }}</p>
                                <span style="font-size: 0.8rem; color: var(--text-muted);"><i class="fa-regular fa-clock" style="margin-right: 3px;"></i> {{ $query->created_at->format('M d, Y') }}</span>
                            </div>
                            <span class="status-badge {{ $query->status === 'resolved' ? 'status-resolved' : 'status-pending' }}">
                                {{ ucfirst($query->status) }}
                            </span>
                        </div>
                        
                        @if($query->admin_response)
                            <div style="background: var(--secondary-gray); padding: 0.75rem 1rem; border-left: 3px solid var(--primary-black); border-radius: 0 var(--radius) var(--radius) 0; margin-top: 0.75rem;">
                                <p style="font-size: 0.8rem; font-weight: 600; color: var(--primary-black); margin-bottom: 0.3rem;">Priyam Finserv</p>
                                <p style="font-size: 0.88rem; color: #3f3f46;">{{ $query->admin_response }}</p>
                                @if($query->appointment_date)
                                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem;"><i class="fa-regular fa-calendar-check" style="margin-right: 3px;"></i> Appointment: {{ \Carbon\Carbon::parse($query->appointment_date)->format('M d, Y g:i A') }}</p>
                                @endif
                            </div>
                        @else
                            <p style="font-size: 0.85rem; color: var(--text-muted); font-style: italic; margin-top: 0.75rem;"><i class="fa-solid fa-clock" style="margin-right: 4px; font-size: 0.75rem;"></i> Awaiting response from our team.</p>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="dash-empty">
                    <i class="fa-regular fa-folder-open"></i>
                    <p>No queries or appointment requests yet.</p>
                    <button class="btn btn-outline" onclick="document.getElementById('queryModal').style.display='flex'" style="margin-top: 1rem; font-size: 0.75rem; padding: 0.5rem 1rem;">
                        <i class="fa-solid fa-plus"></i> Submit Your First Request
                    </button>
                </div>
            @endif
        </div>

        <!-- Files Tab -->
        <div id="tab-files" style="display: none;">
            <div class="dash-card" style="border-style: dashed; display: flex; align-items: center; gap: 1rem;">
                <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data" style="display: flex; gap: 0.75rem; align-items: center; width: 100%;">
                    @csrf
                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 1.3rem; color: var(--text-muted);"></i>
                    <input type="file" name="file" required class="form-control" style="padding: 0.4rem 0.6rem; font-size: 0.85rem; flex-grow: 1; border: none; background: transparent;">
                    <button type="submit" class="btn btn-primary" style="padding: 0.45rem 1rem; font-size: 0.75rem; white-space: nowrap;"><i class="fa-solid fa-upload"></i> Upload</button>
                </form>
            </div>
            
            @if($files->count() > 0)
                @foreach($files as $file)
                    <div class="dash-card" style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 36px; height: 36px; background: var(--secondary-gray); border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; color: var(--text-muted);">
                                <i class="fa-regular fa-file"></i>
                            </div>
                            <div>
                                <p style="font-weight: 600; font-size: 0.9rem;">{{ Str::limit($file->file_name, 35) }}</p>
                                <p style="font-size: 0.78rem; color: var(--text-muted);">{{ $file->created_at->format('M d, Y') }} · {{ ucfirst($file->uploaded_by ?? 'Admin') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('file.download', $file->id) }}" class="btn btn-outline" style="padding: 0.35rem 0.7rem; font-size: 0.7rem;"><i class="fa-solid fa-download"></i></a>
                    </div>
                @endforeach
            @else
                <div class="dash-empty">
                    <i class="fa-solid fa-file-shield"></i>
                    <p>No documents shared yet.</p>
                </div>
            @endif
        </div>

        <div style="height: 3rem;"></div>
    </div>

    <!-- New Request Modal -->
    <div id="queryModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(6px); z-index: 2000; align-items: center; justify-content: center;">
        <div style="background: var(--bg-color); width: 100%; max-width: 460px; border-radius: 12px; padding: 2rem; position: relative; margin: 1rem; animation: fadeInUp 0.3s ease-out;">
            <button onclick="document.getElementById('queryModal').style.display='none'" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--text-muted);"><i class="fa-solid fa-xmark"></i></button>
            <h2 style="font-size: 1.3rem; margin-bottom: 0.3rem;">New Request</h2>
            <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 1.5rem;">Submit a query or schedule a meeting with our team.</p>
            
            <form action="{{ url('/contact') }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf
                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Company Name <span style="color: var(--text-muted); font-weight: 400;">(Optional)</span></label>
                    <input type="text" name="company_name" class="form-control" placeholder="Acme Corp" style="padding: 0.65rem 0.8rem;">
                </div>
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.3rem; font-size: 0.85rem;">Your Requirement *</label>
                    <textarea name="requirement" rows="4" class="form-control" required placeholder="Describe your financial needs..." style="resize: vertical; padding: 0.65rem 0.8rem;"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 0.5rem;"><i class="fa-solid fa-paper-plane"></i> Submit Request</button>
            </form>
        </div>
    </div>

    <script>
        function showTab(tab) {
            document.getElementById('tab-queries').style.display = tab === 'queries' ? 'block' : 'none';
            document.getElementById('tab-files').style.display = tab === 'files' ? 'block' : 'none';
            document.querySelectorAll('.dash-tab').forEach(function(t, i) {
                t.classList.toggle('active', (i === 0 && tab === 'queries') || (i === 1 && tab === 'files'));
            });
        }
    </script>
@endsection
