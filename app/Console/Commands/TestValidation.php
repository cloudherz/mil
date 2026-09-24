<?php

namespace App\Console\Commands;

use App\Http\Controllers\EntityApplicationSubmitController;
use App\Http\Controllers\IndividualApplicationSubmitController;
use App\Http\Controllers\StudentApplicationSubmitController;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use ReflectionClass;

class TestValidation extends Command
{
    protected $signature = 'app:test-validation';
    protected $description = 'Прогоняет набор тестовых данных через правила валидации всех форм';

    public function handle(): int
    {
        $cases = $this->getTestCases();
        $failures = 0;
        $total = 0;

        foreach ($cases as $controllerClass => $controllerCases) {
            $this->newLine();
            $this->info("━━━ {$controllerClass} ━━━");

            $controller = app($controllerClass);
            $rules = $this->invokeProtected($controller, 'getValidationRules');
            $messages = $this->invokeProtected($controller, 'getValidationMessages');

            foreach ($controllerCases as $case) {
                $total++;
                $label = $case['label'];
                $data = $case['data'];
                $shouldPass = $case['shouldPass'];

                $validator = Validator::make($data, $rules, $messages);
                $passes = !$validator->fails();

                if ($passes === $shouldPass) {
                    $this->line("  ✅ {$label}");
                } else {
                    $failures++;
                    $expected = $shouldPass ? 'ПРОЙТИ' : 'УПАСТЬ';
                    $actual = $passes ? 'прошло' : 'упало';
                    $this->error("  ❌ {$label} — ожидалось {$expected}, а {$actual}");

                    if ($validator->fails()) {
                        foreach ($validator->errors()->all() as $err) {
                            $this->line("     ⤷ {$err}");
                        }
                    }
                }
            }
        }

        $this->newLine();
        $this->info("Итого: {$total} кейсов, провалено: {$failures}");

        return $failures === 0 ? self::SUCCESS : self::FAILURE;
    }

    /**
     * Позволяет вызвать protected-метод контроллера через рефлексию.
     */
    private function invokeProtected(object $object, string $method): mixed
    {
        $ref = new ReflectionClass($object);
        $m = $ref->getMethod($method);
        $m->setAccessible(true);
        return $m->invoke($object);
    }

    // ── Фабрики фейковых файлов ──────────────────────────

