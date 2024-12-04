<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Email</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Yêu cầu cung cấp Email</h2>
        <p class="text-center">
            Chúng tôi không nhận được email từ Facebook của bạn. Vui lòng cung cấp email để tiếp tục.
        </p>

        <form action="{{ route('email.save') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Nhập email của bạn" 
                    value="{{ old('email') }}" 
                    required
                >
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-3">Lưu Email</button>
        </form>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
