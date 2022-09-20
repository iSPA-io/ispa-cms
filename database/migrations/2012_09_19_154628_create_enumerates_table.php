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
        Schema::create(Tables::ENUMERATES, static function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('name_alias', 100)->nullable();
            $table->string('enum_key', 50)->nullable()->unique();
            $table->char('type', 50)->nullable();
            $table->foreignId('type_id')->nullable()->references('id')->on(Tables::ENUMERATES_TYPE)->nullOnDelete();
            $table->char('input_type', 20)->nullable();
            $table->boolean('is_filter')->default(false);
            $table->boolean('status')->default(true);

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
        Schema::dropIfExists(Tables::ENUMERATES);
    }
};
