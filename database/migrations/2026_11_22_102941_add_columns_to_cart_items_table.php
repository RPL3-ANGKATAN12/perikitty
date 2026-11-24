<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->after('user_id')->constrained()->cascadeOnDelete();
            $table->integer('qty')->default(1)->after('product_id');

            $table->unique(['user_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'product_id']);
            $table->dropConstrainedForeignId('product_id');
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn('qty');
        });
    }
};