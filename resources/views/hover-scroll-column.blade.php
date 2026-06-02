@php
    $width = $viewportWidth ?? '200px';
@endphp

<div
    {{ $attributes->class(['fi-ta-text']) }}
    x-data="{
        speed: @js($scrollSpeed),
        edgePause: @js($edgePauseMs),
        timer: null,
        distance() {
            return this.$refs.text.scrollWidth - this.$el.clientWidth;
        },
        duration() {
            return Math.max(this.distance(), 0) / this.speed * 1000;
        },
        start() {
            const distance = this.distance();
            if (distance <= 0) {
                return;
            }

            clearTimeout(this.timer);

            const el = this.$refs.text;
            el.style.transition = 'none';
            el.style.transform = 'translateX(0)';

            this.timer = setTimeout(() => {
                el.style.transition = `transform ${this.duration()}ms linear`;
                el.style.transform = `translateX(-${distance}px)`;
            }, this.edgePause);
        },
        reset() {
            clearTimeout(this.timer);

            const el = this.$refs.text;
            el.style.transition = `transform ${this.duration()}ms linear`;
            el.style.transform = 'translateX(0)';
        },
    }"
    @mouseenter="start()"
    @mouseleave="reset()"
    style="width: {{ $width }}; max-width: {{ $width }}; overflow: hidden; white-space: nowrap;"
>
    <span
        x-ref="text"
        style="display: inline-block; white-space: nowrap; will-change: transform;"
    >{!! $text !!}</span>
</div>