    private function fakePptx(): UploadedFile
    {
        return UploadedFile::fake()->create(
            'test.pptx',
            100,
            'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        );
    }

    private function fakePdf(): UploadedFile
    {
        return UploadedFile::fake()->create('test.pdf', 100, 'application/pdf');
    }

    private function fakeExe(): UploadedFile
    {
        return UploadedFile::fake()->create('virus.exe', 100, 'application/octet-stream');
    }

    private function getTestCases(): array
    {
        return [
            StudentApplicationSubmitController::class => [
                [
                    'label' => 'Валидные данные студента (pptx)',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов Иван',
                        'email_student' => 'ivan@mail.com',
                        'phone_student' => '+79991234567',
                        'track_student' => '1',
                        'description_student' => 'Мой проект',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Валидные данные студента (pdf)',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов Иван',
                        'email_student' => 'ivan@mail.com',
                        'phone_student' => '+79991234567',
                        'track_student' => '1',
                        'description_student' => 'Мой проект',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePdf()],
                    ],
                ],
                [
                    'label' => 'Валидный трек 15 (Наставник инноваторов) — должен пройти',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов Иван',
                        'email_student' => 'ivan@mail.com',
                        'phone_student' => '+79991234567',
                        'track_student' => '15',
                        'description_student' => 'Мой проект',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Валидный трек 8 (Региональный прорыв) — должен пройти',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов Иван',
                        'email_student' => 'ivan@mail.com',
                        'phone_student' => '+79991234567',
                        'track_student' => '8',
                        'description_student' => 'Мой проект',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Трек 16 (не существует) — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов Иван',
                        'email_student' => 'ivan@mail.com',
                        'phone_student' => '+79991234567',
                        'track_student' => '16',
                        'description_student' => 'Мой проект',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Трек 0 (не существует) — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов Иван',
                        'email_student' => 'ivan@mail.com',
                        'phone_student' => '+79991234567',
                        'track_student' => '0',
                        'description_student' => 'Мой проект',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'ФИО с точкой и апострофом',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => "О'Нил И.И.",
                        'email_student' => 'a@b.co',
                        'phone_student' => '+79991234567',
                        'track_student' => '3',
                        'description_student' => 'x',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'ФИО с латиницей — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Ivan Ivanov',
                        'email_student' => 'a@b.co',
                        'phone_student' => '+79991234567',
                        'track_student' => '1',
                        'description_student' => 'x',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'ФИО из 1 символа — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'И',
                        'email_student' => 'a@b.co',
                        'phone_student' => '+79991234567',
                        'track_student' => '1',
                        'description_student' => 'x',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Плохой телефон — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов',
                        'email_student' => 'a@b.co',
                        'phone_student' => '89991234567',
                        'track_student' => '1',
                        'description_student' => 'x',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Без галочки согласия — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов',
                        'email_student' => 'a@b.co',
                        'phone_student' => '+79991234567',
                        'track_student' => '1',
                        'description_student' => 'x',
                        'confirmation_student' => '0',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'EXE вместо pptx — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов',
                        'email_student' => 'a@b.co',
                        'phone_student' => '+79991234567',
                        'track_student' => '1',
                        'description_student' => 'x',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakeExe()],
                    ],
                ],
                [
                    'label' => 'Два файла для студента (max:1) — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов',
                        'email_student' => 'a@b.co',
                        'phone_student' => '+79991234567',
                        'track_student' => '1',
                        'description_student' => 'x',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx(), $this->fakePdf()],
                    ],
                ],
                [
                    'label' => 'Email с кириллицей — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов',
                        'email_student' => 'тест@mail.ru',
                        'phone_student' => '+79991234567',
                        'track_student' => '1',
                        'description_student' => 'x',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Email без TLD — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов',
                        'email_student' => 'test@mail',
                        'phone_student' => '+79991234567',
                        'track_student' => '1',
                        'description_student' => 'x',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Email с TLD 1 символ — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_student' => 'student',
                        'person_name_student' => 'Иванов',
                        'email_student' => 'test@mail.c',
                        'phone_student' => '+79991234567',
                        'track_student' => '1',
                        'description_student' => 'x',
                        'confirmation_student' => '1',
                        'files_student' => [$this->fakePptx()],
                    ],
                ],
            ],

            IndividualApplicationSubmitController::class => [
                [
                    'label' => 'Валидные данные физлица',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_individual' => 'individual',
                        'person_name_individual' => 'Петров Пётр',
                        'email_individual' => 'petr@mail.ru',
                        'phone_individual' => '+79998887766',
                        'track_individual' => '2',
                        'description_individual' => 'Описание проекта',
                        'confirmation_individual' => '1',
                        'files_individual' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Валидный трек 7 (Строитель экосистемы) — должен пройти',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_individual' => 'individual',
                        'person_name_individual' => 'Петров Пётр',
                        'email_individual' => 'petr@mail.ru',
                        'phone_individual' => '+79998887766',
                        'track_individual' => '7',
                        'description_individual' => 'Описание',
                        'confirmation_individual' => '1',
                        'files_individual' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Валидный трек 13 (Академический предприниматель) — должен пройти',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_individual' => 'individual',
                        'person_name_individual' => 'Петров Пётр',
                        'email_individual' => 'petr@mail.ru',
                        'phone_individual' => '+79998887766',
                        'track_individual' => '13',
                        'description_individual' => 'Описание',
                        'confirmation_individual' => '1',
                        'files_individual' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Трек 16 (не существует) — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_individual' => 'individual',
                        'person_name_individual' => 'Петров',
                        'email_individual' => 'petr@mail.ru',
                        'phone_individual' => '+79998887766',
                        'track_individual' => '16',
                        'description_individual' => 'Описание',
                        'confirmation_individual' => '1',
                        'files_individual' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Email без домена верхнего уровня — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_individual' => 'individual',
                        'person_name_individual' => 'Петров',
                        'email_individual' => 'petr@mail',
                        'phone_individual' => '+79998887766',
                        'track_individual' => '2',
                        'description_individual' => 'Описание',
                        'confirmation_individual' => '1',
                        'files_individual' => [$this->fakePptx()],
                    ],
                ],
            ],

            EntityApplicationSubmitController::class => [
                [
                    'label' => 'Валидные данные организации (1 трек)',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'ООО «Ромашка»',
                        'organization_tin' => '1234567890',
                        'organization_representative' => 'Иванов Иван',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '1',
                        'track_2' => '',
                        'track_3' => '',
                        'description_entity' => 'Проект компании',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Валидные данные организации (3 трека)',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'АО "Технологии+Бизнес"',
                        'organization_tin' => '123456789012',
                        'organization_representative' => 'Петров П.П.',
                        'email_entity' => 'info@tech.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '1',
                        'track_2' => '2',
                        'track_3' => '3',
                        'description_entity' => 'Описание',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx(), $this->fakePdf(), $this->fakePptx()],
                    ],
                ],
                [
                    'label' => '3 трека из новых (7, 13, 15) — должно пройти',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'ООО «Ромашка»',
                        'organization_tin' => '1234567890',
                        'organization_representative' => 'Иванов Иван',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '7',
                        'track_2' => '13',
                        'track_3' => '15',
                        'description_entity' => 'Описание',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Трек 1 = 15 (только один) — должно пройти',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'ООО «Ромашка»',
                        'organization_tin' => '1234567890',
                        'organization_representative' => 'Иванов',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '15',
                        'track_2' => '',
                        'track_3' => '',
                        'description_entity' => 'x',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Трек 1 = 16 (не существует) — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'ООО Ромашка',
                        'organization_tin' => '1234567890',
                        'organization_representative' => 'Иванов',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '16',
                        'track_2' => '',
                        'track_3' => '',
                        'description_entity' => 'x',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Трек 2 = 0 (не существует) — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'ООО Ромашка',
                        'organization_tin' => '1234567890',
                        'organization_representative' => 'Иванов',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '',
                        'track_2' => '0',
                        'track_3' => '',
                        'description_entity' => 'x',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Ни одного трека — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'ООО Ромашка',
                        'organization_tin' => '1234567890',
                        'organization_representative' => 'Иванов',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '',
                        'track_2' => '',
                        'track_3' => '',
                        'description_entity' => 'x',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'ИНН с буквами — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'ООО Ромашка',
                        'organization_tin' => 'ABC123',
                        'organization_representative' => 'Иванов',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '1',
                        'track_2' => '',
                        'track_3' => '',
                        'description_entity' => 'x',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'ИНН слишком длинный — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'ООО Ромашка',
                        'organization_tin' => '1234567890123',
                        'organization_representative' => 'Иванов',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '1',
                        'track_2' => '',
                        'track_3' => '',
                        'description_entity' => 'x',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Название орг. с / и & — должно пройти',
                    'shouldPass' => true,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'АО & Ко / Филиал #1',
                        'organization_tin' => '1234567890',
                        'organization_representative' => 'Иванов',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '1',
                        'track_2' => '',
                        'track_3' => '',
                        'description_entity' => 'x',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => 'Название орг. с эмодзи — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'ООО Ромашка 😀',
                        'organization_tin' => '1234567890',
                        'organization_representative' => 'Иванов',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '1',
                        'track_2' => '',
                        'track_3' => '',
                        'description_entity' => 'x',
                        'confirmation_entity' => '1',
                        'files_entity' => [$this->fakePptx()],
                    ],
                ],
                [
                    'label' => '4 файла для entity (max:3) — должно упасть',
                    'shouldPass' => false,
                    'data' => [
                        'application_type_entity' => 'entity',
                        'organization_name' => 'ООО Ромашка',
                        'organization_tin' => '1234567890',
                        'organization_representative' => 'Иванов',
                        'email_entity' => 'info@romashka.ru',
                        'phone_entity' => '+79991112233',
                        'track_1' => '1',
                        'track_2' => '',
                        'track_3' => '',
                        'description_entity' => 'x',
                        'confirmation_entity' => '1',
                        'files_entity' => [
                            $this->fakePptx(),
                            $this->fakePptx(),
                            $this->fakePdf(),
                            $this->fakePdf(),
                        ],
                    ],
                ],
            ],
        ];
    }
}
