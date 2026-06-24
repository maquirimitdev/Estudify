<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const SUPERADMIN = 'SUP';
    const ADMIN = 'ADM';
    const TEACHER = 'TCH';
    const STUDENT = 'STU';
    const PARENT = 'PAR';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function enableTwoFactorAuth() {
        $this->two_factor_secret = encrypt(Google2FA::generateSecretKey());
        $this->two_factor_backup_codes = json_encode($this->generateBackupCodes());
        $this->save();
    }
    
    public function verifyTwoFactorCode($code) {
        return Google2FA::verifyKey($this->two_factor_secret, $code);
    }

    public static function findByEmailOrUsername($emailOrUsername)
    {
        return static::where('email', $emailOrUsername)
                     ->orWhere('username', $emailOrUsername)
                     ->first();
    }

    public function isSuperAdmin(): bool {
        return $this->user_type === self::SUPERADMIN;
    }
    
    public function isAdmin(): bool {
        return $this->user_type === self::ADMIN;
    }
    
    public function isTeacher(): bool {
        return $this->user_type === self::TEACHER;
    }
    
    public function isStudent(): bool {
        return $this->user_type === self::STUDENT;
    }
    
    public function isParent(): bool {
        return $this->user_type === self::PARENT;
    }

    public function canManageUsers(): bool {
        return $this->isSuperAdmin() || $this->isAdmin();
    }
    
    // Helper: Check if user can view students
    public function canViewStudents(): bool {
        return $this->isSuperAdmin() || $this->isAdmin() || $this->isTeacher();
    }

    // Helper method to get role name
    public function getRoleName(): string
    {
        return match($this->user_type) {
            self::SUPERADMIN => 'Superadmin',
            self::ADMIN => 'Administrator',
            self::TEACHER => 'Teacher',
            self::STUDENT => 'Student',
            self::PARENT => 'Parent',
            default => 'Unknown'
        };
    }

    public function teacher() {
        return $this->hasOne(Teacher::class);
    }

    public function student() {
        return $this->hasOne(Student::class);
    }

    public function parent() {
        return $this->hasOne(Parent::class);
    }

    // Get contact number based on role
    public function getContactNumber(): ?string {
        if ($this->isTeacher()) {
            return $this->teacher->contact_number;
        } elseif ($this->isStudent()) {
            return $this->student->contact_number;
        } elseif ($this->isParent()) {
            return $this->parent->contact_number;
        }
        return null;
    }
}