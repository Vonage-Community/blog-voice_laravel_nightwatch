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
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();

            $table->string('channel');
            $table->uuid('message_uuid')->unique();
            $table->string('to');
            $table->string('from');
            $table->timestamp('timestamp');

            $table->string('context_status')->nullable();
            $table->string('message_type')->nullable();
            $table->text('text')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webhook_messages');
    }
};
