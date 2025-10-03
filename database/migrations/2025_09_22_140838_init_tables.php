<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reference', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('code', 255);
        });

        Schema::create('amount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('reference', 'id', 'IDX_8EA17042C54C8C93');
            $table->longText('name');
            $table->decimal('amount', 15);
            $table->timestamp('created_at');
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reference');
        Schema::dropIfExists('amount');
    }
};
