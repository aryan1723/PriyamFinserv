@extends('admin.layout')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 1.8rem; color: var(--primary);">Client Directory</h1>
        <div style="color: #666; font-size: 0.95rem;">
            Total Clients: <strong style="color: var(--primary);">{{ $users->count() }}</strong>
        </div>
    </div>

    <div class="card" style="padding: 0;">
        <div class="card-header" style="padding: 1.5rem 2rem 0; margin-bottom: 1rem;">
            <h2 style="font-size: 1.2rem;">Registered Clients</h2>
        </div>
        
        <div style="overflow-x: auto;">
            <table style="margin-top: 0;">
                <thead>
                    <tr>
                        <th style="padding: 1rem 2rem;">Client Profile</th>
                        <th style="padding: 1rem 2rem;">Contact Details</th>
                        <th style="padding: 1rem 2rem; width: 200px;">Registration Date</th>
                        <th style="padding: 1rem 2rem; width: 100px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td style="padding: 1.5rem 2rem;">
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div style="width: 40px; height: 40px; background: var(--primary); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-family: var(--font-serif); font-size: 1.2rem;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <strong style="color: #222; display: block; font-size: 1.05rem;"><a href="{{ route('admin.users.show', $user->id) }}" style="color: inherit; text-decoration: none;">{{ $user->name }}</a></strong>
                                        <span style="color: #888; font-size: 0.85rem;">Client ID: #{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1.5rem 2rem;">
                                <a href="mailto:{{ $user->email }}" style="color: #555; display: flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                                    <i class="fa-regular fa-envelope"></i> {{ $user->email }}
                                </a>
                            </td>
                            <td style="padding: 1.5rem 2rem; color: #666; font-size: 0.9rem;">
                                <i class="fa-regular fa-calendar-check" style="margin-right: 5px;"></i> {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td style="padding: 1.5rem 2rem;">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;"><i class="fa-solid fa-eye"></i> View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 3rem; color: #888;">
                                <i class="fa-solid fa-users-slash" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
                                No registered clients found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
