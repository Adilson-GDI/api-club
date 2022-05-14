<?php

namespace App\Http\Controllers\Professionals;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SearchLogRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Http\Resources\Professionals\StoreResource;
use App\Http\Resources\Professionals\AllStoresResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StoresController extends Controller
{
    /**
     * @var array
     */
    private $stores = [];

    /**
     * Relacionamentos que serão adicionados a toda requisição de lojista
     *
     * @var string[]
     */
    protected $relationsDefault = [
        'type',
        'status',
        'store',
        'segments',
        'actingRegions'
    ];

    public function __construct(Request $request)
    {
        $this->setPerPage($request);
    }

    /**
     * Lista de lojistas
     *
     * @Route('/stores', ['GET'])
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function list(Request $request): AnonymousResourceCollection
    {
        $this->stores = User::stores()
            ->with($this->relationsDefault);

        $this->applyFilters($request);

        $this->stores = $this->stores->active()
            ->stores()
            ->orderBy('account_verified_at', 'DESC')->paginate($this->perPage);

        /** Salva termo de busca */
        if ($request->name) SearchLogRepository::save($request->name, auth('api')->user());

        return StoreResource::collection($this->stores);
    }

    /**
     * Lista de lojistas
     *
     * @Route('/stores', ['GET'])
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function listAll(Request $request): AnonymousResourceCollection
    {
        $this->stores = User::stores()->active()
            ->with(['store','segments','actingRegions'])
            ->orderBy('id', 'DESC')->get();

        return AllStoresResource::collection($this->stores);
    }

    /**
     * Perfil de lojista
     *
     * @Route('/store/{id}', ['GET'])
     * @param Request $request
     * @return StoreResource
     */
    public function view(Request $request)
    {
        $store = User::stores()
            ->active()
            ->where('id', $request->id)
            ->with($this->relationsDefault)
            ->first();

        return new StoreResource($store);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function applyFilters(Request $request): void
    {
        $this->applyFilterName($request);
        $this->applyFilterRegion($request);
        $this->applyFilterActingRegion($request);
    }

    /**
     * @param $request
     * @return void
     */
    public function applyFilterName($request): void
    {
        if ($request->name) {
            $this->stores->where(function ($stores) use ($request) {
                $stores->orWhere('name', 'like', '%'.request('name').'%')
                    ->orWhere('email', 'like', '%'.request('name').'%')
                    ->orWhereRelation('store', 'store_name', 'like', '%' . $request->name . '%')
                    ->orWhereHas('tags', function($tags) use ($request) {
                        $tags->where('name', 'like', '%' . $request->name . '%');
                    })
                    ->orWhereHas('informations', function($informations) use ($request) {
                        $informations->whereIn('information_id', ['16', '17']);
                        $informations->where('content', 'like', '%' . $request->name . '%');
                    });
            });
        }
    }

    /**
     * @param $request
     * @return void
     */
    public function applyFilterRegion($request): void
    {
        if (is_numeric($request->segment)) {
            $this->stores->whereHas('segments', function($segments) use ($request) {
                $segments->where('segment_id', '=', $request->segment);
            });
        }
    }

    /**
     * @param $request
     * @return void
     */
    public function applyFilterActingRegion($request): void
    {
        if (is_numeric($request->region)) {
            $this->stores->whereHas('actingRegions', function($actingRegions) use ($request) {
                $actingRegions->where('acting_region_id', '=', $request->region);
                $actingRegions->where('active', '=', 'yes');
            });
        }
    }
}
