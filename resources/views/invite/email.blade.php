Please use the following link to register:
{{ action('Auth\RegisterController@showRegistrationForm', ['code' => $invite->token, 'email' => $invite->email]) }}

Not working? Try using this invitation code to register: {{ $invite->token }}
