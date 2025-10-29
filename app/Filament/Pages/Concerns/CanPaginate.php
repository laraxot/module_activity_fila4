<?php

declare(strict_types=1);

namespace Modules\Activity\Filament\Pages\Concerns;

use Filament\Tables\Enums\PaginationMode;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

trait CanPaginate
{
    /**
     * @var int|string|null
     */
    public $recordsPerPage;

    protected int|string|null $defaultRecordsPerPageSelectOption = null;

    public function updatedRecordsPerPage(): void
    {
        session()->put([
            $this->getPerPageSessionKey() => $this->getRecordsPerPage(),
        ]);

        $this->resetLivewirePage();
    }

    protected function paginateQuery(Builder $query): Paginator|CursorPaginator
    {
        $perPage = $this->getRecordsPerPage();

        $mode = $this->getPaginationMode();

        if (PaginationMode::Simple === $mode) {
            return $query->simplePaginate(
                perPage: ('all' === $perPage) ? $query->toBase()->getCountForPagination() : (int)$perPage,
                pageName: $this->getPaginationPageName(),
            );
        }

        if (PaginationMode::Cursor === $mode) {
            return $query->cursorPaginate(
                perPage: ('all' === $perPage) ? $query->toBase()->getCountForPagination() : (int)$perPage,
                cursorName: $this->getPaginationPageName(),
            );
        }

        $total = $query->toBase()->getCountForPagination();

        /** @var LengthAwarePaginator $records */
        $records = $query->paginate(
            perPage: ('all' === $perPage) ? $total : (int)$perPage,
            pageName: $this->getPaginationPageName(),
            total: $total,
        );

        return $records->onEachSide(0);
    }

    public function getRecordsPerPage(): int|string|null
    {
        return $this->recordsPerPage;
    }

    public function getTablePage(): int
    {
        return (int)$this->getPage($this->getPaginationPageName());
    }

    public function getDefaultRecordsPerPageSelectOption(): int|string
    {
        $option = session()->get(
            $this->getPerPageSessionKey(),
            $this->defaultRecordsPerPageSelectOption,
        );

        $pageOptions = $this->getRecordsPerPageSelectOptions();

        if (is_array($pageOptions) && in_array($option, $pageOptions)) {
            return (int)$option;
        }

        session()->remove($this->getPerPageSessionKey());

        return (int)($pageOptions[0] ?? 10);
    }

    public function getPaginationPageName(): string
    {
        return 'recordsPerPage';
    }

    public function getPerPageSessionKey(): string
    {
        $name = md5($this::class);

        return "pages.{$name}_per_page";
    }

    /**
     * @return array<int|string>|null
     */
    protected function getRecordsPerPageSelectOptions(): ?array
    {
        return [10, 25, 50];
    }
}