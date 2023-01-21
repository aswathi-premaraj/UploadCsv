<?php

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
    public function up()
    {
        Schema::create('import_csv_progress', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->text('reason')->nullable();
            $table->tinyInteger('status')->comment('1:Finished,0:unfininshed')->default(0)->nullable();
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
        Schema::dropIfExists('import_csv_progress');
    }
};
