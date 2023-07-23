<?php

namespace MHasnainJafri\Cpanel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MHasnainJafri\Cpanel\Skeleton\SkeletonClass
 */
class CpanelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cpanel';
    }
}
