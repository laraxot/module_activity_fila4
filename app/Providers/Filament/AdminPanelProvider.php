<?php

declare(strict_types=1);

namespace Modules\Activity\Providers\Filament;

<<<<<<< HEAD
use Override;
=======
>>>>>>> 0a00ff2 (.)
use Filament\Panel;
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    protected string $module = 'Activity';

<<<<<<< HEAD
    #[Override]
    public function panel(Panel $panel): Panel
    {
=======
    public function panel(Panel $panel): Panel
    {

>>>>>>> 0a00ff2 (.)
        $panel = parent::panel($panel);

        return $panel;
    }
}
