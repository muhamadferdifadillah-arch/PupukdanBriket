<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Cek apakah kolom sudah ada, jika belum tambahkan
            if (!Schema::hasColumn('orders', 'subtotal')) {
                $table->decimal('subtotal', 15, 2)->default(0)->after('total_amount');
            }
            if (!Schema::hasColumn('orders', 'tax')) {
                $table->decimal('tax', 15, 2)->default(0)->after('subtotal');
            }
            if (!Schema::hasColumn('orders', 'courier')) {
                $table->string('courier')->nullable()->after('payment_method');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['subtotal', 'tax', 'courier']);
        });
    }
};