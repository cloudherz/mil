<!DOCTYPE html>
<html>
<head>
    <title>Заявка организации</title>
</head>
<body>
    <h2>Заявка организации №{{ $applicationId }}</h2>
    <p><strong>Название организации:</strong> {{ $organizationName ?? 'Не указано' }}</p>
    <p><strong>ИНН:</strong> {{ $organizationTin ?? 'Не указан' }}</p>
    <p><strong>Представитель:</strong> {{ $organizationRepresentative ?? 'Не указан' }}</p>
    <p><strong>Почта:</strong> {{ $email ?? 'Не указана' }}</p>
    <p><strong>Телефон:</strong> {{ $phone ?? 'Не указан' }}</p>
    <p><strong>Направление 1:</strong> {{ $track1 ?? 'Не указано' }}</p>
    <p><strong>Направление 2:</strong> {{ $track2 ?? 'Не указано' }}</p>
    <p><strong>Направление 3:</strong> {{ $track3 ?? 'Не указано' }}</p>
    <p><strong>Описание проектов:</strong> {{ $description ?? 'Не указано' }}</p>
</body>
</html>
