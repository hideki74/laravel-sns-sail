<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CardList extends Model
{
    use HasFactory;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function card(): HasMany {
        return $this->hasMany(Card::class);
    }

    public function createCardJson(): string {

    }

    public function parseCardJson() {
        $json = '[
            {
                "cards": [],
                "title": "ff"
            },
            {
                "cards": [
                    {
                        "body": "ff"
                    },
                    {
                        "body": "aaaa"
                    }
                ],
                "title": "fffe"
            }
        ]';
    }

}
