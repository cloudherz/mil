@extends('layouts.app')

@section('meta-title', '«МИЛ» Премия Молодые Инновационные Лидеры')
@section('meta-description', 'Премия Российской Ассоциации Инновационного Развития')
@section('meta-keywords', 'МИЛ, MIL')
@section('meta-url', 'https://milpremia.ru/')
@section('meta-image', 'https://milpremia.ru/images/meta/banner_1.png')
@section('meta-image-alt', '«МИЛ»')
@section('meta-site-name', 'Премия «МИЛ»')

@section('mode-desktop')
    <div class="S-DESKTOP-message_application_fail" id="LANDING-MESSAGE-APPLICATION_FAIL"
         @if ($errors->any()) data-show-error="1" @endif>
        <div class="S-MESSAGE_APPLICATION_FAIL-wrapper">
            <div class="S-MESSAGE_APPLICATION_FAIL-carcass">
                <div class="S-MESSAGE_APPLICATION_FAIL-window" id="LANDING-MESSAGE-APPLICATION_FAIL-WINDOW">
                    <div class="S-WINDOW-wrapper">
                        <div class="S-WINDOW-carcass">
                            <div class="S-WINDOW-heading">
                                <h3 class="T-WINDOW-heading TYPO-D-PRESET-CORE_H3">Что-то пошло не так...</h3>
                            </div>
                            <div class="S-WINDOW-messages">
                                @php
                                    $gentleWish = $errors->first('gentle_wish');
                                    $otherErrors = collect($errors->all())
                                        ->reject(fn ($error) => $error === $gentleWish)
                                        ->values();
                                @endphp

                                @if ($otherErrors->isNotEmpty())
                                    <ul>
                                        @foreach ($otherErrors as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="S-WINDOW-description">
                                @if ($gentleWish)
                                    <p class="T-WINDOW-description TYPO-D-PRESET-CORE_P">
                                        {{ $gentleWish }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="S-DESKTOP-message_application_success" id="LANDING-MESSAGE-APPLICATION_SUCCESS"
         @if(session('application_success')) data-show-success="1" @endif>
        <div class="S-MESSAGE_APPLICATION_SUCCESS-wrapper">
            <div class="S-MESSAGE_APPLICATION_SUCCESS-carcass">
                <div class="S-MESSAGE_APPLICATION_SUCCESS-window" id="LANDING-MESSAGE-APPLICATION_SUCCESS-WINDOW">
                    <div class="S-WINDOW-wrapper">
                        <div class="S-WINDOW-carcass">
                            <div class="S-WINDOW-heading">
                                <h3 class="T-WINDOW-heading TYPO-D-PRESET-CORE_H3">Ваша заявка<br>отправлена успешно!</h3>
                            </div>
                            <div class="S-WINDOW-icon">
                                <x-svg.icons.success
                                    class="I-WINDOW-icon"
                                />
                            </div>
                            <div class="S-WINDOW-description">
                                <p class="T-WINDOW-description TYPO-D-PRESET-CORE_P">
                                    Спасибо! Ваша заявка принята и направлена<br>
                                    на верификацию в Оргкомитет, ожидайте информацию<br>
                                    на электронную почту.<br><br>
                                    Окно закроется автоматически через <span id="LANDING-MESSAGE-APPLICATION_SUCCESS-TIMER">5</span> сек.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="S-DESKTOP-message_application_sending" id="LANDING-MESSAGE-APPLICATION_SENDING">
        <div class="S-MESSAGE_APPLICATION_SENDING-wrapper">
            <div class="S-MESSAGE_APPLICATION_SENDING-carcass">
                <div class="S-MESSAGE_APPLICATION_SENDING-window">
                    <div class="S-WINDOW-wrapper S-WINDOW-wrapper_blue">
                        <div class="S-WINDOW-carcass">
                            <div class="S-WINDOW-heading">
                                <h3 class="T-WINDOW-heading T-WINDOW-heading_blue TYPO-D-PRESET-CORE_H3">Заявка отправляется...</h3>
                            </div>
                            <div class="S-WINDOW-loading">
                                <x-svg.icons.loading
                                    class="I-WINDOW-loading I-WINDOW-loading_blue"
                                />
                            </div>
                            <div class="S-WINDOW-description">
                                <p class="T-WINDOW-description T-WINDOW-description_blue TYPO-D-PRESET-CORE_P_BOLD">Пожалуйста, не закрывайте вкладку!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="S-DESKTOP-message_email_copied" id="LANDING-MESSAGE-EMAIL_COPIED">
        <div class="S-MESSAGE_EMAIL_COPIED-wrapper">
            <div class="S-MESSAGE_EMAIL_COPIED-carcass" id="LANDING-MESSAGE-EMAIL_COPIED-CARCASS">
                <div class="S-MESSAGE_EMAIL_COPIED-icon">
                    <x-svg.icons.check
                        class="I-MESSAGE_EMAIL_COPIED-icon"
                    />
                </div>
                <div class="S-MESSAGE_EMAIL_COPIED-text">
                    <p class="T-MESSAGE_EMAIL_COPIED-text TYPO-D-PRESET-CORE_H3">Почта скопирована в буфер обмена</p>
                </div>
            </div>
        </div>
    </div>
    <div class="S-DESKTOP-application" id="LANDING-APPLICATION-POPUP" style="display: none">
        <div class="S-APPLICATION-wrapper">
            <div class="S-APPLICATION-carcass">
                <div class="S-APPLICATION-select S-APPLICATION-window" id="LANDING-APPLICATION-WINDOW-SELECT" style="display: none">
                    <div class="S-SELECT-wrapper S-SELECT-wrapper_blue S-WINDOW-wrapper">
                        <div class="S-SELECT-carcass S-WINDOW-carcass">
                            <div class="S-SELECT-heading">
                                <h3 class="TYPO-D-PRESET-CORE_H3">Выбор типа заявки</h3>
                            </div>
                            <div class="S-SELECT-buttons">
                                <div class="S-BUTTONS-wrapper">
                                    <div class="S-BUTTONS-carcass">
                                        <div class="S-BUTTONS-student S-BUTTONS-all">
                                            <x-blades.application.select.button
                                                type="student"
                                                color="blue"
                                                icon="student"
                                                icon_height="7.3vh"
                                                title="Студент"
                                                text="Студент / Аспирант. Академические проекты, вышедшие за рамки учебной задачи: прототип, пилот, метрики, публикации, участие в конкурсах."
                                                price="7 000₽"
                                            />
                                        </div>
                                        <div class="S-BUTTONS-individual S-BUTTONS-all">
                                            <x-blades.application.select.button
                                                type="individual"
                                                color="blue"
                                                icon="person"
                                                icon_height="7.3vh"
                                                title="Физическое лицо"
                                                text="Физическое лицо / Предприниматель. Индивидуальные проекты, стартапы, независимые разработки с измеримыми результатами (пилот, патент, продажи, публикации)."
                                                price="14 000₽"
                                            />
                                        </div>
                                        <div class="S-BUTTONS-entity S-BUTTONS-all">
                                            <x-blades.application.select.button
                                                type="entity"
                                                color="green"
                                                icon="briefcase"
                                                icon_height="6.5vh"
                                                title="Юридическое лицо"
                                                text="Юридическое лицо / Компания. Технологические проекты и команды на стадии MVP и выше с отраслевым эффектом и потенциалом масштабирования. Компании могут подать до 3 заявок в любые из 5 номинаций."
                                                price="90 000₽"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="S-SELECT-description">
                                <div class="S-DESCRIPTION-wrapper">
                                    <div class="S-DESCRIPTION-carcass">
                                        <div class="S-DESCRIPTION-icon">
                                            <x-svg.icons.info
                                                class="I-DESCRIPTION-icon"
                                            />
                                        </div>
                                        <div class="S-DESCRIPTION-text">
                                            <p class="T-DESCRIPTION-text TYPO-D-PRESET-CORE_P">Участие только для проектов с измеримым эффектом. Оплата организационного<br>взноса только после верификации. Орг. взнос включает билет «Стандарт»<br>на торжественную церемонию награждения премии МИЛ.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-APPLICATION-form S-APPLICATION-student S-APPLICATION-window" id="LANDING-APPLICATION-WINDOW-STUDENT" style="display: none">
                    <x-blades.application.form
                        type="student"
                    />
                </div>
                <div class="S-APPLICATION-form S-APPLICATION-individual S-APPLICATION-window" id="LANDING-APPLICATION-WINDOW-INDIVIDUAL" style="display: none">
                    <x-blades.application.form
                        type="individual"
                    />
                </div>
                <div class="S-APPLICATION-form S-APPLICATION-entity S-APPLICATION-window" id="LANDING-APPLICATION-WINDOW-ENTITY" style="display: none">
                    <x-blades.application.form
                        type="entity"
                    />
                </div>
            </div>
        </div>
    </div>
    <header class="S-DESKTOP-header">
        <div class="S-HEADER-wrapper">
            <div class="S-HEADER-carcass S-HEADER-carcass_transparent" id="LANDING-HEADER-CARCASS">
                <div class="S-HEADER-content">
                    <div class="S-CONTENT-wrapper">
                        <div class="S-CONTENT-carcass">
                            <div class="S-CONTENT-list">
                                <div class="S-LIST-wrapper">
                                    <div class="S-LIST-carcass TYPO-D-PRESET-HEADER_TEXT">
                                        <a class="L-LIST-image" href="#hero">
                                            <x-svg.logo.color_full_2
                                                class="I-LIST-logo I-LIST-logo_color_full"
                                            />
                                            <x-svg.logo.white_hollow_full_2
                                                class="I-LIST-logo I-LIST-logo_white_hollow"
                                            />
                                        </a>
                                        <a class="L-LIST-text" href="#tracks">Номинации</a>
                                        <a class="L-LIST-text" href="#dates">Этапы</a>
                                        <a class="L-LIST-text" href="#partnership">Партнерство</a>
                                        <a class="L-LIST-text" href="#prizes">Награды</a>
                                        <a class="L-LIST-text" href="#conditions">Условия</a>
                                        <a class="L-LIST-text" href="#jury">Жюри</a>
                                        <a class="L-LIST-text" href="#news">Новости</a>
                                    </div>
                                </div>
                            </div>
                            <div class="S-CONTENT-button">
                                <div class="S-BUTTON-wrapper">
                                    <div class="S-BUTTON-carcass">
                                        <button class="B-BUTTON-button B-BUTTON-button_transparent TYPO-D-PRESET-HEADER_TEXT" id="LANDING-HEADER-ACTION_BUTTON">Подать заявку</button>
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
                                            <x-svg.logo.color_full_2
                                                class="I-CONTENT-logo"
                                            />
                                        </div>
                                        <div class="S-CONTENT-heading">
                                            <h1 class="T-CONTENT-heading TYPO-D-PRESET-HERO_HEADING">
                                                молодые инновационные<br>лидеры
                                                <span class="T-CONTENT-heading_alt TYPO-D-PRESET-HERO_HEADING_ALT">России и Беларуси</span>
                                            </h1>
                                        </div>
                                        <div class="S-CONTENT-rair">
                                            <h2 class="TYPO-D-PRESET-HERO_DESCRIPTION">премия Российской Ассоциации Инновационного Развития</h2>
                                            <x-svg.rair.color_full
                                                class="I-CONTENT-rair"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-reason" id="reason">
                    <div class="S-REASON-wrapper">
                        <div class="S-REASON-carcass">
                            <div class="S-REASON-question S-REASON-block">
                                <h3 class="TYPO-D-PRESET-CORE_H3">Зачем участвовать?</h3>
                                <p class="TYPO-D-PRESET-CORE_P">
                                    Ваше инновационное лидерство<br>
                                    получит признание профессионалов<br>
                                    и внимание медиа.<br>
                                    Победа гарантирует участнику:
                                </p>
                            </div>
                            <div class="S-REASON-answer_1 S-REASON-block S-REASON-answer">
                                <h3 class="T-REASON-answer_heading TYPO-D-PRESET-CORE_H3">1.</h3>
                                <p class="T-REASON-answer_text TYPO-D-PRESET-CORE_P">Денежный приз на дальнейшее<br>развитие и значимый<br>репутационный актив.</p>
                            </div>
                            <div class="S-REASON-answer_2 S-REASON-block S-REASON-answer">
                                <h3 class="T-REASON-answer_heading TYPO-D-PRESET-CORE_H3">2.</h3>
                                <p class="T-REASON-answer_text TYPO-D-PRESET-CORE_P">Интеграция в экосистему РАИР<br>для профессиональной<br>кооперации и масштабирования.</p>
                            </div>
                            <div class="S-REASON-answer_3 S-REASON-block S-REASON-answer">
                                <h3 class="T-REASON-answer_heading TYPO-D-PRESET-CORE_H3">3.</h3>
                                <p class="T-REASON-answer_text TYPO-D-PRESET-CORE_P">Приоритетный доступ к сильным<br>игрокам рынка, партнёрам<br>и инвесторам, новые возможности<br>для внедрения проектов.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-blue_bar S-MAIN-bar"></div>
                <div class="S-MAIN-goals" id="goals">
                    <div class="S-GOALS-wrapper">
                        <div class="S-GOALS-carcass">
                            <div class="S-GOALS-title">
                                <h2 class="TYPO-D-PRESET-CORE_H2">О премии</h2>
                            </div>
                            <div class="S-GOALS-cards">
                                <div class="S-CARDS-wrapper">
                                    <div class="S-CARDS-carcass">
                                        <x-blades.goals.card
                                            number="1"
                                            color="blue"
                                            icon="award"
                                            icon_rotate="-7deg"
                                            icon_transform="scale(102%) translateY(5%)"
                                            background_transform="scale(230%) translateX(-12%) translateY(0%) rotate(12deg)"
                                            title="Для кого"
                                            text1="Премия создана для тех, кто уже прошёл путь от идеи до работающего продукта и может показать измеримый эффект для рынка, науки или своего региона."
                                            text2="МИЛ выделяет лидеров, перешедших из стартап-энтузиастов в системных игроков, и победа в пяти номинациях подтверждает зрелость решений, открывая доступ к экспертам и стратегическим возможностям."
                                        />
                                        <x-blades.goals.card
                                            number="2"
                                            color="green"
                                            icon="papers"
                                            icon_rotate="-7deg"
                                            icon_transform="scale(103%)"
                                            background_transform="scale(218%) translateX(-42%) translateY(-10%) rotate(5deg)"
                                            title="Цели и задачи"
                                            text1="Премия формирует трек роста, где лидерство — это внедрения, а каталог проектов МИЛ становится витриной для корпораций, чтобы успешные практики тиражировались в отраслях, а экосистема РАИР даёт пространство для кооперации и грантов."
                                            text2="Премия закрепляет репутацию трека как отраслевого стандарта, маркера зрелости и надёжности для инвесторов и вузов, поднимая видимость молодых инноваторов и признание их на уровне индустрии."
                                        />
                                        <x-blades.goals.card
                                            number="3"
                                            color="green"
                                            icon="court"
                                            icon_rotate="-7deg"
                                            icon_transform="scale(90%)"
                                            background_transform="scale(215%) translateX(-14%) translateY(-5%) rotate(10deg)"
                                            title="Об организаторе"
                                            text1="РАИР объединяет индустриальных партнёров, научные центры и вузы для единой инфраструктуры поддержки технологий, действует с июня 2008 года и стала рупором общественного мнения по стратегиям инновационного развития."
                                            text2="Ассоциация внедряет разработки в реальный сектор, развивает кооперацию науки и бизнеса, а также популяризирует инженерный труд и предпринимательские инициативы."
                                        />
                                        <x-blades.goals.card
                                            number="4"
                                            color="blue"
                                            icon="leader"
                                            icon_rotate="-7deg"
                                            icon_transform="scale(100%)"
                                            background_transform="scale(205%) translateX(-22%) translateY(-3.5%) rotate(14deg)"
                                            title="Кто может участвовать"
                                            text1="Молодые лидеры 20–40 лет, доказавшие свою эффективность: фаундеры и CEO, корпоративные инноваторы, руководители технопарков, инжиниринговых цетров, ОЭЗ, региональные управленцы, академические предприниматели,"
                                            text2="руководители ПИШ, преподаватели инноватики, наставники,социальные визионеры из EdTech, MedTech, AgroTech, те, кто превращает территории в точки роста.<br><br>Для наставников нет возрастных ограничений."
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-blades.main.rair
                    number="1"
                    heading="Превращаем реальные достижения<br>в масштабный эффект"
                    text="15 номинаций сгруппированы по 5 трекам — пяти векторам влияния.<br>Победитель каждой претендует на Гран-при «Лидер года МИЛ»."
                />
                <div class="S-MAIN-tracks" id="tracks">
                    <div class="S-TRACKS-wrapper">
                        <div class="S-TRACKS-carcass">
                            <div class="S-TRACKS-title">
                                <h2 class="TYPO-D-PRESET-CORE_H2">Номинации</h2>
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
                                            text="
                                                <span>Для основателей и руководителей наукоёмких компаний, создавших уникальные продукты на основе ИС и достигших рыночных успехов.</span>
                                                <span class='TYPO-D-PRESET-CORE_H3'>Номинации трека:</span>
                                                <br>
                                                <span><span class='TYPO-D-PRESET-CORE_P_BOLD'>«Технологический прорыв»</span> (DeepTech-лидер)</span>
                                                <span>Критерии: Научная новизна, наличие интеллектуальной собственности, первые коммерческие контракты.</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Масштабирование смыслов»</span>
                                                <span>Критерии: Темпы роста, доля рынка, выход на федеральный или международный уровень.</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Международная экспансия»</span>
                                                <span>Критерий: Объём экспортной выручки, география присутствия, адаптация продукта, партнёрства с иностранными институтами.</span>
                                                "
                                        />
                                        <x-blades.tracks.card
                                            number="2"
                                            color="blue"
                                            icon="office"
                                            icon_scale="4.9vh"
                                            background_transform="scale(190%) translateX(16%) translateY(71%) rotate(6deg)"
                                            heading="Корпорации и Индустрия"
                                            text="
                                                <span>Для основателей, руководителей компаний и R&D, инженерных команд, запустивших новый промышленный продукт или производственную линию.</span>
                                                <span class='TYPO-D-PRESET-CORE_H3'>Номинации трека:</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Архитектор трансформации»</span>
                                                <span>Критерий: Измеримый экономический эффект цифровой или продуктовой трансформации, скорость внедрения, тиражируемость.</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Индустриальный чемпион»</span>
                                                <span>Критерий: Уровень технологической готовности от УГТ5 , импортозамещающий эффект, объём внедрения, отраслевой эффект.</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Кооперация ради суверенитета»</span>
                                                <span>Критерий: Масштаб кооперации, межкорпоративные консорциумы, снижение зависимости от импорта.</span>
                                                "
                                        />
                                        <x-blades.tracks.card
                                            number="3"
                                            color="blue"
                                            icon="region"
                                            icon_scale="5.5vh"
                                            background_transform="scale(195%) translateX(-6%) translateY(64%) rotate(-7deg)"
                                            heading="Регионы и Территории"
                                            text="
                                                <span>Для глав регионов, муниципалитетов, технопарков, ОЭЗ, ИНТЦ и фондов, построивших работающую инфраструктуру инноваций.</span>
                                                <span class='TYPO-D-PRESET-CORE_H3'>Номинации трека:</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Строитель экосистемы»</span>
                                                <span>Критерий: Число резидентов и рабочих мест, фактический объём инвестиций, выживаемость проектов, импульс для развития смежных отраслей.</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Региональный прорыв»</span>
                                                <span>Критерий: Число проектов, улучшающих качество жизни, межрегиональная тиражируемость, масштабируемость, измеримый вклад в инвестиционную привлекательность.</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Устойчивое развитие территории»</span>
                                                <span>Критерий: Проекты, создающие долгосрочную ценность для территории: экологию, рабочие места, вовлечённость сообществ, устойчивую экономику.</span>
                                                "
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
                                            text="
                                                <span>Для лидеров, задающих новые стандарты, улучшающих качество жизни, формирующих кадровый резерв технологического развития.</span>
                                                <span class='TYPO-D-PRESET-CORE_H3'>Номинации трека:</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Технологии для жизни»</span>
                                                <span>Критерий: Охват аудитории в медицине, образовании, городской среде, экологии, социальный эффект, внедрение в государственные системы.</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Визионер отрасли»</span>
                                                <span>Критерий: Влияние на отраслевые стандарты, регулирование, масштаб изменений, признание сообществом, партнерства.</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Наставник поколения»</span>
                                                <span>Критерий: Масштаб образовательных инициатив, трудоустройство выпускников, партнёрства с вузами, развитие талантов.</span>
                                                "
                                        />
                                        <x-blades.tracks.card
                                            number="5"
                                            color="green"
                                            icon="engineering"
                                            icon_scale="5.3vh"
                                            background_transform="scale(185%) translateX(16%) translateY(60%) rotate(10deg)"
                                            heading="Наука и Инженерия"
                                            text="
                                                <span>Для учёных-предпринимателей, передовые инженерные школы и наставников, воспитавших технологических предпринимателей.</span>
                                                <span class='TYPO-D-PRESET-CORE_H3'>Номинации трека:</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Академический предприниматель»</span>
                                                <span>Критерии: Научная новизна и патенты (IP), объём коммерциализации, пилоты/внедрения, реальный вклад в развитие технологического рынка.</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Инженерный прорыв»</span>
                                                <span>Критерии: техническая новизна и сложность, стадия реализации, потенциал масштабирования, кооперация с индустриальным партнёром.</span>
                                                <br>
                                                <span class='TYPO-D-PRESET-CORE_P_BOLD'>«Наставник инноваторов»</span>
                                                <span>Критерии: количество выпускников, основавших компании, реализовавших инновационные проекты, вклад в образовательные программы по технологическому предпринимательству.</span>
                                                "
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
                                <h2 class="TYPO-D-PRESET-CORE_H2">Этапы</h2>
                            </div>
                            <div class="S-DATES-widget">
                                <div class="S-WIDGET-wrapper">
                                    <div class="S-WIDGET-carcass">
                                        <x-blades.dates.side
                                            position="left"
                                        />
                                        <x-blades.dates.column
                                            number="1"
                                            date="25 Сентября, 2026"
                                            description="Старт премии. Начало приема заявок."
                                            state="present"
                                        />
                                        <x-blades.dates.column
                                            number="2"
                                            date="10 Ноября, 2026"
                                            description="Верификация. Формирование списка номинантов."
                                            state="future"
                                        />
                                        <x-blades.dates.column
                                            number="3"
                                            date="25 Декабря, 2026"
                                            description="Независимая экспертная оценка жюри и выставление баллов по критериям."
                                            state="future"
                                        />
                                        <x-blades.dates.column
                                            number="4"
                                            date="15 Января, 2027"
                                            description="Отбор финалистов по каждой номинации. Объявление шорт-листа."
                                            state="future"
                                        />
                                        <x-blades.dates.column
                                            number="5"
                                            date="Март, 2027"
                                            description="Защита проектов. Торжественное награждение финалистов."
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
                <div class="S-MAIN-partnership" id="partnership">
                    <div class="S-PARTNERSHIP-wrapper">
                        <div class="S-PARTNERSHIP-carcass">
                            <div class="S-PARTNERSHIP-background DEV-DISABLE_SELECTION">
                                <div class="S-BACKGROUND-wrapper">
                                    <div class="S-BACKGROUND-carcass">
                                        <x-svg.backgrounds.rair_2
                                            class="I-BACKGROUND-shape"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="S-PARTNERSHIP-content">
                                <div class="S-CONTENT-wrapper">
                                    <div class="S-CONTENT-carcass">
                                        <div class="S-CONTENT-title">
                                            <h2 class="TYPO-D-PRESET-CORE_H2">Партнерство с Премией</h2>
                                        </div>
                                        <div class="S-CONTENT-text">
                                            <p class="TYPO-D-PRESET-CORE_P">
                                                Премия МИЛ открыта к партнёрству с компаниями, институтами развития,<br>медиа и отраслевыми объединениями. Участвуя, вы усиливаете<br>позиционирование и становитесь частью актуальной инициативы<br>по развитию инновационного лидерства.
                                                <br><br>
                                                Напишите нам — обсудим форматы сотрудничества.
                                            </p>
                                        </div>
                                        <div class="S-CONTENT-button">
                                            <button class="B-CONTENT-button TYPO-D-PRESET-CORE_H3" id="LANDING-PARTNERSHIP-COPY_BUTTON">
                                                <span class="T-BUTTON-heading">hello@milpremia.ru</span>
                                                <x-svg.icons.copy
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
                <div class="S-MAIN-prizes" id="prizes">
                    <div class="S-PRIZES-wrapper">
                        <div class="S-PRIZES-carcass">
                            <div class="S-PRIZES-title">
                                <h2 class="TYPO-D-PRESET-CORE_H2">Награды</h2>
                            </div>
                            <div class="S-PRIZES-widget">
                                <div class="S-WIDGET-wrapper">
                                    <div class="S-WIDGET-carcass">
                                        <div class="S-WIDGET-fund">
                                            <h2 class="TYPO-D-PRESET-CORE_H2 T-FUND-heading">Призовой фонд — 2 000 000₽</h2>
                                        </div>
                                        <div class="S-WIDGET-distribution">
                                            <div class="S-DISTRIBUTION-wrapper">
                                                <div class="S-DISTRIBUTION-carcass">
                                                    <div class="S-DISTRIBUTION-background">
                                                        <div class="S-BACKGROUND-wrapper">
                                                            <div class="S-BACKGROUND-carcass">
                                                                <x-svg.backgrounds.prizes
                                                                    class="I-BACKGROUND-shape"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="S-DISTRIBUTION-content">
                                                        <div class="S-CONTENT-wrapper">
                                                            <div class="S-CONTENT-carcass">
                                                                <x-blades.prizes.case
                                                                    place="laureates"
                                                                    heading="15 Лауреатов"
                                                                    color="pale_blue"
                                                                >
                                                                    <x-svg.icons.laurel_branch
                                                                        class="I-INFO-icon"
                                                                        style="scale: 1.23;"
                                                                    />
                                                                    <h3 class="T-INFO-text TYPO-D-PRESET-CORE_H3">диплом лауреата</h3>
                                                                </x-blades.prizes.case>
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
                                                                    <x-svg.icons.medal
                                                                        class="I-INFO-icon"
                                                                        style="scale: 1.05;"
                                                                    />
                                                                    <h3 class="T-INFO-text TYPO-D-PRESET-CORE_H3">по 200 000₽</h3>
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
                                                                        style="scale: 1;"
                                                                    />
                                                                    <h3 class="T-INFO-text TYPO-D-PRESET-CORE_H3">1 000 000₽</h3>
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
                                <h2 class="TYPO-D-PRESET-CORE_H2">Условия участия</h2>
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
                                            background_transform="scale(270%) translateX(-11%) translateY(-30.15%) rotate(-1deg)"
                                            heading="Физическое Лицо"
                                            description="Физическое лицо / Предприниматель.<br>Индивидуальные проекты, стартапы, независимые<br>разработки с измеримыми результатами<br>(пилот, патент, продажи, публикации)."
                                            price="14 000₽ (студентам 7 000₽)"
                                        />
                                        <x-blades.conditions.card
                                            type="entity"
                                            color="green"
                                            icon="briefcase"
                                            icon_scale="5.4vh"
                                            background_shape="briefcases"
                                            background_transform="scale(270%) translateX(44%) translateY(-16%) rotate(45deg)"
                                            heading="Юридическое Лицо"
                                            description="Юридическое лицо / Компания. Технологические проекты<br>и команды на стадии MVP и выше с отраслевым эффектом<br>и потенциалом масштабирования. Компании могут подать<br>до 3 заявок в любые из 5 номинаций."
                                            price="90 000₽"
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
                                <h2 class="TYPO-D-PRESET-CORE_H2">Жюри / Эксперты</h2>
                            </div>
                            <div class="S-JURY-cards">
                                <div class="S-CARDS-wrapper">
                                    <div class="S-CARDS-carcass">
                                        <x-blades.jury.card
                                            number="1"
                                            color="blue"
                                            name="Шичкина Марина Ивановна"
                                            title='Генеральный директор НП «Росссийская ассоциация инновационного развития»'
                                            portrait="images/people/optimized/shichkina_marina_ivanovna-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="2"
                                            color="green"
                                            name="Поденок Андрей Евгеньевич"
                                            title='Президент МОО «Московская<br>ассоциация предпринимателей»'
                                            portrait="images/people/optimized/podenok_andrey_evgenievich-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="3"
                                            color="blue"
                                            name="Колесников Андрей Николаевич"
                                            title='Директор аналитического консалтингового центра экономического факультета МГУ им. М.В. Ломоносова'
                                            portrait="images/people/optimized/kolesnikov_andrey_nikolaevich-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="4"
                                            color="green"
                                            name="Бадулин Николай Александрович"
                                            title='Венчурный инвестор, генеральный директор ИФК «Самотлор-Инвест»'
                                            portrait="images/people/optimized/badulin_nikolay_alexandrovich-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="5"
                                            color="blue"
                                            name="Пастухов Александр Владимирович"
                                            title='Вице-президент Национального экологического института<br>устойчивого развития'
                                            portrait="images/people/optimized/pastuhov_alexandr_vladimirovich-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="6"
                                            color="green"
                                            name="Лейбинен Снежана Александровна"
                                            title='Председатель Гильдии предпринимателей Турочагского района Ресублики Алтай'
                                            portrait="images/people/optimized/leybinen_snezhana_alexandrovna-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="7"
                                            color="blue"
                                            name="Нестеренко Алексей Дмитриевич"
                                            title='Генеральный директор логистической компании «ВекторФрахт»'
                                            portrait="images/people/optimized/nesterenko_alexey_dmitrievich-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="8"
                                            color="green"
                                            name="Замятина Надежда Юрьевна"
                                            title='Профессор Высшей школы урбанистики им. А.А. Высоковского, факультет городского и регионального развития'
                                            portrait="images/people/optimized/zamyatina_nadezhda_yurevna-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="9"
                                            color="blue"
                                            name="Гусева Ольга Вячеславовна"
                                            title='Девелопер, генеральный директор инвестиционной компании<br>«КЕЙ КАПИТАЛ»'
                                            portrait="images/people/optimized/guseva_olga_vyacheslavovna-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="10"
                                            color="green"
                                            name="Нагиева Валентина Викторовна"
                                            title='Генеральный директор «ПетроСервис», исполнительный директор<br>«Доверие потребителя»'
                                            portrait="images/people/optimized/nagieva_valentina_viktorovna-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="11"
                                            color="blue"
                                            name="Бурда Павел<br>Федорович"
                                            title='Предприниматель, сооснователь проектов «Гениальный ребенок»<br>и «ArtVisionAi»'
                                            portrait="images/people/optimized/burda_pavel_fedorovich-portrait-01.webp"
                                        />
                                        <x-blades.jury.card
                                            number="12"
                                            color="green"
                                            name="Липина Светлана Артуровна"
                                            title='Заместитель председателя СОПС ВАВТ Минэкономразвития РФ'
                                            portrait="images/people/optimized/lipina_svetlana_arturovna-portrait-01.webp"
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
                                <h2 class="TYPO-D-PRESET-CORE_H2">Новости</h2>
                            </div>
                            <div class="S-NEWS-feed">
                                <div class="S-FEED-wrapper">
                                    <div class="S-FEED-carcass">
                                        <div class="S-FEED-articles">
                                            <div class="S-ARTICLES-wrapper" id="LANDING-NEWS-ARTICLES-WRAPPER">
                                                <div class="S-ARTICLES-carcass" id="LANDING-NEWS-ARTICLES-CARCASS">
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
                                            <h1 class="TYPO-D-PRESET-HERO_HEADING">Ваш успех<br>начинается здесь!</h1>
                                        </div>
                                        <div class="S-CONTENT-button">
                                            <button class="B-CONTENT-button TYPO-D-PRESET-CORE_H3" id="LANDING-FOOTER-ACTION_BUTTON">
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
    <footer class="S-DESKTOP-footer">
        <div class="S-FOOTER-wrapper">
            <div class="S-FOOTER-carcass">
                <div class="S-FOOTER-logos">
                    <div class="S-LOGOS-wrapper">
                        <div class="S-LOGOS-carcass">
                            <div class="S-LOGOS-mil">
                                <x-svg.logo.color_full_2
                                    class="I-LOGOS-mil"
                                />
                                <p class="T-LOGOS-mil TYPO-D-PRESET-CORE_H3">молодые инновационные<br>лидеры</p>
                            </div>
                            <div class="S-LOGOS-rair">
                                <x-svg.rair.color_full
                                    class="I-LOGOS-rair"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-FOOTER-links">
                    <div class="S-LINKS-wrapper">
                        <div class="S-LINKS-carcass">
                            <div class="S-LINKS-main TYPO-D-PRESET-CORE_P">
                                <a class="L-LINKS-main" href="https://rair-info.ru/" rel="noopener noreferrer" target="_blank">Сайт РАИР</a>
                                <a class="L-LINKS-main" href="mailto:org@rair-info.ru">По всем вопросам:<br>org@rair-info.ru</a>
                            </div>
                            <div class="S-LINKS-socials">
                                <a class="L-LINKS-socials" href="https://rair-info.ru/" rel="noopener noreferrer" target="_blank">
                                    <x-svg.icons.socials.telegram
                                        class="I-LINKS-socials"
                                        style="width: 3.55vh;"
                                    />
                                </a>
                                <a class="L-LINKS-socials" href="https://rair-info.ru/" rel="noopener noreferrer" target="_blank">
                                    <x-svg.icons.socials.vk
                                        class="I-LINKS-socials"
                                        style="width: 3.8vh;"
                                    />
                                </a>
                            </div>
                            <div class="S-LINKS-alt TYPO-D-PRESET-CORE_SMALL">
                                <a class="L-LINKS-alt" href="{{ asset('docs/public_offer.pdf') }}" target="_blank" rel="noopener noreferrer">Публичная оферта</a>
                                <a class="L-LINKS-alt" href="{{ asset('docs/regulations.pdf') }}" target="_blank" rel="noopener noreferrer">Положение о премии</a>
                            </div>
                            <div class="S-LINKS-credit TYPO-D-PRESET-CORE_SMALL">
                                <p class="T-LINKS-credit">© 2026, Все права защищены</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('mode-landscape')
    <p>Landscape</p>
@endsection

@section('mode-mobile')
    <div class="S-MOBILE-dev">
        <div class="S-DEV-wrapper">
            <div class="S-DEV-carcass">
                <div class="S-DEV-logo">
                    <x-svg.logo.mobile_dev
                        class="I-DEV-logo"
                    />
                </div>
                <div class="S-DEV-icon">
                    <x-svg.icons.developing
                        class="I-DEV-icon"
                    />
                </div>
                <div class="S-DEV-text">
                    <h3 class="T-DEV-text TYPO-M-PRESET-CORE_H3_LIGHT">
                        Мобильная версия сайта в разработке.<br>Пожалуйста, откройте страницу с пк<br>или ноутбука
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="S-MOBILE-message_application_fail" id="LANDING-MOBILE-MESSAGE-APPLICATION_FAIL"
         @if ($errors->any()) data-show-error="1" @endif>
        <div class="S-MESSAGE_APPLICATION_FAIL-wrapper">
            <div class="S-MESSAGE_APPLICATION_FAIL-carcass">
                <div class="S-MESSAGE_APPLICATION_FAIL-window" id="LANDING-MOBILE-MESSAGE-APPLICATION_FAIL-WINDOW">
                    <div class="S-WINDOW-wrapper">
                        <div class="S-WINDOW-carcass">
                            <div class="S-WINDOW-heading">
                                <h3 class="T-WINDOW-heading TYPO-M-PRESET-CORE_H3">Что-то пошло не так...</h3>
                            </div>
                            <div class="S-WINDOW-messages">
                                @php
                                    $gentleWish = $errors->first('gentle_wish');
                                    $otherErrors = collect($errors->all())
                                        ->reject(fn ($error) => $error === $gentleWish)
                                        ->values();
                                @endphp

                                @if ($otherErrors->isNotEmpty())
                                    <ul>
                                        @foreach ($otherErrors as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="S-WINDOW-description">
                                @if ($gentleWish)
                                    <p class="T-WINDOW-description TYPO-M-PRESET-CORE_P">
                                        {{ $gentleWish }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="S-MOBILE-message_application_success" id="LANDING-MOBILE-MESSAGE-APPLICATION_SUCCESS"
         @if(session('application_success')) data-show-success="1" @endif>
        <div class="S-MESSAGE_APPLICATION_SUCCESS-wrapper">
            <div class="S-MESSAGE_APPLICATION_SUCCESS-carcass">
                <div class="S-MESSAGE_APPLICATION_SUCCESS-window" id="LANDING-MOBILE-MESSAGE-APPLICATION_SUCCESS-WINDOW">
                    <div class="S-WINDOW-wrapper">
                        <div class="S-WINDOW-carcass">
                            <div class="S-WINDOW-heading">
                                <h3 class="T-WINDOW-heading TYPO-M-PRESET-CORE_H3">Ваша заявка<br>отправлена успешно!</h3>
                            </div>
                            <div class="S-WINDOW-icon">
                                <x-svg.icons.success
                                    class="I-WINDOW-icon"
                                />
                            </div>
                            <div class="S-WINDOW-description">
                                <p class="T-WINDOW-description TYPO-M-PRESET-CORE_P">
                                    Спасибо! Ваша заявка принята и направлена<br>
                                    на верификацию в Оргкомитет, ожидайте<br>
                                    информацию на электронную почту.<br><br>
                                    Окно закроется автоматически<br>
                                    через <span id="LANDING-MOBILE-MESSAGE-APPLICATION_SUCCESS-TIMER">5</span> сек.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="S-MOBILE-message_application_sending" id="LANDING-MOBILE-MESSAGE-APPLICATION_SENDING">
        <div class="S-MESSAGE_APPLICATION_SENDING-wrapper">
            <div class="S-MESSAGE_APPLICATION_SENDING-carcass">
                <div class="S-MESSAGE_APPLICATION_SENDING-window">
                    <div class="S-WINDOW-wrapper S-WINDOW-wrapper_blue">
                        <div class="S-WINDOW-carcass">
                            <div class="S-WINDOW-heading">
                                <h3 class="T-WINDOW-heading T-WINDOW-heading_blue TYPO-M-PRESET-CORE_H3">Заявка отправляется...</h3>
                            </div>
                            <div class="S-WINDOW-loading">
                                <x-svg.icons.loading
                                    class="I-WINDOW-loading I-WINDOW-loading_blue"
                                />
                            </div>
                            <div class="S-WINDOW-description">
                                <p class="T-WINDOW-description T-WINDOW-description_blue TYPO-M-PRESET-CORE_P_BOLD">Пожалуйста, не закрывайте страницу!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="S-MOBILE-message_email_copied" id="LANDING-MOBILE-MESSAGE-EMAIL_COPIED">
        <div class="S-MESSAGE_EMAIL_COPIED-wrapper">
            <div class="S-MESSAGE_EMAIL_COPIED-carcass" id="LANDING-MOBILE-MESSAGE-EMAIL_COPIED-CARCASS">
                <div class="S-MESSAGE_EMAIL_COPIED-icon">
                    <x-svg.icons.check
                        class="I-MESSAGE_EMAIL_COPIED-icon"
                    />
                </div>
                <div class="S-MESSAGE_EMAIL_COPIED-text">
                    <p class="T-MESSAGE_EMAIL_COPIED-text TYPO-M-PRESET-CORE_H3">Почта скопирована<br>в буфер обмена</p>
                </div>
            </div>
        </div>
    </div>
    <div class="S-MOBILE-application" id="LANDING-MOBILE-APPLICATION-POPUP" style="display: none">
        <div class="S-APPLICATION-wrapper">
            <div class="S-APPLICATION-carcass">
                <div class="S-APPLICATION-select S-APPLICATION-window" id="LANDING-MOBILE-APPLICATION-WINDOW-SELECT" style="display: none">
                    <div class="S-SELECT-wrapper S-SELECT-wrapper_blue S-WINDOW-wrapper">
                        <div class="S-SELECT-carcass S-WINDOW-carcass">
                            <div class="S-SELECT-heading">
                                <h3 class="T-SELECT-heading TYPO-M-PRESET-CORE_H3">Выбор типа заявки</h3>
                            </div>
                            <div class="S-SELECT-buttons">
                                <div class="S-BUTTONS-wrapper">
                                    <div class="S-BUTTONS-carcass">
                                        <div class="S-BUTTONS-student S-BUTTONS-all">
                                            <x-blades.mobile.application.select.button
                                                type="student"
                                                color="blue"
                                                icon="student"
                                                icon_height="8.9dvw"
                                                title="Студент"
                                                text="Студент / Аспирант. Академические проекты, вышедшие за рамки учебной задачи: прототип, пилот, метрики, публикации, участие в конкурсах."
                                                price="7 000₽"
                                            />
                                        </div>
                                        <div class="S-BUTTONS-individual S-BUTTONS-all">
                                            <x-blades.mobile.application.select.button
                                                type="individual"
                                                color="blue"
                                                icon="person"
                                                icon_height="9.3dvw"
                                                title="Физическое лицо"
                                                text="Физическое лицо / Предприниматель. Индивидуальные проекты, стартапы, независимые разработки с измеримыми результатами (пилот, патент, продажи, публикации)."
                                                price="14 000₽"
                                            />
                                        </div>
                                        <div class="S-BUTTONS-entity S-BUTTONS-all">
                                            <x-blades.mobile.application.select.button
                                                type="entity"
                                                color="green"
                                                icon="briefcase"
                                                icon_height="8.3dvw"
                                                title="Юридическое лицо"
                                                text="Юридическое лицо / Компания. Технологические проекты и команды на стадии MVP и выше с отраслевым эффектом и потенциалом масштабирования. Компании могут подать до 3 заявок в любые из 5 номинаций."
                                                price="90 000₽"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="S-SELECT-description">
                                <div class="S-DESCRIPTION-wrapper">
                                    <div class="S-DESCRIPTION-carcass">
                                        <div class="S-DESCRIPTION-icon">
                                            <x-svg.icons.info
                                                class="I-DESCRIPTION-icon"
                                            />
                                        </div>
                                        <div class="S-DESCRIPTION-text">
                                            <p class="T-DESCRIPTION-text TYPO-M-PRESET-CORE_P">Участие только для проектов с измеримым эффектом. Оплата организационного взноса только после верификации. Орг. взнос включает билет «Стандарт» на торжественную церемонию награждения премии МИЛ.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-APPLICATION-form S-APPLICATION-student S-APPLICATION-window" id="LANDING-MOBILE-APPLICATION-WINDOW-STUDENT" style="display: none">
                    <x-blades.mobile.application.form
                        type="student"
                    />
                </div>
                <div class="S-APPLICATION-form S-APPLICATION-individual S-APPLICATION-window" id="LANDING-MOBILE-APPLICATION-WINDOW-INDIVIDUAL" style="display: none">
                    <x-blades.mobile.application.form
                        type="individual"
                    />
                </div>
                <div class="S-APPLICATION-form S-APPLICATION-entity S-APPLICATION-window" id="LANDING-MOBILE-APPLICATION-WINDOW-ENTITY" style="display: none">
                    <x-blades.mobile.application.form
                        type="entity"
                    />
                </div>
            </div>
        </div>
    </div>
    <header class="S-MOBILE-header">
        <div class="S-HEADER-wrapper">
            <div class="S-HEADER-carcass">
                <div class="S-HEADER-button">
                    <button class="B-HEADER-button" id="LANDING-MOBILE-HEADER-OPEN">
                        <x-svg.icons.menu.open
                            class="I-HEADER-button"
                        />
                    </button>
                </div>
                <div class="S-HEADER-overlay" id="LANDING-MOBILE-HEADER-OVERLAY">
                    <div class="S-OVERLAY-wrapper" id="LANDING-MOBILE-HEADER-OVERLAY_WRAPPER">
                        <div class="S-OVERLAY-carcass">
                            <div class="S-OVERLAY-background">
                                <div class="S-BACKGROUND-wrapper">
                                    <div class="S-BACKGROUND-carcass">
                                        <x-svg.logo.any_hollow_mobile_header_background
                                            class="I-BACKGROUND-shape"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="S-OVERLAY-content">
                                <div class="S-CONTENT-wrapper">
                                    <div class="S-CONTENT-carcass">
                                        <div class="S-CONTENT-close">
                                            <button class="B-CONTENT-close" id="LANDING-MOBILE-HEADER-CLOSE">
                                                <x-svg.icons.menu.close
                                                    class="I-CONTENT-close"
                                                />
                                            </button>
                                        </div>
                                        <div class="S-CONTENT-action">
                                            <button class="B-CONTENT-action" id="LANDING-MOBILE-HEADER-ACTION_BUTTON">
                                                <p class="T-CONTENT-action TYPO-M-PRESET-CORE_H3_LIGHT">Подать заявку</p>
                                            </button>
                                        </div>
                                        <div class="S-CONTENT-logo">
                                            <a class="L-CONTENT-logo" href="#hero-m">
                                                <x-svg.logo.any_hollow_mobile_header
                                                    class="I-CONTENT-logo"
                                                />
                                            </a>
                                        </div>
                                        <div class="S-CONTENT-text">
                                            <a class="L-CONTENT-text TYPO-M-PRESET-CORE_H3_LIGHT" href="#tracks-m">Номинации</a>
                                            <a class="L-CONTENT-text TYPO-M-PRESET-CORE_H3_LIGHT" href="#dates-m">Этапы</a>
                                            <a class="L-CONTENT-text TYPO-M-PRESET-CORE_H3_LIGHT" href="#partnership-m">Партнерство</a>
                                            <a class="L-CONTENT-text TYPO-M-PRESET-CORE_H3_LIGHT" href="#prizes-m">Награды</a>
                                            <a class="L-CONTENT-text TYPO-M-PRESET-CORE_H3_LIGHT" href="#conditions-m">Условия</a>
                                            <a class="L-CONTENT-text TYPO-M-PRESET-CORE_H3_LIGHT" href="#jury-m">Жюри</a>
                                            <a class="L-CONTENT-text TYPO-M-PRESET-CORE_H3_LIGHT" href="#news-m">Новости</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="S-MOBILE-main">
        <div class="S-MAIN-wrapper">
            <div class="S-MAIN-carcass">
                <div class="S-MAIN-hero" id="hero-m">
                    <div class="S-HERO-wrapper">
                        <div class="S-HERO-carcass">
                            <div class="S-HERO-background">
                                <div class="S-BACKGROUND-wrapper">
                                    <div class="S-BACKGROUND-carcass">
                                        <x-svg.logo.color_hollow_mobile_hero
                                            class="I-BACKGROUND-shape"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="S-HERO-content">
                                <div class="S-CONTENT-wrapper">
                                    <div class="S-CONTENT-carcass">
                                        <div class="S-CONTENT-logo">
                                            <x-svg.logo.color_full_2
                                                class="I-CONTENT-logo"
                                            />
                                        </div>
                                        <div class="S-CONTENT-heading">
                                            <h1 class="T-CONTENT-heading TYPO-M-PRESET-HERO_HEADING">
                                                МОЛОДЫЕ<br>ИННОВАЦИОННЫЕ<br>ЛИДЕРЫ
                                                <span class="T-CONTENT-heading_alt TYPO-M-PRESET-HERO_HEADING_ALT">России и Беларуси</span>
                                            </h1>
                                        </div>
                                        <div class="S-CONTENT-description">
                                            <p class="T-CONTENT-description TYPO-M-PRESET-HERO_DESCRIPTION">премия Российской Ассоциации<br>Инновационного Развития</p>
                                        </div>
                                        <div class="S-CONTENT-rair">
                                            <x-svg.rair.color_full
                                                class="I-CONTENT-rair"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-reason">
                    <div class="S-REASON-wrapper">
                        <div class="S-REASON-carcass">
                            <div class="S-REASON-heading">
                                <h2 class="T-REASON-heading TYPO-M-PRESET-CORE_H2">Зачем участвовать?</h2>
                            </div>
                            <div class="S-REASON-description">
                                <p class="T-REASON-description TYPO-M-PRESET-HERO_DESCRIPTION">Ваше инновационное лидерство получит признание профессионалов и внимание медиа.<br>Победа гарантирует участнику:</p>
                            </div>
                            <div class="S-REASON-number_1 S-REASON-number">
                                <p class="T-REASON-number TYPO-M-PRESET-CORE_H2">1.</p>
                            </div>
                            <div class="S-REASON-answer_1 S-REASON-answer">
                                <p class="T-REASON-answer TYPO-M-PRESET-HERO_DESCRIPTION">Денежный приз на дальнейшее<br>развитие и значимый репутационный актив.</p>
                            </div>
                            <div class="S-REASON-number_2 S-REASON-number">
                                <p class="T-REASON-number TYPO-M-PRESET-CORE_H2">2.</p>
                            </div>
                            <div class="S-REASON-answer_2 S-REASON-answer">
                                <p class="T-REASON-answer TYPO-M-PRESET-HERO_DESCRIPTION">Интеграция в экосистему РАИР<br>для профессиональной кооперации<br>и масштабирования.</p>
                            </div>
                            <div class="S-REASON-number_3 S-REASON-number">
                                <p class="T-REASON-number TYPO-M-PRESET-CORE_H2">3.</p>
                            </div>
                            <div class="S-REASON-answer_3 S-REASON-answer">
                                <p class="T-REASON-answer TYPO-M-PRESET-HERO_DESCRIPTION">Приоритетный доступ к сильным игрокам рынка, партнёрами инвесторам, новые возможности для внедрения проектов.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-blue_bar S-MAIN-bar"></div>
                <div class="S-MAIN-goals" id="goals-m">
                    <div class="S-GOALS-wrapper">
                        <div class="S-GOALS-carcass">
                            <div class="S-GOALS-title">
                                <h2 class="TYPO-M-PRESET-CORE_H2">О премии</h2>
                            </div>
                            <div class="S-GOALS-cards">
                                <div class="S-CARDS-wrapper">
                                    <div class="S-CARDS-carcass">
                                        <x-blades.mobile.goals.card
                                            number="1"
                                            color="blue"
                                            icon="award"
                                            icon_rotate="-7deg"
                                            icon_transform="scale(102%) translateY(5%)"
                                            background_transform="scale(270%) translateX(-1%) translateY(-7%) rotate(12deg)"
                                            title="Для кого"
                                            text1="Премия создана для тех, кто уже прошёл путь от идеи до работающего продукта и может показать измеримый эффект для рынка, науки или своего региона."
                                            text2="МИЛ выделяет лидеров, перешедших из стартап-энтузиастов в системных игроков, и победа в пяти номинациях подтверждает зрелость решений, открывая доступ к экспертам и стратегическим возможностям."
                                        />
                                        <x-blades.mobile.goals.card
                                            number="2"
                                            color="green"
                                            icon="papers"
                                            icon_rotate="-7deg"
                                            icon_transform="scale(103%)"
                                            background_transform="scale(268%) translateX(-12%) translateY(-16%) rotate(5deg)"
                                            title="Цели и задачи"
                                            text1="Премия формирует трек роста, где лидерство — это внедрения, а каталог проектов МИЛ становится витриной для корпораций, чтобы успешные практики тиражировались в отраслях, а экосистема РАИР даёт пространство для кооперации и грантов."
                                            text2="Премия закрепляет репутацию трека как отраслевого стандарта, маркера зрелости и надёжности для инвесторов и вузов, поднимая видимость молодых инноваторов и признание их на уровне индустрии."
                                        />
                                        <x-blades.mobile.goals.card
                                            number="3"
                                            color="blue"
                                            icon="court"
                                            icon_rotate="-7deg"
                                            icon_transform="scale(90%)"
                                            background_transform="scale(300%) translateX(-21.8%) translateY(-6.5%) rotate(-5deg)"
                                            title="Об организаторе"
                                            text1="РАИР объединяет индустриальных партнёров, научные центры и вузы для единой инфраструктуры поддержки технологий, действует с июня 2008 года и стала рупором общественного мнения по стратегиям инновационного развития."
                                            text2="Ассоциация внедряет разработки в реальный сектор, развивает кооперацию науки и бизнеса, а также популяризирует инженерный труд и предпринимательские инициативы."
                                        />
                                        <x-blades.mobile.goals.card
                                            number="4"
                                            color="green"
                                            icon="leader"
                                            icon_rotate="-7deg"
                                            icon_transform="scale(100%)"
                                            background_transform="scale(275%) translateX(28%) translateY(0%) rotate(20deg)"
                                            title="Кто может участвовать"
                                            text1="Молодые лидеры 20–40 лет, доказавшие свою эффективность: фаундеры и CEO, корпоративные инноваторы, руководители технопарков, инжиниринговых цетров, ОЭЗ, региональные управленцы, академические предприниматели,"
                                            text2="руководители ПИШ, преподаватели инноватики, наставники,социальные визионеры из EdTech, MedTech, AgroTech, те, кто превращает территории в точки роста.<br><br>Для наставников нет возрастных ограничений."
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-blades.mobile.main.rair
                    number="1"
                    heading="Превращаем реальные достижения в масштабный эффект"
                    text="15 номинаций сгруппированы по 5 трекам — пяти векторам влияния. Победитель каждой претендует на Гран-при «Лидер года МИЛ»."
                />
                <div class="S-MAIN-tracks" id="tracks-m">
                    <div class="S-TRACKS-wrapper">
                        <div class="S-TRACKS-carcass">
                            <div class="S-TRACKS-title">
                                <h2 class="TYPO-M-PRESET-CORE_H2">Номинации</h2>
                            </div>
                            <div class="S-TRACKS-cards">
                                <div class="S-CARDS-wrapper">
                                    <div class="S-CARDS-carcass">
                                        <x-blades.mobile.tracks.card
                                            number="1"
                                            color="blue"
                                            icon="briefcase"
                                            icon_scale="9.97dvw"
                                            background_transform="scale(190%) translateX(15%) translateY(72%) rotate(-8deg)"
                                            heading="Технологии и Бизнес"
                                            text="
                                                <span>Для основателей и руководителей наукоёмких компаний, создавших уникальные продукты на основе ИС и достигших рыночных успехов.</span>
                                                <span class='TYPO-M-PRESET-CORE_H3'>Номинации трека:</span>
                                                <br>
                                                <span><span class='TYPO-M-PRESET-CORE_P_BOLD'>«Технологический прорыв»</span> (DeepTech-лидер)</span>
                                                <span>Критерии: Научная новизна, наличие интеллектуальной собственности, первые коммерческие контракты.</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Масштабирование смыслов»</span>
                                                <span>Критерии: Темпы роста, доля рынка, выход на федеральный или международный уровень.</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Международная экспансия»</span>
                                                <span>Критерий: Объём экспортной выручки, география присутствия, адаптация продукта, партнёрства с иностранными институтами.</span>
                                                "
                                        />
                                        <x-blades.mobile.tracks.card
                                            number="2"
                                            color="green"
                                            icon="office"
                                            icon_scale="10.62dvw"
                                            background_transform="scale(190%) translateX(16%) translateY(71%) rotate(6deg)"
                                            heading="Корпорации и Индустрия"
                                            text="
                                                <span>Для основателей, руководителей компаний и R&D, инженерных команд, запустивших новый промышленный продукт или производственную линию.</span>
                                                <span class='TYPO-M-PRESET-CORE_H3'>Номинации трека:</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Архитектор трансформации»</span>
                                                <span>Критерий: Измеримый экономический эффект цифровой или продуктовой трансформации, скорость внедрения, тиражируемость.</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Индустриальный чемпион»</span>
                                                <span>Критерий: Уровень технологической готовности от УГТ5 , импортозамещающий эффект, объём внедрения, отраслевой эффект.</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Кооперация ради суверенитета»</span>
                                                <span>Критерий: Масштаб кооперации, межкорпоративные консорциумы, снижение зависимости от импорта.</span>
                                                "
                                        />
                                        <x-blades.mobile.tracks.card
                                            number="3"
                                            color="blue"
                                            icon="region"
                                            icon_scale="11.92dvw"
                                            background_transform="scale(195%) translateX(-6%) translateY(64%) rotate(-7deg)"
                                            heading="Регионы и Территории"
                                            text="
                                                <span>Для глав регионов, муниципалитетов, технопарков, ОЭЗ, ИНТЦ и фондов, построивших работающую инфраструктуру инноваций.</span>
                                                <span class='TYPO-M-PRESET-CORE_H3'>Номинации трека:</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Строитель экосистемы»</span>
                                                <span>Критерий: Число резидентов и рабочих мест, фактический объём инвестиций, выживаемость проектов, импульс для развития смежных отраслей.</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Региональный прорыв»</span>
                                                <span>Критерий: Число проектов, улучшающих качество жизни, межрегиональная тиражируемость, масштабируемость, измеримый вклад в инвестиционную привлекательность.</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Устойчивое развитие территории»</span>
                                                <span>Критерий: Проекты, создающие долгосрочную ценность для территории: экологию, рабочие места, вовлечённость сообществ, устойчивую экономику.</span>
                                                "
                                        />
                                        <x-blades.mobile.tracks.card
                                            number="4"
                                            color="green"
                                            icon="society"
                                            icon_scale="9.75dvw"
                                            background_transform="scale(140%) translateX(-1%) translateY(90%) rotate(-7deg)"
                                            heading="Общество и Будущее"
                                            text="
                                                <span>Для лидеров, задающих новые стандарты, улучшающих качество жизни, формирующих кадровый резерв технологического развития.</span>
                                                <span class='TYPO-M-PRESET-CORE_H3'>Номинации трека:</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Технологии для жизни»</span>
                                                <span>Критерий: Охват аудитории в медицине, образовании, городской среде, экологии, социальный эффект, внедрение в государственные системы.</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Визионер отрасли»</span>
                                                <span>Критерий: Влияние на отраслевые стандарты, регулирование, масштаб изменений, признание сообществом, партнерства.</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Наставник поколения»</span>
                                                <span>Критерий: Масштаб образовательных инициатив, трудоустройство выпускников, партнёрства с вузами, развитие талантов.</span>
                                                "
                                        />
                                        <x-blades.mobile.tracks.card
                                            number="5"
                                            color="blue"
                                            icon="engineering"
                                            icon_scale="11.49dvw"
                                            background_transform="scale(185%) translateX(16%) translateY(60%) rotate(10deg)"
                                            heading="Наука и Инженерия"
                                            text="
                                                <span>Для учёных-предпринимателей, передовые инженерные школы и наставников, воспитавших технологических предпринимателей.</span>
                                                <span class='TYPO-M-PRESET-CORE_H3'>Номинации трека:</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Академический предприниматель»</span>
                                                <span>Критерии: Научная новизна и патенты (IP), объём коммерциализации, пилоты/внедрения, реальный вклад в развитие технологического рынка.</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Инженерный прорыв»</span>
                                                <span>Критерии: техническая новизна и сложность, стадия реализации, потенциал масштабирования, кооперация с индустриальным партнёром.</span>
                                                <br>
                                                <span class='TYPO-M-PRESET-CORE_P_BOLD'>«Наставник инноваторов»</span>
                                                <span>Критерии: количество выпускников, основавших компании, реализовавших инновационные проекты, вклад в образовательные программы по технологическому предпринимательству.</span>
                                                "
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-dates" id="dates-m">
                    <div class="S-DATES-wrapper">
                        <div class="S-DATES-carcass">
                            <div class="S-DATES-title">
                                <h2 class="TYPO-M-PRESET-CORE_H2">Этапы</h2>
                            </div>
                            <div class="S-DATES-widget">
                                <div class="S-WIDGET-wrapper">
                                    <div class="S-WIDGET-carcass">
                                        <x-blades.mobile.dates.lid
                                            number="1"
                                            state="past"
                                        />
                                        <x-blades.mobile.dates.shelf
                                            number="1"
                                            date="25 Сентября, 2026"
                                            description="Старт премии. Начало приема заявок."
                                            state="present"
                                        />
                                        <x-blades.mobile.dates.shelf
                                            number="2"
                                            date="10 Ноября, 2026"
                                            description="Верификация. Формирование списка номинантов."
                                            state="future"
                                        />
                                        <x-blades.mobile.dates.shelf
                                            number="3"
                                            date="25 Декабря, 2026"
                                            description="Независимая экспертная оценка жюри и выставление баллов по критериям."
                                            state="future"
                                        />
                                        <x-blades.mobile.dates.shelf
                                            number="4"
                                            date="15 Января, 2027"
                                            description="Отбор финалистов по каждой номинации. Объявление шорт-листа."
                                            state="future"
                                        />
                                        <x-blades.mobile.dates.shelf
                                            number="5"
                                            date="Март, 2027"
                                            description="Защита проектов. Торжественное награждение финалистов."
                                            state="future"
                                        />
                                        <x-blades.mobile.dates.lid
                                            number="2"
                                            state="future"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-partnership" id="partnership-m">
                    <div class="S-PARTNERSHIP-wrapper">
                        <div class="S-PARTNERSHIP-carcass">
                            <div class="S-PARTNERSHIP-background DEV-DISABLE_SELECTION">
                                <div class="S-BACKGROUND-wrapper">
                                    <div class="S-BACKGROUND-carcass">
                                        <x-svg.backgrounds.mobile.rair_2
                                            class="I-BACKGROUND-shape"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="S-PARTNERSHIP-content">
                                <div class="S-CONTENT-wrapper">
                                    <div class="S-CONTENT-carcass">
                                        <div class="S-CONTENT-title">
                                            <h2 class="T-CONTENT-title TYPO-M-PRESET-CORE_H2">Партнерство с Премией</h2>
                                        </div>
                                        <div class="S-CONTENT-text">
                                            <p class="T-CONTENT-text TYPO-M-PRESET-CORE_P">
                                                Премия МИЛ открыта к партнёрству<br>
                                                с компаниями, институтами развития, медиа<br>
                                                и отраслевыми объединениями. Участвуя, вы<br>
                                                усиливаете позиционирование и становитесь<br>
                                                частью актуальной инициативы по развитию<br>
                                                инновационного лидерства.
                                            </p>
                                        </div>
                                        <div class="S-CONTENT-button">
                                            <button class="B-CONTENT-button TYPO-M-PRESET-CORE_H3" id="LANDING-MOBILE-PARTNERSHIP-COPY_BUTTON">
                                                <span class="T-BUTTON-heading">hello@milpremia.ru</span>
                                                <x-svg.icons.copy
                                                    class="I-BUTTON-icon"
                                                    style=""
                                                />
                                            </button>
                                        </div>
                                        <div class="S-CONTENT-note">
                                            <p class="T-CONTENT-note TYPO-M-PRESET-CORE_P">
                                                Напишите нам — обсудим форматы сотрудничества.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-prizes" id="prizes-m">
                    <div class="S-PRIZES-wrapper">
                        <div class="S-PRIZES-carcass">
                            <div class="S-PRIZES-title">
                                <h2 class="TYPO-M-PRESET-CORE_H2">Награды</h2>
                            </div>
                            <div class="S-PRIZES-widget">
                                <div class="S-WIDGET-wrapper">
                                    <div class="S-WIDGET-carcass">
                                        <div class="S-WIDGET-fund">
                                            <h3 class="T-FUND-heading TYPO-M-PRESET-CORE_H3">Призовой фонд<br>2 000 000₽</h3>
                                        </div>
                                        <div class="S-WIDGET-distribution">
                                            <div class="S-DISTRIBUTION-wrapper">
                                                <div class="S-DISTRIBUTION-carcass">
                                                    <div class="S-DISTRIBUTION-background">
                                                        <div class="S-BACKGROUND-wrapper">
                                                            <div class="S-BACKGROUND-carcass">
                                                                <x-svg.backgrounds.prizes
                                                                    class="I-BACKGROUND-shape"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="S-DISTRIBUTION-content">
                                                        <div class="S-CONTENT-wrapper">
                                                            <div class="S-CONTENT-carcass">
                                                                <x-blades.mobile.prizes.case
                                                                    place="laureates"
                                                                    heading="15 Лауреатов"
                                                                    color="pale_blue"
                                                                >
                                                                    <x-svg.icons.laurel_branch
                                                                        class="I-INFO-icon"
                                                                        style="scale: 1.23;"
                                                                    />
                                                                    <h3 class="T-INFO-text TYPO-M-PRESET-CORE_H3">диплом лауреата</h3>
                                                                </x-blades.mobile.prizes.case>
                                                                <div class="S-CONTENT-pointer S-CONTENT-pointer_1">
                                                                    <x-svg.icons.pointer_down
                                                                        class="I-POINTER-icon"
                                                                    />
                                                                </div>
                                                                <x-blades.mobile.prizes.case
                                                                    place="finalists"
                                                                    heading="5 Финалистов"
                                                                    color="blue"
                                                                >
                                                                    <x-svg.icons.medal
                                                                        class="I-INFO-icon"
                                                                        style="scale: 1.05;"
                                                                    />
                                                                    <h3 class="T-INFO-text TYPO-M-PRESET-CORE_H3">по 200 000₽</h3>
                                                                </x-blades.mobile.prizes.case>
                                                                <div class="S-CONTENT-pointer S-CONTENT-pointer_2">
                                                                    <x-svg.icons.pointer_down
                                                                        class="I-POINTER-icon"
                                                                    />
                                                                </div>
                                                                <x-blades.mobile.prizes.case
                                                                    place="winner"
                                                                    heading="1 Победитель Гран-При"
                                                                    color="green"
                                                                >
                                                                    <x-svg.icons.cup
                                                                        class="I-INFO-icon"
                                                                        style="scale: 1;"
                                                                    />
                                                                    <h3 class="T-INFO-text TYPO-M-PRESET-CORE_H3">1 000 000₽</h3>
                                                                </x-blades.mobile.prizes.case>
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
                <div class="S-MAIN-conditions" id="conditions-m">
                    <div class="S-CONDITIONS-wrapper">
                        <div class="S-CONDITIONS-carcass">
                            <div class="S-CONDITIONS-title">
                                <h2 class="TYPO-M-PRESET-CORE_H2">Условия участия</h2>
                            </div>
                            <div class="S-CONDITIONS-cards">
                                <div class="S-CARDS-wrapper">
                                    <div class="S-CARDS-carcass">
                                        <x-blades.mobile.conditions.card
                                            type="individual"
                                            color="blue"
                                            icon="person"
                                            icon_scale="11.6dvw"
                                            background_shape="people"
                                            background_transform="scale(290%) translateX(-10.5%) translateY(-31%) rotate(-1deg)"
                                            heading="Физическое Лицо"
                                            description="Физическое лицо / Предприниматель.<br>Индивидуальные проекты, стартапы,<br>независимые разработки с измеримыми<br>результатами (пилот, патент, продажи,<br>публикации)."
                                            price="14 000₽ (студентам 7 000₽)"
                                        />
                                        <x-blades.mobile.conditions.card
                                            type="entity"
                                            color="green"
                                            icon="briefcase"
                                            icon_scale="10.6dvw"
                                            background_shape="briefcases"
                                            background_transform="scale(300%) translateX(44%) translateY(-10%) rotate(45deg)"
                                            heading="Юридическое Лицо"
                                            description="Юридическое лицо / Компания.<br>Технологические проекты и команды<br>на стадии MVP и выше с отраслевым<br>эффектом и потенциалом масштабирования. Компании могут подать до 3 заявок<br>в любые из 5 номинаций."
                                            price="90 000₽"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-jury" id="jury-m">
                    <div class="S-JURY-wrapper">
                        <div class="S-JURY-carcass">
                            <div class="S-JURY-title">
                                <h2 class="TYPO-M-PRESET-CORE_H2">Жюри / Эксперты</h2>
                            </div>
                            <div class="S-JURY-cards">
                                <div class="S-CARDS-wrapper">
                                    <div class="S-CARDS-carcass">
                                        <x-blades.mobile.jury.card
                                            number="1"
                                            color="blue"
                                            name="Шичкина Марина Ивановна"
                                            title='Генеральный директор НП «Росссийская<br>ассоциация инновационного развития»'
                                            portrait="images/people/optimized/shichkina_marina_ivanovna-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="2"
                                            color="green"
                                            name="Поденок Андрей Евгеньевич"
                                            title='Президент МОО «Московская<br>ассоциация предпринимателей»'
                                            portrait="images/people/optimized/podenok_andrey_evgenievich-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="3"
                                            color="blue"
                                            name="Колесников Андрей Николаевич"
                                            title='Директор аналитического консалтингового<br>центра экономического факультета<br>МГУ им. М.В. Ломоносова'
                                            portrait="images/people/optimized/kolesnikov_andrey_nikolaevich-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="4"
                                            color="green"
                                            name="Бадулин Николай Александрович"
                                            title='Венчурный инвестор, генеральный директор<br>ИФК «Самотлор-Инвест»'
                                            portrait="images/people/optimized/badulin_nikolay_alexandrovich-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="5"
                                            color="blue"
                                            name="Пастухов Александр Владимирович"
                                            title='Вице-президент Национального экологического института<br>устойчивого развития'
                                            portrait="images/people/optimized/pastuhov_alexandr_vladimirovich-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="6"
                                            color="green"
                                            name="Лейбинен Снежана Александровна"
                                            title='Председатель Гильдии предпринимателей<br>Турочагского района Ресублики Алтай'
                                            portrait="images/people/optimized/leybinen_snezhana_alexandrovna-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="7"
                                            color="blue"
                                            name="Нестеренко Алексей Дмитриевич"
                                            title='Генеральный директор логистической<br>компании «ВекторФрахт»'
                                            portrait="images/people/optimized/nesterenko_alexey_dmitrievich-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="8"
                                            color="green"
                                            name="Замятина Надежда Юрьевна"
                                            title='Профессор Высшей школы урбанистики<br>им. А.А. Высоковского, факультет городского<br>и регионального развития'
                                            portrait="images/people/optimized/zamyatina_nadezhda_yurevna-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="9"
                                            color="blue"
                                            name="Гусева Ольга Вячеславовна"
                                            title='Девелопер, генеральный директор<br>инвестиционной компании «КЕЙ КАПИТАЛ»'
                                            portrait="images/people/optimized/guseva_olga_vyacheslavovna-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="10"
                                            color="green"
                                            name="Нагиева Валентина Викторовна"
                                            title='Генеральный директор «ПетроСервис»,<br>исполнительный директор<br>«Доверие потребителя»'
                                            portrait="images/people/optimized/nagieva_valentina_viktorovna-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="11"
                                            color="blue"
                                            name="Бурда Павел<br>Федорович"
                                            title='Предприниматель, сооснователь<br>проектов «Гениальный ребенок»<br>и «ArtVisionAi»'
                                            portrait="images/people/optimized/burda_pavel_fedorovich-portrait-01.webp"
                                        />
                                        <x-blades.mobile.jury.card
                                            number="12"
                                            color="green"
                                            name="Липина Светлана Артуровна"
                                            title='Заместитель председателя<br>СОПС ВАВТ Минэкономразвития РФ'
                                            portrait="images/people/optimized/lipina_svetlana_arturovna-portrait-01.webp"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-MAIN-news" id="news-m">
                    <div class="S-NEWS-wrapper">
                        <div class="S-NEWS-carcass">
                            <div class="S-NEWS-title">
                                <h2 class="TYPO-M-PRESET-CORE_H2">Новости</h2>
                            </div>
                            <div class="S-NEWS-feed">
                                <div class="S-FEED-wrapper">
                                    <div class="S-FEED-carcass">
                                        <div class="S-FEED-articles">
                                            <div class="S-ARTICLES-wrapper" id="LANDING-MOBILE-NEWS-ARTICLES-WRAPPER">
                                                <div class="S-ARTICLES-carcass" id="LANDING-MOBILE-NEWS-ARTICLES-CARCASS">
                                                    <x-blades.mobile.news.article
                                                        fresh="yes"
                                                        number="1"
                                                        date="14.08.2026"
                                                        headline="Короткий заголовок новой новости"
                                                        text="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                                    />
                                                    <x-blades.mobile.news.article
                                                        fresh="yes"
                                                        number="1"
                                                        date="14.08.2026"
                                                        headline="Короткий заголовок новой новости"
                                                        text="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                                    />
                                                    <x-blades.mobile.news.article
                                                        fresh="no"
                                                        number="1"
                                                        date="14.08.2026"
                                                        headline="Короткий заголовок новой новости"
                                                        text="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                                    />
                                                    <x-blades.mobile.news.article
                                                        fresh="no"
                                                        number="1"
                                                        date="14.08.2026"
                                                        headline="Короткий заголовок новой новости"
                                                        text="Субъектам РФ нужны готовые технологические команды под пилоты, но «мэтч» с ними происходит случайно."
                                                    />
                                                    <x-blades.mobile.news.article
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
                                                    <button class="B-BUTTON-main B-BUTTON-previous" id="LANDING-MOBILE-NEWS-PREVIOUS_BUTTON">
                                                        <x-svg.icons.arrow
                                                            class="I-BUTTON-icon"
                                                            style=""
                                                        />
                                                    </button>
                                                    <button class="B-BUTTON-main B-BUTTON-next" id="LANDING-MOBILE-NEWS-PREVIOUS_NEXT">
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
                <div class="S-MAIN-action" id="action-m">
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
                                            <h1 class="TYPO-M-PRESET-ACTION_HEADING">Ваш успех<br>начинается здесь!</h1>
                                        </div>
                                        <div class="S-CONTENT-button">
                                            <button class="B-CONTENT-button TYPO-M-PRESET-CORE_H3" id="LANDING-MOBILE-FOOTER-ACTION_BUTTON">
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
    <footer class="S-MOBILE-footer">
        <div class="S-FOOTER-wrapper">
            <div class="S-FOOTER-carcass">
                <div class="S-FOOTER-left">
                    <div class="S-LEFT-wrapper">
                        <div class="S-LEFT-carcass">
                            <div class="S-LEFT-rair">
                                <x-svg.rair.color_full
                                    class="I-LEFT-rair"
                                />
                            </div>
                            <div class="S-LEFT-links TYPO-M-PRESET-CORE_P">
                                <a class="L-LEFT-links" href="https://rair-info.ru/" rel="noopener noreferrer" target="_blank">Сайт РАИР</a>
                                <a class="L-LEFT-links" href="mailto:org@rair-info.ru">По всем вопросам:<br>org@rair-info.ru</a>
                            </div>
                            <div class="S-LEFT-docs TYPO-M-PRESET-CORE_SMALL">
                                <a class="L-LEFT-docs" href="{{ asset('docs/public_offer.pdf') }}" target="_blank" rel="noopener noreferrer">Публичная оферта</a>
                                <a class="L-LEFT-docs" href="{{ asset('docs/regulations.pdf') }}" target="_blank" rel="noopener noreferrer">Положение о премии</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="S-FOOTER-right">
                    <div class="S-RIGHT-wrapper">
                        <div class="S-RIGHT-carcass">
                            <div class="S-RIGHT-mil">
                                <x-svg.logo.color_full_2
                                    class="I-RIGHT-mil"
                                />
                                <p class="T-RIGHT-mil TYPO-M-PRESET-CORE_H4">МОЛОДЫЕ<br>ИННОВАЦИОННЫЕ<br>ЛИДЕРЫ</p>
                            </div>
                            <div class="S-RIGHT-credit">
                                <p class="T-RIGHT-credit TYPO-M-PRESET-CORE_SMALL">© Все права защищены</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
