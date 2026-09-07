<div class="S-TRACK-wrapper">
    <div class="S-TRACK-carcass">
        <div class="S-TRACK-title">
            <label class="TYPO-PRESET-CORE_P_BOLD">Номинаци{{ $type === 'individual' ? 'я' : 'и' }}</label>
            <p class="T-TRACK-asterisk T-TRACK-asterisk_{{ $color }} TYPO-PRESET-CORE_P_BOLD">*</p>
        </div>
        <div class="S-TRACK-select S-TRACK-select_{{ $type }} DEV-DISABLE_SELECTION">
            <div class="S-SELECT-carcass S-SELECT-carcass_1 S-SELECT-carcass_{{ $type }} TYPO-PRESET-CORE_P">
                <x-blades.application.select_track.dropdown
                    color="{{ $color }}"
                    number="1"
                />
            </div>
            <div class="S-SELECT-carcass S-SELECT-carcass_2 S-SELECT-carcass_{{ $type }} TYPO-PRESET-CORE_P">
                <x-blades.application.select_track.dropdown
                    color="{{ $color }}"
                    number="2"
                />
            </div>
            <div class="S-SELECT-carcass S-SELECT-carcass_3 S-SELECT-carcass_{{ $type }} TYPO-PRESET-CORE_P">
                <x-blades.application.select_track.dropdown
                    color="{{ $color }}"
                    number="3"
                />
            </div>
        </div>
    </div>
</div>
