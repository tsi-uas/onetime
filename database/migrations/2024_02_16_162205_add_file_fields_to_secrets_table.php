<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileFieldsToSecretsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('secrets', function (Blueprint $table) {
            $table->string('file_name', 256)->nullable()->after('secret');
            $table->integer('file_size')->unsigned()->nullable()->after('file_name');
            $table->string('file_extension', 10)->nullable()->after('file_size');
            $table->string('file_mime', 100)->nullable()->after('file_extension');
            $table->text('file_contents')->nullable()->after('file_mime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secrets', function (Blueprint $table) {
            $table->dropColumn([
                'file_name',
                'file_size',
                'file_extension',
                'file_mime',
                'file_contents',
            ]);
        });
    }
}
