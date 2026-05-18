<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClientQuery;
use App\Models\FileShare;
use App\Models\BlogPost;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::where('role', 'user')->count(),
            'queries' => ClientQuery::count(),
            'pending_queries' => ClientQuery::where('status', 'pending')->count(),
            'blogs' => BlogPost::count(),
        ];
        
        $recent_queries = ClientQuery::latest()->take(5)->get();
        
        // Upcoming meetings where appointment_date is in the future
        $upcoming_meetings = ClientQuery::whereNotNull('appointment_date')
            ->where('appointment_date', '>=', now())
            ->orderBy('appointment_date', 'asc')
            ->get();

        $announcement = \App\Models\Announcement::latest()->first();

        return view('admin.dashboard', compact('stats', 'recent_queries', 'upcoming_meetings', 'announcement'));
    }

    public function postAnnouncement(Request $request)
    {
        $request->validate(['message' => 'required|string|max:255']);
        
        \App\Models\Announcement::create([
            'message' => $request->message,
            'is_active' => true
        ]);

        return redirect()->back()->with('success', 'Announcement updated successfully.');
    }

    public function users()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        $queries = ClientQuery::where('user_id', $id)->latest()->get();
        $files = FileShare::where('user_id', $id)->latest()->get();
        return view('admin.user_show', compact('user', 'queries', 'files'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);
        
        $user->update($request->only('name', 'email'));
        return redirect()->back()->with('success', 'Client details updated.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Client account completely deleted.');
    }

    public function scheduleAppointment(Request $request, $id)
    {
        $request->validate([
            'requirement' => 'required|string',
            'admin_response' => 'nullable|string',
            'appointment_date' => 'nullable|date'
        ]);

        $query = new ClientQuery();
        $query->user_id = $id;
        $query->requirement = $request->requirement;
        $query->admin_response = $request->admin_response;
        $query->appointment_date = $request->appointment_date;
        $query->status = $request->admin_response ? 'resolved' : 'pending';
        $query->save();

        return redirect()->back()->with('success', 'Appointment/Query scheduled for the client.');
    }

    public function queries()
    {
        $queries = ClientQuery::with('user')->latest()->get();
        return view('admin.queries', compact('queries'));
    }

    public function replyQuery(Request $request, $id)
    {
        $request->validate([
            'admin_response' => 'required|string',
            'appointment_date' => 'nullable|date'
        ]);
        $query = ClientQuery::findOrFail($id);
        $query->admin_response = $request->admin_response;
        if ($request->appointment_date) {
            $query->appointment_date = $request->appointment_date;
        }
        $query->status = 'resolved';
        $query->save();

        return redirect()->back()->with('success', 'Reply sent and query marked as resolved.');
    }

    public function deleteQuery($id)
    {
        $query = ClientQuery::findOrFail($id);
        $query->delete();
        return redirect()->back()->with('success', 'Query deleted permanently.');
    }

    public function blogs()
    {
        $posts = BlogPost::latest()->get();
        return view('admin.blogs', compact('posts'));
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120'
        ]);

        $data = $request->only(['title', 'content']);
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('blogs', 'public');
        }

        BlogPost::create($data);
        return redirect()->back()->with('success', 'Blog post published.');
    }

    public function updateBlog(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120'
        ]);

        $blog = BlogPost::findOrFail($id);
        $data = $request->only(['title', 'content']);
        
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);
        return redirect()->back()->with('success', 'Blog post updated successfully.');
    }

    public function deleteBlog($id)
    {
        $blog = BlogPost::findOrFail($id);
        $blog->delete();
        return redirect()->back()->with('success', 'Blog post deleted successfully.');
    }

    public function files()
    {
        $files = FileShare::with('user')->latest()->get();
        $users = User::where('role', 'user')->get();
        return view('admin.files', compact('files', 'users'));
    }

    public function storeFile(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'file' => 'required|file|max:10240' // max 10MB
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('files', $filename, 'local'); // stored in storage/app/files

        FileShare::create([
            'user_id' => $request->user_id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType()
        ]);

        return redirect()->back()->with('success', 'File shared securely.');
    }
}
