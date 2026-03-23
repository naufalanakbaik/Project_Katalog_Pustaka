@include('admin.layout.header')
<title>Dashboard | Pustaka Katalog</title>

<!-- Header -->
<div class="mb-8 bg-blue-50 p-8 border border-blue-200 rounded-lg shadow-sm">
    <h2 class="text-3xl font-semibold text-gray-900 mb-3 flex items-center gap-2">
        Selamat Datang di Katalog Pustaka
    </h2>
    <p class="text-gray-800 leading-relaxed max-w-3xl">
        Halo <span class="font-semibold text-indigo-800">{{ Auth::user()->name }}</span>,
        selamat datang di <span class="font-semibold">Katalog Pustaka</span> — tempat dimana semua koleksi
        buku dan referensi tersedia hanya dalam sekali klik.
    </p>
    <p class="mt-3 text-gray-800 leading-relaxed">
        Dengan fitur pencarian cepat, statistik koleksi, hingga visualisasi data yang interaktif,
        kami berharap pengalaman membaca dan mengelola pustaka Anda menjadi lebih mudah, menyenangkan,
        dan bermanfaat. Mari bersama-sama menjelajahi dunia pengetahuan tanpa batas.
    </p>
</div>

{{-- Statistik Data Buku --}}
<section class="container mx-auto mb-9 px-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Kategori --}}
        <div
            class="bg-white rounded-xl p-7 text-center shadow-sm border border-gray-200
            hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-blue-100">
                <span class="material-icons text-blue-600 text-3xl">
                    folder
                </span>
            </div>
            <div class="text-2xl font-semibold text-slate-800 mb-2">
                {{ number_format($data['jmlKategori'] ?? 0) }}
            </div>
            <div class="text-sm text-slate-500">
                Total Kategori
            </div>
        </div>

        {{-- Total Penerbit --}}
        <div
            class="bg-white rounded-xl p-7 text-center shadow-sm border border-gray-200
            hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-emerald-100">
                <span class="material-icons text-emerald-600 text-3xl">
                    folder_shared
                </span>
            </div>
            <div class="text-2xl font-semibold text-slate-800 mb-2">
                {{ number_format($data['jmlPenerbit'] ?? 0) }}
            </div>
            <div class="text-sm text-slate-500">
                Total Penerbit
            </div>
        </div>

        {{-- Total Buku --}}
        <div
            class="bg-white rounded-xl p-7 text-center shadow-sm border border-gray-200
            hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-pink-100">
                <span class="material-icons text-pink-600 text-3xl">
                    library_books
                </span>
            </div>
            <div class="text-2xl font-semibold text-slate-800 mb-2">
                {{ number_format($data['jmlSemuaBuku'] ?? 0) }}
            </div>
            <div class="text-sm text-slate-500">
                Total Buku
            </div>
        </div>

        {{-- Total Anggota --}}
        <div
            class="bg-white rounded-xl p-7 text-center shadow-sm border border-gray-200
            hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-amber-100">
                <span class="material-icons text-amber-600 text-3xl">
                    group
                </span>
            </div>
            <div class="text-2xl font-semibold text-slate-800 mb-2">
                {{ number_format($data['jmlAnggota'] ?? 0) }}
            </div>
            <div class="text-sm text-slate-500">
                Total Anggota
            </div>
        </div>
    </div>
</section>

<section class="container mx-auto mb-8 grid grid-cols-1 lg:grid-cols-3 gap-4">
    <!-- LINE CHART KATEGORI -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800">
                Tren Buku per Kategori
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Visualisasi distribusi jumlah buku berdasarkan kategori
            </p>
        </div>
        <div class="w-full h-[380px]">
            <canvas id="lineKategori"></canvas>
        </div>
    </div>

    <!-- DOUGHNUT PENERBIT -->
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 flex flex-col">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800">
                Distribusi Buku per Penerbit
            </h2>
            <p class="text-xs text-gray-500">
                Perbandingan jumlah buku aktif berdasarkan penerbit
            </p>
        </div>
        <div class="flex-1 h-[320px]">
            <canvas id="doughnutPenerbit"></canvas>
        </div>
    </div>
</section>

<!-- Header Publisher & Jurnal -->
<div class="mb-8 bg-blue-50 p-8 border border-blue-200 rounded-lg shadow-sm">
    <h2 class="text-xl font-semibold text-gray-900 mb-1 flex items-center gap-2">
        Statistik Jurnal & Publisher
    </h2>
    <p class="text-gray-800 leading-relaxed max-w-3xl">
        Berikut adalah ringkasan statistik terkait jurnal yang telah diajukan oleh para publisher.
        Data ini mencakup total jurnal, status review, serta tren pengajuan jurnal dalam beberapa bulan terakhir.
    </p>
