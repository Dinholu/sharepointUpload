<?php

namespace SharepointUpload\SharepointUpload;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SharepointUpload\SharepointUpload\Skeleton\SkeletonClass
 */
class SharepointUploadFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sharepoint-upload';
    }
}
