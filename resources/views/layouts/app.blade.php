<!DOCTYPE html>
<html lang="tr" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'KısaURL') - Hızlı & Analitik URL Kısaltma Servisi</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icon Set -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js for analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Tailwind Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        slate: {
                            950: '#030712',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS Styles -->
    <style type="text/tailwindcss">
        @layer utilities {
            .glass-card {
                background: rgba(17, 24, 39, 0.45);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.06);
                box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
            }

            .glass-input {
                background: rgba(10, 15, 30, 0.6);
                border: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .glass-input:focus {
                background: rgba(10, 15, 30, 0.8);
                border-color: rgba(99, 102, 241, 0.5);
                box-shadow: 0 0 15px rgba(99, 102, 241, 0.15);
                outline: none;
            }

            .gradient-text {
                background: linear-gradient(135deg, #a855f7 0%, #6366f1 50%, #3b82f6 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .gradient-btn {
                background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
                box-shadow: 0 4px 20px -2px rgba(99, 102, 241, 0.3);
                transition: all 0.3s ease;
            }

            .gradient-btn:hover {
                box-shadow: 0 6px 24px 0 rgba(99, 102, 241, 0.5);
                transform: translateY(-1px);
            }

            .font-mono-custom {
                font-family: 'JetBrains Mono', monospace;
            }
        }
    </style>
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.08), transparent 45%),
                        radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.05), transparent 40%),
                        #030712;
        }
    </style>
    @yield('styles')
</head>
<body class="min-h-screen flex flex-col justify-between overflow-x-hidden">

    <!-- Header Navigation -->
    <header class="w-full border-b border-white/5 bg-slate-950/40 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-xl gradient-btn flex items-center justify-center text-white text-lg font-bold shadow-indigo-500/20">
                            <i class="fa-solid fa-link transition-transform group-hover:rotate-45"></i>
                        </div>
                        <span class="text-xl sm:text-2xl font-extrabold tracking-tight text-white">Kısa<span class="gradient-text">URL</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="flex items-center space-x-3 sm:space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-semibold text-slate-300 hover:text-white transition-all flex items-center space-x-2">
                            <i class="fa-solid fa-chart-line text-indigo-400"></i>
                            <span class="hidden sm:inline">Kontrol Paneli</span>
                        </a>
                        <div class="h-5 w-[1px] bg-white/10"></div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs text-slate-400 hidden md:inline-block">Hoş geldin, <strong class="text-slate-200">{{ Auth::user()->name }}</strong></span>
                            <form action="{{ url('/logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-3.5 py-2 bg-rose-500/10 hover:bg-rose-500/25 text-rose-300 border border-rose-500/20 hover:border-rose-500/30 rounded-xl text-xs font-bold transition-all flex items-center space-x-1.5 cursor-pointer">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Çıkış Yap</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ url('/login') }}" class="px-4 py-2.5 text-sm font-semibold text-slate-300 hover:text-white transition-all">Giriş Yap</a>
                        <a href="{{ url('/register') }}" class="px-4 py-2.5 gradient-btn text-white text-sm font-bold rounded-xl flex items-center space-x-1.5">
                            <i class="fa-solid fa-user-plus"></i>
                            <span>Ücretsiz Üye Ol</span>
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow flex flex-col">
        <!-- Toast Alerts -->
        @if (session('success'))
            <div id="toast-success" class="max-w-md mx-auto mt-6 mx-4 p-4 glass-card border-emerald-500/30 text-emerald-400 rounded-2xl flex items-center justify-between shadow-lg shadow-emerald-950/20 animate-fade-in z-50">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('toast-success').remove()" class="text-slate-400 hover:text-white transition-colors cursor-pointer">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div id="toast-error" class="max-w-md mx-auto mt-6 mx-4 p-4 glass-card border-rose-500/30 text-rose-400 rounded-2xl flex items-center justify-between shadow-lg shadow-rose-950/20 animate-fade-in z-50">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-circle-exclamation text-lg"></i>
                    <span class="text-sm font-medium">{{ $errors->first() }}</span>
                </div>
                <button onclick="document.getElementById('toast-error').remove()" class="text-slate-400 hover:text-white transition-colors cursor-pointer">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full border-t border-white/5 bg-slate-950/80 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-slate-500">© 2026 KısaURL. Tüm Hakları Saklıdır.</span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="#" class="text-sm text-slate-500 hover:text-slate-300 transition-colors">Kullanım Koşulları</a>
                <a href="#" class="text-sm text-slate-500 hover:text-slate-300 transition-colors">Gizlilik Politikası</a>
                <a href="#" class="text-sm text-slate-500 hover:text-slate-300 transition-colors">API Entegrasyonu</a>
            </div>
        </div>
    </footer>

    @yield('scripts')
    <script>
        // Auto remove alerts after 5 seconds
        setTimeout(() => {
            const successToast = document.getElementById('toast-success');
            const errorToast = document.getElementById('toast-error');
            if (successToast) successToast.style.display = 'none';
            if (errorToast) errorToast.style.display = 'none';
        }, 5000);
    </script>
</body>
</html>
