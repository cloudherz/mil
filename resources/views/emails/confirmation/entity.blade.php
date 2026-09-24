<!DOCTYPE html>
<html>
<head>
    <title>Ваша заявка на Премию МИЛ отправлена успешно!</title>
</head>
<body>
    <h2>Спасибо!</h2>
    <p>Ваша заявка принята и направлена на верификацию в Оргкомитет.<br>Ожидайте информацию на электронную почту.</p>
    <br>
    <h2>Указанные данные:</h2>
    <p><strong>Название организации:</strong> {{ $organizationName ?? 'Не указано' }}</p>
    <p><strong>ИНН:</strong> {{ $organizationTin ?? 'Не указан' }}</p>
    <p><strong>Представитель:</strong> {{ $organizationRepresentative ?? 'Не указан' }}</p>
    <p><strong>Почта:</strong> {{ $email ?? 'Не указана' }}</p>
    <p><strong>Телефон:</strong> {{ $phone ?? 'Не указан' }}</p>
    <p><strong>Номинация 1:</strong> {{ $track1 ?? 'Не указана' }}</p>
    <p><strong>Номинация 2:</strong> {{ $track2 ?? 'Не указана' }}</p>
    <p><strong>Номинация 3:</strong> {{ $track3 ?? 'Не указана' }}</p>
    <p><strong>Описание проекта:</strong> {{ $description ?? 'Не указано' }}</p>
</body>
</html>
