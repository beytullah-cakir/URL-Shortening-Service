<!DOCTYPE html>
<html lang="tr" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Bulunamadı - 404 Hata</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top right, rgba(239, 68, 68, 0.05), transparent 45%),
                        radial-gradient(circle at bottom left, rgba(99, 102, 241, 0.05), transparent 40%),
                        #030712;
        }
        .glass-card {
            background: rgba(17, 24, 39, 0.45);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        .gradient-text {
            background: linear-gradient(135deg, #f43f5e 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gradient-btn {
            background: linear-gradient(135deg, #f43f5e 0%, #6366f1 100%);
            box-shadow: 0 4px 20px -2px rgba(99, 102, 241, 0.3);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-6 text-center">
    <div class="max-w-md w-full space-y-6 glass-card p-8 sm:p-10 rounded-3xl border border-white/5 relative overflow-hidden">
        <!-- Accent ring -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-rose-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="w-20 h-20 rounded-full bg-rose-500/10 text-rose-400 flex items-center justify-center text-4xl border border-rose-500/20 mx-auto animate-bounce">
            <i class="fa-solid fa-link-slash"></i>
        </div>

        <h1 class="text-4xl font-extrabold text-white tracking-tight">Bağlantı Bulunamadı</h1>
        
        <p class="text-sm text-slate-400 leading-relaxed">
            Aradığınız kısa kod veritabanımızda mevcut değil veya sahibi tarafından geçici olarak pasifleştirilmiş olabilir.
        </p>

        <div class="pt-4">
            <a href="{{ url('/') }}" class="inline-flex items-center space-x-2 px-6 py-3.5 gradient-btn text-white font-bold rounded-xl shadow-lg transition-transform hover:scale-102 cursor-pointer w-full justify-center">
                <i class="fa-solid fa-house"></i>
                <span>Ana Sayfaya Dön</span>
            </a>
        </div>
    </div>
</body>
</html>
