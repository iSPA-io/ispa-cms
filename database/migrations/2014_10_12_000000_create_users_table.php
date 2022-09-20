<?php

use App\Constants\Tables;
use App\Constants\UserType;
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
        Schema::create(Tables::USERS, static function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('username', 100)->nullable()->unique();
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->tinyInteger('type')->default(UserType::GUESS);
            $table->tinyInteger('level')->default(99);
            $table->foreignId('parent_id')->nullable()->references('id')->on(Tables::USERS)->nullOnDelete();

            $table->char('status', 50)->nullable();
            $table->foreign('status')->references('enum_key')->on(Tables::ENUMERATES)->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->fullText(['email', 'username', 'name'], sprintf(Tables::FULLTEXT_SEARCH, Tables::USERS));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::USERS);
    }
};
