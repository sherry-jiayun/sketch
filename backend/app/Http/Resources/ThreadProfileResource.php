<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThreadProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if((!$this->is_bianyuan)||(auth('api')->check())){
            $body = $this->body;
        }else{
            $body = '';
        }
        if ((!$this->is_anonymous)||((auth('api')->check())&&(auth('api')->id()===$this->user_id))){
            $author = new AuthorIdentifierResource($this->whenLoaded('author'));
        }else{
            $author = [];
        }
        return [
            'type' => 'thread',
            'id' => (int)$this->id,
            'attributes' => [
                'title' => (string)$this->title,
                'brief' => (string)$this->brief,
                'body' => (string)$body,
                'is_anonymous' => (bool)$this->is_anonymous,
                'majia' => (string)$this->majia ?? '匿名咸鱼',
                'created_at' => (string)$this->created_at,
                'edited_at' => (string)$this->edited_at,
                'is_locked' => (bool)$this->is_locked,
                'is_public' => (bool)$this->is_public,
                'is_bianyuan' => (bool)$this->is_bianyuan,
                'no_reply' => (bool)$this->no_reply,
                'use_markdown' => (bool)$this->use_markdown,
                'use_indentation' => (bool)$this->use_indentation,
                'view_count' => (int)$this->views,
                'reply_count' => (int)$this->reply_count,
                'collection_count' => (int)$this->collections,
                'download_count' => (int)$this->downloads,
                'jifen' => (int)$this->jifen,
                'weighted_jifen' => (int)$this->weighted_jifen,
                'total_char' => (int)$this->total_char,
                'responded_at' => (string)$this->responded_at,
            ],
            'author' => $author,
            'channel' => new ChannelBriefResource($this->channel()),
            'tags' => TagInfoResource::collection($this->whenLoaded('tags')),
            'last_component' => new PostBriefResource($this->whenLoaded('last_component')),
            'last_post' => new PostBriefResource($this->whenLoaded('last_post')),
        ];
    }
}
