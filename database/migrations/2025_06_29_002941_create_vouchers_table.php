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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Misal: "REBATIK10"
            $table->string('name'); // Nama voucher
            $table->enum('type', ['percentage', 'fixed']); // Jenis diskon
            $table->decimal('value', 10, 2); // Contoh: 10.00 (%), atau 25000 (rupiah)
            $table->decimal('min_purchase', 10, 2)->nullable(); // Min pembelian
            $table->dateTime('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
