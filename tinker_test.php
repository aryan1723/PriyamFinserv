<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\ClientQuery;
use App\Models\BlogPost;

echo "1. Testing User Creation...\n";
if ($u = User::where('email', 'verify@test.com')->first()) {
    $u->delete();
}
$u = User::create(['name'=>'Test Verify', 'email'=>'verify@test.com', 'password'=>bcrypt('pass'), 'role'=>'user']);
echo "User ID: {$u->id}\n";

echo "2. Testing Client Query...\n";
$q = new ClientQuery();
$q->user_id = $u->id;
$q->requirement = 'Test req';
$q->save();
echo "Query ID: {$q->id}\n";

echo "3. Updating Query (Admin resolve & schedule)...\n";
$q->update(['status'=>'resolved', 'admin_response'=>'Done', 'appointment_date'=>now()->addDays(2)]);
echo "Query Status: {$q->status}\n";

echo "4. Deleting Query...\n";
$q->delete();
echo "Query Deleted.\n";

echo "5. Testing Blog Post...\n";
$b = BlogPost::create(['title'=>'Test Verify Blog', 'content'=>'Content goes here']);
echo "Blog ID: {$b->id}\n";

echo "6. Deleting Blog...\n";
$b->delete();
echo "Blog Deleted.\n";

echo "7. Deleting User...\n";
$u->delete();
echo "User Deleted.\n";

echo "All tests passed successfully.\n";
