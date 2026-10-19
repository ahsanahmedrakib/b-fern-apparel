<?php

namespace App\Features\Teams\Models;

use Database\Factories\TeamMemberFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseFactory(TeamMemberFactory::class)]
class TeamMember extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'position',
        'photo',
    ];

    public function photoUrl(): string
    {
        return asset('images/teams/'.$this->photo);
    }

    public function initials(): string
    {
        $parts = preg_split('/\s+/', trim($this->name)) ?: [];

        $initials = array_map(
            fn (string $part): string => mb_strtoupper(mb_substr($part, 0, 1)),
            array_slice($parts, 0, 2),
        );

        return implode('', $initials);
    }

    /**
     * @param  Builder<TeamMember>  $query
     */
    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('id');
    }
}
