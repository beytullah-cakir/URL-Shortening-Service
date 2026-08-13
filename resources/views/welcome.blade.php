@extends('layouts.app')

@section('title', 'Ana Sayfa')

@section('content')
<!-- Hero Section -->
<div class="relative py-24 px-4 sm:px-6 lg:px-8 flex flex-col items-center justify-center text-center overflow-hidden">
    <!-- Ambient background glows -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-20 left-1/3 w-[300px] h-[300px] bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-40 right-1/4 w-[250px] h-[250px] bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto space-y-8 relative z-10">
        <!-- Premium Pulsing Badge -->
        <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full glass-card border-indigo-500/30 text-indigo-300 text-xs font-semibold uppercase tracking-widest shadow-lg shadow-indigo-950/20">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
            </span>
            <span>Laravel URL Kısaltma & Analiz Servisi</span>
        </div>

        <!-- Heading with modern typography and gradient -->
        <h1 class="text-4xl sm:text-7xl font-extrabold text-white tracking-tight leading-none">
            Bağlantılarını Kısalt,<br class="hidden sm:inline">
            <span class="gradient-text">Etkileşimini</span> Keşfet
        </h1>

        <!-- Subheading -->
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-slate-400 font-normal leading-relaxed">
            Karmaşık, uzun web adreslerinizi saniyeler içinde benzersiz ve güvenli kısa linklere dönüştürün. 
            302 yönlendirme teknolojisi sayesinde tüm ziyaretçi analitiklerini anlık takip edin.
        </p>

        <!-- Main Shortener Panel -->
        <div class="max-w-2xl mx-auto glass-card p-6 sm:p-8 rounded-3xl border border-white/10 shadow-2xl relative">
            <div class="absolute -inset-[1px] rounded-3xl bg-gradient-to-r from-purple-500/20 to-indigo-500/20 opacity-50 blur-sm -z-10"></div>
            @auth
                <div class="space-y-4">
                    <p class="text-sm font-semibold text-slate-300">Oturumunuz aktif! Linklerinizi oluşturmak ve yönetmek için Kontrol Paneli'ne geçebilirsiniz.</p>
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center space-x-2 px-8 py-4 gradient-btn text-white font-bold rounded-2xl shadow-lg transition-all hover:scale-105">
                        <span>Kontrol Paneline Git</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <input type="url" id="quick_url" placeholder="Kısaltmak istediğiniz uzun URL'yi buraya yapıştırın..." 
                               class="flex-grow px-5 py-4 bg-slate-950/80 border border-white/10 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-medium">
                        
                        <button onclick="checkQuickShorten()" class="px-6 py-4 gradient-btn text-white font-bold rounded-2xl shadow-lg transition-all flex items-center justify-center space-x-2 cursor-pointer hover:scale-102">
                            <span>Kısalt</span>
                            <i class="fa-solid fa-scissors"></i>
                        </button>
                    </div>
                    <div class="flex items-center justify-center space-x-2 text-xs text-slate-500 font-medium">
                        <i class="fa-solid fa-circle-info text-indigo-400"></i>
                        <span>İstatistikleri izlemek ve özel kısa kod kullanmak için ücretsiz kayıt olmanız gerekmektedir.</span>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

