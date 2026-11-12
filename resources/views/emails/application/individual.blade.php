<!DOCTYPE html>
<html>
<head>
    <title>Заявка физ. лица</title>
</head>
<body>
    <h2>Заявка физ. лица №{{ $applicationId }}</h2>
    <p><strong>ФИО:</strong> {{ $personName ?? 'Не указано' }}</p>
    <p><strong>Почта:</strong> {{ $email ?? 'Не указана' }}</p>
    <p><strong>Телефон:</strong> {{ $phone ?? 'Не указан' }}</p>
    <p><strong>Номинация:</strong> {{ $trackIndividual ?? 'Не указана' }}</p>
    <p><strong>Описание проекта:</strong> {!! nl2br(e($description)) ?? 'Не указано' !!}</p>
</body>
</html>
