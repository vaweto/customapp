<?php

namespace Tests\Feature;

use App\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function a_team_has_a_name()
    {
        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme',$team->name);
    }

    /** @test */
    public function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $team->add($user);
        $team->add($userTwo);

        $this->assertEquals(2,$team->count());
    }

    /** @test */
    public function a_team_has_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $userone = factory(User::class)->create();
        $userTwo = factory(User::class)->create();
        $userThree = factory(User::class)->create();

        $team->add($userone);
        $team->add($userTwo);


        $this->assertEquals(2,$team->count());

        $this->expectException(\Exception::class);
        $team->add($userThree);

    }

}
