<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Тестовое задание</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flatpickr.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Форма обратной связи</h2>
    <form action="{{ route('feedback.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="fullname">ФИО*</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                @error('fullname')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="birthday">Дата рождения*</label>
                <input type="text" class="form-control" id="birthday" name="birthday" value="{{ old('birthday') }}" required>
                @error('birthday')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="phone">Телефон*</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Электронная почта*</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="comment">Комментарий</label>
            <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment') }}</textarea>
        </div>

        <button class="btn btn-primary mt-2" type="submit">Отправить</button>
    </form>
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('js/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/flatpickr-l10n-ru.js') }}"></script>
</body>
</html>
