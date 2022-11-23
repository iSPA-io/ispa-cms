<?php

use App\Models\User;
use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(Tables::PASSWORD_RESETS, static function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('code', 8)->nullable()->index();
            $table->string('token');
            $table->dateTimeTz('valid_to')->nullable();
            $table->dateTimeTz('checked_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::PASSWORD_RESETS);
    }
};
