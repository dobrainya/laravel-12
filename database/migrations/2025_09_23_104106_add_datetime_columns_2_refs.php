<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reference', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

        \App\Models\Reference::query()
            ->where('created_at', null)
            ->update(['created_at' => new \DateTime()]);

        Schema::table('reference', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable(false)->change();
            $table->timestamp('updated_at')->nullable(false)->change();
        });

        Schema::table('amount', function (Blueprint $table) {
            $table->timestamp('updated_at')->nullable();
        });

        \App\Models\Amount::query()
            ->where('updated_at', null)
            ->update(['updated_at' => new \DateTime()]);

        Schema::table('amount', function (Blueprint $table) {
            $table->timestamp('updated_at')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reference', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at', 'deleted_at']);
        });

        Schema::table('amount', function (Blueprint $table) {
            $table->dropColumn(['updated_at']);
        });
    }
};
