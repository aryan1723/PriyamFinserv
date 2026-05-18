@extends('admin.layout')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 1.8rem; color: var(--primary);">Manage Appointments & Queries</h1>
    </div>

    <div class="card" style="padding: 0;">
        <div style="overflow-x: auto;">
            <table style="margin-top: 0;">
                <thead>
                    <tr>
                        <th style="padding: 1.2rem 1.5rem;">Client Details</th>
                        <th style="padding: 1.2rem 1.5rem;">Requirement / Message</th>
                        <th style="padding: 1.2rem 1.5rem; width: 120px;">Status</th>
                        <th style="padding: 1.2rem 1.5rem; width: 350px;">Action / Response</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($queries as $query)
                        <tr>
                            <td style="padding: 1.5rem;">
                                @if($query->user)
                                    {{-- Registered User --}}
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <div style="width: 36px; height: 36px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #555;">
                                            {{ substr($query->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <strong style="color: #222; display: block;">{{ $query->user->name }}</strong>
                                            <span style="color: #888; font-size: 0.85rem;">{{ $query->user->email }}</span>
                                        </div>
                                    </div>
                                    @if($query->company_name)
                                        <div style="margin-top: 0.5rem; font-size: 0.82rem; color: #666;"><i class="fa-solid fa-building" style="width: 14px; margin-right: 4px;"></i> {{ $query->company_name }}</div>
                                    @endif
                                @else
                                    {{-- Guest User - Show all contact details --}}
                                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.6rem;">
                                        <div style="width: 36px; height: 36px; background: #fff3e0; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #e65100; font-size: 0.85rem;">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div>
                                            <strong style="color: #222; display: block;">{{ $query->name ?? 'Guest User' }}</strong>
                                            <span style="display: inline-block; background: #fff3e0; color: #e65100; font-size: 0.7rem; padding: 0.15rem 0.5rem; border-radius: 10px; font-weight: 600;">GUEST</span>
                                        </div>
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 0.3rem; font-size: 0.82rem; color: #555; padding-left: 0.2rem;">
                                        @if($query->email)
                                            <div><i class="fa-solid fa-envelope" style="width: 14px; margin-right: 6px; color: #888;"></i> <a href="mailto:{{ $query->email }}" style="color: #1a73e8; text-decoration: none;">{{ $query->email }}</a></div>
                                        @endif
                                        @if($query->phone)
                                            <div><i class="fa-solid fa-phone" style="width: 14px; margin-right: 6px; color: #888;"></i> <a href="tel:{{ $query->phone }}" style="color: #555; text-decoration: none;">{{ $query->phone }}</a></div>
                                        @endif
                                        @if($query->whatsapp)
                                            <div><i class="fa-brands fa-whatsapp" style="width: 14px; margin-right: 6px; color: #25d366;"></i> <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $query->whatsapp) }}" target="_blank" style="color: #25d366; text-decoration: none;">{{ $query->whatsapp }}</a></div>
                                        @endif
                                        @if($query->company_name)
                                            <div><i class="fa-solid fa-building" style="width: 14px; margin-right: 6px; color: #888;"></i> {{ $query->company_name }}</div>
                                        @endif
                                    </div>
                                @endif
                                <div style="margin-top: 0.6rem; font-size: 0.78rem; color: #999;"><i class="fa-regular fa-clock"></i> {{ $query->created_at->format('M d, Y g:i A') }}</div>
                            </td>
                            <td style="padding: 1.5rem; color: #444; line-height: 1.5;">
                                {{ $query->requirement }}
                            </td>
                            <td style="padding: 1.5rem;">
                                <span class="badge {{ $query->status === 'resolved' ? 'badge-resolved' : 'badge-pending' }}">
                                    <i class="fa-solid {{ $query->status === 'resolved' ? 'fa-check' : 'fa-hourglass-half' }}"></i> {{ ucfirst($query->status) }}
                                </span>
                            </td>
                            <td style="padding: 1.5rem; background: #fafafa; border-left: 1px solid var(--border);">
                                @if($query->user)
                                    {{-- Registered user: show reply form or response --}}
                                    @if($query->status === 'pending')
                                        <form action="{{ route('admin.queries.reply', $query->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 0.8rem;">
                                            @csrf
                                            <textarea name="admin_response" class="form-control" rows="3" placeholder="Type your response here..." required style="resize: vertical; font-size: 0.9rem;"></textarea>
                                            <input type="datetime-local" name="appointment_date" class="form-control" title="Schedule an Appointment (Optional)" style="font-size: 0.85rem; padding: 0.4rem;">
                                            <button type="submit" class="btn" style="align-self: flex-end; font-size: 0.85rem; padding: 0.5rem 1rem;"><i class="fa-solid fa-paper-plane"></i> Send Reply</button>
                                        </form>
                                    @else
                                        <div style="font-size: 0.9rem; color: #555; margin-bottom: 1rem;">
                                            <strong style="display: block; margin-bottom: 0.3rem; color: #222;">Your Reply:</strong>
                                            <p style="background: #fff; padding: 0.8rem; border: 1px solid var(--border); border-radius: 6px;">{{ $query->admin_response }}</p>
                                        </div>
                                        @if($query->appointment_date)
                                            <div style="font-size: 0.8rem; color: #666; margin-bottom: 1rem;">
                                                <i class="fa-regular fa-calendar-check"></i> Appointment: {{ \Carbon\Carbon::parse($query->appointment_date)->format('M d, Y g:i A') }}
                                            </div>
                                        @endif
                                        <form action="{{ route('admin.queries.delete', $query->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline" style="padding: 0.3rem 0.8rem; font-size: 0.8rem; color: #dc3545; border-color: #dc3545;"><i class="fa-solid fa-trash"></i> Delete Record</button>
                                        </form>
                                    @endif
                                @else
                                    {{-- Guest user: no reply, just mark seen / delete --}}
                                    <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                                        <p style="font-size: 0.82rem; color: #888; font-style: italic; margin-bottom: 0.5rem;">
                                            <i class="fa-solid fa-info-circle" style="margin-right: 3px;"></i> Guest inquiry — reply via contact details shown.
                                        </p>
                                        @if($query->status === 'pending')
                                            <form action="{{ route('admin.queries.reply', $query->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="admin_response" value="Reviewed and marked as seen.">
                                                <button type="submit" class="btn" style="width: 100%; font-size: 0.82rem; padding: 0.45rem 0.8rem; background: #16a34a; border-color: #16a34a; color: #fff;">
                                                    <i class="fa-solid fa-check"></i> Mark as Seen
                                                </button>
                                            </form>
                                        @else
                                            <div style="font-size: 0.8rem; color: #16a34a; font-weight: 600;"><i class="fa-solid fa-circle-check" style="margin-right: 3px;"></i> Reviewed</div>
                                        @endif
                                        <form action="{{ route('admin.queries.delete', $query->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline" style="width: 100%; padding: 0.35rem 0.8rem; font-size: 0.8rem; color: #dc3545; border-color: #dc3545;"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 3rem; color: #888;">
                                <i class="fa-solid fa-inbox" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
                                No queries or appointments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 2000; align-items: center; justify-content: center;">
        <div style="background: #fff; width: 100%; max-width: 400px; border-radius: 12px; padding: 2.5rem; text-align: center; margin: 2rem;">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem; color: #dc3545; margin-bottom: 1rem;"></i>
            <h3 style="margin-bottom: 0.5rem;">Delete this record?</h3>
            <p style="color: #666; margin-bottom: 2rem; font-size: 0.95rem;">This action cannot be undone.</p>
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