<!-- Dynamic Preview Mockup (Dashboard Preview) -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
    <div class="glass-card rounded-3xl border border-white/10 p-4 sm:p-6 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent"></div>
        
        <!-- Window Chrome -->
        <div class="flex items-center space-x-2 mb-4 border-b border-white/5 pb-3">
            <span class="w-3 h-3 rounded-full bg-rose-500/60 inline-block"></span>
            <span class="w-3 h-3 rounded-full bg-amber-500/60 inline-block"></span>
            <span class="w-3 h-3 rounded-full bg-emerald-500/60 inline-block"></span>
            <span class="text-xs text-slate-500 font-mono-custom pl-4">http://localhost/dashboard</span>
        </div>

        <!-- Dashboard UI Mockup -->
        <div class="space-y-6 opacity-85 select-none pointer-events-none">
            <!-- Mockup Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-slate-950/60 border border-white/5 p-4 rounded-xl">
                    <span class="text-[10px] text-slate-500 uppercase font-semibold">Toplam Link</span>
                    <div class="text-xl font-bold text-white">42</div>
                </div>
                <div class="bg-slate-950/60 border border-white/5 p-4 rounded-xl">
                    <span class="text-[10px] text-slate-500 uppercase font-semibold">Tıklamalar</span>
                    <div class="text-xl font-bold text-indigo-400">12,482</div>
                </div>
                <div class="bg-slate-950/60 border border-white/5 p-4 rounded-xl">
                    <span class="text-[10px] text-slate-500 uppercase font-semibold">Aktif Linkler</span>
                    <div class="text-xl font-bold text-emerald-400">40</div>
                </div>
                <div class="bg-slate-950/60 border border-white/5 p-4 rounded-xl">
                    <span class="text-[10px] text-slate-500 uppercase font-semibold">Ort. CTR</span>
                    <div class="text-xl font-bold text-amber-400">297.1</div>
                </div>
            </div>

            <!-- Mockup Layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2 bg-slate-950/60 border border-white/5 p-4 rounded-xl h-48 flex flex-col justify-between">
                    <span class="text-[10px] text-slate-500 uppercase font-semibold">Tıklama Analizi</span>
                    <!-- Fake Chart Line -->
                    <div class="w-full h-24 flex items-end justify-between px-2">
                        <div class="w-8 bg-indigo-500/20 h-10 rounded-t border-t-2 border-indigo-400"></div>
                        <div class="w-8 bg-indigo-500/20 h-14 rounded-t border-t-2 border-indigo-400"></div>
                        <div class="w-8 bg-indigo-500/20 h-24 rounded-t border-t-2 border-indigo-400"></div>
                        <div class="w-8 bg-indigo-500/20 h-18 rounded-t border-t-2 border-indigo-400"></div>
                        <div class="w-8 bg-indigo-500/30 h-32 rounded-t border-t-2 border-indigo-400"></div>
                    </div>
                </div>
                <div class="bg-slate-950/60 border border-white/5 p-4 rounded-xl h-48 flex flex-col justify-between">
                    <span class="text-[10px] text-slate-500 uppercase font-semibold">Yönlendiren Siteler</span>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between text-slate-400"><span class="font-mono">google.com</span><span>4,210</span></div>
                        <div class="flex justify-between text-slate-400"><span class="font-mono">twitter.com</span><span>3,104</span></div>
                        <div class="flex justify-between text-slate-400"><span class="font-mono">github.com</span><span>1,489</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Stats Grid Section -->
<div class="py-20 bg-slate-950/50 border-y border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="glass-card p-8 rounded-3xl border border-white/5 space-y-4 hover:border-indigo-500/20 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center text-xl border border-indigo-500/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-bolt-lightning"></i>
                </div>
                <h3 class="text-xl font-bold text-white">Base62 Kod Üretimi</h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Veritabanı anahtarı üzerinden şifrelenen Base62 algoritması, çakışma (collision) riskini sıfıra indirir ve maksimum veritabanı indeks performansı sağlar.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="glass-card p-8 rounded-3xl border border-white/5 space-y-4 hover:border-purple-500/20 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center text-xl border border-purple-500/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3 class="text-xl font-bold text-white">Ziyaretçi Günlüğü</h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Tıklama yapan her ziyaretçinin IP adresi, yönlendirici (referer) adresi, tarayıcı/cihaz bilgisi ve tıklama zamanı veritabanına otomatik olarak loglanır.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="glass-card p-8 rounded-3xl border border-white/5 space-y-4 hover:border-rose-500/20 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-rose-500/10 text-rose-400 flex items-center justify-center text-xl border border-rose-500/20 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-route"></i>
                </div>
                <h3 class="text-xl font-bold text-white">Neden 302 Yönlendirmesi?</h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    301 yönlendirmesi tarayıcıda önbelleğe alınırken, 302 Found yönlendirmesi ile her tıklama sunucuya yönlendirilir ve istatistiklerinizi eksiksiz takip edebilirsiniz.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Accordion Section -->
