<?php

declare(strict_types=1);

namespace Modules\Activity\Providers;

<<<<<<< HEAD
use Override;
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Override;
=======
>>>>>>> a12f125f4a (.)
=======
use Override;
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Modules\Xot\Providers\XotBaseServiceProvider;

/**
 * Service Provider per il modulo Activity.
 *
 * Gestisce la registrazione e il boot del modulo per il tracciamento delle attività utente.
 *
 * @phpstan-type ModuleConfig array{name: string, alias: string, description: string, keywords: array<int, string>, priority: int, providers: array<int, class-string>}
 */
class ActivityServiceProvider extends XotBaseServiceProvider
{
    /**
     * Nome del modulo.
     *
     * @var string
     */
    public string $name = 'Activity';

    /**
     * Directory del modulo.
     *
     * @var string
     */
    protected string $module_dir = __DIR__;

    /**
     * Namespace del modulo.
     *
     * @var string
     */
    protected string $module_ns = __NAMESPACE__;

    /**
     * Boot del service provider.
     *
     * Configura il modulo Activity e registra le configurazioni specifiche.
     *
     * @return void
     */
<<<<<<< HEAD
    #[Override]
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> a12f125f4a (.)
=======
    #[Override]
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    public function boot(): void
    {
        parent::boot();

        // Registro solo le configurazioni specifiche del modulo
        $this->registerConfig();
    }

    /**
     * Registra i servizi del provider.
     *
     * @return void
     */
<<<<<<< HEAD
    

=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    

=======
=======
>>>>>>> origin/develop
    public function register(): void
    {
        parent::register();
        // Additional register logic can be added here
    }
    
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
    

>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    /**
     * Registra le configurazioni del modulo.
     *
     * @return void
     */
<<<<<<< HEAD
    #[Override]
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> a12f125f4a (.)
=======
    #[Override]
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->name, 'config/config.php') => config_path('activity.php'),
        ], 'config');
<<<<<<< HEAD

        $this->mergeConfigFrom(module_path($this->name, 'config/config.php'), 'activity');
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

        $this->mergeConfigFrom(module_path($this->name, 'config/config.php'), 'activity');
=======
=======
>>>>>>> origin/develop
        
        $this->mergeConfigFrom(
            module_path($this->name, 'config/config.php'), 'activity'
        );
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======

        $this->mergeConfigFrom(module_path($this->name, 'config/config.php'), 'activity');
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    }
}
