<?php

namespace App\UseCase\Project;

use App\Models\Project;

class Show
{
    /**
     * ユーザーの案件詳細情報取得
     *
     * @return Project
     */
    public function invoke(Project $project): Project
    {
        $project = Project::with(['client','tags'])
            ->where('id', $project->id)
            ->first();

        return $project;
    }
}
