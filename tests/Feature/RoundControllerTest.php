<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Round;
use App\Models\Competition;

class RoundControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testRoundIndex()
    {
        // Teszteljük a körök lekérdezését egy adott verseny alapján
        $competition = Competition::first();

        // Lekérjük a köröket és ellenőrizzük a válasz státuszát
        $response = $this->get("/rounds?name={$competition->name}&year={$competition->year}");
        $response->assertStatus(200);
    }

    public function testRoundCreate()
    {
        // Új kör létrehozása és ellenőrzése
        $competition = Competition::first();
        $data = [
            'name' => 'Teszt Kör',
            'location' => 'Teszt Helyszín',
            'date' => '2023-09-30',
            'competition_name' => $competition->name,
            'competition_year' => $competition->year,
        ];

        $response = $this->post('/roundAdd', $data);
        $response->assertStatus(200);

        // Ellenőrizzük, hogy a kör létrejött-e az adatbázisban
        $this->assertDatabaseHas('round', $data);
    }

    public function testRoundDestroy()
    {
        // Kör létrehozása
        $competition = Competition::first();
        $data = [
            'name' => 'Teszt Kör',
            'location' => 'Teszt Helyszín',
            'date' => '2023-09-30',
            'competition_name' => $competition->name,
            'competition_year' => $competition->year,
        ];

        $round = Round::create($data);

        // Kör törlése és ellenőrzése
        $response = $this->delete('/roundDel', ['id' => $round->id]); // Az id-t a létrehozásnál kapott round id-ja
        $response->assertStatus(200);

        // Ellenőrizzük, hogy a kör eltűnt-e az adatbázisból
        $this->assertDatabaseMissing('round', $data);
    }

}
