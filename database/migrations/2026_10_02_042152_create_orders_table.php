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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('order_number')->unique();

            // Snapshot data pembeli saat checkout
            $table->string('customer_name');
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->string('province');

            // Semua nilai uang disimpan sebagai Rupiah bulat
            $table->unsignedBigInteger('subtotal');
            $table->unsignedBigInteger('shipping')->default(10000);
            $table->unsignedBigInteger('total');

            // pending, processed, shipped, completed, cancelled
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};