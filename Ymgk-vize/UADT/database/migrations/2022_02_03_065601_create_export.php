<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->string('title');
            $table->text('description');
            $table->string('country');
            $table->string('city');

            $table->string('total_quantity')->nullable();
            $table->string('company_name');
            $table->text('company_address');
            $table->string('company_phone');
            $table->string('company_mail');
            $table->dateTime('request_date');
            $table->dateTime('deadline');
            $table->integer('isPublished')->default(1);
            $table->enum('type',['API','mail','excel','pdf','manuel']);
            $table->bigInteger('managerId')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
