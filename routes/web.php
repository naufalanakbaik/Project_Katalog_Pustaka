<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FBukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthManualController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\Admin\JournalController as AdminJournalController;
use App\Http\Controllers\Publisher\JournalController as PublisherJournalController;
use App\Http\Controllers\Publisher\DashboardController as PublisherDashboardController;
use App\Http\Controllers\Publisher\ProfileController as PublisherProfileController;


// Route login, register dan logout
Route::get('/login', [AuthManualController::class, 'index'])->name('login');
Route::post('/login', [AuthManualController::class, 'loginProses'])->name('loginProses');
Route::get('/register', [AuthManualController::class, 'register'])->name('register');
Route::post('/register', [AuthManualController::class, 'registerProses'])->name('registerProses');
Route::post('/logout', [AuthManualController::class, 'logout'])->name('logout');


/*|------------------------------------------------------------------------|
|                                   USER                                   |
|--------------------------------------------------------------------------*/
Route::middleware(['auth'])->group(function () {
    Route::get('/', [FBukuController::class, 'index'])->name('homepage');
    Route::get('/katalog/{buku}', [FBukuController::class, 'detail_buku'])->name('detail-buku');
    Route::get('/about', [FBukuController::class, 'about'])->name('about');
    Route::get('/contact', [FBukuController::class, 'contact'])->name('contact');

    // (Profile user) Melihat form edit profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Memperbarui profile user
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // (Favorit buku) Menambahkan dan menghapus buku dari favorit
    Route::post('/katalog/{buku}/favorit', [FBukuController::class, 'toggleFavorit'])
        ->name('buku.favorit');
    // Melihat daftar buku favorit user
    Route::get('/buku-favorit', [FBukuController::class, 'bukuFavorit'])
        ->name('buku.favorit.index');

    // Mengirim pesan kontak
    Route::post('/contact', [ContactController::class, 'store'])
        ->name('contact.store');
    // Melihat balasan pesan dari admin
    Route::get('/reply-contact', [ContactController::class, 'userReplies'])
        ->name('replycontact.index');
    // Detail pesan balasan
    Route::get('/reply-contact/{contact}', [ContactController::class, 'showUserReply'])
        ->name('replycontact.show');
    // Route Klik Notifikasi 🔔
    Route::get('/notification/{id}', [ContactController::class, 'readNotification'])
        ->name('notification.read');

    // Daftar Jurnal User
    Route::get('/katalog-jurnal', [FBukuController::class, 'journals'])
        ->name('journals.index');
    // Show Jurnal Detail
    Route::get('/katalog-jurnal/{journal}', [FBukuController::class, 'showJournal'])
        ->name('journals.show');
    // Download Jurnal
    Route::get('/journal-download/{journal}', [FBukuController::class, 'downloadJournal'])
        ->name('journal.download');
});


/*|------------------------------------------------------------------------|
|                               PUBLISHER                                  |
|--------------------------------------------------------------------------*/
Route::middleware(['auth', 'publisher'])
    ->prefix('publisher')
    ->name('publisher.')
    ->group(function () {

        Route::get('/dashboard', [PublisherDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/global-journals', [PublisherJournalController::class, 'global'])
            ->name('journals.global');
            
        // CRUD Jurnal (Publisher)
        Route::resource('journals', PublisherJournalController::class);

        Route::get('/profile', [PublisherProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::post('/profile', [PublisherProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('/profile/show', [ProfileController::class, 'show'])
            ->name('profile.show');

        // Notifikasi
        // Route::get('/notifications', [PublisherDashboardController::class, 'notifications'])
        //     ->name('notifications.index');

        // Route::post('/notifications/read/{id}', [PublisherDashboardController::class, 'markAsRead'])
        //     ->name('notifications.read');

        // Route::post('/notifications/read-all', [PublisherDashboardController::class, 'markAllRead'])
        //     ->name('notifications.readAll');

        // Documentation
        Route::view('/documentation', 'publisher.docs.documentation')
            ->name('documentation');
        // Help
        Route::view('/help', 'publisher.docs.help')
            ->name('help');
    });


/*|------------------------------------------------------------------------|
|                                   ADMIN                                  |
|--------------------------------------------------------------------------*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('kategori', KategoriController::class);
        Route::resource('penerbit', PenerbitController::class);
        Route::resource('buku', BukuController::class);
        Route::resource('peminjaman', PeminjamanController::class);
        Route::resource('anggota', AnggotaController::class)->parameters(['anggota' => 'anggota']);
        Route::resource('users', UserController::class);

        // Menampilkan daftar
        Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
        // Menampilkan detail pesan
        Route::get('contact/{contact}', [ContactController::class, 'show'])->name('contact.show');
        // Proses balas pesan
        Route::post('contact/{contact}/reply', [ContactController::class, 'reply'])->name('contact.reply');
        // Menghapus pesan contact
        Route::delete('contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');

        // ------------------------- CRUD Jurnal (Admin) -------------------------
        // Menampilkan list jurnal
        Route::get('/journals', [AdminJournalController::class, 'index'])
            ->name('journals.index');
        // Menampilkan detail jurnal
        Route::get('/journals/{journal}', [AdminJournalController::class, 'show'])
            ->name('journals.show');
        // Approve jurnal
        Route::post('/journals/{journal}/approve', [AdminJournalController::class, 'approve'])
            ->name('journals.approve');
        // Reject jurnal
        Route::post('/journals/{journal}/reject', [AdminJournalController::class, 'reject'])
            ->name('journals.reject');
    });
