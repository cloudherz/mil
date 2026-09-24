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
    <p><strong>ФИО:</strong> {{ $personName ?? 'Не указано' }}</p>
    <p><strong>Почта:</strong> {{ $email ?? 'Не указана' }}</p>
    <p><strong>Телефон:</strong> {{ $phone ?? 'Не указан' }}</p>
    <p><strong>Номинация:</strong> {{ $trackStudent ?? 'Не указана' }}</p>
    <p><strong>Описание проекта:</strong> {{ $description ?? 'Не указано' }}</p>
</body>
</html>
