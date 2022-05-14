<?php

namespace App\Http\Resources\Professionals;

use App\Libraries\PathLibrary;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->data = [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'account_verified_at' => $this->account_verified_at,
            'bio' => $this->professional->bio,
            'birthday' => $this->professional->birthday,
            'marital_status' => $this->professional->maritalStatus,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'type' => $this->type,
            'acting_regions' => $this->actingRegions,
        ];

        $this->loadPictures();
        $this->loadAddress();
        $this->loadInformations();
        $this->loadScores();

        return $this->data;
    }

    /**
     * @return void
     */
    public function loadInformations(): void
    {
        if ($user = Auth::guard('api')->user()) {
            $this->data['contact'] = [
                'phone' => $user->information('phone'),
                'cellphone' => $user->information('cellphone'),
                'whatsapp' => $user->information('whatsapp'),
                'skype' => $user->information('skype'),
            ];

            $this->data['links'] = [
                'site' => $user->information('site'),
                'facebook' => $user->information('facebook'),
                'twitter' => $user->information('twitter'),
                'instagram' => $user->information('instagram'),
                'youtube' => $user->information('youtube'),
                'linkedin' => $user->information('linkedin'),
                'blog' => $user->information('blog'),
                'pinterest' => $user->information('pinterest'),
            ];

            $this->data['docs'] = [
                'rg' => $user->information('rg'),
                'cpf' => $user->information('cpf'),
                'cnpj' => $user->information('cnpj'),
                'rne' => $user->information('rne'),
                'register' => $user->information('register'),
            ];

            $this->data['info'] = [
                'office' => $user->information('office'),
                'company_name' => $user->information('company_name'),
            ];
        }
    }

    /**
     * Carrega dados de imagem
     *
     * @return void
     */
    public function loadPictures(): void
    {
        $this->data['picture'] = [
            'small' => avatar_url($this->picture, 'small'),
            'normal' => avatar_url($this->picture),
            'large' => avatar_url($this->picture, 'large'),
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
                'state' => $this->address->state,
                'city' => $this->address->city
            ]
            : [];
    }

    /**
     * Carrega valores de pontuaçao do usuário
     *
     * @return void
     */
    public function loadScores(): void
    {
        $this->scores->where(function($query) {
            $query->where('expiration', '>=', now()->addYear(-2));
            $query->where('value_true', '>', 0);
        });
        $this->data['scores'] = (integer) $this->scores->sum('value');
    }

}
