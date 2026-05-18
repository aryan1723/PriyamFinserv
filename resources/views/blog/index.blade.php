@extends('layouts.public')

@section('title', 'Financial Insights | Priyam Finserv')

@section('content')
    <section class="section" style="background-color: var(--primary-black); color: var(--bg-color); text-align: center; padding: 3rem 1.5rem;">
        <div class="container">
            <h1 style="color: var(--bg-color); font-size: 3rem; margin-bottom: 1rem;">Financial Insights</h1>
            <p style="color: #ccc; font-size: 1.2rem; max-width: 600px; margin: 0 auto;">Stay updated with the latest trends in financial literacy, corporate due diligence, and risk advisory.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            @if(isset($posts) && $posts->count() > 0)
                <div class="grid">
                    @foreach($posts as $post)
                        <div class="card" style="display: flex; flex-direction: column; padding: 0; overflow: hidden;">
                            @if($post->image_path)
                                <div style="height: 200px; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                                </div>
                            @endif
                            <div style="padding: 2rem; display: flex; flex-direction: column; flex-grow: 1;">
                                <h3 style="margin-bottom: 0.5rem;">{{ $post->title }}</h3>
                                <div style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">
                                    <i class="fa-regular fa-calendar"></i> {{ $post->created_at->format('M d, Y') }} &bull; {{ max(1, ceil(str_word_count($post->content) / 200)) }} min read
                                </div>
                                <p style="flex-grow: 1; margin-bottom: 1.5rem; color: var(--text-muted);">
                                    {{ Str::limit($post->content, 150) }}
                                </p>
                                <a href="{{ route('blog.show', $post->id) }}" class="btn btn-outline" style="align-self: flex-start; padding: 0.5rem 1rem; font-size: 0.9rem;">Read More <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem;"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 4rem 0; color: var(--text-muted);">
                    <i class="fa-solid fa-newspaper" style="font-size: 4rem; color: #ddd; margin-bottom: 1.5rem; display: block;"></i>
                    <h3 style="margin-bottom: 1rem;">No insights published yet.</h3>
                    <p>Check back later for updates from our financial experts.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
