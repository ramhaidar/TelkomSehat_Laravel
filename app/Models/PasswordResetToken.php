<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordResetToken
 *
 * @property string $email
 * @property string $token
 * @property Carbon|null $created_at
 *
 * @package App\Models
 */
class PasswordResetToken extends Model
{
    protected $_table      = 'password_reset_tokens';
    protected $_primaryKey = 'email';
    public $incrementing  = false;
    public $timestamps    = false;

    protected $_hidden = [
        'token',
    ];

    protected $_fillable = [
        'token',
    ];
}
