<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Pivot model for agent languages
 */
class AgentLanguage extends Pivot
{
    /**
     * table name
     *
     * @var string
     */
    protected $table = "agent_language";
}