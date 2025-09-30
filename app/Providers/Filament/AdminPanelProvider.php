<?php

declare(strict_types=1);

namespace Modules\Activity\Providers\Filament;

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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    #[Override]
    public function panel(Panel $panel): Panel
    {
=======
    public function panel(Panel $panel): Panel
    {

>>>>>>> a12f125f4a (.)
=======
    #[Override]
    public function panel(Panel $panel): Panel
    {
>>>>>>> b93ef594b4 (.)
=======
    public function panel(Panel $panel): Panel
    {

>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        $panel = parent::panel($panel);

        return $panel;
    }
}
