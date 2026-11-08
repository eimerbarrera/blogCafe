<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Messages\MailMessage;

#[Fillable(['name', 'email', 'password', 'description', 'urlfacebook', 'urlinstagram', 'urlyoutube'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'description',
        'urlfacebook',
        'urlinstagram',
        'urlyoutube',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Enviar la notificación de restablecimiento de contraseña personalizada en español.
     */
    public function sendPasswordResetNotification($token): void
    {
        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->getEmailForPasswordReset(),
        ], false));

        $this->notify(
            (new MailMessage)
                ->subject('☕ Restablecer contraseña - Café Cosecha y Grano')
                ->greeting('¡Hola, ' . $this->name . '!')
                ->line('Estás recibiendo este correo porque hemos recibido una solicitud de recuperación de contraseña para tu cuenta.')
                ->action('Restablecer Contraseña', $url)
                ->line('Este enlace de recuperación expirará en 60 minutos.')
                ->line('Si no solicitaste un cambio de contraseña, puedes ignorar este mensaje.')
                ->salutation('Atentamente, Café Cosecha y Grano')
        );
    }
}
