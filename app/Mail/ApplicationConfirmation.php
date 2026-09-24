<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApplicationConfirmation extends Mailable
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

    private function getTrackName(?string $trackNumber): ?string
    {
        if ($trackNumber === null || $trackNumber === '' || $trackNumber === '-') {
            return null;
        }

        return self::TRACK_NAMES[$trackNumber] ?? $trackNumber;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: config('mail.from.address'),
            subject: 'Ваша заявка на Премию МИЛ отправлена успешно!',
        );
    }

    public function content(): Content
    {
        $view = match ($this->applicationType) {
            'student' => 'emails.confirmation.student',
            'individual' => 'emails.confirmation.individual',
            'entity' => 'emails.confirmation.entity',
            default => 'emails.confirmation.default',
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

    /**
     * В письмо-подтверждение пользователю файлы НЕ прикладываем —
     * они уже ушли админу. Плюс, чтобы не забивать почтовый ящик пользователя.
     */
    public function attachments(): array
    {
        return [];
    }
}
