@extends('layouts.app')

@section('title', 'Kontrol Paneli')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

    <!-- Top Greeting & Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-white/5 pb-6">
        <div>

            <h1 class="text-3xl font-extrabold text-white tracking-tight">Linklerim</h1>
        </div>

    </div>

    <!-- Quick Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Stat 1: Total Links -->
        <div class="glass-card p-5 rounded-2xl flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Kısaltılan Linkler</span>
                <div class="text-3xl font-extrabold text-white">{{ $totalLinks }}</div>
                <span class="text-[11px] text-slate-400 font-medium">Toplam oluşturulan</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center text-xl border border-indigo-500/20">
                <i class="fa-solid fa-link"></i>
            </div>
        </div>

        <!-- Stat 2: Total Clicks -->
        <div class="glass-card p-5 rounded-2xl flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Toplam Tıklama</span>
                <div class="text-3xl font-extrabold text-white">0</div>
                <span class="text-[11px] text-emerald-400 font-medium">Canlı yönlendirme logları</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center text-xl border border-purple-500/20">
                <i class="fa-solid fa-chart-line"></i>
            </div>
        </div>

        <!-- Stat 3: Active Redirects -->
        <div class="glass-card p-5 rounded-2xl flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Aktif Yönlendirmeler</span>
                <div class="text-3xl font-extrabold text-white">0</div>
                <span class="text-[11px] text-indigo-400 font-medium">Kullanıma hazır</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-xl border border-emerald-500/20">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <!-- Stat 4: Avg Clicks -->
        <div class="glass-card p-5 rounded-2xl flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Link Başı Tıklama</span>
                <div class="text-3xl font-extrabold text-white">0</div>
                <span class="text-[11px] text-slate-400 font-medium">Ortalama tıklama sayısı</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl border border-amber-500/20">
                <i class="fa-solid fa-bullseye"></i>
            </div>
        </div>
    </div>

    <!-- Create Short URL Form Component -->
    <div id="create-form" class="glass-card p-6 sm:p-8 rounded-3xl border border-white/5 relative space-y-6">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl gradient-btn flex items-center justify-center text-white font-bold">
                <i class="fa-solid fa-plus text-sm"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Yeni Kısa URL Oluştur</h2>
                <p class="text-xs text-slate-400">Uzun web adresinizi girin ve anında kısa bir yönlendirme kodu elde edin.</p>
            </div>
        </div>

        <form action="{{ url('/urls') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- Long URL Input -->
                <div class="lg:col-span-2 space-y-1.5">
                    <label for="original_url" class="block text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Hedef Uzun URL <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <!-- Checks query parameter `url` if user started shortening on home page -->
                        <input type="url" name="original_url" id="original_url" required
                               value="{{ old('original_url', request()->query('url')) }}"
                               placeholder="https://github.com/beytullah/URL-Shortening-Service"
                               class="w-full pl-11 pr-4 py-3.5 bg-slate-950/80 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 font-mono-custom text-sm">
                    </div>
                </div>

                <!-- Custom Alias/Short Code -->
                <div class="space-y-1.5">
                    <label for="custom_code" class="block text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Özel Kısa Kod <span class="text-slate-500 font-normal">(İsteğe Bağlı)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 font-mono text-xs">
                            /
                        </div>
                        <input type="text" name="custom_code" id="custom_code" value="{{ old('custom_code') }}"
                               placeholder="benim-baglantim"
                               class="w-full pl-7 pr-4 py-3.5 bg-slate-950/80 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 font-mono-custom text-sm">
                    </div>
                </div>
            </div>

            <div class="pt-2 flex items-center justify-between">
                <div class="flex items-center space-x-2 text-xs text-slate-500 font-medium">
                    <i class="fa-solid fa-circle-question text-indigo-400/80"></i>
                    <span>Tıklama analizleri için <strong>302 Found</strong> yönlendirme yöntemi uygulanmaktadır.</span>
                </div>
                <button type="submit" class="w-full sm:w-auto px-8 py-3.5 gradient-btn text-white font-bold rounded-xl shadow-lg transition-all flex items-center justify-center space-x-2 cursor-pointer">
                    <i class="fa-solid fa-circle-chevron-right"></i>
                    <span>Kısaltılmış Link Üret</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Recent Created URLs List -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-white">Bağlantılarım</h2>
        </div>

        <div class="glass-card rounded-2xl overflow-hidden border border-white/5 shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/5 bg-slate-900/40 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            <th class="py-4 px-5">Kısa Link</th>
                            <th class="py-4 px-5">Orijinal Hedef Adres</th>
                            <th class="py-4 px-5 text-center">Toplam Tıklama</th>
                            <th class="py-4 px-5 text-center">Durum</th>
                            <th class="py-4 px-5 text-right">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-sm">
                        @forelse($urls as $url)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <!-- Short Link -->
                                <td class="py-4 px-5">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ url('/' . $url->short_code) }}" target="_blank" class="font-mono-custom text-indigo-400 hover:text-indigo-300 font-semibold hover:underline">
                                            {{ url('/' . $url->short_code) }}
                                        </a>
                                        <button onclick="copyToClipboard('{{ url('/' . $url->short_code) }}')" class="text-slate-500 hover:text-slate-200 transition-colors p-1" title="Panoya Kopyala">
                                            <i class="fa-solid fa-copy"></i>
                                        </button>
                                    </div>
                                </td>

                                <!-- Original Link -->
                                <td class="py-4 px-5 text-slate-400 font-mono-custom text-xs max-w-xs truncate" title="{{ $url->original_url }}">
                                    {{ $url->original_url }}
                                </td>

                                <!-- Click Count -->
                                <td class="py-4 px-5 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                                        {{ $url->click_count }}
                                    </span>
                                </td>

                                <!-- Status (Toggle Active) -->
                                <td class="py-4 px-5 text-center">
                                    <form action="{{ url('/urls/' . $url->id . '/toggle') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="cursor-pointer">
                                            @if($url->is_active)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-ping"></span>
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-500/10 text-slate-400 border border-slate-500/20">
                                                    Pasif
                                                </span>
                                            @endif
                                        </button>
                                    </form>
                                </td>

                                <!-- Actions -->
                                <td class="py-4 px-5 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Show Analytics button -->
                                        <button onclick="loadAnalytics({{ $url->id }})" class="px-3 py-1.5 bg-indigo-500/10 hover:bg-indigo-500/25 text-indigo-300 border border-indigo-500/20 rounded-lg text-xs font-semibold transition-all flex items-center space-x-1 cursor-pointer">
                                            <i class="fa-solid fa-chart-pie"></i>
                                            <span>İstatistikler</span>
                                        </button>

                                        <!-- Delete form -->
                                        <form action="{{ url('/urls/' . $url->id) }}" method="POST" onsubmit="return confirm('Bu kısa linki silmek istediğinizden emin misiniz?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 bg-rose-500/10 hover:bg-rose-500/25 text-rose-300 border border-rose-500/20 rounded-lg text-xs font-semibold transition-all flex items-center space-x-1 cursor-pointer">
                                                <i class="fa-solid fa-trash-can"></i>
                                                <span>Sil</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-10 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <i class="fa-solid fa-link-slash text-3xl text-slate-600"></i>
                                        <span class="font-medium">Henüz hiçbir link kısaltmadınız.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Live Analytics Panel Container (Hidden by default, loaded via Ajax) -->
    <div id="analytics-container" class="hidden space-y-6 scroll-mt-24">
        <div class="border-b border-white/5 pb-4">
            <h2 class="text-2xl font-extrabold text-white flex items-center space-x-3">
                <i class="fa-solid fa-chart-column text-indigo-400"></i>
                <span>Tıklama Analiz Paneli</span>
                <span id="active-analytics-code" class="text-sm font-semibold font-mono-custom text-slate-400 bg-white/5 px-2.5 py-0.5 rounded-lg"></span>
            </h2>
            <p class="text-xs text-slate-400 mt-1">Seçili linkin detaylı ziyaretçi analiz grafikleri ve tıklama kayıtları.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Daily Clicks Chart -->
            <div class="lg:col-span-2 glass-card p-6 rounded-2xl border border-white/5 space-y-4">
                <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider">Günlük Tıklama Eğilimleri (Son 14 Gün)</h3>
                <div class="relative h-64 sm:h-80 w-full">
                    <canvas id="clicksChart"></canvas>
                </div>
            </div>

            <!-- Browser and Device distribution -->
            <div class="glass-card p-6 rounded-2xl border border-white/5 space-y-4 flex flex-col">
                <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider">Tarayıcı Dağılımı</h3>
                <div class="relative flex-grow flex items-center justify-center h-48 sm:h-64">
                    <canvas id="browsersChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Top Referrers -->
            <div class="glass-card p-6 rounded-2xl border border-white/5 space-y-4">
                <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider">En Çok Yönlendiren Siteler (Referrers)</h3>
                <div class="space-y-3" id="referrer-list">
                    <!-- Loaded dynamically -->
                </div>
            </div>

            <!-- Recent Click Logs -->
            <div class="lg:col-span-2 glass-card p-6 rounded-2xl border border-white/5 space-y-4">
                <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider">Son 10 Ziyaretçi Günlüğü</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-white/5 text-slate-400 font-semibold uppercase">
                                <th class="pb-3">IP Adresi</th>
                                <th class="pb-3">Yönlendirici</th>
                                <th class="pb-3">Tarayıcı Bilgisi</th>
                                <th class="pb-3 text-right">Zaman</th>
                            </tr>
                        </thead>
                        <tbody id="clicks-log-tbody" class="divide-y divide-white/5 text-slate-300">
                            <!-- Loaded dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Copy short url helper
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Quick alert or custom notification
            alert('Kısa link panoya kopyalandı!');
        }, function(err) {
            console.error('Kopyalama hatası: ', err);
        });
    }

    // Chart instances
    let clicksChartInstance = null;
    let browsersChartInstance = null;

    // Load URL analytics details via AJAX
    function loadAnalytics(urlId) {
        const container = document.getElementById('analytics-container');

        fetch(`/urls/${urlId}/stats`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Analiz bilgisi yüklenemedi.');
                }
                return response.json();
            })
            .then(data => {
                // Show container
                container.classList.remove('hidden');
                container.scrollIntoView({ behavior: 'smooth' });

                // Update Code Title
                document.getElementById('active-analytics-code').innerText = data.url.short_code;

                // Render Chart 1: Click Trends
                renderClicksChart(data.clicks_over_time);

                // Render Chart 2: Browser Distribution
                renderBrowsersChart(data.browsers);

                // Render Referrer list
                renderReferrerList(data.referrers);

                // Render logs list
                renderLogsTable(data.latest_clicks);
            })
            .catch(error => {
                alert(error.message);
            });
    }

    function renderClicksChart(clickData) {
        const ctx = document.getElementById('clicksChart').getContext('2d');

        // Destruct labels and data
        const labels = clickData.map(item => item.click_date);
        const counts = clickData.map(item => item.count);

        if (clicksChartInstance) {
            clicksChartInstance.destroy();
        }

        clicksChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.length > 0 ? labels : ['Kayıt Yok'],
                datasets: [{
                    label: 'Tıklama Sayısı',
                    data: counts.length > 0 ? counts : [0],
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#8b5cf6',
                    pointBorderColor: '#fff',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#94a3b8',
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });
    }

    function renderBrowsersChart(browserData) {
        const ctx = document.getElementById('browsersChart').getContext('2d');

        const labels = browserData.map(item => item.label);
        const values = browserData.map(item => item.value);

        if (browsersChartInstance) {
            browsersChartInstance.destroy();
        }

        if (labels.length === 0) {
            labels.push('Veri Yok');
            values.push(1);
        }

        browsersChartInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        '#6366f1',
                        '#a855f7',
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#64748b'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#94a3b8',
                            padding: 15,
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                cutout: '75%'
            }
        });
    }

    function renderReferrerList(referrers) {
        const list = document.getElementById('referrer-list');
        list.innerHTML = '';

        if (referrers.length === 0) {
            list.innerHTML = '<div class="text-slate-500 text-xs py-4 text-center">Henüz yönlendiren site bilgisi yok.</div>';
            return;
        }

        referrers.forEach(item => {
            const row = document.createElement('div');
            row.className = 'flex items-center justify-between border-b border-white/5 pb-2 last:border-0';
            row.innerHTML = `
                <span class="text-xs text-slate-300 font-mono-custom max-w-[200px] truncate" title="${item.label}">${item.label}</span>
                <span class="text-xs font-semibold text-slate-400 bg-white/5 px-2 py-0.5 rounded">${item.value} tıklama</span>
            `;
            list.appendChild(row);
        });
    }

    function renderLogsTable(logs) {
        const tbody = document.getElementById('clicks-log-tbody');
        tbody.innerHTML = '';

        if (logs.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="py-4 text-center text-slate-500">Bu linke henüz tıklanmamış.</td></tr>';
            return;
        }

        logs.forEach(log => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="py-2.5 font-mono-custom">${log.ip_address}</td>
                <td class="py-2.5 font-mono-custom text-slate-400">${log.referer}</td>
                <td class="py-2.5 text-slate-400 truncate max-w-xs" title="${log.user_agent}">${log.user_agent}</td>
                <td class="py-2.5 text-right font-mono-custom text-slate-400">${log.visited_at}</td>
            `;
            tbody.appendChild(tr);
        });
    }
</script>
@endsection
