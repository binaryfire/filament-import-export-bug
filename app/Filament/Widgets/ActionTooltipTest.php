<?php

namespace App\Filament\Widgets;

use Livewire\Attributes\On;
use Filament\Actions\Action;
use Filament\Widgets\Widget;
use Illuminate\Support\HtmlString;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class ActionTooltipTest extends Widget implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;
    
    protected static string $view = 'filament.widgets.action-tooltip-test';

    #[On('open-test-modal')] 
    public function openTestActionModal(): void
    {
        $this->mountAction('testAction');
    }

    public function testAction(): Action
    {
        return Action::make('test')
            ->requiresConfirmation()
            ->modalHeading('Test modal')
            ->action(fn () => null)
            ->icon('heroicon-o-chat-bubble-left-ellipsis')
            ->iconButton()
            ->tooltip('Test tooltip')
            ->extraAttributes([
                'class' => 'invisible',
            ]);
    }
}
