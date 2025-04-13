<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->enum('duration', ['monthly']);
            $table->enum('type', ['basic', 'pro_designer', 'normal']); // إضافة نوع "normal"
            $table->boolean('can_contact_designer')->default(false);
            $table->boolean('featured_post')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('subscription_plans')->insert([
            [
                'name' => 'Basic',
                'price' => 15.00,
                'duration' => 'monthly',
                'type' => 'basic',
                'can_contact_designer' => false,
                'featured_post' => true,
            ],
            [
                'name' => 'Pro Designer',
                'price' => 30.00,
                'duration' => 'monthly',
                'type' => 'pro_designer',
                'can_contact_designer' => true,
                'featured_post' => true,
            ],
            [
                'name' => 'Normal',
                'price' => 0.00,
                'duration' => 'monthly',
                'type' => 'normal',
                'can_contact_designer' => false,
                'featured_post' => false,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
