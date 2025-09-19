<?php

declare(strict_types=1);

namespace Modules\Activity\Providers;

<<<<<<< HEAD
use Override;
=======
>>>>>>> 0a00ff2 (.)
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
>>>>>>> 0a00ff2 (.)
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
    public function register(): void
    {
        parent::register();
        // Additional register logic can be added here
    }
    
>>>>>>> 0a00ff2 (.)
    /**
     * Registra le configurazioni del modulo.
     *
     * @return void
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 0a00ff2 (.)
    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->name, 'config/config.php') => config_path('activity.php'),
        ], 'config');
<<<<<<< HEAD

        $this->mergeConfigFrom(module_path($this->name, 'config/config.php'), 'activity');
=======
        
        $this->mergeConfigFrom(
            module_path($this->name, 'config/config.php'), 'activity'
        );
>>>>>>> 0a00ff2 (.)
    }
}
