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
        Schema::create(Tables::LANGUAGES, static function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('code', 10)->nullable();
            $table->string('locale', 10)->nullable()->comment('Exp: en, vi, ja, ...');
            $table->string('locale_alias', 10)->nullable()->comment('Exp: en_US, vi_VN, ja_JP, ...');
            $table->string('flag', 20)->nullable();
            $table->string('currency', 10)->nullable();
            $table->boolean('default_web')->default(false);
            $table->boolean('default_adm')->default(false);
            $table->boolean('default_app')->default(false);
            $table->boolean('for_web')->default(false)->comment('Use for this platform');
            $table->boolean('for_adm')->default(false);
            $table->boolean('for_app')->default(false);
            $table->boolean('is_locked')->default(false);

            $table->char('status', 50)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::LANGUAGES);
    }
};
