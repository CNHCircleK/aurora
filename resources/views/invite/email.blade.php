Please use the following link to register:
{{ url('/register', ['code' => $invite->token, 'email' => $invite->email]) }}

Not working? Try using this invitation code to register: {{ $invite->code }}
