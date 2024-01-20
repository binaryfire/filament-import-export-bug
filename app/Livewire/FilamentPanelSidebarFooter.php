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

class FilamentPanelSidebarFooter extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function testFooterAction(): Action
    {
        return Action::make('testFooterAction')
            ->action(fn () => null)
            //->action(fn () => $this->dispatch('open-test-modal'))            
            ->icon('heroicon-o-chat-bubble-left-ellipsis')
            ->iconButton()
            ->tooltip('Test footer action')
            ->extraAttributes([
                'class' => 'border border-gray-500',
                'x-on:click' => new HtmlString("\$wire.dispatch('open-test-modal')"),                
            ]);
            
    }

    public function render()
    {
        return view('filament.panel-sidebar-footer');
    }
}
