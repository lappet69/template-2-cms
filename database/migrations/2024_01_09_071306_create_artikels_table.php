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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('author')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_program')->nullable();
            $table->string('nama_program')->nullable();
            $table->text('title')->nullable();
            $table->text('info')->nullable();
            $table->text('value_program')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        Schema::create('bootcamps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bootcamp')->nullable();
            $table->text('subtitle_bootcamp')->nullable();
            $table->text('why_point')->nullable();
            $table->text('destinasi_karir')->nullable();
            $table->string('file_silabus')->nullable();
            $table->string('biaya')->nullable();
            $table->unsignedBigInteger('program_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('program_id')->references('id')->on('programs')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('beasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bootcamp_id')->nullable();
            $table->text('syarat')->nullable();
            $table->text('ketentuan')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('bootcamp_id')->references('id')->on('bootcamps')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('phases', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('kurikulum_caption')->nullable();
            $table->text('kurikulum_desc')->nullable();
            $table->unsignedBigInteger('bootcamp_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('bootcamp_id')->references('id')->on('bootcamps')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('career_support', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_name')->nullable();
            $table->unsignedBigInteger('bootcamp_id')->nullable();
            $table->string('day_range')->nullable();
            $table->string('time_range')->nullable();
            $table->date('prepare_day_date')->nullable();
            $table->date('bootcamp_phase_date')->nullable();
            $table->string('duration')->nullable();

            $table->foreign('bootcamp_id')->references('id')->on('bootcamps')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('logo');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bootcamp_id');
            $table->unsignedBigInteger('program_id');
            $table->string('nama');
            $table->string('email');
            $table->string('jenis_kelamin');
            $table->date('tgl_lahir');
            $table->string('no_hp');
            $table->string('kota_domisili');
            $table->text('alamat');
            $table->timestamps();

            $table->foreign('bootcamp_id')->references('id')->on('bootcamps')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('testimoni');
            $table->unsignedBigInteger('batch_id');
            $table->string('photo');
            $table->string('nama_project');
            $table->text('deskripsi_project');
            $table->string('link_project');
            $table->timestamps();

            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('bootcamps');
        Schema::dropIfExists('phases');
        Schema::dropIfExists('batches');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('registrations');
        Schema::dropIfExists('alumnis');
    }
};
