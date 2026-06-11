<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('todo_list_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('name');

            $table->text('content');

            // on garde created_at custom (comme ton TP)
            $table->timestamp('created_at');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};