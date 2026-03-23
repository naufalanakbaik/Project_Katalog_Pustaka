<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    // Menambahkan data jumlah pesan kontak belum dibaca ke semua view admin
    public function boot(): void
    {
        View::composer('admin.*', function ($view) {
        $unreadMessages = Contact::where('is_read', false)->count();

        $latestMessages = Contact::latest()
            ->take(5)
            ->get();

        $view->with([
            'unreadMessages' => $unreadMessages,
            'latestMessages' => $latestMessages,
        ]);
    });
    }
}