</div>

{{-- Statistik Data Jurnal --}}
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
    {{-- Total Jurnal --}}
    <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-100 items-center text-center">
        <h3 class="text-sm text-gray-500">Total Jurnal</h3>
        <p class="text-3xl font-semibold text-blue-700 mt-2">
            {{ $statJurnal->total }}
        </p>
    </div>

    {{-- Pending --}}
    <div class="bg-yellow-50 shadow-sm rounded-lg p-6 border border-yellow-100 items-center text-center">
        <h3 class="text-sm text-yellow-600">Jurnal Ditunda</h3>
        <p class="text-3xl font-semibold text-yellow-700 mt-2">
            {{ $statJurnal->pending }}
        </p>
    </div>

    {{-- Approved --}}
    <div class="bg-green-50 shadow-sm rounded-lg p-6 border border-green-100 items-center text-center">
        <h3 class="text-sm text-green-600">Jurnal Disetujui</h3>
        <p class="text-3xl font-semibold text-green-700 mt-2">
            {{ $statJurnal->approved }}
        </p>
    </div>

    {{-- Rejected --}}
    <div class="bg-red-50 shadow-sm rounded-lg p-6 border border-red-100 items-center text-center">
        <h3 class="text-sm text-red-600">Jurnal Ditolak</h3>
        <p class="text-3xl font-semibold text-red-700 mt-2">
            {{ $statJurnal->rejected }}
        </p>
    </div>
</section>

{{-- Statistik Approved, Disetujui, dan Publisher Aktif --}}
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    {{-- Approval Rate --}}
    <div class="bg-white shadow-sm rounded-lg p-6 border">
        <h3 class="text-sm text-gray-500">Approval Rate</h3>
        <p class="text-2xl font-semibold text-indigo-700 mt-2">
            {{ $approvalRate }}%
        </p>
    </div>

    {{-- Approved This Month --}}
    <div class="bg-white shadow-sm rounded-lg p-6 border">
        <h3 class="text-sm text-gray-500">Disetujui Bulan Ini</h3>
        <p class="text-2xl font-semibold text-green-700 mt-2">
            {{ $approvedThisMonth }}
        </p>
    </div>

    {{-- Publisher Aktif --}}
    <div class="bg-white shadow rounded-lg p-6 border">
        <h3 class="text-sm text-gray-500">Publisher Aktif</h3>
        <p class="text-2xl font-semibold text-blue-700 mt-2">
            {{ $publisherAktif }}
        </p>
    </div>
</section>

{{-- Grafik Jurnal per Publisher --}}
<section class="container mx-auto mt-6 grid grid-cols-1 lg:grid-cols-3 gap-4">
    {{-- LINE CHART - 6 BULAN --}}
    <div class="lg:col-span-2 bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800">
                Grafik Jurnal per Publisher
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Tren jumlah jurnal yang masuk dan diproses berdasarkan publisher
            </p>
        </div>
        <div class="w-full h-[380px]">
            <canvas id="publisherChart" height="100"></canvas>
        </div>
    </div>

    {{-- STATUS CHART --}}
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 flex flex-col">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800">
                Grafik Status Jurnal
            </h2>
            <p class="text-xs text-gray-500">
                Distribusi jurnal berdasarkan status validasi
            </p>
        </div>
        <div class="flex-1 h-[320px]">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
</section>

{{-- Grafik Jurnal per Tahun --}}
{{-- <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-6 mb-6 mt-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Statistik Jurnal Approved
            </h2>
            <p class="text-sm text-gray-500">
                Distribusi jurnal yang disetujui per bulan tahun {{ $year }}
            </p>
        </div>

        <div class="flex items-center gap-3">

            <!-- Label kecil -->
            <span class="text-sm font-medium text-gray-600">
                Filter Tahun
            </span>

            <!-- Filter Card -->
            <form method="GET">
                <div class="relative">

                    <!-- Icon -->
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10m2 10H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />
                        </svg>
                    </span>

                    <select name="year" onchange="this.form.submit()"
                        class="appearance-none rounded-xl border border-gray-300 bg-white pl-9 pr-10 py-2.5 text-sm font-medium text-gray-700 shadow-sm transition-all duration-200 hover:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                        @for ($y = now()->year; $y >= now()->year - 5; $y--)
                            <option value="{{ $y }}" @selected($year == $y)>
                                Tahun {{ $y }}
                            </option>
                        @endfor
                    </select>

                    <!-- Dropdown Arrow -->
                    <span class="absolute inset-y-0 right-4 flex items-center text-gray-400 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>

                </div>
            </form>
        </div>
    </div>
    <!-- Chart Container -->
    <div class="relative h-[350px]">
        <canvas id="journalMonthlyChart"></canvas>
    </div>
</div> --}}

