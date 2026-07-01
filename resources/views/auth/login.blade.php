<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SIMPEG Asy-Syakiriyah Jati</title>

    <!-- Google Font: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top right, #047857 0%, #022C22 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Subtle Islamic Geometric Grid Overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            opacity: 0.04;
            background-image: 
                radial-gradient(#ffffff 2px, transparent 2px), 
                radial-gradient(#ffffff 2px, transparent 2px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
            z-index: 0;
            pointer-events: none;
        }

        /* Animated floating stars */
        .star-decoration {
            position: absolute;
            color: rgba(251, 191, 36, 0.15);
            pointer-events: none;
            animation: floatSlow 8s infinite ease-in-out;
            z-index: 0;
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(180deg); }
        }

        .login-card-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            max-width: 950px;
            z-index: 1;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
        }

        /* Left Branding Panel */
        .bg-branding {
            background: linear-gradient(135deg, rgba(6, 78, 59, 0.95) 0%, rgba(2, 44, 34, 0.98) 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: #ffffff;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            overflow: hidden;
        }
        .bg-branding::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at bottom left, rgba(245, 158, 11, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .divider-gold {
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #FBBF24, #D97706);
            border-radius: 2px;
        }

        .motto-box .badge-gold {
            background-color: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #FBBF24;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            border-radius: 30px;
            padding: 8px 18px;
        }

        /* Right Login Form */
        .login-form-panel {
            padding: 50px 45px;
            background: #ffffff;
        }

        .brand-icon-mobile {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            background: rgba(4, 120, 87, 0.1);
            color: #047857;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        /* Custom Input Wrapper */
        .input-group-custom {
            position: relative;
        }
        .input-group-custom .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #047857;
            z-index: 10;
            font-size: 1.05rem;
            transition: color 0.2s ease;
        }
        .input-group-custom .form-control {
            padding-left: 46px;
            border-radius: 12px;
            padding-top: 12px;
            padding-bottom: 12px;
            border: 1.5px solid #E2E8F0;
            background-color: #F8FAFC;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        .input-group-custom .form-control:focus {
            background-color: #ffffff;
            border-color: #047857;
            box-shadow: 0 0 0 4px rgba(4, 120, 87, 0.15);
        }
        .input-group-custom .form-control:focus + .input-icon {
            color: #D97706; /* Changes to Gold on focus */
        }

        /* Submit Button Customization */
        .btn-primary {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.03em;
            box-shadow: 0 4px 15px rgba(4, 120, 87, 0.25);
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #047857 0%, #0369a1 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(4, 120, 87, 0.35);
        }

        .text-gold {
            color: #D97706;
        }

        @media (max-width: 991px) {
            .login-card-container {
                max-width: 450px;
            }
            .login-form-panel {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>

<!-- Animated Islamic Stars Decoration in Background -->
<div class="star-decoration" style="top: 10%; left: 8%; font-size: 2.5rem; animation-duration: 12s;"><i class="fa-solid fa-star-and-crescent"></i></div>
<div class="star-decoration" style="bottom: 15%; left: 15%; font-size: 1.8rem; animation-duration: 9s; animation-delay: 1s;"><i class="fa-solid fa-moon"></i></div>
<div class="star-decoration" style="top: 15%; right: 10%; font-size: 2rem; animation-duration: 10s; animation-delay: 2s;"><i class="fa-solid fa-star-and-crescent"></i></div>
<div class="star-decoration" style="bottom: 10%; right: 15%; font-size: 2.2rem; animation-duration: 11s; animation-delay: 0.5s;"><i class="fa-solid fa-mosque"></i></div>

<div class="card login-card-container border-0 shadow-lg">
    <div class="row g-0">
        
        <!-- Left Branding Panel (Hidden on Mobile) -->
        <div class="col-lg-6 d-none d-lg-flex bg-branding align-items-center justify-content-center text-center">
            <div class="branding-content px-4">
                <!-- Large Custom Islamic Logo (Mosque Illustration) -->
                <svg width="180" height="180" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="goldGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#FBBF24" />
                            <stop offset="100%" stop-color="#D97706" />
                        </linearGradient>
                    </defs>
                    <!-- Islamic Star Octagon Border -->
                    <circle cx="100" cy="100" r="88" fill="none" stroke="url(#goldGrad)" stroke-width="2" stroke-dasharray="12, 6" />
                    <circle cx="100" cy="100" r="82" fill="none" stroke="rgba(251, 191, 36, 0.2)" stroke-width="1" />
                    
                    <!-- Mosque Silhouette -->
                    <!-- Dome 1 (Center) -->
                    <path d="M100 45 C107 60 115 65 115 90 C115 92 100 93 100 93 C100 93 85 92 85 90 C85 65 93 60 100 45 Z" fill="url(#goldGrad)"/>
                    <!-- Dome 2 (Left) -->
                    <path d="M65 65 C70 75 75 78 75 95 C75 96 65 96 65 96 C65 96 55 96 55 95 C55 78 60 75 65 65 Z" fill="rgba(251, 191, 36, 0.75)"/>
                    <!-- Dome 3 (Right) -->
                    <path d="M135 65 C140 75 145 78 145 95 C145 96 135 96 135 96 C135 96 125 96 125 95 C125 78 130 75 135 65 Z" fill="rgba(251, 191, 36, 0.75)"/>
                    
                    <!-- Base structure -->
                    <rect x="50" y="94" width="100" height="40" rx="3" fill="url(#goldGrad)" />
                    
                    <!-- Gate arch -->
                    <path d="M85 134 L85 110 C85 102 115 102 115 110 L115 134 Z" fill="#022C22"/>
                    
                    <!-- Minaret Left -->
                    <rect x="35" y="70" width="8" height="65" rx="1" fill="url(#goldGrad)" />
                    <path d="M35 70 L39 60 L43 70 Z" fill="url(#goldGrad)" />
                    <!-- Minaret Right -->
                    <rect x="157" y="70" width="8" height="65" rx="1" fill="url(#goldGrad)" />
                    <path d="M157 70 L161 60 L165 70 Z" fill="url(#goldGrad)" />
                    
                    <!-- Crescent & Star -->
                    <path d="M100 32 A 4 4 0 1 0 104 38 A 3 3 0 1 1 100 32 Z" fill="#FBBF24" />
                    <polygon points="100,24 102,28 106,28 103,30 104,34 100,32 96,34 97,30 94,28 98,28" fill="#FBBF24"/>
                </svg>

                <h3 class="fw-bold mt-4 mb-2 text-white">PP. Asy-Syakiriyah Jati</h3>
                <p class="text-white-50 mb-4 text-sm px-3">Mendidik Generasi Rabbani, Unggul dalam Prestasi, Berakhlak Mulia</p>
                <div class="divider-gold mx-auto mb-4"></div>
                <div class="motto-box">
                    <span class="badge badge-gold px-3 py-2 text-uppercase font-weight-bold">Amanah &bull; Unggul &bull; Islami</span>
                </div>
            </div>
        </div>
        
        <!-- Right Login Form Panel -->
        <div class="col-lg-6 login-form-panel">
            
            <!-- Mobile Brand Icon (Visible only on Mobile) -->
            <div class="d-block d-lg-none text-center mb-4">
                <div class="brand-icon-mobile">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">SIMPEG PP. Asy-Syakiriyah</h4>
                <p class="text-muted text-sm mb-0">Sistem Informasi Kepegawaian</p>
            </div>

            <!-- Title for Desktop -->
            <div class="d-none d-lg-block mb-5">
                <h3 class="fw-bold text-dark mb-1">Masuk Aplikasi</h3>
                <p class="text-secondary text-sm">Sistem Informasi Kepegawaian (SIMPEG)</p>
            </div>

            <!-- Validation Session Status -->
            @if (session('status'))
                <div class="alert alert-success border-0 text-sm py-2 rounded-3 mb-4" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 text-sm py-2 rounded-3 mb-4" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold text-secondary text-xs text-uppercase mb-2">Alamat Email</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i class="fa-solid fa-envelope"></i></span>
                        <input id="email" type="email" name="email" class="form-control" placeholder="nama@syakiriyah.sch.id" value="{{ old('email') }}" required autofocus autocomplete="username">
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="form-label fw-bold text-secondary text-xs text-uppercase mb-2">Password</label>
                    <div class="input-group-custom">
                        <span class="input-icon"><i class="fa-solid fa-lock"></i></span>
                        <input id="password" type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required autocomplete="current-password">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-4 text-start">
                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                    <label for="remember_me" class="form-check-label text-sm text-secondary">
                        Ingat sesi login saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 mb-2 py-3 text-uppercase font-weight-bold">
                    Masuk ke Sistem <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
                </button>
            </form>
            
            <div class="text-center mt-5 text-xs text-muted">
                <small class="fw-semibold">&copy; 2026 PP. Asy-Syakiriyah Jati &bull; All Rights Reserved</small>
            </div>
        </div>
        
    </div>
</div>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
