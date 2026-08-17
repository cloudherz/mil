@extends('layouts.app')

@section('meta-title', '«МИЛ» Премия Молодые Инновационные Лидеры')
@section('meta-description', '')
@section('meta-image', '')
@section('meta-url', '')

@section('mode-desktop')
    <header class="S-DESKTOP-header">
        <div class="S-HEADER-wrapper">
            <div class="S-HEADER-carcass S-HEADER-carcass_transparent" id="LANDING-HEADER-CARCASS">
                <div class="S-HEADER-content">
                    <div class="S-CONTENT-wrapper">
                        <div class="S-CONTENT-carcass">
                            <div class="S-CONTENT-list">
                                <div class="S-LIST-wrapper">
                                    <div class="S-LIST-carcass TYPO-PRESET-HEADER_TEXT">
                                        <a class="L-LIST-image" href="#hero">
                                            <x-svg.logo.color_full
                                                class="I-LIST-logo"
                                            />
                                        </a>
                                        <a class="L-LIST-text" href="#goals">Цели</a>
                                        <a class="L-LIST-text" href="#tracks">Треки</a>
                                        <a class="L-LIST-text" href="#prizes">Награды</a>
                                        <a class="L-LIST-text" href="#news">Новости</a>
                                    </div>
                                </div>
                            </div>
                            <div class="S-CONTENT-button">
                                <div class="S-BUTTON-wrapper">
                                    <div class="S-BUTTON-carcass">
                                        <button class="B-BUTTON-button B-BUTTON-button_transparent TYPO-PRESET-HEADER_TEXT" id="LANDING-HEADER-ACTION_BUTTON">Подать заявку</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="S-DESKTOP-main">
        <div class="S-MAIN-wrapper">
            <div class="S-MAIN-carcass">
                <div class="S-MAIN-hero" id="hero">
                    <div class="S-HERO-wrapper">
                        <div class="S-HERO-carcass">
                            <div class="S-HERO-background">
                                <div class="S-BACKGROUND-wrapper">
                                    <div class="S-BACKGROUND-carcass">
                                        <x-svg.backgrounds.hero
                                            class="I-BACKGROUND-shape"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="S-HERO-content">
                                <div class="S-CONTENT-wrapper">
                                    <div class="S-CONTENT-carcass">
                                        <div class="S-CONTENT-logo DEV-DISABLE_SELECTION">
                                            <x-svg.logo.color_full
                                                class="I-CONTENT-logo"
                                            />
                                        </div>
                                        <div class="S-CONTENT-heading">
                                            <h1 class="TYPO-PRESET-HERO_HEADING">молодые инновационные<br>
                                                лидеры</h1>
                                        </div>
                                        <div class="S-CONTENT-rair">
                                            <h2 class="TYPO-PRESET-HERO_DESCRIPTION">премия российской ассоциации инновационного развития</h2>
                                            <img class="I-CONTENT-rair DEV-DISABLE_SELECTION" src="{{ asset('images/rair/color_full.png') }}" alt="Логотип РАИР" title="Логотип РАИР" draggable="false">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-goals" id="goals">
                    <div class="S-GOALS-wrapper">
                        <div class="S-GOALS-carcass">
                            <div class="S-GOALS-title">
                                <h2 class="TYPO-PRESET-CORE_H2">Цели премии</h2>
                            </div>
                            <div class="S-GOALS-cards">
                                <div class="S-CARDS-wrapper">
                                    <div class="S-CARDS-carcass">
                                        <x-blades.goals.card
                                            number="1"
                                            color="blue"
                                            icon="passport"
                                            icon_rotate="-9deg"
                                            icon_transform="scale(102%) translateY(5%)"
                                            background_transform="scale(250%) translateX(-16%) translateY(1%) rotate(8deg)"
                                            title="Госповестка<br>работает на нас"
                                            text1="Курс на технологический суверенитет и развитие регионов: спрос на «своих» инноваторов как никогда высок."
                                            text2="Курс на технологический суверенитет и развитие регионов: спрос на «своих» инноваторов как никогда высок."
                                        />
                                        <x-blades.goals.card
                                            number="2"
                                            color="green"
                                            icon="connections"
                                            icon_rotate="-8deg"
                                            icon_transform="scale(100%)"
                                            background_transform="scale(218%) translateX(-48%) translateY(-18%) rotate(7deg)"
                                            title="Нет единой<br>точки входа"
                                            text1="Сильные молодые лидеры разрознены — нет федеральной площадки, где их одновременно видят государство, корпорации и капитал."
                                            text2="Сильные молодые лидеры разрознены — нет федеральной площадки, где их одновременно видят государство, корпорации и капитал."
                                        />
                                        <x-blades.goals.card
                                            number="3"
                                            color="green"
                                            icon="map"
                                            icon_rotate="0"
                                            icon_transform="scale(88%)"
                                            background_transform="scale(195%) translateX(-15%) translateY(-10%) rotate(6deg)"
                                            title="Регионам нужны<br>команды"
                                            text1="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                            text2="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                        />
                                        <x-blades.goals.card
                                            number="4"
                                            color="blue"
                                            icon="cup"
                                            icon_rotate="-7deg"
                                            icon_transform="scale(88%)"
                                            background_transform="scale(195%) translateX(-20%) translateY(3%) rotate(7deg)"
                                            title="Старые премии<br>устарели"
                                            text1="Награды для «подающих надежды» не отражают тех, кто уже построил бизнес, команду и измеримый эффект."
                                            text2="Награды для «подающих надежды» не отражают тех, кто уже построил бизнес, команду и измеримый эффект."
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-blades.main.rair
                    number="1"
                    heading="Создано в сотрудничестве с РАИР"
                    text="Действует с июня 2008 года. На сегодняшний день объединяет более 1400 членов<br>
                        из 28 регионов. За время работы РАИР стала рупором общественного мнения<br>
                        по стратегическим векторам инновационного развития страны и регионов."
                />
                <div class="S-MAIN-tracks" id="tracks">
                    <div class="S-TRACKS-wrapper">
                        <div class="S-TRACKS-carcass">
                            <div class="S-TRACKS-title">
                                <h2 class="TYPO-PRESET-CORE_H2">Треки</h2>
                            </div>
                            <div class="S-TRACKS-cards">
                                <div class="S-CARDS-wrapper">
                                    <div class="S-CARDS-carcass">
                                        <x-blades.tracks.card
                                            number="1"
                                            color="blue"
                                            icon="briefcase"
                                            icon_scale="4.6vh"
                                            background_transform="scale(190%) translateX(15%) translateY(72%) rotate(-8deg)"
                                            heading="Технологии и Бизнес"
                                            text="<span>
                                                Описание:<br><br>
                                                для основателей науĸоёмĸих ĸомпаний, создавших униĸальный продуĸт на основе собственной разработĸи или патента.
                                                </span>
                                                <span>
                                                Критерий:<br><br>
                                                научная новизна, наличие интеллеĸтуальной собственности, первые ĸоммерчесĸие ĸонтраĸты.
                                                </span>
                                                <span>
                                                Пример ĸандидата:<br><br>
                                                Анна Воронцова, 31 год — основатель «НейроСинтез», разработчиĸа отечественных нейроморфных чипов. 12 патентов, выход из лаборатории МФТИ, первый ĸонтраĸт с предприятием Росатома на партию вычислительных модулей.
                                                </span>"
                                        />
                                        <x-blades.tracks.card
                                            number="2"
                                            color="green"
                                            icon="office"
                                            icon_scale="4.9vh"
                                            background_transform="scale(190%) translateX(16%) translateY(71%) rotate(6deg)"
                                            heading="Корпорации и Индустрия"
                                            text="<span>
                                                Описание:<br><br>
                                                для молодых топ-менеджеров и интрапренёров, запустивших цифровую или продуĸтовую трансформацию внутри ĸрупной ĸомпании или госĸорпорации.
                                                </span>
                                                <span>
                                                Критерий:<br><br>
                                                измеримый эĸономичесĸий эффеĸт, сĸорость внедрения, тиражируемость решения на всю струĸтуру.
                                                </span>
                                                <span>
                                                Пример ĸандидата:<br><br>
                                                Марина Соĸолова, 33 года — CDO «УралМеталл». Внедрила цифровых двойниĸов на четырёх заводах, соĸратив издержĸи на 2 млрд ₽ в год и переведя планирование на предиĸтивную аналитиĸу.
                                                </span>"
                                        />
                                        <x-blades.tracks.card
                                            number="3"
                                            color="blue"
                                            icon="region"
                                            icon_scale="5.5vh"
                                            background_transform="scale(195%) translateX(-6%) translateY(64%) rotate(-7deg)"
                                            heading="Регионы и Территории"
                                            text="<span>
                                                Описание:<br><br>
                                                для лидеров, превративших регион в пилотную площадĸу для отработĸи и масштабирования инноваций.
                                                </span>
                                                <span>
                                                Критерий:<br><br>
                                                число запущенных пилотов, межрегиональная тиражируемость, вĸлад в инвестиционную привлеĸательность субъеĸта.
                                                </span>
                                                <span>
                                                Пример ĸандидата:<br><br>
                                                Алия Нургалиева, 28 лет — основатель аĸселератора при ОЭЗ «Алабуга» (Татарстан). Организовала пилотные зоны для 20 стартапов, три из ĸоторых вышли на федеральный рыноĸ.
                                                </span>"
                                        />
                                    </div>
                                    <div class="S-CARDS-carcass">
                                        <x-blades.tracks.card
                                            number="4"
                                            color="green"
                                            icon="society"
                                            icon_scale="4.5vh"
                                            background_transform="scale(140%) translateX(-1%) translateY(90%) rotate(-7deg)"
                                            heading="Общество и Будущее"
                                            text="<span>
                                                Описание:<br><br>
                                                для лидеров, чьи решения напрямую улучшают ĸачество жизни людей — в медицине, образовании, городсĸой среде, эĸологии.
                                                </span>
                                                <span>
                                                Критерий:<br><br>
                                                охват аудитории, измеримый социальный эффеĸт, внедрение в государственные или муниципальные системы.
                                                </span>
                                                <span>
                                                Пример ĸандидата:<br><br>
                                                Павел Морозов, 32 года — основатель MedTech-проеĸта «КардиоГуард», портативного прибора ĸардиодиагностиĸи. Внедрён в 200 фельдшерсĸо-аĸушерсĸих пунĸтах, соĸратил время постановĸи диагноза в отдалённых районах.
                                                </span>"
                                        />
                                        <x-blades.tracks.card
                                            number="5"
                                            color="green"
                                            icon="engineering"
                                            icon_scale="5.3vh"
                                            background_transform="scale(185%) translateX(16%) translateY(60%) rotate(10deg)"
                                            heading="Корпорации и Индустрия"
                                            text="<span>
                                                Описание:<br><br>
                                                для молодых топ-менеджеров и интрапренёров, запустивших цифровую или продуĸтовую трансформацию внутри ĸрупной ĸомпании или госĸорпорации.
                                                </span>
                                                <span>
                                                Критерий:<br><br>
                                                измеримый эĸономичесĸий эффеĸт, сĸорость внедрения, тиражируемость решения на всю струĸтуру.
                                                </span>
                                                <span>
                                                Пример ĸандидата:<br><br>
                                                Марина Соĸолова, 33 года — CDO «УралМеталл». Внедрила цифровых двойниĸов на четырёх заводах, соĸратив издержĸи на 2 млрд ₽ в год и переведя планирование на предиĸтивную аналитиĸу.
                                                </span>"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-dates" id="dates">
                    <div class="S-DATES-wrapper">
                        <div class="S-DATES-carcass">
                            <div class="S-DATES-title">
                                <h2 class="TYPO-PRESET-CORE_H2">Регламент и Даты</h2>
                            </div>
                            <div class="S-DATES-widget">
                                <div class="S-WIDGET-wrapper">
                                    <div class="S-WIDGET-carcass">
                                        <x-blades.dates.side
                                            position="left"
                                        />
                                        <x-blades.dates.column
                                            number="1"
                                            date="10 августа, 2026"
                                            description="Старт премии, начало приема заявок"
                                            state="past"
                                        />
                                        <x-blades.dates.column
                                            number="2"
                                            date="10 октября, 2026"
                                            description="Конец приема заявок, начало оценки кандидатов составом жюри"
                                            state="past"
                                        />
                                        <x-blades.dates.column
                                            number="3"
                                            date="10 февраля, 2027"
                                            description="Объявление результатов, определние лауреатов"
                                            state="present"
                                        />
                                        <x-blades.dates.column
                                            number="4"
                                            date="20 марта, 2027"
                                            description="Торжественное награждение финалистов и победителя Гран-При"
                                            state="future"
                                        />
                                        <x-blades.dates.column
                                            number="5"
                                            date="20 марта, 2027"
                                            description="Торжественное награждение финалистов и победителя Гран-При"
                                            state="future"
                                        />
                                        <x-blades.dates.side
                                            position="right"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-blades.main.rair
                    number="2"
                    heading="Создано в сотрудничестве с РАИР"
                    text="Действует с июня 2008 года. На сегодняшний день объединяет более 1400 членов<br>
                        из 28 регионов. За время работы РАИР стала рупором общественного мнения<br>
                        по стратегическим векторам инновационного развития страны и регионов."
                />
                <div class="S-MAIN-prizes" id="prizes">
                    <div class="S-PRIZES-wrapper">
                        <div class="S-PRIZES-carcass">
                            <div class="S-PRIZES-title">
                                <h2 class="TYPO-PRESET-CORE_H2">Награды</h2>
                            </div>
                            <div class="S-PRIZES-widget">
                                <div class="S-WIDGET-wrapper">
                                    <div class="S-WIDGET-carcass">
                                        <div class="S-WIDGET-fund">
                                            <h2 class="TYPO-PRESET-CORE_H2">Призовой фонд</h2>
                                            <h1 class="T-FUND-number TYPO-PRESET-PRIZES_NUMBER">2 000 000₽</h1>
                                        </div>
                                        <div class="S-WIDGET-distribution">
                                            <div class="S-DISTRIBUTION-wrapper">
                                                <div class="S-DISTRIBUTION-carcass">
                                                    <div class="S-DISTRIBUTION-background">
                                                        <div class="S-BACKGROUND-wrapper">
                                                            <div class="S-BACKGROUND-carcass">
                                                                <x-svg.backgrounds.prizes
                                                                    class="I-BACKGROUND-shape I-BACKGROUND-shape_{$number}"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="S-DISTRIBUTION-content">
                                                        <div class="S-CONTENT-wrapper">
                                                            <div class="S-CONTENT-carcass">
                                                                <div class="S-CONTENT-place S-CONTENT-laureates">
                                                                    <div class="S-LAUREATES-wrapper">
                                                                        <div class="S-LAUREATES-carcass">
                                                                            <h3 class="T-LAUREATES-heading TYPO-PRESET-CORE_H3">15 Лауреатов<br>по 5 трекам</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="S-CONTENT-pointer S-CONTENT-pointer_1">
                                                                    <x-svg.icons.pointer
                                                                        class="I-POINTER-icon"
                                                                    />
                                                                </div>
                                                                <x-blades.prizes.case
                                                                    place="finalists"
                                                                    heading="5 Финалистов"
                                                                    color="blue"
                                                                >
                                                                    <h3 class="T-INFO-text TYPO-PRESET-CORE_H3">по 200 000₽</h3>
                                                                </x-blades.prizes.case>
                                                                <div class="S-CONTENT-pointer S-CONTENT-pointer_2">
                                                                    <x-svg.icons.pointer
                                                                        class="I-POINTER-icon"
                                                                    />
                                                                </div>
                                                                <x-blades.prizes.case
                                                                    place="winner"
                                                                    heading="1 Победитель Гран-При"
                                                                    color="green"
                                                                >
                                                                    <x-svg.icons.cup
                                                                        class="I-INFO-icon"
                                                                        style=""
                                                                    />
                                                                    <h3 class="T-INFO-text TYPO-PRESET-CORE_H3">1 000 000₽</h3>
                                                                </x-blades.prizes.case>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-conditions" id="conditions">
                    <div class="S-CONDITIONS-wrapper">
                        <div class="S-CONDITIONS-carcass">
                            <div class="S-CONDITIONS-title">
                                <h2 class="TYPO-PRESET-CORE_H2">Условия участия</h2>
                            </div>
                            <div class="S-CONDITIONS-cards">
                                <div class="S-CARDS-wrapper">
                                    <div class="S-CARDS-carcass">
                                        <x-blades.conditions.card
                                            type="individual"
                                            color="blue"
                                            icon="person"
                                            icon_scale="5.9vh"
                                            background_shape="people"
                                            background_transform="scale(270%) translateX(-11%) translateY(-30.4%) rotate(-1deg)"
                                            heading="Физическое Лицо"
                                            description="Гран-При — это главная награда премии.<br>
                                                Победитель МИЛ входит в экспертный совет РАИР<br>
                                                награда премии экспертный"
                                            price="15 000₽"
                                        />
                                        <x-blades.conditions.card
                                            type="entity"
                                            color="green"
                                            icon="briefcase"
                                            icon_scale="5.4vh"
                                            background_shape="briefcases"
                                            background_transform="scale(270%) translateX(44%) translateY(-16%) rotate(45deg)"
                                            heading="Юридическое Лицо"
                                            description="Гран-При — это главная награда премии.<br>
                                                Победитель МИЛ входит в экспертный совет РАИР<br>
                                                награда премии экспертный"
                                            price="100 000₽"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-jury" id="jury">
                    <div class="S-JURY-wrapper">
                        <div class="S-JURY-carcass">
                            <div class="S-JURY-title">
                                <h2 class="TYPO-PRESET-CORE_H2">Жюри</h2>
                            </div>
                            <div class="S-JURY-cards">
                                <div class="S-CARDS-wrapper">
                                    <div class="S-CARDS-carcass">
                                        <x-blades.jury.card
                                            number="1"
                                            color="blue"
                                            name="Шичкина Марина Ивановна"
                                            title='Генеарльный директор НП "Росссийская<br>
                                                ассоциация инновационного развития"'
                                            portrait="images/people/shichkina_marina_ivanovna-portrait-01.png"
                                        />
                                        <x-blades.jury.card
                                            number="2"
                                            color="green"
                                            name="Колесников Андрей Николаевич"
                                            title='Директор аналитического консалтингового центра<br>
                                                экономического факультета МГУ им. М.В.Ломоносова'
                                            portrait="images/people/kolesnikov_andrey_nikolaevich-portrait-01.png"
                                        />
                                        <x-blades.jury.card
                                            number="3"
                                            color="green"
                                            name="Поденок Андрей Евгеньевич"
                                            title='Президент МОО "Московская<br>
                                                ассоциация предпринимателей"'
                                            portrait="images/people/podenok_andrey_evgenievich-portrait-01.png"
                                        />
                                        <x-blades.jury.card
                                            number="4"
                                            color="blue"
                                            name="Лейбинен Снежана Александровна"
                                            title='Председатель Гильдии предпринимателей<br>Турочагского района Ресублики Алтай'
                                            portrait="images/people/leybinen_snezhana_alexandrovna-portrait-01.png"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-news" id="news">
                    <div class="S-NEWS-wrapper">
                        <div class="S-NEWS-carcass">
                            <div class="S-NEWS-title">
                                <h2 class="TYPO-PRESET-CORE_H2">Новости</h2>
                            </div>
                            <div class="S-NEWS-feed">
                                <div class="S-FEED-wrapper">
                                    <div class="S-FEED-carcass">
                                        <div class="S-FEED-articles">
                                            <div class="S-ARTICLES-wrapper">
                                                <div class="S-ARTICLES-carcass">
                                                    <x-blades.news.article
                                                        fresh="yes"
                                                        number="1"
                                                        date="14.08.2026"
                                                        headline="Короткий заголовок новой новости"
                                                        text="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                                    />
                                                    <x-blades.news.article
                                                        fresh="yes"
                                                        number="1"
                                                        date="14.08.2026"
                                                        headline="Короткий заголовок новой новости"
                                                        text="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                                    />
                                                    <x-blades.news.article
                                                        fresh="no"
                                                        number="1"
                                                        date="14.08.2026"
                                                        headline="Короткий заголовок новой новости"
                                                        text="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                                    />
                                                    <x-blades.news.article
                                                        fresh="no"
                                                        number="1"
                                                        date="14.08.2026"
                                                        headline="Короткий заголовок новой новости"
                                                        text="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                                    />
                                                    <x-blades.news.article
                                                        fresh="no"
                                                        number="1"
                                                        date="14.08.2026"
                                                        headline="Короткий заголовок новой новости"
                                                        text="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="S-FEED-buttons">
                                            <div class="S-BUTTONS-wrapper">
                                                <div class="S-BUTTONS-carcass">
                                                    <button class="B-BUTTON-main B-BUTTON-previous" id="LANDING-NEWS-PREVIOUS_BUTTON">
                                                        <x-svg.icons.arrow
                                                            class="I-BUTTON-icon"
                                                            style=""
                                                        />
                                                    </button>
                                                    <button class="B-BUTTON-main B-BUTTON-next" id="LANDING-NEWS-PREVIOUS_NEXT">
                                                        <x-svg.icons.arrow
                                                            class="I-BUTTON-icon"
                                                            style=""
                                                        />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-action" id="action">
                    <div class="S-ACTION-wrapper">
                        <div class="S-ACTION-carcass">
                            <div class="S-ACTION-background DEV-DISABLE_SELECTION">
                                <div class="S-BACKGROUND-wrapper">
                                    <div class="S-BACKGROUND-carcass">
                                        <x-svg.backgrounds.action
                                            class="I-BACKGROUND-shape"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="S-ACTION-content">
                                <div class="S-CONTENT-wrapper">
                                    <div class="S-CONTENT-carcass">
                                        <div class="S-CONTENT-slogan">
                                            <h1 class="TYPO-PRESET-HERO_HEADING">Ваш успех<br>начинается здесь!</h1>
                                        </div>
                                        <div class="S-CONTENT-button">
                                            <button class="B-CONTENT-button TYPO-PRESET-CORE_H3" id="LANDING-FOOTER-ACTION_BUTTON">
                                                <span class="T-BUTTON-heading">Подать заявку</span>
                                                <x-svg.icons.arrow
                                                    class="I-BUTTON-icon"
                                                    style=""
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <main class="S-DESKTOP-footer">
        <div class="S-FOOTER-wrapper">
            <div class="S-FOOTER-carcass">
                <div class="S-FOOTER-logos">
                    <div class="S-LOGOS-wrapper">
                        <div class="S-LOGOS-carcass">
                            <div class="S-LOGOS-mil">
                                <x-svg.logo.color_full
                                    class="I-LOGOS-mil"
                                />
                                <p class="T-LOGOS-mil TYPO-PRESET-CORE_H3">молодые инновационные<br>лидеры</p>
                            </div>
                            <div class="S-LOGOS-rair">
                                <img class="I-LOGOS-rair DEV-DISABLE_SELECTION" src="{{ asset('images/rair/color_full.png') }}" alt="Логотип РАИР" title="Логотип РАИР" draggable="false">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-FOOTER-links">
                    <div class="S-LINKS-wrapper">
                        <div class="S-LINKS-carcass">
                            <div class="S-LINKS-main TYPO-PRESET-CORE_P">
                                <a class="L-LINKS-main" href="#">Ссылка номер 1</a>
                                <a class="L-LINKS-main" href="#">Поддержка</a>
                                <a class="L-LINKS-main" href="#">Сайт РАИР</a>
                                <a class="L-LINKS-main" href="#">info@rair-info.ru</a>
                            </div>
                            <div class="S-LINKS-socials">
                                <a class="L-LINKS-socials" href="#">
                                    <x-svg.icons.socials.telegram
                                        class="I-LINKS-socials"
                                        style="width: 3.55vh;"
                                    />
                                </a>
                                <a class="L-LINKS-socials" href="#">
                                    <x-svg.icons.socials.vk
                                        class="I-LINKS-socials"
                                        style="width: 3.8vh;"
                                    />
                                </a>
                            </div>
                            <div class="S-LINKS-alt TYPO-PRESET-CORE_SMALL">
                                <a class="L-LINKS-alt" href="#">Положение о премии</a>
                                <a class="L-LINKS-alt" href="#">Согласие на обработку персональных данных</a>
                            </div>
                            <div class="S-LINKS-credit TYPO-PRESET-CORE_SMALL">
                                <p class="T-LINKS-credit">© 2026, Все права защищены</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('mode-landscape')
    <p>Landscape</p>
    <p>App Name: {{ $APP_Name }}</p>
@endsection

@section('mode-mobile')
    <p>Mobile</p>
    <p>App Name: {{ $APP_Name }}</p>
@endsection
