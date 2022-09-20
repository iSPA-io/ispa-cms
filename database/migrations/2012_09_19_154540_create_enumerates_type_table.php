<?php

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
        Schema::create(Tables::ENUMERATES_TYPE, static function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('key_name', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::ENUMERATES_TYPE);
    }
};
