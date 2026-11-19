<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'district')) {
                $table->string('district')->nullable();
            }
            if (! Schema::hasColumn('orders', 'village')) {
                $table->string('village')->nullable();
            }
            if (! Schema::hasColumn('orders', 'shipping_fee')) {
                $table->unsignedBigInteger('shipping_fee')->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            foreach (['district', 'village', 'shipping_fee'] as $col) {
                if (Schema::hasColumn('orders', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};