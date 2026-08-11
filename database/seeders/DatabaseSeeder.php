<?php

use Illuminate\Database\Seeder;
use App\Models\Guest;
use App\Models\Visit;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $guest = Guest::create([
            'name' => 'Adly',
            'email' => 'adly@example.com',
            'phone' => '08123456789',
            'company' => 'GLOSINDO',
            'purpose' => 'Kunjungan kerja',
            'face_descriptor' => null,
        ]);

        Visit::create([
            'guest_id' => $guest->id,
            'check_in' => \Carbon\Carbon::now(),
            'check_out' => null,
        ]);
    }
}