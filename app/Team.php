<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $fillable = ['name', 'size'];

    public function add($user)
    {
        //guard
        $this->guardAgainstTooManyMembers();

        $method = $user instanceof USER ? 'save' : 'saveMany';
        $this->members()->$method($user);
    }

    public function members()
    {
         return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    public function remove($user)
    {
        return $user->leaveTeam();
    }

    public function removeAll()
    {
        return $this->members()->update(['team_id' => null]);
    }

    protected function guardAgainstTooManyMembers()
    {
        if($this->count() >= $this->size)
            throw new \Exception;
    }


}
