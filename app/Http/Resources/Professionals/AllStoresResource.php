<?php

namespace App\Http\Resources\Professionals;

use App\Libraries\PathLibrary;
use Illuminate\Http\Resources\Json\JsonResource;

class AllStoresResource extends JsonResource
{
    /**
     * @param $resource
     * @param $list
     */
    public function __construct($resource, $list = true)
    {
        parent::__construct($resource);
    }

    /**
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * @var array
     */
    private $data = [];

    /**
     * Transform the resource into an array.
     * @route() [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->data = [
            'id' => $this->id,
            'name' => $this->store?->store_name,//$this->name,
            'username' => $this->username,
            'email' => $this->email,
//            'status' => [
//                'id' => $this->status?->id,
//                'name' => $this->status?->name
//            ],
//            'type' => [
//                'id' => $this->type?->id,
//                'name' => $this->type?->name
//            ],
            'segments' => $this->segments,
            'acting_regions' => $this->actingRegions
        ];

        $this->loadPictures();
//        $this->loadAddress();

        return $this->data;
    }

    /**
     * Carrega dados de imagem
     *
     * @return void
     */
    public function loadPictures(): void
    {
        $this->data['picture'] = [
            'small' => PathLibrary::getAvatarUrl($this->picture, 'small'),
            'normal' => PathLibrary::getAvatarUrl($this->picture),
            'large' => PathLibrary::getAvatarUrl($this->picture, 'large'),
        ];
    }

    /**
     * Carrega dados de endereço
     *
     * @return void
     */
//    public function loadAddress(): void
//    {
//        $this->data['address'] = ($this->address)
//            ? [
//                'address' => $this->address->address,
//                'number' => $this->address->number,
//                'neighborhood' => $this->address->neighborhood,
//                'complement' => $this->address->complement,
//                'latitude' => $this->address->latitude,
//                'longitude' => $this->address->longitude,
//                'zipcode' => $this->address->zipcode,
//                'state_name' => $this->address->state->name,
//                'state_id' => $this->address->state->id,
//                'city_name' => $this->address->city->name,
//                'city_id' => $this->address->city->id
//            ]
//            : [];
//    }
}
