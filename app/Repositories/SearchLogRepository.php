<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\SearchLog;

class SearchLogRepository
{
    /**
     * @param $searchTerm
     * @param User $user
     * @return void
     * @throws void
     */
    public static function save($searchTerm, User $user): void
    {
        $searchlog = new SearchLog();
        $searchlog->search_term = $searchTerm;
        $searchlog->user_id = $user->id;
        $searchlog->user_type_id = $user->type_user_id;
        $searchlog->created_at = now();

        if (! $searchlog->save())
            throw new \Exception("Não foi possivel salvar o termo de busca");
    }
}
