@extends('admin.layout')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 1.8rem; color: var(--primary);">Financial Insights Panel</h1>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem; align-items: start;">
        
        <!-- Create Post Form -->
        <div class="card" style="position: sticky; top: 20px;">
            <div style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.3rem; margin-bottom: 0.5rem;"><i class="fa-solid fa-pen-nib" style="margin-right: 0.5rem; color: var(--primary);"></i> Publish New Insight</h2>
                <p style="font-size: 0.85rem; color: #888;">Share your expertise with your clients.</p>
            </div>

            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Insight Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="E.g., Q3 Market Analysis" required>
                </div>
                <div class="form-group">
                    <label for="image">Cover Image (Optional)</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" rows="12" placeholder="Write the content of the insight here..." required style="resize: vertical;"></textarea>
                </div>
                <button type="submit" class="btn" style="width: 100%; justify-content: center; margin-top: 1rem;"><i class="fa-solid fa-paper-plane"></i> Publish Insight</button>
            </form>
        </div>

        <!-- Posts List -->
        <div class="card" style="padding: 0;">
            <div class="card-header" style="padding: 1.5rem 2rem 0; margin-bottom: 1rem;">
                <h2 style="font-size: 1.3rem;">Published Insights</h2>
            </div>
            
            <div style="overflow-x: auto;">
                <table style="margin-top: 0;">
                    <thead>
                        <tr>
                            <th style="padding: 1rem 2rem;">Title & Excerpt</th>
                            <th style="padding: 1rem 2rem; width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td style="padding: 1.5rem 2rem;">
                                    <strong style="color: #222; display: block; font-size: 1.05rem; margin-bottom: 0.3rem;">{{ $post->title }}</strong>
                                    <p style="color: #666; font-size: 0.85rem; line-height: 1.4; margin-bottom: 0.5rem;">{{ Str::limit($post->content, 100) }}</p>
                                    <div style="color: #999; font-size: 0.8rem;"><i class="fa-regular fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}</div>
                                </td>
                                <td style="padding: 1.5rem 2rem; text-align: center;">
                                    <div style="display: flex; gap: 0.5rem; justify-content: center; align-items: center;">
                                        <button type="button" class="btn btn-outline" style="padding: 0.4rem 0.6rem; font-size: 0.8rem;" onclick="editBlog({{ $post->id }})"><i class="fa-solid fa-pen"></i></button>
                                        <form action="{{ route('admin.blogs.delete', $post->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline" style="padding: 0.4rem 0.6rem; font-size: 0.8rem; color: #dc3545; border-color: #dc3545;"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" style="text-align: center; padding: 3rem; color: #888;">
                                    <i class="fa-solid fa-file-pen" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
                                    No insights published yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Edit Blog Modal -->
    <div id="editBlogModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 2000; align-items: center; justify-content: center;">
        <div style="background: #fff; width: 100%; max-width: 600px; border-radius: 12px; padding: 2.5rem; position: relative; margin: 2rem;">
            <button onclick="document.getElementById('editBlogModal').style.display='none'" style="position: absolute; top: 1.5rem; right: 1.5rem; background: none; border: none; font-size: 1.2rem; cursor: pointer; color: #888;"><i class="fa-solid fa-xmark"></i></button>
            <h2 style="margin-bottom: 1.5rem;">Edit Insight</h2>
            
            <form id="editBlogForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="edit_title">Insight Title</label>
                    <input type="text" name="title" id="edit_title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit_image">Update Cover Image (Optional)</label>
                    <input type="file" name="image" id="edit_image" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="edit_content">Content</label>
                    <textarea name="content" id="edit_content" class="form-control" rows="8" required style="resize: vertical;"></textarea>
                </div>
                <button type="submit" class="btn" style="width: 100%; justify-content: center;"><i class="fa-solid fa-save"></i> Save Changes</button>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 2000; align-items: center; justify-content: center;">
        <div style="background: #fff; width: 100%; max-width: 400px; border-radius: 12px; padding: 2.5rem; text-align: center; margin: 2rem;">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem; color: #dc3545; margin-bottom: 1rem;"></i>
            <h3 style="margin-bottom: 0.5rem;">Delete this insight?</h3>
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

    <!-- Store blog data safely for JS -->
    <script>
        var blogData = @json($posts->map(function($p) { return ['id' => $p->id, 'title' => $p->title, 'content' => $p->content]; })->keyBy('id'));

        function editBlog(id) {
            var post = blogData[id];
            if (!post) return;
            document.getElementById('edit_title').value = post.title;
            document.getElementById('edit_content').value = post.content;
            document.getElementById('editBlogForm').action = "/admin/blogs/" + id + "/update";
            document.getElementById('editBlogModal').style.display = 'flex';
        }

        // Intercept delete forms to show custom modal
        document.querySelectorAll('.delete-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                document.getElementById('deleteForm').action = this.action;
                document.getElementById('deleteModal').style.display = 'flex';
            });
        });
    </script>

@endsection
