<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->char('book_id')->unique();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('author');
            $table->bigInteger('chapters')->unsigned()->nullable();
            $table->enum('genre', ['romance', 'horror', 'tragedy', 'politics', 'sci-fi', 'fantasy']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
