<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');
            $table->enum('role',['admin','user','adviser','employee'])->default('user');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_name')->nullable();
            $table->longText('company_description')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('company_web')->nullable();
            $table->enum('company_type',['Anonim','Limited','Kollektif','Komandit','Kooperatif'])->default('Anonim');
            $table->integer('company_foundation_year')->nullable();
            $table->string('company_capital')->nullable();
            $table->string('company_tax_administration')->nullable();
            $table->string('company_closed_area')->nullable();
            $table->string('company_open_area')->nullable();
            $table->string('company_number_employees')->nullable();
            $table->longText('company_document')->nullable();
            $table->integer('is_published')->default(0);
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
