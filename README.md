# Filament Hover Scroll Column

A Filament table column that smoothly scrolls overflowing text horizontally when the user hovers over the cell — a clean "marquee on hover" for long values in narrow columns. No build step, no extra CSS or JavaScript: the animation is driven by inline Alpine.js, which Filament already ships.

Compatible with **Filament v4 and v5** (Livewire v3 and v4).

## Installation

```bash
composer require wagnerbugs/filament-hover-scroll-column
```

That's it. The column registers its own view automatically, so there is nothing to publish.

## Usage

Use it anywhere you would use a `TextColumn`:

```php
use Wagnerbugs\FilamentHoverScrollColumn\HoverScrollColumn;

HoverScrollColumn::make('title')
    ->viewportWidth('220px')
    ->scrollSpeed(80)
    ->edgePause(500);
```

It also works with relationship and array state, just like `TextColumn`:

```php
HoverScrollColumn::make('description')
    ->label('Descrição')
    ->scrollSpeed(100);
```

## Options

| Method | Default | Description |
| --- | --- | --- |
| `viewportWidth(string\|Closure\|null)` | `'200px'` | Fixed visible width of the cell. Anything wider scrolls on hover. |
| `scrollSpeed(int\|Closure)` | `50` | Scrolling speed in pixels per second. |
| `edgePause(int\|Closure)` | `600` | Pause in milliseconds before scrolling starts and after it returns. |

If the text fits within `viewportWidth`, nothing animates — the column behaves like a normal truncated cell.

## Good to know

This column overrides Filament's text rendering to inject the scrolling wrapper, so the
visual extras of `TextColumn` (`badge()`, `color()`, `icon()`, `copyable()`, `limit()`, etc.)
do **not** apply. State formatting (`formatStateUsing()`, `searchable()`, `sortable()`) works
as usual. If you need one of those visual extras, adapt the Blade view in
`resources/views/hover-scroll-column.blade.php`.

## Requirements

- PHP 8.3+ (uses the `#[\Override]` attribute; drop it and the `php` constraint can be `^8.2`)
- Filament v4 or v5

## License

The MIT License (MIT). See [LICENSE.md](LICENSE.md).
