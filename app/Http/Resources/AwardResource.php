<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AwardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->data = [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'slug' => $this->slug,
            'picture' => award_url($this->picture),
            'size' => $this->size,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'can_view' => $this->can_view,
            'can_redeem' => $this->can_redeem,
            'description' => $this->description,
            'type' => $this->type,
            'category' => $this->category,
            'position' => $this->position,
            'active' => $this->active,
        ];

        $this->loadPackages();
        $this->loadFiles();
        $this->loadLandingPage();

        return $this->data;
    }

    /**
     * @return void
     */
    public function loadPackages(): void
    {
        $this->data['packages'] = $this->packages;
    }

    /**
     * @return void
     */
    public function loadFiles(): void
    {
        $this->data['files'] = collect($this->files)->map(function ($file) {
            $file->url = award_url($file->name);
            return $file;
        });
    }

    /**
     * @return void
     */
    public function loadLandingPage(): void
    {
        $this->data['landingPage'] = $this->landingPage;
    }
}
