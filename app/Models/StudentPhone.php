<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPhone extends Model
{
    use HasFactory;


    protected $table = 'student_phones';
    protected $primarykey = 'id';
    protected $fillable = [
        'student_id',
        'phone'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
