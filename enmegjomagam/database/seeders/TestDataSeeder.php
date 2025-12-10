<?php

namespace Database\Seeders;

use App\Models\Kategoria;
use App\Models\Kepesseg;
use App\Models\Leny;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@kulkat.hu',
            'password' => Hash::make('password'),
        ]);

        // Create categories
        $kategoriak = [
            ['nev' => 'Mágikus', 'leiras' => 'Mágikus képességekkel rendelkező lények'],
            ['nev' => 'Mutáns', 'leiras' => 'Mutáns vagy genetikailag módosított lények'],
            ['nev' => 'Digitális', 'leiras' => 'Digitális vagy virtuális lények'],
        ];

        foreach ($kategoriak as $kat) {
            Kategoria::create($kat);
        }

        // Create abilities
        $kepessegek = [
            ['nev' => 'Teleportáció', 'leiras' => 'Képes azonnal egyik helyről a másikra ugrani'],
            ['nev' => 'Láthatatlanság', 'leiras' => 'Képes láthatatlanná válni'],
            ['nev' => 'Repülés', 'leiras' => 'Képes repülni'],
        ];

        foreach ($kepessegek as $kep) {
            Kepesseg::create($kep);
        }

        // Create a test creature
        $leny = Leny::create([
            'nev' => 'Teleportáló Teve',
            'leiras' => 'Egy különleges teve, amely képes teleportálni',
            'kategoria_id' => 1,
            'user_id' => $user->id,
        ]);

        // Attach abilities to the creature
        $leny->kepessegek()->attach([1]);
    }
}
