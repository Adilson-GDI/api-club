<?php

use App\Libraries\PathLibrary;

if (! function_exists('avatar_url')) {

    /**
     * Informa o caminho absoluto da imagem de perfil dos usuarios
     *
     * @param $image
     * @param $size
     * @return string
     */
    function avatar_url($image, $size = 'normal')
    {
        return PathLibrary::getAvatarUrl($image, $size);
    }
}

if (! function_exists('award_url')) {

    /**
     * Informa o caminho absoluto da imagem de premiações
     *
     * @param $image
     * @return string
     */
    function award_url($image)
    {
        return PathLibrary::getAwardUrl($image);
    }
}
