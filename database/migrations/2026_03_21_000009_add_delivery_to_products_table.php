<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->enum('delivery_type', ['free', 'fixed'])->default('free')->after('is_featured');
            $table->decimal('delivery_charge', 10, 2)->nullable()->after('delivery_type');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['delivery_type', 'delivery_charge']);
        });
    }
};
