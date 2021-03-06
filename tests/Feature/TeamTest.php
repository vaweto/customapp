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

    /** @test  */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function a_team_has_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $userone = factory(User::class)->create();
        $userTwo = factory(User::class)->create();


        $team->add($userone);
        $team->add($userTwo);


        $this->assertEquals(2,$team->count());

        $this->expectException(\Exception::class);
        $userThree = factory(User::class)->create();
        $team->add($userThree);

    }

    /** @test  */
    public function a_team_has_a_maximum_size_when_pass_a_collection()
    {
        $team = factory(Team::class)->create(['size'=>2]);

        $users = factory(User::class, 3)->create();

        $this->expectException(\Exception::class);

        $team->add($users);
    }

    /** @test  */
    public function a_team_can_remove_a_member()
    {
        $team = factory(Team::class)->create(['size'=> 2]);

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $team->remove($users[0]);

        $this->assertEquals(1, $team->count());
    }

    /** @test  */
    public function a_team_can_remove_all_members_at_once()
    {
        $team = factory(Team::class)->create(['size'=>5]);

        $users = factory(User::class, 5)->create();

        $team->add($users);

        $team->removeAll();

        $this->assertEquals(0, $team->count());
    }


}
