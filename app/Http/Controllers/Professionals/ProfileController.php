<?php

namespace App\Http\Controllers\Professionals;

use Exception;
use App\Models\User;
use App\Models\Address;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Models\InformationType;
use App\Models\UserInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Symfony\Component\Routing\Annotation\Route;
use App\Http\Resources\Professionals\ProfileResource;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

class ProfileController extends Controller
{
    /**
     * Relacionamentos que serão adicionados a toda requisição de lojista
     *
     * @var string[]
     */
    protected $relationsDefault = [
        'type',
        'status',
        'professional',
        'address',
        'professional.occupation',
        'professional.maritalStatus',
        'professional.gender',
        'scores',
        'actingRegions'
    ];

    /**
     * Parametros permitidos via parametro para busca de dados do usuário
     *
     * @var array
     */
    protected $paramsAllowed = [];

    /**
     * @route("/profile", ["GET"])
     * @return mixed
     */
    public function profile(): mixed
    {
        $profile = Auth::guard('api')->user();

        // TODO: tornar esta linha em uma unica instrução, reutilizavel
        if (! $profile) return $this->response('Unauthenticated', 402);

        $profile->load(...$this->relationsDefault);

        return new ProfileResource($profile);
    }

    /**
     * @route("/profile", ["POST"])
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function update(Request $request)
    {
        $data = $this->filterRequest($request);

        // TODO: Validar troca de e-mail somente apos confirmação por e-mail cadastrado

        $validated = $this->validateFormRequest($request);
        // TODO: validation

        $user = Auth::guard('api')->user();

        if (! $user) return $this->response('Unauthenticated', 402);

        try {

            $user->fill($data);

            $user->save();
            $this->saveProfile($user, $data);
            $this->saveAddress($user, $data);
            $this->saveInformations($user, $data);

        } catch (Exception $e) {
            return $this->response($e->getMessage(), 400);
        }

        return $this->response('Salvo com sucesso', 200);
    }

    /**
     * @param User $user
     * @param array $data
     * @return bool
     * @throws mixed
     */
    public function saveProfile(User $user, array $data): mixed
    {
        if (! $user->professional) {
            $user->professional = new Professional();
        }

        try {
            $user->professional->fill($data);
            $user->professional->save();

            return true;

        } catch (Exception $e) {
            throw new Exception('Não foi possivel salvar perfil de profissional. Mais detalhes: ' . $e->getMessage());
        }
    }

    /**
     * @param User $user
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function saveAddress(User $user, array $data)
    {
        if (! $user->address) {
            $user->address = new Address();
        }

        try {
            $user->address->fill($data);
            $user->address->save();

            return true;

        } catch (Exception $e) {
            throw new Exception('Não foi possivel o endereço do usuário. Mais detalhes: ' . $e->getMessage());
        }
    }

    /**
     * @param User $user
     * @param array $data
     * @return void
     */
    public function saveInformations(User $user, array $data): void
    {
        $informationsType = InformationType::select(['id', 'slug'])->where('active', 'yes')->get();

        foreach ($informationsType as $informationType) {
            foreach ($data as $key => $_data) {
                if ($informationType->slug == $key) {

                    // TODO: refatorar isso aqui, retirar para outro método
                    $where = [
                        'user_id' => $user->id,
                        'information_id' => $informationType->id
                    ];

                    $information = UserInformation::where($where)->first();

                    if ($information) {

                        if ($_data == '') {
                            $information->delete();
                        } else {
                            $information->content = $_data;
                            $information->save();
                        }
                    } else {
                        if ($_data != '') {
                            $information = new UserInformation();
                            $information->fill($where);
                            $information->content = $_data;
                            $information->save();
                        }
                    }
                }
            }
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function filterRequest(Request $request)
    {
        unset($request->id);
        unset($request->user_id);

        return $request->all();
    }

    /**
     * @param Request $request
     * @return Validator
     */
    public function validateFormRequest(Request $request): Validator
    {
        return ValidatorFacade::make($request->all(), [
            'name' => 'required|max:60',
            'email' => 'required|email',
            'bio' => 'nullable|min:5',
            'birthday' => 'nullable|min:8|max:10',
            'marital_status_id' => 'nullable|integer',
            'occupation_id' => 'nullable|integer',
            'gender_id' => 'nullable|integer',
            'office' => 'nullable|min:5',
            'phone' => 'nullable|min:10|max:15',
            'cellphone' => 'nullable|min:10|max:15',
            'whatsapp' => 'nullable|min:10|max:15',
            'site' => 'nullable|min:3',
            'skype' => 'nullable|min:3|max:60',
            'blog' => 'nullable|min:3',
            'facebook' => 'nullable|min:3',
            'instagram' => 'nullable|min:3',
            'twitter' => 'nullable|min:3',
            'youtube' => 'nullable|min:3',
            'linkedin' => 'nullable|min:3',
            'pinterest' => 'nullable|min:3',
            'zipcode' => 'nullable|min:8|max:10',
            'address' => 'nullable|string|min:4|max:200',
            'number' => 'nullable',
            'neighborhood' => 'required,min:8',
            'complement' => 'nullable',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer'
        ]);
    }
}
