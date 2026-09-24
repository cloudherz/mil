<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $applicationType;
    public int $applicationId;
    public string $applicantName;
    public array $files;

    public ?string $personName = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $description = null;
    public ?string $trackStudent = null;
    public ?string $trackIndividual = null;
    public ?string $organizationName = null;
    public ?string $organizationTin = null;
    public ?string $organizationRepresentative = null;
    public ?string $track1 = null;
    public ?string $track2 = null;
    public ?string $track3 = null;

    /**
     * Соответствие номера трека и названия
     */
    private const TRACK_NAMES = [
        '1'  => 'Технологический прорыв',
        '2'  => 'Масштабирование смыслов',
        '3'  => 'Международная экспансия',
        '4'  => 'Архитектор трансформации',
        '5'  => 'Индустриальный чемпион',
        '6'  => 'Кооперация ради суверенитета',
        '7'  => 'Строитель экосистемы',
        '8'  => 'Региональный прорыв',
        '9'  => 'Устойчивое развитие территории',
        '10' => 'Технологии для жизни',
        '11' => 'Визионер отрасли',
        '12' => 'Наставник поколения',
        '13' => 'Академический предприниматель',
        '14' => 'Инженерный прорыв',
        '15' => 'Наставник инноваторов',
    ];

    public function __construct(
        array $applicationData,
        string $applicationType,
        int $applicationId,
        string $applicantName,
        array $files = []
    ) {
        $this->applicationType = $applicationType;
        $this->applicationId = $applicationId;
        $this->applicantName = $applicantName;
        $this->files = $files;

        match ($applicationType) {
            'student' => $this->fillStudentData($applicationData),
            'individual' => $this->fillIndividualData($applicationData),
            'entity' => $this->fillEntityData($applicationData),
            default => null,
        };
    }

    private function fillStudentData(array $data): void
    {
        $this->personName = $data['person_name_student'] ?? null;
        $this->email = $data['email_student'] ?? null;
        $this->phone = $data['phone_student'] ?? null;
        $this->description = $data['description_student'] ?? null;
        $this->trackStudent = $this->getTrackName($data['track_student'] ?? null);
    }

    private function fillIndividualData(array $data): void
    {
        $this->personName = $data['person_name_individual'] ?? null;
        $this->email = $data['email_individual'] ?? null;
        $this->phone = $data['phone_individual'] ?? null;
        $this->description = $data['description_individual'] ?? null;
        $this->trackIndividual = $this->getTrackName($data['track_individual'] ?? null);
    }

    private function fillEntityData(array $data): void
    {
        $this->organizationName = $data['organization_name'] ?? null;
        $this->organizationTin = $data['organization_tin'] ?? null;
        $this->organizationRepresentative = $data['organization_representative'] ?? null;
        $this->email = $data['email_entity'] ?? null;
        $this->phone = $data['phone_entity'] ?? null;
        $this->description = $data['description_entity'] ?? null;
        $this->track1 = $this->getTrackName($data['track_1'] ?? null);
        $this->track2 = $this->getTrackName($data['track_2'] ?? null);
        $this->track3 = $this->getTrackName($data['track_3'] ?? null);
    }

    /**
     * Преобразование номера трека в название.
     */
    private function getTrackName(?string $trackNumber): ?string
    {
        if ($trackNumber === null || $trackNumber === '' || $trackNumber === '-') {
            return null;
        }

        return self::TRACK_NAMES[$trackNumber] ?? $trackNumber;
    }

    public function envelope(): Envelope
    {
        $typeLabels = [
            'student' => 'Студент',
            'individual' => 'Физ. лицо',
            'entity' => 'Организация',
        ];

        $typeLabel = $typeLabels[$this->applicationType] ?? ucfirst($this->applicationType);

        return new Envelope(
            from: new Address(
                config('mail.from.address'),
                config('mail.from.name'),
            ),
            subject: "{$typeLabel} №{$this->applicationId} — {$this->applicantName}",
        );
    }

    public function content(): Content
    {
        $view = match ($this->applicationType) {
            'student' => 'emails.application.student',
            'individual' => 'emails.application.individual',
            'entity' => 'emails.application.entity',
            default => 'emails.application.default',
        };

        return new Content(
            view: $view,
            with: [
                'applicationType' => $this->applicationType,
                'applicationId' => $this->applicationId,
                'applicantName' => $this->applicantName,
                'personName' => $this->personName,
                'email' => $this->email,
                'phone' => $this->phone,
                'description' => $this->description,
                'trackStudent' => $this->trackStudent,
                'trackIndividual' => $this->trackIndividual,
                'organizationName' => $this->organizationName,
                'organizationTin' => $this->organizationTin,
                'organizationRepresentative' => $this->organizationRepresentative,
                'track1' => $this->track1,
                'track2' => $this->track2,
                'track3' => $this->track3,
            ]
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        foreach ($this->files as $file) {
            $diskPath = $file['disk_path'] ?? null;

            if (!$diskPath || !Storage::disk('local')->exists($diskPath)) {
                Log::warning('ApplicationMail: attachment missing', [
                    'application_id' => $this->applicationId,
                    'disk_path' => $diskPath,
                ]);
                continue;
            }

            $absolutePath = Storage::disk('local')->path($diskPath);

            $attachments[] = Attachment::fromPath($absolutePath)
                ->as($file['name'])
                ->withMime(
                    $file['mime']
                    ?? 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                );
        }

        return $attachments;
    }

    public function build(): static
    {
        return $this->withSymfonyMessage(function (\Symfony\Component\Mime\Email $message) {
            $message->getHeaders()->addTextHeader('X-Application-Id', (string) $this->applicationId);
        });
    }
}
