<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Competition;

class CompetitionControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCompetitionIndex()
    {
        // Lekérjük az összes versenyt és ellenőrizzük a válasz státuszát
        $response = $this->get('/competitions');
        $response->assertStatus(200);

        // Teszteljük, hogy a válasz tartalmazza az elvárt versenyeket
        $competition = Competition::first();
        $response->assertJsonFragment([
            'name' => $competition->name,
            'year' => $competition->year,
            'location' => $competition->location,
        ]);
    }

    public function testCompetitionCreate()
    {
        // Új verseny létrehozása és ellenőrzése
        $data = [
            'name' => 'Teszt Verseny',
            'year' => 2023,
            'location' => 'Teszt Helyszín',
        ];

        $response = $this->post('/competitionAdd', $data);
        $response->assertStatus(200);

        // Ellenőrizzük, hogy a verseny létrejött-e az adatbázisban
        $this->assertDatabaseHas('competition', $data);
    }

    public function testCompetitionDestroy()
    {
        // Verseny létrehozása
        $data = [
            'name' => 'Teszt Verseny',
            'year' => 2023,
            'location' => 'Teszt Helyszín',
        ];

        Competition::create($data);

        // Verseny törlése és ellenőrzése
        $response = $this->delete('/competitionDel', $data);
        $response->assertStatus(200);

        // Ellenőrizzük, hogy a verseny eltűnt-e az adatbázisból
        $this->assertDatabaseMissing('competition', $data);
    }
}
