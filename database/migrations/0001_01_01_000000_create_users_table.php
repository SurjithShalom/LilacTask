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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('fk_department');
            $table->unsignedBigInteger('fk_designation');
            $table->string('phone_number');
            $table->timestamps();
            $table->softDeletes();
        });
        // Seed users
        DB::table('users')->insert([
            [
                'name' => 'Jhon Due',
                'fk_department' => 1,
                'fk_designation' => 1,
                'phone_number' => '1234567890',
                'created_at' => now()
            ],
            [
                'name' => 'Tommy Mark',
                'fk_department' => 2,
                'fk_designation' => 2,
                'phone_number' => '9876543210',
                'created_at' => now()
            ],
            [
                'name' => 'Balaji',
                'fk_department' => 1,
                'fk_designation' => 1,
                'phone_number' => '1234567890',
                'created_at' => now()
            ],
            [
                'name' => 'Azhagesan',
                'fk_department' => 2,
                'fk_designation' => 2,
                'phone_number' => '9876543210',
                'created_at' => now()
            ]
        ]);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
