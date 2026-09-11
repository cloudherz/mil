<div class="S-ARTICLES-article S-ARTICLES-article_{{ $number }}">
    <div class="S-ARTICLE-wrapper">
        <div class="S-ARTICLE-carcass">
            <div class="S-ARTICLE-headline">
                <h3 class="T-ARTICLE-headline TYPO-D-PRESET-CORE_H3">{!! $headline !!}</h3>
            </div>
            <div class="S-ARTICLE-text">
                <p class="T-ARTICLE-text TYPO-D-PRESET-CORE_P">{!! $text !!}</p>
            </div>
            <div class="S-ARTICLE-bottom">
                <div class="S-BOTTOM-wrapper">
                    <div class="S-BOTTOM-carcass">
                        <div class="S-BOTTOM-date">
                            <p class="TYPO-D-PRESET-CORE_P_ITALIC">{{ $date }}</p>
                        </div>
                        <div class="S-BOTTOM-fresh" style="visibility: {{ $fresh === 'yes' ? 'unset' : 'hidden' }};">
                            <div class="S-FRESH-wrapper">
                                <div class="S-FRESH-carcass">
                                    <p class="TYPO-D-PRESET-CORE_P">Свежее</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
