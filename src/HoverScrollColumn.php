<?php

declare(strict_types = 1);

namespace Wagnerbugs\FilamentHoverScrollColumn;

use Closure;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use Throwable;

class HoverScrollColumn extends TextColumn
{
    protected int | Closure $scrollSpeed = 50;

    protected int | Closure $edgePauseMs = 600;

    protected string | Closure | null $viewportWidth = '200px';

    /**
     * Scrolling speed in pixels per second.
     */
    public function scrollSpeed(int | Closure $pixelsPerSecond): static
    {
        $this->scrollSpeed = $pixelsPerSecond;

        return $this;
    }

    /**
     * Pause (in milliseconds) before scrolling starts and after it resets.
     */
    public function edgePause(int | Closure $milliseconds): static
    {
        $this->edgePauseMs = $milliseconds;

        return $this;
    }

    /**
     * Fixed visible width of the column viewport, e.g. "200px" or "16rem".
     */
    public function viewportWidth(string | Closure | null $width): static
    {
        $this->viewportWidth = $width;

        return $this;
    }

    public function getScrollSpeed(): int
    {
        return (int) $this->evaluate($this->scrollSpeed);
    }

    public function getEdgePauseMs(): int
    {
        return (int) $this->evaluate($this->edgePauseMs);
    }

    public function getViewportWidth(): ?string
    {
        return $this->evaluate($this->viewportWidth);
    }

    /**
     * @throws Throwable
     */
    #[\Override]
    public function toEmbeddedHtml(): string
    {
        $state = $this->getState();

        if ($state instanceof Collection) {
            $state = $state->all();
        }

        if (is_array($state)) {
            $text = implode(', ', array_map(
                $this->formatStateForDisplay(...),
                $state,
            ));
        } else {
            $text = $this->formatStateForDisplay($state);
        }

        return view('hover-scroll-column::hover-scroll-column', [
            'text'          => $text,
            'viewportWidth' => $this->getViewportWidth(),
            'scrollSpeed'   => $this->getScrollSpeed(),
            'edgePauseMs'   => $this->getEdgePauseMs(),
            'attributes'    => $this->getExtraAttributeBag(),
        ])->render();
    }

    protected function formatStateForDisplay(mixed $state): string
    {
        $formatted = $this->formatState($state);

        return $formatted instanceof Htmlable
            ? $formatted->toHtml()
            : e((string) $formatted);
    }
}
