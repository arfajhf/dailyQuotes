<?php

namespace Database\Seeders;

use App\Models\Quotes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quotes::create([
            'text' => 'Jikalau engkau ingin melihat aku bahagia itu simpel, Kamu bahagiain aja dirimu sendiri itu udah membuat aku bahagia
SIMPELKAN?',
            'author' => 'ArFaj',
            'image' => 'image/tiga.jpg'
        ]);
        Quotes::create([
            'text' => 'Terkadang aku iri melihat kamu yang sangat dekat dengan dia, tapi aku sadar dia lebih dulu mengenalmu dari pada aku',
            'author' => 'ArFaj',
            'image' => 'image/tiga.jpg'
        ]);
    }
}
