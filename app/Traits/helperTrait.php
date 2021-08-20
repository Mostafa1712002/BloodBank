<?php

namespace App\Traits;
trait helperTrait
{

    /**
     * @imageRequest the image which come from the fill form
     * @placeMove the place will this method move the image to it .
     */
    public function uploadImages($imageRequest, $placeMove)
    {
        $img = time() . md5(uniqid()) . "." . $imageRequest->guessExtension();
        $imageRequest->move(public_path("$placeMove"), $img);
        return $img;
    }

}
