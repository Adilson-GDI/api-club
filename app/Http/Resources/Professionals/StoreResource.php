<?php

namespace App\Http\Resources\Professionals;

use App\Libraries\PathLibrary;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
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
//            'account_verified_at' => $this->account_verified_at,
//            'store_name' => $this->store?->store_name,
//            'inauguration_date' => $this->store?->inauguration_date,
//            'number_stores' => $this->store?->number_stores,
//            'about' => $this->store?->about,
            'points_multiplies' => $this->store?->points_multiplies,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
            'phone' => $this->information('phone'),
            'cellphone' => $this->information('cellphone'),
            'whatsapp' => $this->information('whatsapp'),
            'status_name' => [
                'id' => $this->status?->id,
                'name' => $this->status?->name
            ],
            'type' => [
                'id' => $this->type?->id,
                'name' => $this->type?->name
            ],
            'segments' => $this->segments,
            'acting_regions' => $this->actingRegions
        ];

        $this->loadPictures();
        $this->loadAddress();

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
    public function loadAddress(): void
    {
        $this->data['address'] = ($this->address)
            ? [
                'address' => $this->address->address,
                'number' => $this->address->number,
                'neighborhood' => $this->address->neighborhood,
                'complement' => $this->address->complement,
                'latitude' => $this->address->latitude,
                'longitude' => $this->address->longitude,
                'zipcode' => $this->address->zipcode,
                'state_name' => $this->address->state->name,
                'state_id' => $this->address->state->id,
                'city_name' => $this->address->city->name,
                'city_id' => $this->address->city->id
            ]
            : [];
    }
}
