<?php

use App\Models\Catalogue;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Catalogue::class)->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('thumbnail')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('content');
//            $table->string('tags')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->string('is_active');
            // $table->boolean('deleted')->default(false);
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
