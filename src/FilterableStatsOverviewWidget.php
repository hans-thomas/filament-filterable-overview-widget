<?php

namespace FilterableStatsWithFormOverview\FilterableStatsOverviewWidget;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

/**
 * @property Form $form
 */
abstract class FilterableStatsOverviewWidget extends BaseWidget implements HasForms
{
    use InteractsWithActions;
    use InteractsWithFormActions;
    use InteractsWithForms;

    protected static string $view = 'filterableStatsOverviewWidget::filterable-overview';

    protected static ?string $pollingInterval = null;

    protected ?string $item_label = null;

    public ?int $item_id = null;

    protected function getColumns(): int
    {
        return 4;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Select::make('item_id')
                        ->label($this->getItemLabel())
                        ->lazy()
                        ->afterStateUpdated(fn ($state) => $this->processFormData())
                        ->searchable()
                        ->getSearchResultsUsing($this->getSearchResultsUsing())
                        ->getOptionLabelUsing($this->getOptionLabelUsing()),
                ]
            );
    }

    public function processFormData(): void
    {
        $this->form->validate();
        $this->resetCachedStats();
    }

    protected function resetCachedStats(): void
    {
        $this->cachedStats = null;
    }

    abstract protected function getSearchResultsUsing(): callable;

    abstract protected function getOptionLabelUsing(): callable;

    protected function getItemLabel(): ?string
    {
        return $this->item_label;
    }
}