<!-- Penutup -->
<div class="bg-gray-50 border border-gray-200 rounded-lg p-6 shadow-inner mt-8">
    <p class="text-gray-700 leading-relaxed max-w-4xl mx-auto text-center">
        Sistem ini terus berkembang untuk memberikan kemudahan dalam pengelolaan perpustakaan.
        Jangan ragu untuk menjelajahi lebih banyak fitur dan manfaatkan semaksimal mungkin.
    </p>
</div>

<!-- === Chart.js CDN === -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- JS Chart Kategori & Penerbit  --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {

        // Kembali ke font awal Anda
        Chart.defaults.font.family = "'Poppins', sans-serif";
        Chart.defaults.color = "#64748B";

        const labelsKategori = @json($namaKategori ?? []);
        const dataKategori = @json($jumlahBuku ?? []);
        const labelsPenerbit = @json($namaPenerbit ?? []);
        const dataPenerbit = @json($jumlahBukuPenerbit ?? []);

        function safeData(labels, data) {
            if (!labels.length || !data.length) {
                return {
                    labels: ["Belum Ada Data"],
                    data: [1]
                };
            }
            return {
                labels,
                data
            };
        }

        const kategoriSafe = safeData(labelsKategori, dataKategori);
        const penerbitSafe = safeData(labelsPenerbit, dataPenerbit);

        /* ==========================
            LINE CHART - PASTEL
        ========================== */
        const ctxLine = document.getElementById("lineKategori");

        if (ctxLine) {

            const gradient = ctxLine.getContext("2d")
                .createLinearGradient(0, 0, 0, 400);

            gradient.addColorStop(0, "rgba(167, 139, 250, 0.35)");
            gradient.addColorStop(1, "rgba(167, 139, 250, 0)");

            new Chart(ctxLine, {
                type: "line",
                data: {
                    labels: kategoriSafe.labels,
                    datasets: [{
                        label: "Jumlah Buku",
                        data: kategoriSafe.data,
                        borderColor: "#A78BFA",
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.45,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: "#A78BFA",
                        pointBorderColor: "#fff",
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: "#1E293B",
                            padding: 12,
                            cornerRadius: 10,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: "rgba(0,0,0,0.04)"
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        /* ==========================
            DOUGHNUT - PASTEL FIX
        ========================== */
        const ctxDonut = document.getElementById("doughnutPenerbit");

        if (ctxDonut) {

            const pastelColors = [
                "#C4B5FD",
                "#A7F3D0",
                "#FDE68A",
                "#FBCFE8",
                "#BAE6FD",
                "#DDD6FE",
                "#FCD34D",
                "#86EFAC"
            ];

            new Chart(ctxDonut, {
                type: "doughnut",
                data: {
                    labels: penerbitSafe.labels,
                    datasets: [{
                        data: penerbitSafe.data,
                        backgroundColor: pastelColors.slice(0, penerbitSafe.data.length),
                        borderWidth: 2,
                        borderColor: "#ffffff"
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: "70%",

                    plugins: {
                        legend: {
                            position: "bottom",
                            labels: {
                                padding: 15,
                                boxWidth: 14,
                                boxHeight: 14,
                                usePointStyle: true,
                                pointStyle: "circle",
                                font: {
                                    family: "ubuntu, sans-serif",
                                    size: 12,
                                    weight: "500"
                                },
                                color: "#475569"
                            }
                        },
                        tooltip: {
                            backgroundColor: "#1E293B",
                            padding: 12,
                            cornerRadius: 10,
                            displayColors: false
                        }
                    }
                }
            });
        }

    });
</script>

{{-- JS Chart Publisher 6 Akhir & Perbadingan Aprroved/Pending/Rejected   --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

        /* =========================
            GLOBAL STYLE
        ========================= */
        Chart.defaults.font.family = "'Poppins', sans-serif";
        Chart.defaults.color = "#64748B";

        const statusLabels = @json($statusLabels ?? []);
        const statusCounts = @json($statusCounts ?? []);

        const months = @json($months ?? []);
        const journalCounts = @json($journalCounts ?? []);

        function safeData(labels, data) {
            if (!labels.length || !data.length) {
                return {
                    labels: ["Belum Ada Data"],
                    data: [1],
                    isEmpty: true
                };
            }
            return {
                labels,
                data,
                isEmpty: false
            };
        }

        const statusSafe = safeData(statusLabels, statusCounts);
        const journalSafe = safeData(months, journalCounts);

        /* =========================================
            DOUGHNUT - STATUS (Modern Minimal)
        ========================================= */
        const statusCtx = document.getElementById("statusChart");

        if (statusCtx) {

            const pastelStatus = [
                "#A7F3D0", // approved
                "#FCA5A5", // rejected
                "#BFDBFE" // pending
            ];

            const total = statusSafe.data.reduce((a, b) => a + b, 0);

            const centerTextPlugin = {
                id: "centerText",
                beforeDraw(chart) {
                    if (statusSafe.isEmpty) return;

                    const {
                        width,
                        height,
                        ctx
                    } = chart;
                    ctx.restore();
                    ctx.font = "600 20px Poppins";
                    ctx.fillStyle = "#1E293B";
                    ctx.textAlign = "center";
                    ctx.textBaseline = "middle";
                    ctx.fillText(total, width / 2, height / 2);
                    ctx.save();
                }
            };

            new Chart(statusCtx, {
                type: "doughnut",
                data: {
                    labels: statusSafe.labels,
                    datasets: [{
                        data: statusSafe.data,
                        backgroundColor: statusSafe.isEmpty ? ["#E5E7EB"] : pastelStatus.slice(
                            0, statusSafe.data.length),
                        borderWidth: 2,
                        borderColor: "#ffffff",
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: "75%",
                    plugins: {
                        legend: {
                            position: "bottom",
                            labels: {
                                usePointStyle: true,
                                boxWidth: 10,
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: "#1E293B",
                            padding: 12,
                            cornerRadius: 10,
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw;
                                    const percent = total ?
                                        ((value / total) * 100).toFixed(1) :
                                        0;
                                    return ` ${value} jurnal (${percent}%)`;
                                }
                            }
                        }
                    }
                },
                plugins: statusSafe.isEmpty ? [] : [centerTextPlugin]
            });
        }

        /* =========================================
            BAR CHART - 6 BULAN (Modern Soft)
        ========================================= */
        const ctx = document.getElementById("journalChart");

        if (ctx) {

            const gradient = ctx.getContext("2d")
                .createLinearGradient(0, 0, 0, 400);

            gradient.addColorStop(0, "rgba(99,102,241,0.8)");
            gradient.addColorStop(1, "rgba(99,102,241,0.3)");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: journalSafe.labels,
                    datasets: [{
                        label: "Jumlah Jurnal",
                        data: journalSafe.data,
                        backgroundColor: journalSafe.isEmpty ?
                            "#E5E7EB" : gradient,
                        borderRadius: 10,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: "#1E293B",
                            padding: 12,
                            cornerRadius: 10,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            grid: {
                                color: "rgba(0,0,0,0.04)"
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

    });
</script>

{{-- JS Chart per Publisher --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const canvas = document.getElementById('publisherChart');
        if (!canvas) return;

        // Jika chart sudah ada, hancurkan dulu
        if (window.publisherChartInstance) {
            window.publisherChartInstance.destroy();
        }

        const ctx = canvas.getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(99,102,241,0.35)');
        gradient.addColorStop(1, 'rgba(99,102,241,0.05)');

        window.publisherChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($publisherNames),
                datasets: [{
                    label: 'Jumlah Jurnal',
                    data: @json($publisherJournalCounts),
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: 'rgba(79,70,229,1)',
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: 'rgba(79,70,229,1)',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 13,
                                weight: 'normal'
                            },
                            color: '#374151',
                            usePointStyle: true,
                            pointStyle: 'rectRounded',
                            padding: 20,
                            boxWidth: 12,
                            boxHeight: 12
                        }
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleFont: {
                            size: 13,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        },
                        ticks: {
                            precision: 0,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });

    });
</script>

{{-- JS Chart Jurnal pertahun --}}
<script>
    const ctx = document.getElementById('journalMonthlyChart').getContext('2d');

    // Gradient area
    const gradient = ctx.createLinearGradient(0, 0, 0, 350);
    gradient.addColorStop(0, 'rgba(79,70,229,0.35)');
    gradient.addColorStop(1, 'rgba(79,70,229,0.05)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Jurnal Approved Tahun {{ $year }}',
                data: @json($totals),
                fill: true,
                backgroundColor: gradient,
                borderColor: 'rgba(79,70,229,1)',
                borderWidth: 3,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: 'rgba(79,70,229,1)',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 13,
                            weight: 'normal'
                        },
                        usePointStyle: true,
                        pointStyle: 'rectRounded',
                        boxWidth: 12,
                        boxHeight: 12,
                        padding: 20
                    }
                },
                tooltip: {
                    backgroundColor: '#111827',
                    titleFont: {
                        size: 13,
                        weight: '600'
                    },
                    bodyFont: {
                        size: 12
                    },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return ' ' + context.parsed.y + ' jurnal';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        precision: 0,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
</script>

@include('admin.layout.footer')
