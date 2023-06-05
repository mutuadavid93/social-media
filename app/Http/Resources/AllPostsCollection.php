<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

/*
|--------------------------------------------------------------------------
| Get All the data for all the Posts that are created
|--------------------------------------------------------------------------
|
| Create Response using Eloquent Relationships
|
| TIP: since it's a collection, all posts will have below same structure in json
|
*/

class AllPostsCollection extends ResourceCollection
{

    /*
    |--------------------------------------------------------------------------
    | Resource Collection
    |--------------------------------------------------------------------------
    |
    | Here is where you can structure data from Models and their relationships to
    | and return them as JSON.
    | 
    | TIP: When "data" property is explicitly specified in the return type,
    | the toArray() return type is `array`;
    | 
    | TIP: When implicitly inferred, return type is `JsonSerializable`
    | 
    | HINT: Union type is the best.
    |
    */


    public function toArray(Request $request): array|JsonSerializable
    {
        // NOTE: $item : references the post being passed in below context
        return [
            "data" => $this->collection->map(function ($item) {
                return [
                    // All the posts data
                    'id' => $item->id,
                    'text' => $item->text,
                    'image' => $item->image,
                    'created_at' => $item->created_at->format('M D Y'),

                    // Comments associated with the post. Since 'hasMany' is being used we have to loop.
                    'comments' => $item->comments->map(function ($comment) {
                        return [
                            'id' => $comment->id,
                            'text' => $comment->text,

                            // User who made the comment. Since we are using 'belongsTo' so won't need to loop.
                            'user' => [
                                'id' => $comment->user->id,
                                'name' => $comment->user->name,
                                'image' => $comment->user->image,
                            ]
                        ];
                    }),

                    // Another 'belongsTo' relationship thus no looping
                    'user' => [
                        'id' => $item->user->id,
                        'name' => $item->user->name,
                        'image' => $item->user->image,
                    ]
                ];
            }),
            'meta' => [
                'total' => $this->collection->count(),
            ],
        ];


    }
}
