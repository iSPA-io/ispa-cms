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
        Schema::create(Tables::AUDIT_LOGS, static function (Blueprint $table) {
            $table->id();
            $table->string('action', 50)->nullable();
            $table->mediumText('old_value')->nullable();
            $table->mediumText('new_value')->nullable();
            $table->string('target_type', 100)->nullable();
            $table->unsignedBigInteger('target_id')->nullable();
            $table->ipAddress()->nullable();
            $table->text('user_agent')->nullable();
            $table->string('url', 1000)->nullable();
            $table->text('options')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['target_id', 'target_type']);
            $table->fullText(['old_value', 'new_value', 'user_agent', 'url'], sprintf(Tables::FULLTEXT_SEARCH, Tables::AUDIT_LOGS));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::AUDIT_LOGS);
    }
};
