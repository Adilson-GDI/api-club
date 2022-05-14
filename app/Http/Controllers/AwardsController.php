<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Http\Request;
use App\Http\Resources\AwardResource;
use App\Http\Resources\AwardsResource;
use Symfony\Component\Routing\Annotation\Route;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AwardsController extends Controller
{
    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->setPerPage($request);
    }

    /**
     * @Route('/awards/', ['GET'])
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function list(Request $request): AnonymousResourceCollection
    {
        $awards = Award::with([
                'category',
                'files',
                'packages' => fn ($query) => $query->active()
            ])
            ->active()
            ->paginate($this->perPage);

        return AwardsResource::collection($awards);
    }

    /**
     * Perfil de lojista
     *
     * @Route('/award/{id}', ['GET'])
     * @param Request $request
     * @return AwardResource
     */
    public function view(Request $request, $id): AwardResource
    {
        $award = Award::find($id);

        $award->load([
            'category',
            'files',
            'packages' => fn ($query) => $query->active(),
            'landingPage'
        ]);

        return new AwardResource($award);
    }
}
