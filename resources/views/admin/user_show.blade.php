@extends('admin.layout')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 1.8rem; color: var(--primary);">Client Profile: {{ $user->name }}</h1>
        <div>
            <a href="{{ route('admin.users') }}" class="btn btn-outline" style="margin-right: 1rem;"><i class="fa-solid fa-arrow-left"></i> Back to Directory</a>
            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline;" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline" style="color: #dc3545; border-color: #dc3545;"><i class="fa-solid fa-trash"></i> Delete Client</button>
            </form>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2.5rem; align-items: start;">
        
        <!-- Left Side: Client Info & Schedule Form -->
        <div style="display: flex; flex-direction: column; gap: 2.5rem;">
            <div class="card" style="margin-bottom: 0;">
                <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem;">
                    <div style="width: 80px; height: 80px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-family: var(--font-serif);">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 style="font-size: 1.5rem; margin-bottom: 0.2rem;">{{ $user->name }}</h2>
                        <p style="color: #888;"><i class="fa-regular fa-envelope"></i> {{ $user->email }}</p>
                        <p style="color: #888; font-size: 0.85rem;"><i class="fa-regular fa-calendar"></i> Client since {{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 2rem;">
                
                <h3 style="font-size: 1.1rem; margin-bottom: 1rem;"><i class="fa-solid fa-user-pen" style="margin-right: 0.5rem;"></i> Edit Details</h3>
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label>Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label>Email Address</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-outline" style="width: 100%;"><i class="fa-solid fa-save"></i> Save Changes</button>
                </form>
            </div>

            <div class="card" style="margin-bottom: 0;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.2rem;"><i class="fa-solid fa-calendar-plus" style="margin-right: 0.5rem;"></i> Schedule Appointment</h3>
                <form action="{{ route('admin.users.appointment', $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="requirement">Appointment Details / Notes</label>
                        <textarea name="requirement" id="requirement" class="form-control" rows="3" placeholder="E.g., Quarterly financial review scheduled for Friday..." required style="resize: vertical;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="admin_response">Admin Resolution (Optional)</label>
                        <textarea name="admin_response" id="admin_response" class="form-control" rows="2" placeholder="Leave blank to keep status pending..." style="resize: vertical;"></textarea>
                        <small style="color: #888;">If you add a response, the appointment query will be marked as resolved.</small>
                    </div>
                    <div class="form-group">
                        <label for="appointment_date">Formal Appointment Date & Time (Optional)</label>
                        <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control">
                    </div>
                    <button type="submit" class="btn" style="width: 100%;"><i class="fa-solid fa-calendar-check"></i> Create Appointment</button>
                </form>
            </div>
            
            <div class="card" style="margin-bottom: 0;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.2rem;"><i class="fa-solid fa-cloud-arrow-up" style="margin-right: 0.5rem;"></i> Share File with Client</h3>
                <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="form-group">
                        <label for="file">Select File</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn" style="width: 100%;"><i class="fa-solid fa-upload"></i> Share File</button>
                </form>
            </div>
        </div>

        <!-- Right Side: Queries & Files -->
        <div style="display: flex; flex-direction: column; gap: 2.5rem;">
            
            <div class="card" style="margin-bottom: 0; padding: 0;">
                <div class="card-header" style="padding: 1.5rem 2rem 0; margin-bottom: 1rem;">
                    <h3 style="font-size: 1.2rem;">Client's Queries & Appointments</h3>
                </div>
                <div style="overflow-x: auto;">
                    <table style="margin-top: 0;">
                        <thead>
                            <tr>
                                <th style="padding: 1rem 2rem;">Details</th>
                                <th style="padding: 1rem 2rem; width: 120px;">Status</th>
                                <th style="padding: 1rem 2rem; width: 150px;">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($queries as $query)
                                <tr>
                                    <td style="padding: 1.5rem 2rem;">
                                        <p style="color: #444; margin-bottom: 0.8rem; font-size: 0.95rem;">{{ $query->requirement }}</p>
                                        @if($query->admin_response)
                                            <div style="background: #fafafa; padding: 0.8rem; border-left: 3px solid var(--primary); font-size: 0.85rem; color: #666;">
                                                <strong>Admin:</strong> {{ $query->admin_response }}
                                            </div>
                                        @endif
                                    </td>
                                    <td style="padding: 1.5rem 2rem;">
                                        <span class="badge {{ $query->status === 'resolved' ? 'badge-resolved' : 'badge-pending' }}">
                                            {{ ucfirst($query->status) }}
                                        </span>
                                    </td>
                                    <td style="padding: 1.5rem 2rem; color: #666; font-size: 0.85rem;">
                                        {{ $query->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; padding: 2rem; color: #888;">No queries found for this client.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card" style="margin-bottom: 0; padding: 0;">
                <div class="card-header" style="padding: 1.5rem 2rem 0; margin-bottom: 1rem;">
                    <h3 style="font-size: 1.2rem;">Shared Documents</h3>
                </div>
                <div style="overflow-x: auto;">
                    <table style="margin-top: 0;">
                        <thead>
                            <tr>
                                <th style="padding: 1rem 2rem;">File Name</th>
                                <th style="padding: 1rem 2rem; width: 150px;">Uploaded By</th>
                                <th style="padding: 1rem 2rem; width: 150px;">Date</th>
                                <th style="padding: 1rem 2rem; width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($files as $file)
                                <tr>
                                    <td style="padding: 1.5rem 2rem;">
                                        <strong style="color: #222;">{{ $file->file_name }}</strong>
                                    </td>
                                    <td style="padding: 1.5rem 2rem; color: #555; font-size: 0.9rem;">
                                        <span style="display: inline-block; padding: 0.2rem 0.6rem; border-radius: 4px; background: {{ $file->uploaded_by === 'client' ? '#e3f2fd' : '#f5f5f5' }}; color: {{ $file->uploaded_by === 'client' ? '#1976d2' : '#666' }}; font-weight: 500; font-size: 0.8rem;">
                                            {{ ucfirst($file->uploaded_by ?? 'Admin') }}
                                        </span>
                                    </td>
                                    <td style="padding: 1.5rem 2rem; color: #666; font-size: 0.85rem;">
                                        {{ $file->created_at->format('M d, Y') }}
                                    </td>
                                    <td style="padding: 1.5rem 2rem;">
                                        <a href="{{ route('file.download', $file->id) }}" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;"><i class="fa-solid fa-download"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 2rem; color: #888;">No documents shared yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 2000; align-items: center; justify-content: center;">
        <div style="background: #fff; width: 100%; max-width: 400px; border-radius: 12px; padding: 2.5rem; text-align: center; margin: 2rem;">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem; color: #dc3545; margin-bottom: 1rem;"></i>
            <h3 style="margin-bottom: 0.5rem;">Delete this client?</h3>
            <p style="color: #666; margin-bottom: 2rem; font-size: 0.95rem;">This will permanently delete the account and all associated data.</p>
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <button onclick="document.getElementById('deleteModal').style.display='none'" class="btn btn-outline">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background: #dc3545; border-color: #dc3545;"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                document.getElementById('deleteForm').action = this.action;
                document.getElementById('deleteModal').style.display = 'flex';
            });
        });
    </script>
@endsection
