Hello {{ $company->username }}. Your account on {{ config('app.name') }} has been created. Please click the link below to login to your account.
{{ route('login') }}. Your username is {{ $company->username }} and your password is "password. Please change your password after login. Thanks and regards.
