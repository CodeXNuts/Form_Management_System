<?php

namespace Database\Seeders;

use App\Models\InputElement;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@fm.com',
            'is_admin' => true
        ]);

        InputElement::create([
            'name' => 'Text',
            'type' => 'text',
            'has_options' => false
        ]);
        InputElement::create([
            'name' => 'Paragraph',
            'type' => 'textarea',
            'has_options' => false
        ]);
        InputElement::create([
            'name' => 'Multiple Tick Boxes',
            'type' => 'checkbox',
            'has_options' => true
        ]);
        InputElement::create([
            'name' => 'Menu Item Dropdown',
            'type' => 'select',
            'has_options' => true
        ]);
        InputElement::create([
            'name' => 'Multiple Choice',
            'type' => 'radio',
            'has_options' => true
        ]);
    }
}
