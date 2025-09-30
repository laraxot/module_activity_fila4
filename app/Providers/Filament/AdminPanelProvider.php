<?php

declare(strict_types=1);

namespace Modules\Activity\Providers\Filament;

<<<<<<< HEAD
<<<<<<< HEAD
use Override;
=======
>>>>>>> 0a00ff2 (.)
=======
use Override;
>>>>>>> 18dcd64 (.)
use Filament\Panel;
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    protected string $module = 'Activity';

<<<<<<< HEAD
<<<<<<< HEAD
    #[Override]
    public function panel(Panel $panel): Panel
    {
=======
    public function panel(Panel $panel): Panel
    {

>>>>>>> 0a00ff2 (.)
=======
    #[Override]
    public function panel(Panel $panel): Panel
    {
>>>>>>> 18dcd64 (.)
        $panel = parent::panel($panel);

        return $panel;
    }
}
