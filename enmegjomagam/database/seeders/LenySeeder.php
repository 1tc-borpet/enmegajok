<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LenySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $userId = DB::table('users')->first()->id;

        // Példa lények
        $lenyek = [
            [
                'nev' => 'Főnix',
                'leiras' => 'Tűzből újjászülető mitikus madár, amely halhatatlan és gyönyörű dallamokat énekel. Teste lángoló piros és arany színben pompázik.',
                'kategoria_id' => 1, // Mágikus
                'user_id' => $userId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nev' => 'Kvantumkígyó',
                'leiras' => 'Digitális dimenzióban élő AI entitás, amely képes kvantum-állapotban létezni. Folyamatosan változtatja formáját és helyét.',
                'kategoria_id' => 3, // Digitális
                'user_id' => $userId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nev' => 'Biomérnök Medúza',
                'leiras' => 'Genetikailag módosított tengeri élőlény, amely képes szöveteket regenerálni és toxinokat gyártani. Három szeme van és biolumineszcens.',
                'kategoria_id' => 2, // Mutáns
                'user_id' => $userId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nev' => 'Árnyékfarkas',
                'leiras' => 'Sötétségben élő mágikus lény, amely képes árnyékká válni és láthatatlanul mozogni. Ezüst színű szőrzete csak holdvilágnál látható.',
                'kategoria_id' => 1, // Mágikus
                'user_id' => $userId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nev' => 'Holografikus Sárkány',
                'leiras' => 'Virtuális realitásban létező digitális entitás, amely háromdimenziós hologramként jelenik meg. Képes adatfolyamokat manipulálni.',
                'kategoria_id' => 3, // Digitális
                'user_id' => $userId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($lenyek as $leny) {
            $lenyId = DB::table('lenyek')->insertGetId($leny);

            // Véletlenszerű képességek hozzáadása
            $kepessegek = DB::table('kepessegek')->pluck('id')->toArray();
            $randomKepessegek = array_rand(array_flip($kepessegek), min(2, count($kepessegek)));
            
            if (!is_array($randomKepessegek)) {
                $randomKepessegek = [$randomKepessegek];
            }

            foreach ($randomKepessegek as $kepessegId) {
                DB::table('leny_kepesseg')->insert([
                    'leny_id' => $lenyId,
                    'kepesseg_id' => $kepessegId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