<div class="py-24 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
    <div class="text-center space-y-2">
        <h2 class="text-3xl font-extrabold text-white">Sıkça Sorulan Sorular</h2>
        <p class="text-slate-400 text-sm">Servisimizin çalışma mantığı ve altyapısına dair teknik detaylar.</p>
    </div>

    <div class="space-y-4">
        <!-- FAQ 1 -->
        <div class="glass-card rounded-2xl border border-white/5 overflow-hidden">
            <button onclick="toggleFaq(1)" class="w-full px-6 py-5 text-left font-bold text-white flex justify-between items-center cursor-pointer hover:bg-white/[0.02] transition-colors">
                <span>Kısa kodlar nasıl oluşturulur ve çakışma engellenir?</span>
                <i id="faq-icon-1" class="fa-solid fa-chevron-down text-slate-500 transition-transform"></i>
            </button>
            <div id="faq-content-1" class="hidden px-6 pb-5 text-sm text-slate-400 leading-relaxed">
                Her yeni link oluşturulduğunda veritabanı primary key (ID) değeri Base62 karakter seti (0-9, a-z, A-Z) kullanılarak kodlanır. 
                Bu yöntem matematiksel olarak benzersiz olduğu için link çakışması (collision) ihtimali kesinlikle bulunmaz.
            </div>
        </div>

        <!-- FAQ 2 -->
        <div class="glass-card rounded-2xl border border-white/5 overflow-hidden">
            <button onclick="toggleFaq(2)" class="w-full px-6 py-5 text-left font-bold text-white flex justify-between items-center cursor-pointer hover:bg-white/[0.02] transition-colors">
                <span>Kullanıcı verileri ve tıklamalar nasıl takip edilir?</span>
                <i id="faq-icon-2" class="fa-solid fa-chevron-down text-slate-500 transition-transform"></i>
            </button>
            <div id="faq-content-2" class="hidden px-6 pb-5 text-sm text-slate-400 leading-relaxed">
                Ziyaretçiler kısa linke ulaştığında, yönlendirme öncesi sunucumuz istek başlıklarından IP adresini, referer başlığını (yönlendirici web sitesi) ve tarayıcı user agent string'ini yakalar. Bu veriler anlık olarak `click_logs` tablosuna kaydedilir.
            </div>
        </div>

        <!-- FAQ 3 -->
        <div class="glass-card rounded-2xl border border-white/5 overflow-hidden">
            <button onclick="toggleFaq(3)" class="w-full px-6 py-5 text-left font-bold text-white flex justify-between items-center cursor-pointer hover:bg-white/[0.02] transition-colors">
                <span>API Entegrasyonu mevcut mu?</span>
                <i id="faq-icon-3" class="fa-solid fa-chevron-down text-slate-500 transition-transform"></i>
            </button>
            <div id="faq-content-3" class="hidden px-6 pb-5 text-sm text-slate-400 leading-relaxed">
                Evet! Backend altyapısında bulunan Sanctum token doğrulama sistemi ile Laravel API endpoint'leri (`/api/auth/login`, `/api/auth/register` vb.) üçüncü parti uygulamalarla entegre olmaya hazırdır.
            </div>
        </div>
    </div>
</div>

@guest
<!-- CTA Section -->
<div class="py-16 text-center max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
    <h2 class="text-3xl font-extrabold text-white">Bağlantılarınızı Akıllandırın</h2>
    <p class="text-slate-400 text-sm max-w-xl mx-auto leading-relaxed">
        Ücretsiz üye olarak kendi özel kısa kodlarınızı (alias) belirleyin, linkleri dilediğiniz zaman pasifleştirip silin ve grafiklerle analizin tadını çıkarın.
    </p>
    <div>
        <a href="{{ url('/register') }}" class="px-8 py-4 gradient-btn text-white font-bold rounded-2xl shadow-lg transition-all hover:scale-105 inline-flex items-center space-x-2">
            <span>Hemen Ücretsiz Katıl</span>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>
@endguest
@endsection

@section('scripts')
<script>
    function checkQuickShorten() {
        const url = document.getElementById('quick_url').value;
        if (!url) {
            alert('Lütfen geçerli bir URL girin.');
            return;
        }
        
        // Redirect guest user to register or login with the url pre-filled
        window.location.href = "{{ url('/register') }}?url=" + encodeURIComponent(url);
    }

    function toggleFaq(id) {
        const content = document.getElementById(`faq-content-${id}`);
        const icon = document.getElementById(`faq-icon-${id}`);
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }
</script>
@endsection
