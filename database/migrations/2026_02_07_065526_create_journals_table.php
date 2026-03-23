<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();

            $table->string('judul');
            $table->text('pengarang');
            $table->text('abstrak')->nullable();
            $table->year('tahun_terbit');
            $table->string('file_path');

            // Publisher
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Status validasi
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            // $table->integer('downloads')->default(0);

            // Admin validator
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();
            $table->text('rejection_note')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
