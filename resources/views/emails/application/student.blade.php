<!DOCTYPE html>
<html>
<head>
    <title>Заявка студента</title>
</head>
<body>
    <h2>Заявка студента №{{ $applicationId }}</h2>
    <p><strong>ФИО:</strong> {{ $personName ?? 'Не указано' }}</p>
    <p><strong>Почта:</strong> {{ $email ?? 'Не указана' }}</p>
    <p><strong>Телефон:</strong> {{ $phone ?? 'Не указан' }}</p>
    <p><strong>Номинация:</strong> {{ $trackStudent ?? 'Не указана' }}</p>
    <p><strong>Описание проекта:</strong> {!! nl2br(e($description)) ?? 'Не указано' !!}</p>
</body>
</html>
