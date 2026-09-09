<div class="S-CONTENT-case S-CONTENT-case_{{ $color }} S-CONTENT-{{ $place }}">
    <div class="S-CASE-wrapper">
        <div class="S-CASE-carcass">
            <div class="S-CASE-heading">
                <div class="S-HEADING-wrapper">
                    <div class="S-HEADING-carcass">
                        <div class="S-HEADING-text">
                            <h3 class="T-HEADING-text T-HEADING-text_{{ $color }} TYPO-PRESET-CORE_H3">{!! $heading !!}</h3>
                        </div>
                        <div class="S-HEADING-icon">
                            <div class="S-ICON-wrapper">
                                <div class="S-ICON-carcass S-ICON-carcass_{{ $color }}">
                                    <x-svg.icons.pointer
                                        class="I-ICON-icon"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="S-CASE-info">
                <div class="S-INFO-wrapper">
                    <div class="S-INFO-carcass">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
