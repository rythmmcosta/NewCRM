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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('father_name')->nullable();
            $table->text('correspondence_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('telephone')->nullable();
            $table->date('dob')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('nid_number')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('photograph')->nullable();
            $table->json('emergency_contact')->nullable();
            $table->json('educational_details')->nullable();
            $table->json('employment_details')->nullable();
            $table->json('family_details')->nullable();
            $table->json('professional_references')->nullable();
            $table->date('declaration_date')->nullable();
            $table->string('declaration_place')->nullable();
            $table->string('signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'father_name',
                'correspondence_address',
                'permanent_address',
                'telephone',
                'dob',
                'marital_status',
                'nid_number',
                'blood_group',
                'photograph',
                'emergency_contact',
                'educational_details',
                'employment_details',
                'family_details',
                'professional_references',
                'declaration_date',
                'declaration_place',
                'signature',
            ]);
        });
    }
};
