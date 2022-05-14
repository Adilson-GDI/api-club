<?php
namespace App\Libraries;

class PathLibrary
{
    /**
     * Obtem pasta padrão de armazenamento de foto de perfil de usuário
     *
     * @param $image
     * @param string $size
     * @return string
     */
    public static function getAvatarUrl($image, string $size = 'normal'): string
    {
        return ($image)
            ? env('AWS_URL') . 'avatars/' . $size . '/' . $image
            : '';
    }

    /**
     * Obtem a imagem referente a experiencia
     *
     * @param $image
     * @return string
     */
    public static function getAwardUrl($image): string
    {
        return ($image)
            ? env('AWS_URL') . 'awards/' . $image
            : '';
    }
}
