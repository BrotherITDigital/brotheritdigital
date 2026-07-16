<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login – Brother IT Digital PLC</title>

    {{-- Fonts & CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: #0F172A; display: flex; align-items: center; justify-content: center; min-height: 100vh; font-family: 'Inter', sans-serif;">

    {{-- Login card wrapper --}}
    <div style="width: 100%; max-width: 420px; padding: 1.5rem;">
        
        <div style="background: #111827; border: 1px solid #1E293B; border-radius: var(--radius-lg); padding: 2.5rem; box-shadow: var(--shadow-lg); text-align: center;">
            
            {{-- Logo / Header --}}
            <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #2563EB, #06B6D4); border-radius: .75rem; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #fff; font-family: 'Poppins', sans-serif; font-size: 1.25rem; margin: 0 auto 1.25rem;">B</div>
            
            <h1 style="color: #fff; font-size: 1.5rem; font-weight: 800; margin-bottom: .5rem;">Admin Login</h1>
            <p style="color: #64748B; font-size: .875rem; margin-bottom: 2rem;">Sign in to access your administrative dashboard.</p>

            {{-- Form --}}
            <form action="{{ route('login') }}" method="POST" style="text-align: left; display: flex; flex-direction: column; gap: 1.25rem;" aria-label="Admin Login">
                @csrf
                
                {{-- Email --}}
                <div class="form-group">
                    <label for="email" style="color: #F1F5F9; font-weight: 600; font-size: .875rem;">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') error @enderror" style="background:#1F2937; border-color:#374151; color:#fff;" placeholder="admin@brotheritdigital.com" required autofocus>
                    @error('email')
                    <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" style="color: #F1F5F9; font-weight: 600; font-size: .875rem;">Password</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') error @enderror" style="background:#1F2937; border-color:#374151; color:#fff;" placeholder="••••••••" required>
                    @error('password')
                    <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: .5rem;">
                    <div style="display: flex; align-items: center; gap: .5rem;">
                        <input type="checkbox" id="remember" name="remember" style="width:1rem; height:1rem; cursor:pointer;">
                        <label for="remember" style="color: #94A3B8; font-size: .875rem; cursor:pointer; user-select:none;">Remember Me</label>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary" style="justify-content: center; width: 100%; margin-top: .5rem;" id="login-submit-btn">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>

            </form>

        </div>

    </div>

</body>
</html>
