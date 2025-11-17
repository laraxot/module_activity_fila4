<?php

declare(strict_types=1);

namespace Modules\Activity\Providers;

use Modules\Xot\Providers\XotBaseRouteServiceProvider;

/**
 * Route Service Provider per il modulo Activity.
 *
 * Gestisce la registrazione delle route per il modulo Activity.
 */
class RouteServiceProvider extends XotBaseRouteServiceProvider
{
<<<<<<< HEAD
<<<<<<< HEAD
    /**
=======
   /**
>>>>>>> 0a00ff2 (.)
=======
    /**
>>>>>>> 18dcd64 (.)
     * The module namespace to assume when generating URLs to actions.
     */
    protected string $moduleNamespace = 'Modules\Activity\Http\Controllers';

    protected string $moduleDir = __DIR__;

    protected string $moduleNs = __NAMESPACE__;

    public string $name = 'Activity';
}
