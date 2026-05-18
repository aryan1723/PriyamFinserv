@extends('admin.layout')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 1.8rem; color: var(--primary);">Secure File Sharing</h1>
    </div>

    <div style="display: grid; grid-template-columns: 350px 1fr; gap: 2.5rem; align-items: start;">
        
        <!-- Upload Form -->
        <div class="card" style="position: sticky; top: 20px;">
            <div style="text-align: center; margin-bottom: 2rem; color: var(--primary);">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <h2 style="font-size: 1.3rem;">Share New File</h2>
                <p style="font-size: 0.85rem; color: #888; margin-top: 0.5rem;">Securely upload documents to specific clients.</p>
            </div>

            <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="user_id">Select Client</label>
                    <select name="user_id" id="user_id" class="form-control" required style="cursor: pointer;">
                        <option value="">-- Choose a Client --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">Select File (Max 10MB)</label>
                    <div style="position: relative;">
                        <input type="file" name="file" id="file" class="form-control" required style="padding-left: 2.5rem; cursor: pointer;">
                        <i class="fa-solid fa-paperclip" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #888;"></i>
                    </div>
                </div>
                <button type="submit" class="btn" style="width: 100%; justify-content: center; margin-top: 1rem;"><i class="fa-solid fa-upload"></i> Upload & Share</button>
            </form>
        </div>

        <!-- Files List -->
        <div class="card" style="padding: 0;">
            <div class="card-header" style="padding: 1.5rem 2rem 0; margin-bottom: 1rem;">
                <h2 style="font-size: 1.3rem;">Shared Files History</h2>
            </div>
            
            <div style="overflow-x: auto;">
                <table style="margin-top: 0;">
                    <thead>
                        <tr>
                            <th style="padding: 1rem 2rem;">Document Details</th>
                            <th style="padding: 1rem 2rem;">Shared With Client</th>
                            <th style="padding: 1rem 2rem;">Date Shared</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($files as $file)
                            <tr>
                                <td style="padding: 1.5rem 2rem;">
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <div style="background: #f0f0f0; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: var(--primary);">
                                            <i class="fa-regular fa-file-pdf"></i>
                                        </div>
                                        <div>
                                            <strong style="color: #222; display: block;">{{ $file->file_name }}</strong>
                                            <span style="color: #888; font-size: 0.8rem; text-transform: uppercase;">{{ explode('/', $file->file_type ?? 'Unknown')[1] ?? 'File' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1.5rem 2rem;">
                                    <div style="font-weight: 500; color: #333;">{{ $file->user->name ?? 'Unknown' }}</div>
                                    <div style="font-size: 0.85rem; color: #888;">{{ $file->user->email ?? '' }}</div>
                                </td>
                                <td style="padding: 1.5rem 2rem; color: #666;">
                                    {{ $file->created_at->format('M d, Y') }}<br>
                                    <span style="font-size: 0.8rem; color: #aaa;">{{ $file->created_at->format('h:i A') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; padding: 3rem; color: #888;">
                                    <i class="fa-solid fa-folder-open" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
                                    No files have been shared yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
