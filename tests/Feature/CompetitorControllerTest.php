<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Competitor;
use App\Models\Round;

class CompetitorControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCompetitorIndex()
    {
        // Teszteljük a versenyzők lekérdezését egy adott kör alapján
        $round = Round::first();

        // Lekérjük a versenyzőket és ellenőrizzük a válasz státuszát
        $response = $this->get("/competitors?id={$round->id}");
        $response->assertStatus(200);
    }

    public function testCompetitorCreate()
    {
        // Új versenyző létrehozása és ellenőrzése
        $round = Round::first();
        $data = [
            'name' => 'Teszt Versenyző',
            'email' => 'teszt@example.com',
            'round_id' => $round->id,
        ];

        $response = $this->post('/competitorAdd', $data);
        $response->assertStatus(200);

        // Ellenőrizzük, hogy a versenyző létrejött-e az adatbázisban
        $this->assertDatabaseHas('competitor', $data);
    }

    public function testCompetitorDestroy()
    {
        // Versenyző létrehozása
        $round = Round::first();
        $data = [
            'name' => 'Teszt Versenyző',
            'email' => 'teszt@example.com',
            'round_id' => $round->id,
        ];

        Competitor::create($data);

        // Versenyző törlése és ellenőrzése
        $response = $this->delete('/competitorDel', $data);
        $response->assertStatus(200);

        // Ellenőrizzük, hogy a versenyző eltűnt-e az adatbázisból
        $this->assertDatabaseMissing('competitor', $data);
    }


}
