<?php

namespace App\UseCase\Project;

use App\Models\Project;

class Destroy
{
    /**
     * 顧客情報削除
     *
     * @param Project $project
     * @return Project
     */
    public function invoke(Project $project): int
    {
        $project = Project::where('id', $project->id)->delete();
        return $project;
    }
}
