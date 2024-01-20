<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use Filament\Actions\Action;
use Illuminate\Support\HtmlString;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class FilamentPanelSidebarHeader extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function testHeaderAction(): Action
    {
        return Action::make('testHeader')
            ->label('Some important action')
            ->action(fn () => null)
            //->action(fn () => $this->dispatch('open-test-modal'))
            ->extraAttributes([
                'class' => 'w-full',
                'x-on:click' => new HtmlString("\$wire.dispatch('open-test-modal')"),
            ]);
    }

    public function render()
    {
        return view('filament.panel-sidebar-header');
    }
}
