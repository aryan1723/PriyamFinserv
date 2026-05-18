<?php

require 'vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::create(
        '/login',
        'POST',
        ['email' => 'admin@priyamfinserv.com', 'password' => 'password']
    )
);

echo "Login Response Status: " . $response->getStatusCode() . "\n";

// Test Dashboard Redirect
$response = $kernel->handle(
    Illuminate\Http\Request::create('/dashboard', 'GET')
);
echo "Dashboard Status (Admin should redirect to admin): " . $response->getStatusCode() . "\n";

// Test Admin Blog Store
$response = $kernel->handle(
    Illuminate\Http\Request::create('/admin/blogs', 'POST', [
        'title' => 'Test Blog 1',
        'content' => 'This is a test blog.'
    ])
);
echo "Admin Blog Store Status: " . $response->getStatusCode() . "\n";

$blog = \App\Models\BlogPost::where('title', 'Test Blog 1')->first();
echo "Blog Created: " . ($blog ? 'Yes' : 'No') . "\n";

if ($blog) {
    // Test Admin Blog Update
    $response = $kernel->handle(
        Illuminate\Http\Request::create('/admin/blogs/' . $blog->id, 'POST', [
            'title' => 'Test Blog Updated',
            'content' => 'Updated content.'
        ])
    );
    echo "Admin Blog Update Status: " . $response->getStatusCode() . "\n";

    // Test Admin Blog Delete
    $response = $kernel->handle(
        Illuminate\Http\Request::create('/admin/blogs/' . $blog->id, 'POST', [
            '_method' => 'DELETE'
        ])
    );
    echo "Admin Blog Delete Status: " . $response->getStatusCode() . "\n";
}

// Check queries
$query = \App\Models\ClientQuery::first();
if ($query) {
    echo "Found Query ID: " . $query->id . "\n";
    if ($query->status === 'resolved') {
        $response = $kernel->handle(
            Illuminate\Http\Request::create('/admin/queries/' . $query->id, 'POST', [
                '_method' => 'DELETE'
            ])
        );
        echo "Admin Delete Resolved Query Status: " . $response->getStatusCode() . "\n";
    }
}
