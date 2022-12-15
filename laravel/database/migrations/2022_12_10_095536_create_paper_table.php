<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title")->unique();
            $table->text("memo")->nullable();
            $table->text("url")->nullable();
            $table->text("author")->nullable();
            $table->text("journal")->nullable();
            $table->text("publisher")->nullable();
            $table->integer("volume")->nullable();
            $table->integer("number")->nullable();
            $table->text("pages")->nullable();
            $table->integer("year")->nullable();
            $table->binary("pdf_url")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('papers');
    }
};
