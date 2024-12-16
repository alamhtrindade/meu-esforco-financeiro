<?php

namespace App\Domain\Task\Status\Models;

use App\Domain\Auditoria\Models\Registro;

class Status extends Registro
{
    const ID_STATUS = 'id_status';
    const NAME = 'name';
    const ACTIVE = 'active';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task.status';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = self::ID_STATUS;

    /**
     * The attributes that should be hidden.
     *
     * @var array
     */
    public $hidden = [
        "created_at", "updated_at"
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ID_STATUS,
        self::NAME,
        self::ACTIVE
    ];
}