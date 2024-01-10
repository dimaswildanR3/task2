<?php

// database/migrations/xxxx_xx_xx_create_vouchers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('amount', 10, 2);
            $table->timestamp('expired_at');
            $table->boolean('is_used')->default(false);
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
