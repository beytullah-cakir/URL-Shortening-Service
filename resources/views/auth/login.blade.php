@extends('layouts.app')

@section('title', 'Giriş Yap')

@section('content')
<div class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 glass-card p-8 sm:p-10 rounded-3xl border border-white/5 relative overflow-hidden">
        <!-- Background Light Element -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Tekrar Hoş Geldiniz</h2>
            <p class="mt-2 text-sm text-slate-400">
                Hesabınıza giriş yapın veya 
                <a href="{{ url('/register') }}" class="font-semibold text-indigo-400 hover:text-indigo-300 hover:underline">yeni bir hesap oluşturun</a>
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ url('/login') }}" method="POST">
            @csrf
            
            <div class="space-y-4">
                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">E-posta Adresi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" 
                               class="w-full pl-10 pr-4 py-3 bg-slate-950/80 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-medium" 
                               placeholder="isim@adres.com">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Şifre</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                               class="w-full pl-10 pr-4 py-3 bg-slate-950/80 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-medium" 
                               placeholder="••••••••">
                    </div>
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" 
                           class="h-4 w-4 rounded border-slate-700 bg-slate-950/80 text-indigo-600 focus:ring-indigo-500/20 focus:ring-offset-slate-900">
                    <label for="remember" class="ml-2 block text-sm text-slate-400 select-none cursor-pointer">Beni Hatırla</label>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full py-3.5 gradient-btn text-white font-bold rounded-xl shadow-lg transition-all flex items-center justify-center space-x-2 cursor-pointer">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Giriş Yap</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
