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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('uploaded_user_id')->nullable();
            $table->unsignedBigInteger('attachmentable_id');
            $table->string('attachmentable_type')->nullable();
            $table->string('url');
            $table->string('state');
            $table->string('lable');
            $table->string('file');
            $table->string('content_type');
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
