<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'              =>  $this->title,
            'description'        =>  $this->description,
            'photo'              =>  $this->photo == 'default.jpg' ? 'User didn\'t upload a photo for this post'  : 'User uploaded a photo for this post',
            'posted_by'          =>  $this->author,
            'likes'              =>  $this->likes == 0 ? 'No likes for this post yet' : $this->likes.' likes',
            'dislikes'           =>  $this->dislikes == 0 ? 'No likes for this post yet' : $this->dislikes,
            'links'              =>  [
                    'go_to_user_profile' =>  url('http://dev.socialblog/view/'.$this->author),    
            ]  
        ];
    }
}
