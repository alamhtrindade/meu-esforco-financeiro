<?php

namespace App\Domain\Task\Task\Models;

use App\Domain\Auditoria\Models\Registro;

class Task extends Registro
{
    const ID_TASK = 'id_task';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const PRIORITY_ID = 'priority_id';
    const STATUS_ID = 'status_id';
    const START_DATE = 'start_date';
    const END_DATE = 'end_date';
    const START_TIME = 'start_time';
    const END_TIME = 'end_time';


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task.task';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = self::ID_TASK;

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
        self::ID_TASK,
        self::NAME,
        self::DESCRIPTION,
        self::PRIORITY_ID,
        self::STATUS_ID,
        self::START_DATE,
        self::END_DATE,
        self::START_TIME,
        self::END_TIME,
    ];
}