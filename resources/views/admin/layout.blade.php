<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | Priyam Finserv</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #0a0a0a;
            --sidebar-color: #a0a0a0;
            --sidebar-hover: #ffffff;
            --content-bg: #f8f9fa;
            --primary: #0a0a0a;
            --border: #e0e0e0;
            --transition: all 0.3s ease;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { display: flex; height: 100vh; background-color: var(--content-bg); color: #333; overflow: hidden; }
        
        .sidebar { width: 280px; background: var(--sidebar-bg); color: var(--sidebar-color); display: flex; flex-direction: column; transition: var(--transition); }
        .sidebar-header { padding: 2rem; font-size: 1.4rem; font-weight: 700; color: #fff; letter-spacing: 1px; display: flex; align-items: center; gap: 0.8rem; border-bottom: 1px solid rgba(255,255,255,0.05); }
        
        .nav-links { list-style: none; flex-grow: 1; padding: 1.5rem 1rem; overflow-y: auto; }
        .nav-links li { margin-bottom: 0.5rem; }
        .nav-links li a { display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1.2rem; color: var(--sidebar-color); text-decoration: none; border-radius: 8px; font-weight: 500; transition: var(--transition); }
        .nav-links li a i { width: 20px; font-size: 1.1rem; }
        .nav-links li a:hover, .nav-links li a.active { color: var(--sidebar-hover); background: rgba(255,255,255,0.1); }
        
        .content-wrapper { flex-grow: 1; display: flex; flex-direction: column; overflow: hidden; }
        .topbar { background: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); }
        
        .content { flex-grow: 1; overflow-y: auto; padding: 2.5rem; }
        
        .card { background: #fff; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); margin-bottom: 2rem; border: 1px solid var(--border); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        
        .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.2rem; border: none; background: var(--primary); color: #fff; cursor: pointer; border-radius: 6px; text-decoration: none; font-weight: 500; font-size: 0.9rem; transition: var(--transition); }
        .btn:hover { opacity: 0.8; transform: translateY(-1px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .btn-outline { background: transparent; color: var(--primary); border: 1px solid var(--primary); }
        .btn-outline:hover { background: var(--primary); color: #fff; }
        
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 1rem; border-bottom: 1px solid var(--border); }
        th { color: #888; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; background: #fafafa; }
        tr:hover td { background: #fdfdfd; }
        
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-size: 0.9rem; font-weight: 500; color: #555; }
        .form-control { width: 100%; padding: 0.8rem 1rem; border: 1px solid var(--border); border-radius: 6px; font-family: inherit; font-size: 0.95rem; transition: var(--transition); background: #fafafa; }
        .form-control:focus { outline: none; border-color: var(--primary); background: #fff; }
        
        .alert { padding: 1rem 1.5rem; margin-bottom: 2rem; border-radius: 8px; display: flex; align-items: center; gap: 0.8rem; font-weight: 500; }
        .alert-success { background: #e6f4ea; color: #1e8e3e; border: 1px solid #ceead6; }
        
        .badge { padding: 0.25rem 0.6rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
        .badge-pending { background: #fff4e5; color: #b26a00; border: 1px solid #ffe0b2; }
        .badge-resolved { background: #e6f4ea; color: #1e8e3e; border: 1px solid #ceead6; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fa-solid fa-gem"></i> Admin
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-chart-pie"></i> Overview</a></li>
            <li><a href="{{ route('admin.queries') }}" class="{{ request()->routeIs('admin.queries') ? 'active' : '' }}"><i class="fa-solid fa-clipboard-list"></i> Appointments</a></li>
            <li><a href="{{ route('admin.files') }}" class="{{ request()->routeIs('admin.files') ? 'active' : '' }}"><i class="fa-solid fa-file-shield"></i> File Sharing</a></li>
            <li><a href="{{ route('admin.blogs') }}" class="{{ request()->routeIs('admin.blogs') ? 'active' : '' }}"><i class="fa-solid fa-newspaper"></i> Blog Panel</a></li>
            <li><a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Client Directory</a></li>
        </ul>
    </div>
    
    <div class="content-wrapper">
        <div class="topbar">
            <div style="font-weight: 500; color: #666;">
                {{ date('l, F j, Y') }}
            </div>
            <div style="display: flex; align-items: center; gap: 1.5rem;">
                <a href="{{ url('/') }}" target="_blank" style="color: #666; text-decoration: none; font-size: 0.9rem;"><i class="fa-solid fa-arrow-up-right-from-square"></i> View Site</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #333; cursor: pointer; font-size: 0.95rem; font-weight: 500; font-family: inherit;"><i class="fa-solid fa-arrow-right-from-bracket" style="margin-right: 5px;"></i> Logout</button>
                </form>
            </div>
        </div>
        
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>
</body>
</html>
